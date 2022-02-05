<?php
// Variables
$DirectoryToScan = "files/";
$FilesCount = 0;
$UsedSpaceInBytes = 0;
$CapacityInBytes = 200000000000;
$Files = array();
$FileTypes = array();

function file_extension($filename)
{
    $path_info = pathinfo($filename);
    return (isset($path_info['extension']) ? $path_info['extension'] : "");
}

function array_most_common($input) 
{ 
  $counted = array_count_values($input); 
  arsort($counted); 
  return(key($counted));     
}

// Returns formated string with size of file
function format_size($size) {
       $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
       if ($size == 0) { return('n/a'); } else {
       return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); }
 }

// Scan specified folder
$DirectoryContent = scandir($DirectoryToScan);
natcasesort($DirectoryContent);

$FilesCount = count($DirectoryContent) -3; // -3 is because the array contains . and .. and .htaccess

// Open a known directory, and proceed to read its contents
foreach($DirectoryContent as $File)
{
  if ($File != "." && $File != ".." && $File != ".htaccess") {
    $FileType = strtolower(file_extension($File));
    $FileSize = filesize($DirectoryToScan.$File); // Get file size in bytes
    $FileTime=date('Y-m-d H:i:s', filemtime($DirectoryToScan.$File));
    $Icon = "images/types/_blank.png";

    if(file_exists("images/types/{$FileType}.png")) {
      $Icon="images/types/{$FileType}.png";
    }

    // Add file size to the all used space value
    $UsedSpaceInBytes = $UsedSpaceInBytes + $FileSize;

    array_push($FileTypes, $FileType);
    array_push($Files, array('filename' => $File, 'icon' => $Icon, 'filetype' => $FileType, 'filesize' => format_size($FileSize), 'filecreated' => $FileTime));
  }
}

$stats[] = array('storagecapacity' => format_size($CapacityInBytes), 'usedcapacity' => format_size($UsedSpaceInBytes), 'totalfiles' => $FilesCount, 'populartype' => array_most_common($FileTypes));
$output = array();
array_push($output, array('files' => $Files, 'statistics' => $stats));

header('Content-Type: application/json');
echo(json_encode($output));

?>

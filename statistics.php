<?php
 function file_extension($filename)
{
    $path_info = pathinfo($filename);
    return $path_info['extension'];
}

function format_size($size) {
       $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
       if ($size == 0) { return('n/a'); } else {
       return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); }
 }
 
 
$adresar = 'files/';
$vypis = scandir($adresar);
sort($vypis);
echo("<table border=\"1\">");
    echo("<tr>\n");
    echo("<th>Typ</th>\n");
    echo("<th>Název souboru</th>\n");
    echo("<th>Datum nahrání</th>\n");
    echo("<th>Velikost</th>\n");
    echo("<th>Stáhnout</th>\n");
    echo("</tr>\n");
foreach($vypis as $file) { 
  if ($file != "." && $file != "..") {
    $extension=strtolower(file_extension($file));
    if(file_exists("images/types/{$extension}.png")) {
      $icon="images/types/{$extension}.png";
    } 
    else {
      $icon="images/types/_blank.png";
    }
    echo("<tr>\n");
    echo("<td><img src=\"{$icon}\" alt=\"{$extension}\" /></td>\n");
    echo("<td>{$file}</td>\n");
    $filetime=date('j.n.Y v H:i:s', filemtime($adresar.$file));
    echo("<td>{$filetime}</td>\n");
    
    $filesize=format_size(filesize($adresar.$file));
    
    echo("<td>{$filesize}</td>\n");
    echo("<td><a href=\"{$adresar}{$file}\"><img src=\"images/download.png\" alt=\"{$file} download\" /></a></td>\n");
    echo("</tr>\n");
  } 
}
echo("</table>");

 ?>
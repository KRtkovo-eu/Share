<?php
$soubor_name = ($_FILES["soubor"]["name"]);
$soubor = ($_FILES["soubor"]["tmp_name"]);
$soubor_size = ($_FILES["soubor"]["size"]);
$adresar = 'files/';

function formatURL($string) {
  $ext = substr(strrchr($string,'.'),1);
  $string = preg_replace("/\\.[^.]*$/", "", basename($string));
  $match = array("/\s+/","/[^a-zA-Z0-9\-]/","/-+/","/^-+/","/-+$/");
  $replace = array("-","","-","","");
  $string = preg_replace($match,$replace, $string);
  return $string.".".$ext;
}

if ($soubor_name!="" && $soubor_size<=209715200) {

  $soubor_nove_jmeno=formatURL($soubor_name);
  
  if (move_uploaded_file($soubor, "./{$adresar}{$soubor_nove_jmeno}")) {
    chmod ("./{$adresar}{$soubor_nove_jmeno}", 0646);
  }
}
 header("HTTP/1.1 301 Moved Permanently");
 header("Location: http://share.krtkovo.eu/");
 header("Connection: close");
?>

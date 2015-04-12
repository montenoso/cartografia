<?php

function redimensionaImaxe($fn, $target_filename_here, $w){

  $size = getimagesize($fn);
  $ratio = $size[0]/$size[1]; // width/height
  if( $ratio > 1) {
      $width = $w;
      $height = $w/$ratio;
  }
  $src = imagecreatefromstring(file_get_contents($fn));
  $dst = imagecreatetruecolor($width,$height);
  imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
  imagedestroy($src);
  imagepng($dst,$target_filename_here); // adjust format as needed
  imagedestroy($dst);  

}

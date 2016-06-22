<?php
function imageCreateFromAny($filepath) {
    $type = getImageSize($filepath)[2]; // [] if you don't have exif you could use getImageSize()
    $allowedTypes = array(
        1,  // [] gif
        2,  // [] jpg
        3,  // [] png
        6   // [] bmp
    );
    if (!in_array($type, $allowedTypes)) {
        return false;
    }
    switch ($type) {
        case 1 :
            $im = imageCreateFromGif($filepath);
        break;
        case 2 :
            $im = imageCreateFromJpeg($filepath);
        break;
        case 3 :
            $im = imageCreateFromPng($filepath);
        break;
        case 6 :
            $im = imageCreateFromBmp($filepath);
        break;
    }
    return $im;
}

function brightness($r, $g, $b) {
   return sqrt(
      $r * $r * .241 +
      $g * $g * .691 +
      $b * $b * .068);
}

function imageMeanColor($rel_path) {
   /*
      params:
         $rel_path path of the image, relative to the site's root
      returns:
         associative array containing the keys:
            "color": html hex representation of the mean color
            "brightness" 0-255 integer representation of the image's mean brightness

      basically it works like this: resample the image to a size of 1x1 pixel,
      so that the resizing algorithm averages the color for us.
      Then, read the color of that single pixel.
   */
   $impath = $_SERVER['DOCUMENT_ROOT'] . $rel_path;
   $image = imageCreateFromAny($impath);
   list($width, $height) = getimagesize($impath);

   $tmp_img = ImageCreateTrueColor(1,1);
   ImageCopyResampled($tmp_img,$image,0,0,0,0,1,1,$width,$height);
   $rgb = ImageColorAt($tmp_img,0,0);

   $red   = ($rgb >> 16) & 0xFF;
   $green = ($rgb >> 8) & 0xFF;
   $blue  =  $rgb & 0xFF;

   $ret = array();
   $ret["color"] = "#" . dechex($red) . dechex($green) . dechex($blue);
   $ret["brightness"] = brightness($red, $green, $blue);
   return $ret;
}
 ?>

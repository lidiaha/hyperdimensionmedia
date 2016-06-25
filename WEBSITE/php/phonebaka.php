<?php

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function scanSubPath($subpath) {
   $docroot = "/home/michele/polimi/Hypermedia/progetto/technology/WEBSITE";
   $files = scandir($docroot . $subpath);
   array_splice($files, 0, 2);
   for ($i=0; $i<count($files); $i++) {
      $files[$i] = $subpath . "/" . $files[$i];
   }
   return $files;
}

function recursiveScan($start, $filecback) {
   $content = scanSubPath($start);
   foreach ($content as $node) {
      if (is_dir("/home/michele/polimi/Hypermedia/progetto/technology/WEBSITE" . $node)) {
         recursiveScan($node, $filecback);
      } else {
         $filecback($node);
      }
   }
}

function saveTo($path, $data) {
   $savefile = fopen($path, "w") or die("Unable to open file!");
   fwrite($savefile, $data);
   fclose($savefile);
}

function retrieveAndCopy($filepath) {
   $baseurl = "http://127.0.0.1";
   $newhome = "/home/michele/polimi/Hypermedia/progetto/technology/WEBSITE-baka";
   $fullurl = $baseurl . $filepath;
   $newfullpath = $newhome . $filepath;
   echo "loading $fullurl <br>\n";
   $data = file_get_contents($fullurl);
   if (!is_dir(dirname($newfullpath))) {
      echo "creating dir " . dirname($newfullpath) . " <br>\n";
      mkdir(dirname($newfullpath), 0755, $recursive=true);
   }
   echo "writing to $newfullpath <br>\n";
   saveTo($newfullpath, $data);
}

recursiveScan("", "retrieveAndCopy");

 ?>

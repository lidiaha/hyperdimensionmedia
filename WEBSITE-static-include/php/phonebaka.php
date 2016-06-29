<?php

$changeback = array();
$newhome = realpath($_SERVER['DOCUMENT_ROOT'] . "/..") . "/WEBSITE-baka";

if (realpath($_SERVER['DOCUMENT_ROOT'] . "/..") == "") {
   die("Cannot generate WEBSITE-baka path");
}

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function scanSubPath($subpath, $docrootoverride="") {
   $docroot = $_SERVER['DOCUMENT_ROOT'];
   if ($docrootoverride != "") $docroot = $docrootoverride;
   $files = scandir($docroot . $subpath);
   array_splice($files, 0, 2);
   for ($i=0; $i<count($files); $i++) {
      $files[$i] = $subpath . "/" . $files[$i];
   }
   return $files;
}

function recursiveScan($start, $filecback, $docrootoverride="") {
   $docroot = $_SERVER['DOCUMENT_ROOT'];
   if ($docrootoverride != "") $docroot = $docrootoverride;
   $content = scanSubPath($start, $docrootoverride);
   foreach ($content as $node) {
      if (is_dir($docroot . $node)) {
         recursiveScan($node, $filecback, $docrootoverride);
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
   global $changeback, $newhome;
   $convert2html = false;
   $baseurl = "http://127.0.0.1";
   $oldhome = $_SERVER['DOCUMENT_ROOT'];
   $fullurl = $baseurl . $filepath;
   $oldfullpath = $oldhome . $filepath;
   $newfullpath = $newhome . $filepath;
   if (startsWith($filepath, "/pages") || startsWith($filepath, "index.php")) {
      echo "this file must be fetched from the server ($fullurl). <br>\n";
      $data = file_get_contents($fullurl);
      $convert2html = true;
   } else {
      echo "this file must be fetched from the disk ($oldfullpath). <br>\n";
      $data = file_get_contents($oldfullpath);
   }

   if (!is_dir(dirname($newfullpath))) {
      echo "creating dir " . dirname($newfullpath) . " <br>\n";
      mkdir(dirname($newfullpath), 0755, $recursive=true);
   }
   if (!$convert2html) {
      echo "writing to $newfullpath <br>\n";
      saveTo($newfullpath, $data);
   } else {
      $newfullpathhtml = preg_replace('/\\.[^.\\s]{3,4}$/', '', $newfullpath);
      $newfullpathhtml = $newfullpathhtml . ".html";
      echo "writing to ~~$newfullpath~~ -> $newfullpathhtml <br>\n";
      $changeback[$filepath] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filepath) . ".html";
      saveTo($newfullpathhtml, $data);
   }
}

function fixReferences($filepath) {
   global $changeback, $newhome;
   $fullpath = $newhome . $filepath;
   echo "processing $fullpath <br>\n";
   $data = file_get_contents($fullpath);
   foreach ($changeback as $phppath => $htmlpath) {
      $datafixedref = str_replace($phppath, $htmlpath, $data);
      if ($datafixedref != $data) {
         echo "fixed reference: $phppath -> $htmlpath in file $fullpath <br>\n";
      }
      $data = $datafixedref;
   }
   saveTo($fullpath, $data);
}
echo "<h1>scanning</h1><br>\n";
recursiveScan("", "retrieveAndCopy");
echo "<h1>fixing references</h1><br>\n";
recursiveScan("", "fixReferences", $newhome);

 ?>

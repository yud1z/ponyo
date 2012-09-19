<?php

/**
 * http://www.anzaan.com/2009/05/using-java-style-import-to-include-files-in-php/
 * Import a class using the java naming syntax for a class name.
 * use * to include all files in a package
 * @param string $name The name of the package to be imported
 * @return void
 */
$_imports = array();
function import($import) {

  // if this import has already happened, don't bother,
  if (isset($_imports[$import]) )
    return true;

  // seperate import into a package and a class
  $lastDot = strrpos($import, '.');
  $class = $lastDot ? substr($import, $lastDot + 1) : $import;
  $package = substr($import, 0, $lastDot);

  // create a folder path out of the package name
  $folder = '' . ($package ? str_replace('.', '/', $package) : '');
  $file = "$folder/$class.php";

  if ($class != '*') {
    // add the class and it's file location to the imports array
    
    if (!@include_once($file)) {
      throw new Exception('Tidak bisa meload file <font color=red>'. $file .'</font>');
    }


  } else {
    // add all the classes from this package and their file location to the imports array
    // first log the fact that this whole package was alread imported
    $_imports["$package.*"] = 1;
    $dir = opendir($folder);
    while (($file = readdir($dir)) !== false) {
      if (strrpos($file, '.php')) {
        include_once("$folder/$file");
      }
    }
  }

  $_imports[$import] = $import;
}

function bongkar($alay)
{
  echo '<pre>';
  print_r($alay);
  echo '</pre>';
}

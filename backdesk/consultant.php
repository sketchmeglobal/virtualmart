<?php 
include 'cores/comm-head.php';

  // consultant pages called from ./consultant-pages/

  if (isset($_GET['page'])) {
    // code...
  
  $path = "/consultant-pages/".$_GET['page'].'.php';
  
  $file1 = basename($path); // full file name with extension
  $file2 = basename($path, ".php"); // only file name
  
  include "consultant-pages/".$file1;

}
else{ // if not isset
  include_once "consultant-pages/consultant.php";
}

?>

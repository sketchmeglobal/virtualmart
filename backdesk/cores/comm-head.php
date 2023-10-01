<?php 

include '../function/functions.php';
if (!isset($_SESSION['id'])) {   //|| $_SESSION['admin']==false

  header('location:logout.php');

  exit();

}

 ?>
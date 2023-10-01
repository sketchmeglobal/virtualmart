<?php

/* Getting file name */
$filename = $_FILES['file']['name'];

/* Getting File size */
$filesize = $_FILES['file']['size'];

/* Location */
$location = $filename;

$return_arr = array();

/* Upload file */
if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
   
    $return_arr = array("name" => $filename,"size" => $filesize);
}

echo json_encode($return_arr);

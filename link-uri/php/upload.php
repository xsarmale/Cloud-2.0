<?php

include('session.php');


$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
//$fileType = $_FILES["file1"]["type"]; // The type of file it is
//$fileSize = $_FILES["file1"]["size"]; // File size in bytes
//$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true

$filenameE =$_SESSION['login_user']."/$fileName";

if (file_exists($filenameE)) {
    echo "The file $fileName exists!";
    exit();
} else {
    
    if (!$fileTmpLoc) { // if file not chosen
    echo "<script>alert('Nu ati selectat nici un fisier')</script>";
    exit();}
    
    if(move_uploaded_file($fileTmpLoc, "".$_SESSION['login_user']."/$fileName") && $ok=1){
    echo "$fileName upload is complete"; 

     } else {
    echo "move_uploaded_file function failed";}
}

?>
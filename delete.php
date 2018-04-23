<?php
session_start();
require_once('../connect.php');
if(!isset($_SESSION['username']) & empty($_SESSION['username'])){
  header('location: ..\login.php');
}

$username = $_SESSION['username'];
$sql = "SELECT * from `usermanagement` WHERE username='$username'";
$res = mysqli_query($connection,$sql);
$r = mysqli_fetch_assoc($res);
$profilepic = $r['profilepic'];
if (file_exists($profilepic)) {
  if(unlink($profilepic)){
    $query = "UPDATE `usermanagement` SET profilepic='' WHERE username='$username'";
    $qres = mysqli_query($connection,$query);
      if ($qres) {
        header("location: upload.php");
      }
  }
}else {
  $query = "UPDATE `usermanagement` SET profilepic='' WHERE username='$username'";
  $qres = mysqli_query($connection,$query);
    if ($qres) {
      header('location: upload.php');
    }
}



?>

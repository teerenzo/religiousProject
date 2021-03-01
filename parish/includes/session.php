<?php

session_start();

if(!isset($_SESSION['id'])){
  header("location:../parish/");
}
include("includes/connect.php");
$sel=mysqli_query($conn,"SELECT * FROM parishes where id='".$_SESSION['id']."'");
$result=mysqli_fetch_array($sel);
$data_name = $result["parish_name"];

$sel1=mysqli_query($conn,"SELECT * FROM diocese WHERE id='".$_SESSION['diocese_id']."'");
$result1=mysqli_fetch_array($sel1);
 ?>
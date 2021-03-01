<?php

session_start();

if(!isset($_SESSION['id'])){
  header("location:../central/");
}

$sel=mysqli_query($conn,"SELECT * FROM believers where log_id='".$_SESSION['id']."'");
$data_name=mysqli_fetch_array($sel);

$fname=$data_name['fname'];
$lname=$data_name['lname'];
$email_top=$data_name['email'];
$sel1=mysqli_query($conn,"SELECT * FROM parishes WHERE id='".$_SESSION['parish_id']."'");
$result1=mysqli_fetch_array($sel1);
//$cat=$result1["status"];
//$title=$result1["religionName"];
//$cat1=strtolower($cat);
//$title1=strtolower($title);

 ?>
<?php

session_start();

if(!isset($_SESSION['id'])){
  header("location:../central/");
}

$sel=mysqli_query($conn,"SELECT * FROM centrals where id='".$_SESSION['id']."'");
$result=mysqli_fetch_array($sel);
$data_name = $result["central_name"];
$name_top = $result["central_name"];
$email_top = $result["email"];

$sel1=mysqli_query($conn,"SELECT * FROM parishes WHERE id='".$_SESSION['parish_id']."'");
$result1=mysqli_fetch_array($sel1);

$Usernamedata = $conn->query("SELECT * FROM users WHERE ((user_id='".$_SESSION["id"]."') AND (user_type='central'))");
$access = mysqli_fetch_array($Usernamedata);
$username_data = $access["username"];
 ?>
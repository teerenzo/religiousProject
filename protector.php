<?php
    include("includes/connect.php");
    session_start(); // Use session variable on this page. This function must put on the top of page. 

    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!=true){  // if session variable "username" does not exist.
        echo '<script>alert("Access denied please check your credentials!.");</script>';
        echo "<script>window.location.href='/religion/religion_account/';</script>";
        // Re-direct to index.php
    }
    $id = $_SESSION["id"];
    $query_top_name = mysqli_query($conn,"SELECT * FROM believers WHERE log_id='$id'");
    $get_data = mysqli_fetch_array($query_top_name);

    $fname = $get_data["fname"];
    $lname = $get_data["lname"];
    $email_top = $get_data["email"];
?>
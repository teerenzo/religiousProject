﻿<?php
	
	include("../includes/connect.php");
	if(isset($_POST["submit"])){
		$username = $_POST["username"];
		$pass = $_POST["password"];

		$query = $conn->query("SELECT * FROM users WHERE (((username = '$username') AND (password= '$pass')AND(user_type='diocese')))");
		if(mysqli_num_rows($query) > 0){
          $usn_id = mysqli_fetch_array($query);
          $id = $usn_id["user_id"];
          session_start();
          $_SESSION["logged_in"]=True;
 		  $_SESSION['id']=$id;
			
		  header("location:homepage");

		}else{ 
			echo '<script>alert("Invalid credentials.")</script>';
		 }
		

	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catholic church services management system</title>
    <link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="../css/theme.css" rel="stylesheet">
    <link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
</head>

<body>

    <?php include("../includes/header.php"); ?>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="module module-login span4 offset4">
                    <form class="form-vertical" method="POST">
                        <div class="module-head">
                            <h3>Login as diocese</h3>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input required name="username" class="span12" type="text" id="username"
                                        placeholder="Account username">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input required name="password" class="span12" type="password" id="password"
                                        placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button id="submit" name="submit" type="submit"
                                        class="btn btn-primary pull-right btn-block"> <i class="fa fa-sign-in"
                                            aria-hidden="true"></i> Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/.wrapper-->

    <?php include("../includes/footer.php"); ?>
    <script src="../scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script>
    $(document).ready(function() {
        $("#submit").on('click', function() {
            var username = $("#username").val();
            var password = $("#password").val();
            if (username == '') {
                alert("Username must be filled.");
            } else if (password == '') {
                alert("Password field must be filled.");
            }
        })
    })
    </script>
    <script src="../scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
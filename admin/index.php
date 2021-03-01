<?php
	
	include("../includes/connect.php");
	if(isset($_POST["submit"])){
		$uname = $_POST["username"];
		$pass = $_POST["password"];

		$query = mysqli_query($conn,"SELECT * FROM users WHERE (((username = '$uname')AND(password= '$pass')AND(user_type='admin')))");
		if(mysqli_num_rows($query) > 0){
          $un_id = mysqli_fetch_array($query);
          $id = $un_id["id"];
          session_start();
          $_SESSION['logged_in'] = True;
          $_SESSION['id']=$id;			
		  header("location:homepage");

		}else{ 
			echo '<script>alert("Wrong Username or password.")</script>';
		 }
		

	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catholic church management information system</title>
    <link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="../css/theme.css" rel="stylesheet">
    <link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
</head>

<body>

    <?php include("includes/header.php"); ?>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="module module-login span4 offset4">
                    <form class="form-vertical" method="POST">
                        <div class="module-head">
                            <h3>System admin authentication</h3>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input name="username" class="span12" type="text" id="inputEmail"
                                        placeholder="Username">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input name="password" class="span12" type="password" id="inputPassword"
                                        placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button name="submit" type="submit" class="btn btn-primary btn-block pull-right"> <i
                                            class="fa fa-sign-in" aria-hidden="true"></i> Login</button>
                                </div>
                                <hr>
                                <div class="control-group">
                                    <div class="controls row-fluid">
                                        <a class="float-left" href="/religion/">back to home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/.wrapper-->

    <?php include("includes/footer.php"); ?>
    <script src="../scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
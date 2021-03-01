<?php
	
	include("includes/connect.php");
	if(isset($_POST["submit"])){
		$id = $_POST["mid"];
		$pass = $_POST["password"];

		$query = mysqli_query($conn,"SELECT * FROM users WHERE (((username = '$id') AND (password= '$pass')and(user_type='believer')))");
		if(mysqli_num_rows($query) > 0){
            $get_data=mysqli_fetch_array($query);
            $log_id=$get_data['user_id'];
            $sel=$conn->query("SELECT * FROM believers WHERE log_id='$log_id'");
            $result=mysqli_fetch_array($sel);
            $parish_id=$result['parish_id'];
          //  echo $parish_id;
		  session_start();
          $_SESSION['id']=$id;
          $_SESSION['logged_in'] = True;
          $_SESSION['parish_id']=$parish_id;
         // $_SESSION['rel_id'] = $rel_id;
		  header("location:homepage");

		}else{ 
			echo '<script>alert("Wrong login ID or password.")</script>';
		 }
		

	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religious computerised services system</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
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
                            <h3>Login as member</h3>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input name="mid" class="span12" type="text" id="inputEmail"
                                        placeholder="Member ID">
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/.wrapper-->

    <?php include("includes/footer.php"); ?>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
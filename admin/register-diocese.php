<?php
    include("../includes/connect.php");
    session_start(); // Use session variable on this page. This function must put on the top of page. 

    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!=true){  // if session variable "username" does not exist.
        echo '<script>alert("Access denied please check your credentials!.");</script>';
        echo "<script>window.location.href='/religion/admin/';</script>";
        // Re-direct to index.php
    }
    if (isset($_POST["submit"])){
        $name  = $_POST["d-name"];
        $short_desc = $_POST["short-desc"];
        $email = strtolower($_POST["email"]);
        $phone = $_POST["phone"];
        $type = "diocese";
        $username = strtolower($name."123");
        $pass = "123456"; 
        if(empty($email) || empty($phone)){
            echo '<script>alert("Field must be filled.");</script>';
            echo "<script>window.location.href='register-diocese';</script>";
        }else{
        $check_exist = mysqli_query($conn,"SELECT * FROM diocese WHERE diocese_name='$name'");
        if (mysqli_num_rows($check_exist) > 0){
            echo '<script>alert("Diocese already exist.");</script>';
            echo "<script>window.location.href='register-diocese';</script>";
        }else{
            $query = mysqli_query($conn,"INSERT INTO diocese(diocese_name,short_descriptions,email,phone) VALUES('$name','$short_desc','$email','$phone')");
            if($query){
                $did = $conn->query("SELECT * FROM diocese WHERE diocese_name='$name'");
                $uid_fetch = mysqli_fetch_array($did);
                $uid_data = $uid_fetch["id"];
                $user_add_qry = $conn->query("INSERT INTO users(username,password,user_type,user_id) VALUES('$username','$pass','$type','$uid_data')");
                if ($user_add_qry){
                    echo '<script>alert("Diocese has registered successfully");</script>';
                    echo "<script>window.location.href='register-diocese';</script>";
                    }
                }
            }
        } 
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>System admin</title>
        <link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../css/theme.css" rel="stylesheet">
        <link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>

<body>
    <?php include("includes/nav-top.php"); ?>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <?php include("includes/sidebar.php"); ?>
                </div>
                <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Register Diocese</h3>
                            </div>
                            <div class="module-body">

                                <form method="POST">
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Diocese name</label>
                                        <select name="d-name" class="span8 form-control" id="">
                                            <option value="" disabled selected>Select diocese</option>
                                            <option value="Kigali">Kigali</option>
                                            <option value="Butare">Butare</option>
                                            <option value="Byumba">Byumba</option>
                                            <option value="Cyangugu">Cyangugu</option>
                                            <option value="Gikongoro">Gikongoro</option>
                                            <option value="Kabgayi">Kabgayi</option>
                                            <option value="Kibungo">Kibungo</option>
                                            <option value="Ruhengeri">Ruhengeri</option>
                                            <option value="Nyundo">Nyundo</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Short descriptions
                                            (Optional)</label>
                                        <textarea name="short-desc" placeholder="Short descriptions"
                                            class="span8 form-control" id="" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Email </label>
                                        <input type="text" name='email' id="basicinput" placeholder="Email address"
                                            required="" class="span8 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Phone number</label>
                                        <input type="text" name='phone' id="basicinput" placeholder="Phone number"
                                            required="" class="span8 form-control">
                                    </div>

                                    <div class="control-group">
                                        <div class="controls">
                                            <button name="submit" class="btn btn-primary" type="submit"
                                                class="btn">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <?php include("includes/admin-footer.php"); ?>
    <script src="../scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="../scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="../scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../scripts/common.js" type="text/javascript"></script>

</body>
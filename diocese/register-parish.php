<?php
    include("../includes/connect.php");
    include("protector.php");
    $id = $_SESSION["id"];

    if (isset($_POST["submit"])){
        $name  = $_POST["parish_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $username = strtolower($name."123");
        $pass = "123456";
        $logo = 'parish.png';
        //$dios = $_POST["dios"];
        if(empty($name)){
            echo '<script>alert("Field must be filled.");</script>';
            //echo "<script>window.location.href='new-ctg';</script>";
        }else{
        $check_name = $conn->query("SELECT * FROM parishes WHERE (parish_name='$name')");
        if (mysqli_num_rows($check_name) > 0){
            echo '<script>alert("Parish you entered is already exist.");</script>';
            echo "<script>window.location.href='register-parish';</script>";
        }else{
            $query = $conn->query("INSERT INTO parishes(parish_name,diocese_id,email,phone) VALUES('$name','".$_SESSION["id"]."','$email','$phone')");
            if($query){             
                $sel_id = $conn->query("SELECT id,parish_name FROM parishes WHERE parish_name='$name'");
                $data_id=mysqli_fetch_array($sel_id);
                $query1 = $conn->query("INSERT INTO users(username,password,user_type,user_id) VALUES('$username','$pass','parish','".$data_id[0]."')");
                 if($query1){
                    echo '<script>alert("Parish registration successful.");</script>';
                    echo "<script>window.location.href='register-parish';</script>";
                 }else{
                    echo '<script>alert("Error in registration.");</script>';
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
        <title>Parish registration</title>
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
                                <h3>Parish registration</h3>
                            </div>
                            <div class="module-body">

                                <form method="POST">

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Parish name</label>
                                        <input type="text" name='parish_name' id="basicinput"
                                            placeholder="Type parish name" required="" class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Email</label>
                                        <input type="email" name="email" id="" required placeholder="Email address"
                                            class="form-control span8">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Phone number</label>
                                        <input type="number" name="phone" id="" required placeholder="Phone number"
                                            class="form-control span8">
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
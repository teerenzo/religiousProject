<?php
    include("includes/connect.php");
        include 'includes/session.php';
 // Use session variable on this page. This function must put on the top of page. 


    $get_admin = $conn->query("SELECT * FROM users WHERE user_id='".$_SESSION["id"]."' AND user_type='believer'");
    $fetch_data = mysqli_fetch_array($get_admin);
    if (isset($_POST["change-info"])){
        $username = $_POST["username"];
        $currpass = $_POST["currpass"];
        $getPass = $conn->query("SELECT * FROM users WHERE user_id='".$_SESSION["id"]."' AND user_type='believer'");
        $get_userInfo = mysqli_fetch_array($getPass);
        $current_pas = $get_userInfo["password"];
        if (empty($currpass)){
            echo '<script>alert("Enter password to continue.");</script>';
        }else{
        if($currpass != $current_pas){
            echo '<script>alert("Wrong password for this account.");</script>';
        }else{
            $check_username = $conn->query("SELECT * from users WHERE username='$username' AND user_type='believer'");
            if($get_userInfo["username"] != $username){
                if(mysqli_num_rows($check_username) > 0){
                    echo '<script>alert("Username already exist");</script>';
                    echo "<script>window.location.href='profile';</script>";
                }else{
                    $query = $conn->query("UPDATE users SET username='$username' WHERE user_id='".$_SESSION["id"]."' AND user_type='central'");
                    echo '<script>alert("Profile updated successfully.");</script>';
                    echo "<script>window.location.href='profile';</script>";
                }
            }else{
                    echo '<script>alert("Username still the same.");</script>';
                    echo "<script>window.location.href='profile';</script>";
            }
            
        }
    }
}


if(isset($_POST["save-pass"])){
    $old_pass = $_POST["old-pass"];
    $new_pass = $_POST["new-pass"];
    $conf_pass  =$_POST["conf-pass"];
    $getPass = $conn->query("SELECT * FROM users WHERE user_id='".$_SESSION["id"]."' AND user_type='believer'");
    $get_userInfo = mysqli_fetch_array($getPass);
    $current_pas = $get_userInfo["password"];
    if(empty($old_pass)){
        echo '<script>alert("Enter password to continue.");</script>';
    }else if(empty($new_pass)){
        echo '<script>alert("You must enter new password to continue.");</script>';

    }else if(empty($conf_pass)){
        echo '<script>alert("Please confirm your password to continue.");</script>';
    }else if($new_pass != $conf_pass){
        echo '<script>alert("Passwords did not much.");</script>';

    }else{
    if($old_pass != $current_pas){
        echo '<script>alert("Wrong password for this account.");</script>';
    }else{
            $change_pass = $conn->query("UPDATE users SET password='$new_pass' WHERE user_id='".$_SESSION["id"]."' AND user_type='believer'");
            if ($change_pass){
                echo '<script>alert("Account password updated successfully.");</script>';
                echo "<script>window.location.href='profile';</script>";
            }else{
                echo "Error".mysqli_error($conn);
            }
        }
    }
}

?>
<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Catholic church services management information system </title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
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
                    <!--/.sidebar-->
                </div>
                <!--/.span3-->
                <div class="span9">
                    <div class="content">
                        <div class="module">
                            <div class="module-body">
                                <div class="profile-head media">
                                    <a href="#" class="media-avatar pull-left">
                                        <img src="images/user.png">
                                    </a>
                                    <div class="media-body">
                                        <h4>
                                           Believer <small></small>
                                        </h4>
                                        <p class="profile-brief">
                                            
                                        </p>
                                    </div>
                                </div>

                                <ul class="profile-tab nav nav-tabs">
                                    <li class="active"><a href="#activity" data-toggle="tab">Account</a></li>
                                    <li><a href="#settings" data-toggle="tab">Account settings</a></li>
                                    <li><a href="#change-password" data-toggle="tab">Change password</a></li>
                                </ul>
                                <div class="profile-tab-content tab-content">
                                    <div class="tab-pane fade active in" id="activity">
                                        <div class="stream-list">
                                            <div class="media stream">
                                                <div class="media-body">
                                                    <h4>
                                                        Log_Id
                                                    </h4>
                                                    <p class="profile-brief">
                                                        <?php echo $fetch_data["username"]; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="settings">
                                        <div class="module-option clearfix">
                                            <h5>Change account settings</h5>
                                        </div>
                                        <div class="module-body">
                                            <div class="row-fluid">
                                                <div class="span8">
                                                    <form method="POST">
                                                        <div class="form-group">
                                                            <label class="control-label" for="basicinput">Log_Id
                                                            </label>
                                                            <input type="text" name='username' id="basicinput"
                                                                placeholder="username" required=""
                                                                value="<?php echo $fetch_data["username"];  ?>"
                                                                class="span8 form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label" for="basicinput">Current
                                                                password
                                                            </label>
                                                            <input type="password"  name='currpass' id="basicinput"
                                                                placeholder="Current password"
                                                                class="span8 form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="span8">
                                                                <button type="submit" name="change-info"
                                                                    class="btn btn-primary btn-block">Save
                                                                    Changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--/.row-fluid-->
                                            <br />

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="change-password">
                                        <div class="module-option clearfix">
                                            <h5>Change password</h5>
                                        </div>
                                        <div class="module-body">
                                            <div class="row-fluid">
                                                <div class="span8">
                                                    <form method='post'>
                                                        <div class="form-group">
                                                            <label class="control-label" for="basicinput">Current
                                                                password
                                                            </label>
                                                            <input type="password" name='old-pass' id="basicinput"
                                                                placeholder="Current password"
                                                                class="span8 form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="basicinput">New password
                                                            </label>
                                                            <input type="password" name='new-pass' id="basicinput"
                                                                placeholder="New password" class="span8 form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="basicinput">Confirm
                                                                password
                                                            </label>
                                                            <input type="password" name='conf-pass' id="basicinput"
                                                                placeholder="Confirm password"
                                                                class="span8 form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="span8">
                                                                <button type="submit" name="save-pass"
                                                                    class="btn btn-primary btn-block">Save
                                                                    Changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--/.row-fluid-->
                                            <br />

                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!--/.module-body-->
                        </div>
                        <!--/.module-->
                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <?php include("includes/footer.php"); ?>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="scripts/common.js" type="text/javascript"></script>

</body>
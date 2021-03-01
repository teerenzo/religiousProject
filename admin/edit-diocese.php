<?php
    include("../includes/connect.php");
    session_start(); // Use session variable on this page. This function must put on the top of page. 

    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!=true){  // if session variable "username" does not exist.
        echo '<script>alert("Access denied please check your credentials!.");</script>';
        echo "<script>window.location.href='/religion/admin/';</script>";
        // Re-direct to index.php
    }
$get_id = $_GET["rel_id"];
    if(isset($_POST["submit"])){
        $name  = $_POST["rel"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $desc = $_POST["short-desc"];
        if(empty($name) || empty($phone) || empty($email)){
            echo '<script>alert("Field must be filled.");</script>';
            //echo "<script>window.location.href='new-ctg';</script>";
        }else{
        $select_status = mysqli_query($conn,"SELECT * FROM diocese WHERE diocese_name='$name'");
        if (mysqli_num_rows($select_status) > 0){
            echo '<script>alert("Religion already exist.");</script>';
            echo "<script>window.location.href='edit-diocese?rel_id=$get_id';</script>";
        }else{
            $query = $conn->query("UPDATE diocese SET diocese_name='$name', email='$email', phone='$phone', short_descriptions='$des' WHERE id='".$_GET['rel_id']."'");
            if($query){
               
                echo '<script>alert("Religion updated successfully");</script>';
                echo "<script>window.location.href='religions';</script>";
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
        <title>Religion admin</title>
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
                <?php 
                
                    $select_t = $conn->query("SELECT * FROM diocese where id='".$_GET["rel_id"]."'");
                    $fetch_qry = mysqli_fetch_array($select_t); 
                ?>
                <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Edit religion</h3>
                            </div>
                            <div class="module-body">

                                <form method="POST">
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Diocese name</label>
                                        <select name="name" value="" class="span8 form-control" id="">
                                            <option value="<?php echo $fetch_qry['diocese_name']; ?>" disabled selected>
                                                <?php echo $fetch_qry['diocese_name']; ?>
                                            </option>
                                            <option value="">Kigali</option>
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
                                            class="span8 form-control" id="" cols="30"
                                            rows="5"><?php echo $fetch_qry['short_descriptions']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Email </label>
                                        <input type="text" value="<?php echo $fetch_qry['email']; ?>" name='email'
                                            id="basicinput" placeholder="Email address" required=""
                                            class="span8 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Phone number</label>
                                        <input type="text" value="<?php echo $fetch_qry['phone']; ?>" name='phone'
                                            id="basicinput" placeholder="Phone number" required=""
                                            class="span8 form-control">
                                    </div>

                                    <div class="control-group">
                                        <div class="controls">
                                            <button name="submit" class="btn btn-primary" type="submit"
                                                class="btn">Update</button>
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
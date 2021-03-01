<?php
    include("../includes/connect.php");
    include("protector.php");
    $id = $_SESSION["id"];

    if (isset($_POST["submit"])){
        $name  = $_POST["sac"];

        if(empty($name)){
            echo '<script>alert("Field must be filled.");</script>';
            //echo "<script>window.location.href='new-ctg';</script>";
        }else{
            $sacra_id = $conn->query("SELECT * FROM sacraments WHERE sacrament_name='$name'");
            $fetch_data = mysqli_fetch_array($sacra_id);
            $sid = $fetch_data["sacrament_id"];
            $get_sacra = $conn->query("SELECT * FROM religion_sacraments where ((sacrament_id='$sid') and (religionId='".$_SESSION['id']."'))");
            if(mysqli_num_rows($get_sacra) > 0){
                echo '<script>alert("Sacrament already registered.");</script>';
            }else{
            $query = $conn->query("INSERT INTO religion_sacraments(religionId,sacrament_id) VALUES('".$_SESSION['id']."','$sid')");
            if($query){
                echo '<script>alert("Sacrament submitted.");</script>';
                }
            }
        
        }
    }
            $ch_data = $conn->query("SELECT * FROM churches WHERE religionId='".$_SESSION["id"]."'");
            $stat_data = mysqli_fetch_array($ch_data);
    
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register sacrament</title>
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
                                <h3>Sacrament registration</h3>
                            </div>
                            <div class="module-body">

                                <form method="POST">
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Name</label>
                                        <select required="" name="sac">
                                            <option value="" disabled selected>Select sacrament</option>
                                            <?php 
                                            if($lwrname == "catholic" && $lwrstatus =='christians'){
                                         $sel=$conn->query("SELECT * FROM sacraments");
                                         while($result=mysqli_fetch_array($sel)){ ?>
                                            <option><?php echo $result["sacrament_name"]; ?></option>
                                            <?php }
                                            }else{
                                                $sel=$conn->query("SELECT * FROM sacraments WHERE ((sacrament_name != 'eucharist') AND (sacrament_name!='sustenance'))");
                                                while($result=mysqli_fetch_array($sel)){ ?>
                                            <option><?php echo $result["sacrament_name"]; ?></option>
                                            <?php } }?>

                                        </select>
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
<?php
    include("../includes/connect.php");
    session_start(); // Use session variable on this page. This function must put on the top of page. 

    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!=true){  // if session variable "username" does not exist.
        echo '<script>alert("Access denied please check your credentials!.");</script>';
        echo "<script>window.location.href='/religion/admin/';</script>";
        // Re-direct to index.php
    }
?>
<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Catholic church services M.I.S | Homepage</title>
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
                    <!--/.sidebar-->
                </div>
                <!--/.span3-->
                <div class="span9">
                    <div class="content">
                        <div class="btn-controls">
                            <div class="btn-box-row row-fluid">
                                <?php 
                                    $count_diocese = mysqli_query($conn,"SELECT COUNT(id) FROM diocese");
                                    while($row = mysqli_fetch_array($count_diocese))
                                    {
                                        $total_dios = $row[0];
                                    break;
                                    }
                                    $count_parish = mysqli_query($conn,"SELECT COUNT(id) FROM parishes");
                                    while($row = mysqli_fetch_array($count_parish))
                                    {
                                        $total_parish = $row[0];
                                    break;
                                    }
                                    $count_centrals = mysqli_query($conn,"SELECT COUNT(id) FROM centrals");
                                    while($row = mysqli_fetch_array($count_centrals))
                                    {
                                        $total_centrals = $row[0];
                                    break;
                                    }
                                    $count_sucursals = mysqli_query($conn,"SELECT COUNT(id) FROM sucursals");
                                    while($row = mysqli_fetch_array($count_sucursals))
                                    {
                                        $total_suc = $row[0];
                                    break;
                                    }
                                    $count_basic_ch = mysqli_query($conn,"SELECT COUNT(id) FROM basic_churches");
                                    while($row = mysqli_fetch_array($count_basic_ch))
                                    {
                                        $total_basic = $row[0];
                                    break;
                                    }
                                    $count_believers = mysqli_query($conn,"SELECT COUNT(id) FROM diocese");
                                    while($row = mysqli_fetch_array($count_believers))
                                    {
                                        $total_christ = $row[0];
                                    break;
                                    }

                                ?>
                                <a href="#" class="btn-box big span4">
                                    <i class="fa fa-institution" aria-hidden="true"></i>
                                    <b><?php echo $total_dios; ?></b>
                                    <p class="text-muted">Diocese</p>
                                </a>

                                <a href="#" class="btn-box big span4"><i class="fa fa-server"></i><b>Parishes</b>
                                    <p class="text-muted">
                                        <?php echo $total_parish; ?></p>
                                </a>

                                <a href="#" class="btn-box big span4"><i class="fa fa-list"></i><b>Centrals</b>
                                    <p class="text-muted">
                                        <?php echo $total_centrals; ?></p>
                                </a>
                                <a href="#" class="btn-box big span4"><i class="fa fa-bell"></i><b>Sucursals</b>
                                    <p class="text-muted">
                                        <?php echo $total_suc; ?></p>
                                </a>
                                <a href="#" class="btn-box big span4"><i class="fa fa-home"></i><b>Basic churches</b>
                                    <p class="text-muted">
                                        <?php echo $total_basic; ?></p>
                                </a>
                                <a href="#" class="btn-box big span4"><i class="fa fa-users"></i><b>Christians</b>
                                    <p class="text-muted">
                                        <?php echo $total_christ; ?></p>
                                </a>
                            </div>
                        </div>
                        <!--/#btn-controls-->
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
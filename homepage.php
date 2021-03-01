<?php
    include("protector.php");
?>
<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Religious Computerised services system | Homepage</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>

<body>

    <?php 
    include("includes/nav-top.php"); 
    ?>
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

                                 <a href="#" class="btn-box big span4"><i class="fa fa-users"></i><b>Baptised</b>
                                    <br>
                                    <p class="text-muted">
                                        <?php
                                       $sel=$conn->query("SELECT * FROM sacrament_issuing WHERE believer_id='".$_SESSION['id']."' AND issue='Baptism'");
                                       if(mysqli_num_rows($sel) != null){
                                        echo "Yes";
                                       }else{
                                        echo "not yet";
                                       }
                                        ?>
                                    </p>
                                </a>

                              
                                <a href="#" class="btn-box big span4"><i class="fa fa-users"></i><b>Eucharist</b>
                                    <br>
                                    <p class="text-muted">
                                        <?php
                                       $sel=$conn->query("SELECT * FROM sacrament_issuing WHERE believer_id='".$_SESSION['id']."' AND issue='Eucharist'");
                                       if(mysqli_num_rows($sel) != null){
                                        echo "Yes";
                                       }else{
                                        echo "not yet";
                                       }
                                        ?>
                                    </p>
                                </a>

                                <a href="#" class="btn-box big span4">
                                    <i class="fa fa-server" aria-hidden="true"></i> <b> Sustenance </b>
                                    <br>
                                    <p class="text-muted"> <?php
                                       $sel=$conn->query("SELECT * FROM sacrament_issuing WHERE believer_id='".$_SESSION['id']."' AND issue='Sustenance'");
                                       if(mysqli_num_rows($sel) != null){
                                        echo "Yes";
                                       }else{
                                        echo "not yet";
                                       }?></p>
                                </a>



                            </div>
                            <div class="btn-box-row row-fluid">
                                <div class="span8">


                                </div>

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
    <?php include("admin/includes/admin-footer.php"); ?>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="scripts/common.js" type="text/javascript"></script>

</body>
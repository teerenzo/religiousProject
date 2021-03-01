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
        <title>Catholic church services MIS | Homepage</title>
        <link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../css/theme.css" rel="stylesheet">
        <link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
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
                                <?php 
                                    $total_centrals=0;
                                    $total_christ=0;
                                    $total_suc=0;
                                    $count_parish = mysqli_query($conn,"SELECT COUNT(id) FROM parishes WHERE diocese_id='".$_SESSION["id"]."'");
                                    while($row = mysqli_fetch_array($count_parish))
                                    {
                                        $total_parish = $row[0];
                                  
                                    }
                                    //------------------- get numbers ------------------------------  
                                    $get_par_id = $conn->query("SELECT * FROM parishes WHERE diocese_id='".$_SESSION["id"]."'");
                                    while($par_row = mysqli_fetch_array($get_par_id)){
                                        $par_id = $par_row["id"];
                                                     
                                    $count_centrals = mysqli_query($conn,"SELECT COUNT(id) FROM centrals WHERE parish_id='$par_id'");
                                    while($row = mysqli_fetch_array($count_centrals))
                                    {
                                        @$total_centrals = $row[0];
                               
                                    }
                                    $count_sucursals = mysqli_query($conn,"SELECT COUNT(id) FROM sucursals where parish_id='$par_id'");
                                    while($row = mysqli_fetch_array($count_sucursals))
                                    {
                                        @$total_suc = $row[0];
                                 
                                    }

                                     //------------------- get numbers ------------------------------  
                                    $get_cent_id = $conn->query("SELECT * FROM centrals WHERE parish_id='$par_id'");
                                    while($cent_row = mysqli_fetch_array($get_cent_id)){
                                        $cent_id = $cent_row["id"];
                                       
                                    $get_suc_id = $conn->query("SELECT * FROM sucursals WHERE central_id='$cent_id'");
                                    while($suc_row = mysqli_fetch_array($get_suc_id)){
                                        $suc_id = $suc_row["id"];
                                    
            
                                        }
                                    }
                                    $count_believers = mysqli_query($conn,"SELECT COUNT(believer_ID) FROM believers WHERE parish_id='$par_id'");
                                    while($row = mysqli_fetch_array($count_believers))
                                    {
                                        @$total_christ = $row[0];
                      
                                    }
                                }
                            
                                ?>

                                <a href="parishes" class="btn-box big span4"><i class="fa fa-server"></i><b>Parishes</b>
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
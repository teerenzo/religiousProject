<?php
include 'includes/connect.php';
include 'includes/session.php';


?>

<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Parish | Homepage</title>
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
                                $get_cent = $conn->query("SELECT * FROM centrals WHERE id='" . $_SESSION["id"] . "'");
                                $data_cent = mysqli_fetch_array($get_cent);
                                $cent_name = $data_cent["central_name"];
                                $parish_id  = $data_cent["parish_id"];
                                $count_religions = mysqli_query($conn, "SELECT COUNT(believer_ID) FROM believers WHERE ((central_name='$cent_name') AND (parish_id='$parish_id'))");
                                while ($row = mysqli_fetch_array($count_religions)) {
                                    $total = $row[0];
                                }

                                ?>
                                <a href="members" class="btn-box big span4">
                                    <i class="fa fa-institution" aria-hidden="true"></i> <b><?php echo $total; ?></b>
                                    <p class="text-muted">
                                        <main>Member(s)</main>
                                    </p>
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
    <?php include("includes/admin-footer.php"); ?>
    <script src="../scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="../scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="../scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="../scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../scripts/common.js" type="text/javascript"></script>

</body>
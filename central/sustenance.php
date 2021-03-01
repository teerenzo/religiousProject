<?php
    include("../includes/connect.php");

    include 'includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baptised christians</title>
    <link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="../css/theme.css" rel="stylesheet">
    <link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
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
                            <div class="module-head">
                                <h3>Sustened christians</h3>
                            </div>
                            <div class="module-body col-lg-12">
                                <table cellpadding="0" cellspacing="0" border="0"
                                    class="datatable-1 table-responsive table table-bordered table-striped	 display"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>Names</th>
                                            <th>National ID</th>
                                            <th>Email</th>
                                            <th>System ID</th>
                                            <th>Sustened date</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $qr_religions = mysqli_query($conn,"SELECT believers.fname,believers.lname,believers.id_number,believers.log_id,believers.email,believers.church_id,believers.date_of_birth,sacrament_issuing.date,sacrament_issuing.issue,sacrament_issuing.church_sacra_id,sacrament_issuing.believer_id,sacrament_issuing.id FROM believers INNER JOIN sacrament_issuing ON believers.log_id=sacrament_issuing.believer_id WHERE ((believers.church_id='".$_SESSION['id']."')AND(sacrament_issuing.issue='Sustenance'))");
                                            while($row = mysqli_fetch_array($qr_religions)){
                                        ?>
                                        <tr>
                                            <td><?php echo $row["fname"]." ".$row["lname"] ?></td>
                                            <td><?php echo $row["id_number"] ?></td>
                                            <td><?php echo $row["email"]; ?></td>
                                            <td><?php echo $row["log_id"]; ?></td>
                                            <td><?php echo $row["date"]; ?></td>


                                            <td><a onclick="return confirm('Do you want to delete this record ?')"
                                                    class="btn btn-danger btn-xs"
                                                    href="remove-sust?member_id=<?php echo $row["id"]; ?>"> <i
                                                        class="fa fa-remove" aria-hidden="true"></i> Remove</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!--/.module-->

                        <br />

                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->

    <?php include("includes/footer.php"); ?>

    <script src="../scripts/jquery-1.9.1.min.js"></script>
    <script src="../scripts/jquery-ui-1.10.1.custom.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../scripts/datatables/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function() {
        $('.datatable-1').dataTable();
        $('.dataTables_paginate').addClass("btn-group datatable-pagination");
        $('.dataTables_paginate > a').wrapInner('<span />');
        $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
        $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    });
    </script>
</body>
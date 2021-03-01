<?php
    include("../includes/connect.php");
    session_start(); // Use session variable on this page. This function must put on the top of page. 

    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!=true){  // if session variable "username" does not exist.
        echo '<script>alert("Access denied please check your credentials!.");</script>';
        echo "<script>window.location.href='/religion/admin/';</script>";
        // Re-direct to index.php
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christians</title>
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
    <?php  
    
    if(isset($_GET['change'])){ ?>
    <script>
    alert('<?php echo $_GET["change"]; ?>')
    </script>
    <?php } ?>


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
                                <h3>Christians</h3>
                            </div>
                            <div class="module-body col-lg-12">
                                <table cellpadding="0" cellspacing="0" border="0"
                                    class="datatable-1 table-responsive table table-bordered table-striped	 display"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>Full name</th>
                                            <th>ID number</th>
                                            <th>Date of birth</th>
                                            <th>Parish name</th>
                                            <th>Diocese</th>
                                            <th>View more</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $qr_religions = mysqli_query($conn,"SELECT * FROM believers");
                                            while($row = mysqli_fetch_array($qr_religions)){
                                                $row_id = $row["believer_ID"];
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row["fname"]." ".$row["lname"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["id_number"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["date_of_birth"]; ?>
                                            </td>

                                            <td>
                                                <?php $get_par = $conn->query("SELECT * FROM parishes WHERE id='".$row['parish_id']."'"); 
                                                    while($par_row = mysqli_fetch_array($get_par)){
                                                        echo $par_row["parish_name"];  
                                                    
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                        $get_dioceseONpar = $conn->query("SELECT * FROM diocese WHERE id='".$par_row['diocese_id']."'");
                                                        while($getItem = mysqli_fetch_array($get_dioceseONpar)){
                                                            echo $getItem["diocese_name"];
                                                        
                                                ?>

                                            </td>
                                            <td>
                                                <a href="christian-info?mid=<?php echo $row["believer_ID"]; ?>"
                                                    class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i>
                                                    View more info.</a>
                                            </td>
                                            <?php  
                                                    }
                                                }
                                            }
                                        ?>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Full name</th>
                                            <th>ID number</th>
                                            <th>Date of birth</th>
                                            <th>Parish name</th>
                                            <th>Diocese</th>
                                            <th>View more</th>
                                        </tr>
                                    </tfoot>
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
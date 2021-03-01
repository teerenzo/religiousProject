<?php
    include("protector.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursals</title>
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
                                <h3>Basic Churches</h3>
                            </div>
                            <div class="module-body col-lg-12">
                                <table cellpadding="0" cellspacing="0" border="0"
                                    class="datatable-1 table-responsive table table-bordered table-striped	 display"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>Basic church name</th>
                                            <th>Sucursal name</th>
                                            <th>Central name</th>
                                            <th>Parish name</th>
                                            <th>Diocese</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $get_parish = $conn->query("SELECT * FROM parishes WHERE diocese_id='".$_SESSION["id"]."'");
                                            while($row_p = mysqli_fetch_array($get_parish)){
                                                $parish_id = $row_p["id"];   
                                            }
                                            $get_central = $conn->query("SELECT * FROM centrals WHERE parish_id='$parish_id'");
                                            while($central_id = mysqli_fetch_array($get_central)){
                                                $cent_id = $central_id["id"];
                                            }
                                            $qr_religions = mysqli_query($conn,"SELECT * FROM basic_churches where parish_id='$parish_id'");
                                            while($row = mysqli_fetch_array($qr_religions)){
                                                $row_id = $row["id"];
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row["name"] ?>
                                            </td>
                                            <td>
                                                <?php $get_suc = $conn->query("SELECT * FROM sucursals WHERE id='".$row['sucursal_id']."'"); 
                                                        while($suc_row = mysqli_fetch_array($get_suc)){
                                                            echo $suc_row["suc_name"]; 
                                                          
                                                ?>
                                            </td>
                                            <td>
                                                <?php $get_cent = $conn->query("SELECT * FROM centrals WHERE id='".$suc_row['central_id']."'"); 
                                                    while($cent_row = mysqli_fetch_array($get_cent)){
                                                        echo $cent_row["central_name"];  
                                                    
                                                ?>
                                            </td>
                                            <td>
                                                <?php $get_par = $conn->query("SELECT * FROM parishes WHERE id='".$cent_row['parish_id']."'"); 
                                                    while($par_row = mysqli_fetch_array($get_par)){
                                                        echo $par_row["parish_name"];  
                                                    
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                        $get_dioceseONpar = $conn->query("SELECT * FROM diocese WHERE id='".$par_row['diocese_id']."'");
                                                        while($getItem = mysqli_fetch_array($get_dioceseONpar)){
                                                            echo $getItem["diocese_name"];
                                                        }
                                                    }
                                                }
                                                ?>

                                            </td>
                                        </tr>
                                        <?php  } } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Basic church name</th>
                                            <th>Sucursal name</th>
                                            <th>Central name</th>
                                            <th>Parish name</th>
                                            <th>Diocese</th>
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
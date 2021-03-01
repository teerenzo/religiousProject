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
                                <h3>Married christians</h3>
                            </div>
                            <div class="module-body col-lg-12">
                                <table cellpadding="0" cellspacing="0" border="0"
                                    class="datatable-1 table-responsive table table-bordered table-striped	 display"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>Partner 1</th>
                                            <th>Partner 2</th>
                                            <th>Married date</th>
                                            <th>View more</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $qr_religions = mysqli_query($conn, "SELECT * from marriage WHERE parish_id='" . $_SESSION["id"] . "'");
                                        while ($row = mysqli_fetch_array($qr_religions)) {
                                            $get_user1 = $conn->query("SELECT * FROM believers WHERE log_id='" . $row["partner_1_ID"] . "'");
                                            $dataU1 = mysqli_fetch_array($get_user1);
                                            $get_user2 = $conn->query("SELECT * FROM believers WHERE log_id='" . $row["partner_2_ID"] . "'");
                                            $dataU2 = mysqli_fetch_array($get_user2);
                                        ?>
                                        <tr>
                                            <td><?php echo $dataU1["fname"] . " " . $dataU1["lname"] ?></td>
                                            <td><?php echo $dataU2["fname"] . " " . $dataU2["lname"] ?></td>

                                            <td><?php echo $row["date"]; ?></td>

                                            <td>
                                                <a href="marriage-detail?m1=<?php echo $dataU1["log_id"]; ?>&m2=<?php echo $dataU2["log_id"]; ?>"
                                                    class="btn btn-info"> <i class="fa fa-eye"></i> </a>
                                            </td>

                                            <td>
                                                <?php $QueryD = $conn->query("SELECT * FROM marriage WHERE ((partner_1_ID='" . $dataU1["log_id"] . "')AND(partner_2_ID='" . $dataU2["log_id"] . "'))");
                                                    while ($dataQ = mysqli_fetch_array($QueryD)) {
                                                    ?>
                                                <a onclick="return confirm('Do you want to delete this record ?')"
                                                    class="btn btn-danger"
                                                    href="remove-married?member_id=<?php echo $row["id"]; ?>"> <i
                                                        class="fa fa-remove"></i></a>
                                                <?php } ?>
                                            </td>
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
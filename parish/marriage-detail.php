<?php
include("../includes/connect.php");

include 'includes/session.php';
$uid = $_GET["m1"];
$uid1 = $_GET["m2"];
$get = $conn->query("SELECT * FROM believers   WHERE log_id='$uid'");
$data = mysqli_fetch_array($get);
$names = $data["fname"] . " " . $data["lname"];
//------------- Person2 ------------------
$get1 = $conn->query("SELECT * FROM believers   WHERE log_id='$uid1'");
$data1 = mysqli_fetch_array($get1);
$names1 = $data1["fname"] . " " . $data1["lname"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christians <?php echo $names; ?> & <?php echo $names1; ?></title>
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

                        <div style="overflow-x: scroll;" class="module">
                            <div class="module-head">
                                <h3 style="text-transform: capitalize;">Christians <?php echo $names1; ?> &
                                    <?php echo $names; ?></h3>
                            </div>

                            <div class="module-body col-lg-12">
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th>Full name</th>
                                            <th>Father's name</th>
                                            <th>Mother's name</th>
                                            <th>Parish</th>
                                            <th>Diocese</th>
                                            <th>National ID number</th>
                                            <th>System ID</th>
                                            <th>Date of birth</th>
                                            <th>Phone number</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php $get_christ_data = $conn->query("SELECT * FROM believers WHERE log_id='$uid1'");
                                            $row = mysqli_fetch_array($get_christ_data);
                                            ?>

                                            <td><?php print($row["fname"] . " " . $row["lname"]); ?></td>
                                            <td><?php print($row["father"]); ?></td>
                                            <td><?php print($row["mother"]); ?></td>
                                            <td><?php
                                                $get_parish = $conn->query("SELECT * FROM parishes WHERE id='" . $row['parish_id'] . "'");
                                                $data_par = mysqli_fetch_array($get_parish);
                                                echo $data_par["parish_name"];
                                                echo     $dio_id = $data_par["diocese_id"];

                                                ?></td>
                                            <td>
                                                <?php
                                                $get_dioQuery = $conn->query("SELECT * FROM diocese WHERE id='" . $data_par["diocese_id"] . "'");
                                                $DioceseData = mysqli_fetch_array($get_dioQuery);
                                                echo $DioceseData["diocese_name"];
                                                ?>
                                            </td>
                                            <td><?php print($row["id_number"]); ?></td>
                                            <td><?php print($row['log_id']); ?></td>
                                            <td><?php print($row['date_of_birth']); ?></td>
                                            <td><?php print($row['tel']); ?></td>
                                            <td><?php echo $row["email"]; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="module-body col-lg-12">
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th>Full name</th>
                                            <th>Father's name</th>
                                            <th>Mother's name</th>
                                            <th>Parish</th>
                                            <th>Diocese</th>
                                            <th>National ID number</th>
                                            <th>System ID</th>
                                            <th>Date of birth</th>
                                            <th>Phone number</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php $get_christ_data = $conn->query("SELECT * FROM believers WHERE log_id='$uid'");
                                            $row = mysqli_fetch_array($get_christ_data);
                                            ?>

                                            <td><?php print($row["fname"] . " " . $row["lname"]); ?></td>
                                            <td><?php print($row["father"]); ?></td>
                                            <td><?php print($row["mother"]); ?></td>
                                            <td><?php
                                                $get_parish = $conn->query("SELECT * FROM parishes WHERE id='" . $row['parish_id'] . "'");
                                                $data_par = mysqli_fetch_array($get_parish);
                                                echo $data_par["parish_name"];
                                                echo     $dio_id = $data_par["diocese_id"];

                                                ?></td>
                                            <td>
                                                <?php
                                                $get_dioQuery = $conn->query("SELECT * FROM diocese WHERE id='" . $data_par["diocese_id"] . "'");
                                                $DioceseData = mysqli_fetch_array($get_dioQuery);
                                                echo $DioceseData["diocese_name"];
                                                ?>
                                            </td>
                                            <td><?php print($row["id_number"]); ?></td>
                                            <td><?php print($row['log_id']); ?></td>
                                            <td><?php print($row['date_of_birth']); ?></td>
                                            <td><?php print($row['tel']); ?></td>
                                            <td><?php echo $row["email"]; ?></td>
                                        </tr>
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

</body>
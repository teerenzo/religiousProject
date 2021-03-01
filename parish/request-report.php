<?php
include("../includes/connect.php");
include("includes/session.php");
$church_id = $_SESSION["id"];

if (isset($_POST["submit"])) {
    $name  = $_POST["name"];
    $amount  = $_POST["amount"];
    $type  = $_POST["type"];
    $num  = $_POST["num"];
    $opt  = $_POST["opt"];
    $period = $num . $opt;
    //echo $period;
    if (empty($opt) || empty($name) || empty($amount) || empty($type) || empty($num)) {
        echo '<script>alert("Field must be filled.");</script>';
        //echo "<script>window.location.href='new-ctg';</script>";
    } else {

        $query1 = $conn->query("INSERT INTO services(service_name,period,type,payable_amount,parish_id) VALUES('$name','$period','$type','$amount','" . $_SESSION['id'] . "')");
        if ($query1) {
            echo '<script>alert("Service registration successful.");</script>';
            echo "<script>window.location.href='add-service';</script>";
            echo "tee" . mysqli_error($conn);
        } else {
            // echo "tee".mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Report</title>
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
                                <h3>Payment Report</h3>
                            </div>
                            <div class="module-body">

                                <form method="POST" action="report">
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <div class="form-group">
                                                <label class="control-label" for="basicinput">First Date
                                                    <i>(from)</i></label>
                                                <input type="date" name='first-date' id="basicinput"
                                                    placeholder="First date" required="" class="span12 form-control">
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <div class="form-group">
                                                <label class="control-label" for="basicinput">Second Date
                                                    <i>(up to)</i></label>
                                                <input type="date" name='second-date' id="basicinput" maxlength="16"
                                                    placeholder="" required="" class="span12 form-control">
                                            </div>
                                        </div>
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
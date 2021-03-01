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
        <title>Service Rgistration</title>
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
                                <h3>Service registration</h3>
                            </div>
                            <div class="module-body">

                                <form method="POST">


                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Service Name</label>
                                        <input type="text" name='name' id="basicinput" placeholder="Type name"
                                            required="" class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Type</label>
                                        <input type="text" name='type' id="basicinput" maxlength="16"
                                            placeholder="Enter Type" required="" class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Period</label>
                                        <select name="num">
                                            <option value="" disabled selected>Select period for payment</option>
                                            <option value="Once">Once</option>
                                            <?php
                                            $n = 31;
                                            for ($i = 1; $i <= $n; $i++) {
                                            ?>
                                            <option><?php echo $i; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <select name="opt">
                                            <option value="" disabled selected>Select period</option>
                                            <option value="Once">Once</option>
                                            <option value="month">month(s)</option>
                                            <option value="year">year(s)</option>

                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Amounts</label>
                                        <input type="number" name="amount" id="" required placeholder="Phone number"
                                            class="form-control span8">
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
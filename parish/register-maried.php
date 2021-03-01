<?php
include("../includes/connect.php");
include("includes/session.php");
$ch_id = $_SESSION["id"];


?>

<?php
if (isset($_POST["submit"])) {
    $fp_id = $_POST["fp_ID"];
    $sp_id = $_POST["sp_ID"];
    $check_first = $conn->query("SELECT * FROM believers WHERE log_id='$fp_id'");
    $check_second = $conn->query("SELECT * FROM believers WHERE log_id='$sp_id'");

    $check_services = $conn->query("SELECT SUM(payable_amount) FROM services WHERE ((parish_id=0) OR (parish_id='" . $_SESSION["id"] . "'))");

    while ($row = mysqli_fetch_array($check_services)) {
        $sum = $row[0];
    }
    $check_paid_amount1 = $conn->query("SELECT SUM(paid_amount) FROM payment WHERE 	believer_id='$fp_id'");
    while ($fp_row = mysqli_fetch_array($check_paid_amount1)) {
        $paid1 = $fp_row[0];
    }
    //------ second partiner --------
    $check_paid_amount2 = $conn->query("SELECT SUM(paid_amount) FROM payment WHERE believer_id='$sp_id'");
    while ($sp_row = mysqli_fetch_array($check_paid_amount2)) {
        $paid2 = $sp_row[0];
    }

    $remain_amount1 = $sum - $paid1;
    $remain_amount2 = $sum - $paid2;
    // $check_paid1 = $conn->query("SELECT * FROM payments WHERE believer_id='$fp_id'");
    // $get_paid1 = mysqli_fetch_array($check_paid1);
    // $pamount1 = $get_paid1["status"];
    // $check_paid2 = $conn->query("SELECT * FROM payments WHERE believer_id='$sp_id'");
    // $get_paid2 = mysqli_fetch_array($check_paid2);

    if (empty($fp_id) || empty($sp_id)) {
        echo '<script>alert("Field must be filled.");</script>';
    } else if (!mysqli_num_rows($check_first) > 0) {
        echo '<script>alert("Partner 1 ID you have entered does not exist in the system.");</script>';
        echo "<script>window.location.href='register-maried';</script>";
    } else if (!mysqli_num_rows($check_second) > 0) {
        echo '<script>alert("Partner 2 ID you have entered does not exist in the system.");</script>';
        echo "<script>window.location.href='register-maried';</script>";
    } else {

        if ($paid1 < $sum) {
            echo '<script>alert("First partner have unpaid balance of ' . $remain_amount1 . ' Rwf.");</script>';
            echo "<script>window.location.href='register-maried';</script>";
        } else if ($paid2 < $sum) {
            echo '<script>alert("Second partner have unpaid balance of ' . $remain_amount2 . ' Rwf.");</script>';
            echo "<script>window.location.href='register-maried';</script>";
        } else {
            $check_first_M = $conn->query("SELECT * FROM marriage WHERE partner_1_ID='$fp_id'");
            $check_second_M = $conn->query("SELECT * FROM marriage WHERE partner_2_ID='$sp_id'");

            if ($fp_id == $sp_id) {
                echo '<script>alert("Both two people is the same. Two IDs match.");</script>';
                echo "<script>window.location.href='register-maried';</script>";
            } else {
                if (mysqli_num_rows($check_first_M) > 0) {
                    echo '<script>alert("Christian on first partner is already married");</script>';
                    echo "<script>window.location.href='register-maried';</script>";
                } else if (mysqli_num_rows($check_second_M) > 0) {
                    echo '<script>alert("Christian on second partner is already married");</script>';
                    echo "<script>window.location.href='register-maried';</script>";
                } else {
                    $addMariage = $conn->query("INSERT INTO marriage(partner_1_ID,partner_2_ID,parish_id) VALUES('$fp_id','$sp_id','" . $_SESSION["id"] . "')");
                    if ($addMariage) {
                        echo '<script>alert("People registered as married successfully.");</script>';
                    } else {
                        echo "Error" . mysqli_error($conn);
                    }
                }
            }
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
        <title>Marriage registration</title>
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
                                <h3>Register marriage</h3>
                            </div>
                            <div class="module-body">

                                <form method="POST">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="control-label" for="basicinput">Enter Christian ID for
                                                    First partner</label>
                                                <input type="text" id="fp_ID" name='fp_ID' id="basicinput"
                                                    placeholder="First Partner ID" class="span8 form-control">
                                            </div>
                                            <div id="disp-result"></div>
                                        </div>
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="control-label" for="basicinput"></label>
                                                <button style="margin-top:20px;" id="check_fp_ID"
                                                    class="btn btn-primary"><i class="fa fa-search"></i> Click to search
                                                </button>
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="control-label" for="basicinput">Enter Christian ID for
                                                    Second partner</label>
                                                <input type="text" id="sp_ID" name='sp_ID' id="basicinput"
                                                    placeholder="Second Partner ID" class="span8 form-control">
                                            </div>
                                            <div id="disp-result1"></div>
                                        </div>
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="control-label" for="basicinput"></label>
                                                <button style="margin-top:20px;" id="check_sp_ID"
                                                    class="btn btn-primary"><i class="fa fa-search"></i> Click to search
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="control-group col-md-5">
                                        <div class="controls">
                                            <button name="submit" class="btn btn-primary btn-block" type="submit"
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
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#check_fp_ID").on('click', function() {
            var reg = $("#fp_ID").val();
            if (reg == '') {
                alert('Please enter system identification ID.')
            } else {
                $.ajax({
                    type: "POST",
                    url: 'processors/data.php',
                    data: 'sys_number=' + reg,
                    success: function(data) {
                        $("#disp-result").html(data);
                    }
                });
            }
            return false;
        });

        $("#check_sp_ID").on('click', function() {
            var reg = $("#sp_ID").val();
            if (reg == '') {
                alert('Please enter system identification ID.')
            } else {
                $.ajax({
                    type: "POST",
                    url: 'processors/data.php',
                    data: 'sys_number=' + reg,
                    success: function(data) {
                        $("#disp-result1").html(data);
                    }
                });
            }
            return false;
        });
    })
    </script>
</body>
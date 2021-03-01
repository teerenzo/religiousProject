<?php
include("../includes/connect.php");
include("includes/session.php");
$church_id = $_SESSION["id"];
$cid = $_GET["member_id"];
error_reporting(0);
if (isset($_POST["submit"])) {
    $fname  = $_POST["fname"];
    $sname = $_POST["sname"];
    $father = $_POST["father"];
    $mother = $_POST["mother"];
    $phone = $_POST["phone"];
    $email = $_POST['email'];
    $suc = $_POST['suc'];
    $basic = $_POST['basic'];
    $id = $_POST['id'];
    $birth = $_POST["date"];
    $pass = "123456";
    //$log_id= rand(10000,99999);
    if (empty($fname) || empty($email) || empty($phone) || empty($birth) || empty($sname) || empty($id)) {
        echo '<script>alert("Field must be filled.");</script>';
        //echo "<script>window.location.href='new-ctg';</script>";
    } else {
        $check_id = $conn->query("SELECT * FROM believers WHERE id_number='$id'");
        $check_email = $conn->query("SELECT * FROM believers WHERE email='$email'");

        $check_memberQuery = $conn->query("SELECT * FROM believers WHERE believer_ID='$cid'");
        $queryNid = mysqli_fetch_array($check_memberQuery);
        $data_ID = $queryNid["id_number"];
        $dataEmail = $queryNid["email"];

        if ($id != $data_ID) {
            if (mysqli_num_rows($check_id) > 0) {
                echo '<script>alert("Member with national ID you entered is already exist.");</script>';
                echo "<script>window.location.href='edit_member?member_id=" . $cid . "';</script>";
            } else {
                $getID = $conn->query("SELECT * FROM believers WHERE believer_ID = '$cid'");
                $dataC = mysqli_fetch_array($getID);
                $queryCenter = $conn->query("SELECT * FROM centrals WHERE ((central_name='" . $dataC["central_name"] . "')AND(parish_id='" . $_SESSION["id"] . "'))");
                $CentQuery = mysqli_fetch_array($queryCenter);
                $cent_name = $CentQuery["central_name"];
                $parish_id = $CentQuery["parish_id"];

                $query = $conn->query("UPDATE believers SET fname='$fname',lname ='$sname' ,father='$father',mother='$mother',id_number='$id',date_of_birth='$birth',email='$email',tel='$phone',central_name='$cent_name',sucursal_name='$suc',basic_name='$basic' WHERE believer_ID='$cid'");
                if ($query) {
                    echo '<script>alert("Member info updated successful.");</script>';
                    echo "<script>window.location.href='members';</script>";
                } else {
                    echo "tee" . mysqli_error($conn);
                }
            }
        } else if ($email != $dataEmail) {
            if (mysqli_num_rows($check_email) > 0) {
                echo '<script>alert("Member with email you entered is already exist.");</script>';
                echo "<script>window.location.href='edit_member?member_id=" . $cid . "';</script>";
            } else {
                $get_cent = $conn->query("SELECT * FROM centrals WHERE id='$church_id'");
                $cent_data = mysqli_fetch_array($get_cent);
                $cent_name = $cent_data["central_name"];
                $parish_id = $cent_data["parish_id"];

                $query = $conn->query("UPDATE believers SET fname='$fname',lname ='$sname' ,father='$father',mother='$mother',id_number='$id',date_of_birth='$birth',email='$email',tel='$phone',central_name='$cent_name',sucursal_name='$suc',basic_name='$basic' WHERE believer_ID='$cid'");
                if ($query) {
                    echo '<script>alert("Member info updated successful.");</script>';
                    echo "<script>window.location.href='members';</script>";
                } else {
                    echo "tee" . mysqli_error($conn);
                }
            }
        } else {
            $get_cent = $conn->query("SELECT * FROM centrals WHERE id='$church_id'");
            $cent_data = mysqli_fetch_array($get_cent);
            $cent_name = $cent_data["central_name"];
            $parish_id = $cent_data["parish_id"];

            $query = $conn->query("UPDATE believers SET fname='$fname',lname ='$sname' ,father='$father',mother='$mother',id_number='$id',date_of_birth='$birth',email='$email',tel='$phone',central_name='$cent_name',sucursal_name='$suc',basic_name='$basic' WHERE believer_ID='$cid'");
            if ($query) {
                echo '<script>alert("Member info updated successful.");</script>';
                echo "<script>window.location.href='members';</script>";
            } else {
                echo "tee" . mysqli_error($conn);
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
        <title>Update christian info</title>
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
                        <?php
                        $query_info = $conn->query("SELECT * FROM believers WHERE believer_ID='$cid'");
                        $Udata = mysqli_fetch_array($query_info);
                        ?>
                        <div class="module">
                            <div class="module-head">
                                <h3>Update christian <?php echo $Udata["fname"] . " " . $Udata["lname"]; ?> -
                                    <?php echo $Udata["log_id"] ?></h3>
                            </div>
                            <div class="module-body">

                                <form method="POST">

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">first name</label>
                                        <input type="text" name='fname' id="basicinput" placeholder="Type first name"
                                            required="" value="<?php echo $Udata["fname"] ?>"
                                            class="span8 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">second name</label>
                                        <input type="text" name='sname' value="<?php echo $Udata["lname"] ?>"
                                            id="basicinput" placeholder="Type second name" required=""
                                            class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Father's name</label>
                                        <input type="text" name='father' id="basicinput"
                                            value="<?php echo $Udata["father"] ?>" placeholder="Father's name"
                                            required="" class="span8 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Mother's name</label>
                                        <input type="text" name='mother' id="basicinput"
                                            value="<?php echo $Udata["mother"] ?>" placeholder="Mother's name"
                                            required="" class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">ID Number</label>
                                        <input type="text" name='id' id="basicinput"
                                            value="<?php echo $Udata["id_number"] ?>" maxlength="16"
                                            placeholder="Type second name" required="" class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Date Of Birth</label>
                                        <input type="date" name='date' value="<?php echo $Udata["date_of_birth"] ?>"
                                            id="basicinput" placeholder="Type second name" required=""
                                            class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Email</label>
                                        <input type="email" name="email" id="" value="<?php echo $Udata["email"] ?>"
                                            required placeholder="Email address" class="form-control span8">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Phone number</label>
                                        <input type="number" name="phone" id="" value="<?php echo $Udata["tel"] ?>"
                                            required placeholder="Phone number" class="form-control span8">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Sucursal</label>
                                        <select class="form-control span8" name="suc">
                                            <option value="<?php echo $Udata["sucursal_name"] ?>" disabled selected>
                                                <?php echo $Udata["sucursal_name"] ?>
                                            </option>
                                            <option value="None">None</option>
                                            <?php
                                            $getID = $conn->query("SELECT * FROM believers WHERE believer_ID = '$cid'");
                                            $dataC = mysqli_fetch_array($getID);
                                            $queryCenter = $conn->query("SELECT * FROM centrals WHERE ((central_name='" . $Udata["central_name"] . "')AND(parish_id='" . $_SESSION["id"] . "'))");

                                            $CentQuery = mysqli_fetch_array($queryCenter);
                                            $sel = $conn->query("SELECT * FROM sucursals WHERE parish_id='" . $_SESSION["id"] . "'");
                                            while ($rowCent = mysqli_fetch_array($sel)) {
                                            ?>
                                            <option><?php echo $rowCent["suc_name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Basic_Church(umuryango
                                            remezo)</label>
                                        <select class="form-control span8" name="basic">
                                            <option value="<?php echo $Udata["basic_name"] ?>" disabled selected>
                                                <?php echo $Udata["basic_name"] ?>

                                                <?php
                                                $sel1 = $conn->query("SELECT * FROM basic_churches WHERE parish_id='" . $_SESSION["id"] . "'");
                                                while ($row = mysqli_fetch_array($sel1)) { ?>
                                            <option><?php echo $row["name"]; ?></option>
                                            <?php
                                                }
                                        ?>

                                        </select>
                                    </div>


                                    <div class="control-group">
                                        <div class="controls">
                                            <button name="submit" class="btn btn-primary" type="submit" class="btn">Save
                                                Changes</button>
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
<?php
include("../includes/connect.php");
include("includes/session.php");
$church_id = $_SESSION["id"];

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
    $log_id = rand(10000, 99999);
    if (empty($fname) || empty($email) || empty($phone) || empty($birth) || empty($sname) || empty($id)) {
        echo '<script>alert("Field must be filled.");</script>';
        //echo "<script>window.location.href='new-ctg';</script>";
    } else {
        $check_id = $conn->query("SELECT * FROM believers WHERE id_number='$id'");
        $check_email = $conn->query("SELECT * FROM believers WHERE email='$email'");

        if (mysqli_num_rows($check_id) > 0) {
            echo '<script>alert("Member with national ID you entered is already exist.");</script>';
            echo "<script>window.location.href='add_member';</script>";
        } else if (mysqli_num_rows($check_email) > 0) {
            echo '<script>alert("Member with email you entered is already exist.");</script>';
            echo "<script>window.location.href='add_member';</script>";
        } else {
            $get_cent = $conn->query("SELECT * FROM centrals WHERE id='$church_id'");
            $cent_data = mysqli_fetch_array($get_cent);
            $cent_name = $cent_data["central_name"];
            $parish_id = $cent_data["parish_id"];

            $query = $conn->query("INSERT INTO believers(fname,lname,father,mother,id_number,date_of_birth,email,tel,central_name,sucursal_name,basic_name,parish_id,log_id) VALUES('$fname','$sname','$father','$mother','$id','$birth','$email','$phone','$cent_name','$suc','$basic','$parish_id','$log_id')");
            if ($query) {
                $get_id = $conn->query("SELECT log_id FROM believers WHERE id_number='$id'");
                $b_id = mysqli_fetch_array($get_id);
                $r_id = $b_id[0];
                $query1 = $conn->query("INSERT INTO users(username,password,user_type,user_id) VALUES('$log_id','$pass','believer','$r_id')");
                if ($query1) {
                    echo '<script>alert("Member registration successful.");</script>';
                    echo "<script>window.location.href='add_member';</script>";
                } else {
                    echo "tee" . mysqli_error($conn);
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
        <title>Register Member</title>
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
                                <h3>Member registration</h3>
                            </div>
                            <div class="module-body">

                                <form method="POST">

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">first name</label>
                                        <input type="text" name='fname' id="basicinput" placeholder="Type first name"
                                            required="" class="span8 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">second name</label>
                                        <input type="text" name='sname' id="basicinput" placeholder="Type second name"
                                            required="" class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Father's name</label>
                                        <input type="text" name='father' id="basicinput" placeholder="Father's name"
                                            required="" class="span8 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Mother's name</label>
                                        <input type="text" name='mother' id="basicinput" placeholder="Mother's name"
                                            required="" class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">ID Number</label>
                                        <input type="text" name='id' id="basicinput" maxlength="16"
                                            placeholder="Type second name" required="" class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Date Of Birth</label>
                                        <input type="date" name='date' id="basicinput" placeholder="Type second name"
                                            required="" class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Email</label>
                                        <input type="email" name="email" id="" required placeholder="Email address"
                                            class="form-control span8">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Phone number</label>
                                        <input type="number" name="phone" id="" required placeholder="Phone number"
                                            class="form-control span8">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Sucursal</label>
                                        <select class="form-control span8" name="suc">
                                            <option value="None">None</option>
                                            <?php
                                            $sel = $conn->query("SELECT * FROM sucursals WHERE central_id='" . $_SESSION['id'] . "' AND suc_name != '" . $result1[3] . "' ");
                                            while ($result = mysqli_fetch_array($sel)) {
                                            ?>
                                            <option><?php echo $result[3]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Basic_Church(umuryango
                                            remezo)</label>
                                        <select class="form-control span8" name="basic">
                                            <option value="" disabled selected>Select basic church (Umuryangoremezo)
                                            </option>

                                            <?php
                                            $sel1 = $conn->query("SELECT * FROM basic_churches WHERE central_id='" . $_SESSION['id'] . "'");
                                            while ($row = mysqli_fetch_array($sel1)) { ?>
                                            <option><?php echo $row["name"]; ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
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
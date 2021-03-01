<?php

include 'protector.php';
$tee = $_SESSION['parish_id'];
$userId = $_SESSION['id'];
$sel = $conn->query("SELECT * FROM sacrament_issuing WHERE believer_id='" . $_SESSION['id'] . "' AND issue='Baptism'");

if (mysqli_num_rows($sel) > 0) {

    $sel = $conn->query("SELECT payment.believer_id,payment.service_id,payment.paid_date,services.service_name FROM payment INNER JOIN services ON payment.service_id=services.id WHERE  payment.believer_id='" . $_SESSION['id'] . "' AND payment.status ='pending' AND payment.payment_method ='' AND services.parish_id='" . $_SESSION['parish_id'] . "' AND services.service_name='baptism'");

    $sel1 = $conn->query("SELECT payment.believer_id,payment.service_id,payment.paid_date,services.service_name FROM payment INNER JOIN services ON payment.service_id=services.id WHERE  payment.believer_id='" . $_SESSION['id'] . "' AND payment.status ='paid' AND payment.payment_method!='' AND services.parish_id='" . $_SESSION['parish_id'] . "' AND services.service_name='baptism'");

    $sel4 = $conn->query("SELECT * FROM payment WHERE service_id='1' AND user_id='" . $_SESSION['id'] . "'");

    $sel3 = $conn->query("SELECT payment.believer_id,payment.service_id,payment.paid_date,services.service_name FROM payment INNER JOIN services ON payment.service_id=services.id WHERE  payment.believer_id='" . $_SESSION['id'] . "' AND payment.status ='pending' AND payment.payment_method !='' AND services.parish_id='" . $_SESSION['parish_id'] . "' AND services.service_name='baptism'");

    if (mysqli_num_rows($sel4) == 0) {


        if (isset($_POST['done1'])) {
            $paid = $_POST["paid"];
            $fileName = "baptism" . $userId . ".pdf";
            $file = "files/bank_recpt/" . $fileName;
            $target_dir = "files/bank_recpt/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $pdate = date("Y-m-d");
            // Select file type
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $path = "../" . $target_dir . $fileName;
            // Valid file extensions
            $extensions_arr = array("pdf");

            // Check extension
            if (in_array($imageFileType, $extensions_arr)) {
                $sel = $conn->query("SELECT * FROM services Where service_name = 'baptism' AND parish_id='" . $_SESSION['parish_id'] . "'");
                $res = mysqli_fetch_array($sel);
                $insert_da = "INSERT INTO payment(believer_id,service_id,paid_date,user_id,payment_method,status,paid_amount,parish_id) VALUES('" . $_SESSION['id'] . "','" . $res['id'] . "','$pdate','" . $_SESSION['id'] . "','$path','pending','$paid','".$_SESSION['parish_id']."')";
                $isDone = mysqli_query($conn, "$insert_da");
                $isUploaded = move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $fileName);
                if ($isDone and $isUploaded) {
                    //$updateIsPayQuery = "UPDATE `applications` SET `isPayed`='pending' WHERE `student_id`='$userId'";
                    // mysqli_query($connect, "$updateIsPayQuery");
                    echo "<script>alert('Your bank recpt submitted well done,Check your email regural  for responde');window.open('sustenance_cert.php','_self');</script>";
                } else echo "Error:" . mysqli_error($conn);
            }
        } ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religious computerised services system</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
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
                <div class="module span4">
                    <form class="form-vertical" method="POST" enctype='multipart/form-data' action="#">
                        <div class="module-head">

                            <h3>Acount number: 456785678456756 equity bank</h3>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <label>
                                    <h3>Upload BankSlip 500rwf</h3>
                                </label>

                            </div>

                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input name="file" class="span12" onchange="return fileValidation()" type="file"
                                        id="file">
                                </div>
                            </div>
                            <div class="control-group">

                                <input type="hidden" value="500" placeholder="Enter amount are on the slip" name="paid"
                                    id="" class="span3 form-control">
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button name="done1" type="submit" class="btn btn-primary btn-block pull-right"> <i
                                            class="fa fa-upload" aria-hidden="true"></i> Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/.wrapper-->

    <?php include("includes/footer.php"); ?>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
    function fileValidation() {
        var fileInput =
            document.getElementById('file');

        var filePath = fileInput.value;

        // Allowing file type 
        var allowedExtensions =
            /(\.pdf)$/i;

        if (!allowedExtensions.exec(filePath)) {
            alert('Invalid file type, Only pdf format is allowed');
            fileInput.value = '';
            return false;
        }
        return true;
    }
    </script>
</body>

<?php


    }

    if (mysqli_num_rows($sel3) > 0) { ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religious computerised services system</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
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
                <div class="module span4">
                    <h1>Check your email Regulary for response or contact Parish</h1>
                </div>
            </div>
        </div>
    </div>
    <!--/.wrapper-->

    <?php include("includes/footer.php"); ?>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</body>
<?php

    } else {
    }
    //echo $tee;
    if (mysqli_num_rows($sel) > 0) {


        if (isset($_POST['done'])) {
            $fileName = "eucharist" . $userId . ".pdf";
            $file = "files/bank_recpt/" . $fileName;
            $target_dir = "files/bank_recpt/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $path = "../" . $target_dir . $fileName;
            // Valid file extensions
            $extensions_arr = array("pdf");

            // Check extension
            if (in_array($imageFileType, $extensions_arr)) {
                $sel = $conn->query("SELECT * FROM services Where service_name = 'sustenance' AND parish_id='" . $_SESSION['parish_id'] . "'");
                $res = mysqli_fetch_array($sel);
            $insert_da = "INSERT INTO payment(believer_id,service_id,paid_date,user_id,payment_method,status,paid_amount,parish_id) VALUES('" . $_SESSION['id'] . "','" . $res['id'] . "','$pdate','" . $_SESSION['id'] . "','$path','pending','$paid','".$_SESSION['parish_id']."')";
                $isDone = mysqli_query($conn, "$insert_da");
                $isUploaded = move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $fileName);
                if ($isDone and $isUploaded) {
                    //$updateIsPayQuery = "UPDATE `applications` SET `isPayed`='pending' WHERE `student_id`='$userId'";
                    // mysqli_query($connect, "$updateIsPayQuery");
                    echo "<script>alert('Your bank recpt submitted well done,Check your email regural  for responde');window.open('sustenance_cert.php','_self');</script>";
                } else echo "Error:" . mysqli_error($connect);
            }
        } ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religious computerised services system</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
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
                <div class="module span4">
                    <form class="form-vertical" method="POST" enctype='multipart/form-data' action="#">
                        <div class="module-head">

                            <h3>Acount number: 456785678456756 equity bank</h3>
                        </div>
                        <div class="module-body">
                            <div class="control-group">
                                <label>
                                    <h3>Upload BankSlip 500rwf</h3>
                                </label>

                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input name="file" class="span12" onchange="return fileValidation()" type="file"
                                        id="file">
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button name="done" type="submit" class="btn btn-primary btn-block pull-right"> <i
                                            class="fa fa-upload" aria-hidden="true"></i> Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/.wrapper-->

    <?php include("includes/footer.php"); ?>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
    function fileValidation() {
        var fileInput =
            document.getElementById('file');

        var filePath = fileInput.value;

        // Allowing file type 
        var allowedExtensions =
            /(\.pdf)$/i;

        if (!allowedExtensions.exec(filePath)) {
            alert('Invalid file type, Only pdf format is allowed');
            fileInput.value = '';
            return false;
        }
        return true;
    }
    </script>
</body>

<?php

    }


    if (mysqli_num_rows($sel1)) {

        $select = $conn->query("SELECT * FROM parishes WHERE id='" . $_SESSION['parish_id'] . "'");
        $result = mysqli_fetch_array($select);
        //  echo $result[1]." "."Parish";

        $select1 = $conn->query("SELECT * FROM sacrament_issuing WHERE believer_id='" . $_SESSION['id'] . "'");
        $result1 = mysqli_fetch_array($select1);
        //  echo $result[1]." "."Parish";

        $select2 = $conn->query("SELECT * FROM believers WHERE log_id='" . $_SESSION['id'] . "'");

        $result2 = mysqli_fetch_array($select2);
        //  echo $result[1]." "."Parish";

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religious computerised services system</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
</head>

<body>

    <div class="container">

        <center>

            <div
                style="width:800px; height:600px; padding:20px; text-align:center; background-color: cyan; border: 10px solid #787878">
                <div
                    style="width:750px; height:550px; padding:20px; text-align:center; background-color: white; border: 5px solid #787878">
                    <span style="font-size:50px; font-weight:bold">Certificate of Baptism</span>
                    <br><br>
                    <span style="font-size:25px"><i>This is to certify that</i></span>
                    <br><br>
                    <span style="font-size:30px"><b
                            style="color: black;text-transform: capitalize;"><?php
                                                                                                                echo $result2['fname'] . " " . $result2['lname'];

                                                                                                                ?></b></span><br /><br />
                    <span style="font-size:25px"><i>has Baptised</i></span> <br /><br />
                    <span style="font-size:30px">in <?php echo $result[1] . " " . "Parish" ?></span> <br /><br />
                    <span style="font-size:20px">on <b> <?php echo $result1[4]; ?></b></span> <br /><br /><br /><br />

                    <span style="font-size:25px"><i>Father Habarurema Emmanuel</i></span> <br /><br />
                    <span style="font-size:30px"><img height="50" width="120" src="images/signature.jpg"></span>


                    <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
                    <script src="qrcode/jquery.min.js"></script>
                    <script src="qrcode/qrcode.min.js"></script>
                    <script src="qrcode/qrcode.js"></script>
                    <div class="qrcode" style="float:left;margin-top:55px;margin-left:20px;">
                        <input style='text-transform: capitalize;' id="text" type="hidden" value="<?php echo $result2['fname'] . " " . $result2['lname'] . " 
" . "has baptised in " . $result[1] . " " . "Parish" . "  " . "on" . "  " . $result1[4] . "  ";  ?>"
                            style="width:80%"><br>
                        <div id="qrcode" style="margin-top:15px;">
                            <script type="text/javascript">
                            var qrcode = new QRCode(document.getElementById("qrcode"), {
                                width: 100,
                                height: 100
                            });

                            function makeCode() {
                                var elText = document.getElementById("text");

                                if (!elText.value) {
                                    alert("Input a text");
                                    elText.focus();
                                    return;
                                }

                                qrcode.makeCode(elText.value);
                            }

                            makeCode();

                            $("#text").
                            on("blur", function() {
                                makeCode();
                            }).
                            on("keydown", function(e) {
                                if (e.keyCode == 13) {
                                    makeCode();
                                }
                            });
                            </script>
                            <label style="margin-left:0px;font-size:10px;">Scan for Verification</label>
                        </div>
                    </div>
                </div>
            </div>
        </center>

        <div class="row">



        </div>
    </div>

</body>

</html>

<?php
        ?>

<?php
    }
} else {

    ?>

<script>
alert('You are to be Baptised Before Getting this certificate.')
</script>";
<script>
window.location.href = 'homepage'
</script>";
<?php

}


?>
<?php include 'includes/session.php';



 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Payments</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/startmin.js"></script>
    <script>
        const sendEmail = (from, name, subject, sendTo, msg) => {
            window.open(`https://webprojecteduc.000webhostapp.com/sendMail.php?from=${from}&name=${name}&subject=${subject}&sendTo=${sendTo}&msg=${msg}`, '_self');
        }
    </script>
</body>

</html>
<?php

$day = date("d");
$month = date("m");
$year = date("Y");

$query = "UPDATE `payment` SET `status`='paid' WHERE `id`='".$_GET['pay_id']."'";
$done = mysqli_query($conn, "$query");
$sel=$conn->query("SELECT believer_id FROM payment WHERE id='".$_GET['pay_id']."'");
$fetc=mysqli_fetch_array($sel);

$studentInfor = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `believers` WHERE `believer_ID`='".$fetc[0]."'"));

 $sendTo = $studentInfor[5];
 $studentName = "$studentInfor[1] $studentInfor[2]";
 $msg = " Hello $studentName<br>your payment of <b>500 Frw</b> has approved";

$parish = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `parishes` WHERE `id`='".$_SESSION['id']."'"));
 $sendFrom = $parish['email'];
 $schoolName = $parish['parish_name'];
 $subject = "Payment Accepts";

// $isInserted = mysqli_query($connect, "$paymentQuery");
if ($done) {
    echo "<script>sendEmail('$sendFrom','$schoolName','$subject','$sendTo','$msg')</script>";
} else echo "Error: " . mysqli_error($connect);





?>
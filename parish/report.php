<?php
$get_pay;
error_reporting(0);
include("../includes/connect.php");

include 'includes/session.php';

$captureQuery = $conn->query("SELECT * FROM parishes WHERE id = '" . $_SESSION["id"] . "'");
$CaData = mysqli_fetch_array($captureQuery);
$pname = $CaData["parish_name"];
$diocese = $CaData["diocese_id"];
$QueringDios = $conn->query("SELECT * FROM diocese WHERE id='" . $diocese . "'");
$fetch_diocese = mysqli_fetch_array($QueringDios);
$Dname = $fetch_diocese["diocese_name"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Report from <?php echo $_POST["first-date"] ?> up to <?php echo $_POST["second-date"]; ?></title>
    <link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="../css/theme.css" rel="stylesheet">
    <link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
</head>

<body>
    <div style="margin-top:50px;" id="report_header"><br>
        <?php echo $pname; ?> Parish payments report
        <i>from</i> <?php echo $_POST['first-date']; ?> <i>up to </i> <?php echo $_POST['second-date']; ?>
    </div>
    <div id="men">
        <p style="font-family:arial;margin-top:36px;font-size:14px;">
            Catholic church<br>
            Diocese <?php echo $Dname; ?><br>
            Parish <?php echo $pname; ?><BR>
            <CENTER>
                <BR>
        </p>
    </div>
    <div class="container">
        <div id="m-r">
            <table border="1" cellpadding="10">
                <tr>
                    <th>Christian</th>
                    <th>ID Number</th>
                    <th>System ID</th>
                    <th>Paid Date</th>
                    <th>Service name</th>
                    <th>Payment status</th>
                    <th>Paid amount</th>
                    <th>Remained Amount</th>
                    <th>Payable Payment</th>
                    <?php
                    if (isset($_POST['submit'])) {
                        $first = $_POST['first-date'];
                        $second = $_POST['second-date'];
                        $query = $conn->query("SELECT * FROM payment WHERE ((paid_date BETWEEN '$first' AND '$second')AND(parish_id='" . $_SESSION["id"] . "'))");
                        while ($row = mysqli_fetch_array($query)) {
                            $getPerson = $conn->query("SELECT * FROM believers WHERE log_id='" . $row["believer_id"] . "'");
                            $data = mysqli_fetch_array($getPerson);
                    ?>

                <tr>
                    <td><?php echo $data['fname'] . " " . $data["lname"]; ?></td>
                    <td><?php echo $data['id_number']; ?></td>
                    <td><?php echo $data['log_id']; ?></td>
                    <td><?php echo $row['paid_date']; ?></td>
                    <td>
                        <?php

                            $queryService = $conn->query("SELECT * FROM services WHERE id='" . $row["service_id"] . "'");
                            $data_name = mysqli_fetch_array($queryService);
                            echo $service_name = $data_name["service_name"];
                            $full_pay = $data_name["payable_amount"] . " " . "Rwf";
                        ?>
                    </td>
                    <td><?php echo $row["status"]; ?></td>
                    <td><?php echo $row['paid_amount'] . " " . "Rwf"; ?></td>
                    <td><?php

                            $remained = $data_name["payable_amount"] - $row["paid_amount"];
                            echo $remained . " " . "Rwf";
                        ?></td>
                    <td><?php echo $full_pay; ?></td>

                    <?php

                            $totalQuery = $conn->query("SELECT SUM(paid_amount) FROM payment WHERE ((paid_date BETWEEN '$first' AND '$second')AND(parish_id='" . $_SESSION["id"] . "'))");
                            while ($total = mysqli_fetch_array($totalQuery)) {
                                $total_paid = $total[0];
                            }
                    ?>
                </tr>
                <?php
                            $get_pay = $get_pay + $data_name["payable_amount"];
                            $get_rem = $get_rem + $remained;
                        }
                    }
        ?>
                <tr>
                    <th colspan="6">Totals</th>
                    <th>Paid amount</th>
                    <th>Remaining amount (Credit)</th>
                    <th>Payable amount</th>
                </tr>
                <tr>
                    <th colspan="6"></th>
                    <th><?php echo $total_paid; ?> Rwf</th>
                    <th><?php echo $get_rem; ?> Rwf</th>
                    <th><?php echo $get_pay; ?> Rwf</th>
                </tr>
            </table>
            </form>
        </div>
    </div>

    <script>
    function printdata() {
        document.getElementById('btn').innerHTML = ""
        window.print();
    }
    </script><br>
    <center>
        <label id=btn>
            <a style="margin-top:20px;" href="request-report" onclick="printdata()"><button type="submit" name="print"
                    style="cursor: pointer;"><img src="../images/p.ico" width="40" height="45"></button></a>
        </label>
    </center><br>
    <table>
</body>

</html>
<style type="text/css">
#men p {
    margin-left: 105px;
    font-size: 25px;
    font-family: Gabriola;
    color: black;
    font-weight: bold;
}

#men i {
    font-size: 20px;
}

#report_header {
    width: 85%;
    height: 90px;
    text-align: center;
    margin: 30px;
    margin-left: 70px;
    font-weight: bold;
    font-size: 30px;
    font-family: MoolBoran;
    border: double;
}

.men p {
    margin-left: 105px;
    font-size: 15px;
    font-family: Gabriola;
    color: black;
    font-weight: bold;
}
</style>
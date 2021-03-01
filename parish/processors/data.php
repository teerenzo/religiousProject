<?php
session_start();

include("../includes/connect.php");
$id_sys_number =  stripslashes($_POST["sys_number"]);
$sys_data = mysqli_query($conn, "SELECT * FROM believers WHERE log_id='$id_sys_number'");
$get_data = mysqli_fetch_array($sys_data);
$sum = 0;
if (mysqli_num_rows($sys_data) > 0) { ?>

<div class="form-group">
    <label class="control-label" for="basicinput">Names:</label>
    <input type="text" name='sname' id="basicinput" placeholder="Type second name"
        value="<?php echo $get_data["fname"] . " " . $get_data["lname"];  ?>" readonly="" required=""
        class="span8 form-control">
</div>

<div class="form-group">
    <label class="control-label" for="basicinput">ID Number</label>
    <input type="text" name='id' id="basicinput" maxlength="16" placeholder="Type second name" readonly=""
        value="<?php print($get_data["id_number"]); ?>" required="" class="span8 form-control">
</div>
<table class="table table-responsive">
    <thead>
        <th>Service</th>
        <th>Paid amount</th>
        <th>Paid date</th>
        <th>Status</th>
        <th>Slip</th>

    </thead>
    <?php


        $check_payments = $conn->query("SELECT * FROM payment WHERE believer_id='$id_sys_number'");
        while ($row = mysqli_fetch_array($check_payments)) {
            $check_services = $conn->query("SELECT * FROM services WHERE (((id='" . $row['service_id'] . "')AND(parish_id=0)OR(parish_id='" . $_SESSION["id"] . "')))");
            while ($row2 = mysqli_fetch_array($check_services)) {
        ?>

    <tr>
        <td><?php echo $row2["service_name"]; ?></td>
        <td><?php echo $row["paid_amount"]; ?></td>
        <td><?php echo $row["paid_date"]; ?></td>
        <td><?php echo $row["status"]; ?></td>
        <td><a class="badge badge-success" href="<?php
                                                                $sel = $conn->query("SELECT * FROM payment WHERE user_id='$id_sys_number' and service_id='" . $row['service_id'] . "'");
                                                                $res = mysqli_fetch_array($sel);
                                                                echo $res['payment_method'];
                                                                ?>"><i class="fa fa-eye"></i></a></td>
    </tr>
    <?php $sum = $sum + $row2["payable_amount"];  ?>
    <?php }
        } ?>
    <tr>
        <td>Total: <?php echo $sum; ?></td>
    </tr>
    <?php
        ?>
</table>
<?php } else { ?>
<div class="alert alert-danger">
    <h5>Data Error.</h5>
    <hr>
    <p>Data not found to person of this system number <?php echo $id_sys_number; ?> </p>
</div>
<?php } ?>
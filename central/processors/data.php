<?php 

	include("../includes/connect.php");
	$id_sys_number =  stripslashes($_POST["sys_number"]);
	$sys_data = mysqli_query($conn, "SELECT * FROM believers WHERE log_id='$id_sys_number'");
	$get_data = mysqli_fetch_array($sys_data);
	if (mysqli_num_rows($sys_data) > 0){ ?>

<div class="form-group">
    <label class="control-label" for="basicinput">Names:</label>
    <input type="text" name='sname' id="basicinput" placeholder="Type second name"
        value="<?php echo $get_data["fname"]." ".$get_data["lname"];  ?>" readonly="" required=""
        class="span8 form-control">
</div>

<div class="form-group">
    <label class="control-label" for="basicinput">ID Number</label>
    <input type="text" name='id' id="basicinput" maxlength="16" placeholder="Type second name" readonly=""
        value="<?php  print($get_data["id_number"]); ?>" required="" class="span8 form-control">
</div>


<?php }else{?>
<div class="alert alert-danger">
    <h5>Data Error.</h5>
    <hr>
    <p>Data not found to person of this system number <?php echo $id_sys_number; ?> </p>
</div>
<?php } ?>
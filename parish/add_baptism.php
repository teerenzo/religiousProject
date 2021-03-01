<?php
    include("../includes/connect.php");
    include("includes/session.php");
    $ch_id = $_SESSION["id"];


?>

<?php 
    if(isset($_POST["submit"])){
        $log_id = $_POST["sys_id"];
        $check_log_id = $conn->query("SELECT * FROM believers WHERE log_id='$log_id'");
        $check_exist = $conn->query("SELECT * FROM sacrament_issuing WHERE (((parish_id='".$_SESSION['id']."')AND(believer_id='$log_id')AND(issue='Baptism')))");
        $check_church = $conn->query("SELECT * FROM believers WHERE ((parish_id='$ch_id')AND(log_id='$log_id'))");
        if(!mysqli_num_rows($check_church) > 0){
             echo "<script>alert('Person not registered in our church.');</script>";
        }else{

            if(empty($_POST["sys_id"])){
                   echo "<script>alert('Please enter member system ID.');</script>";
            }else if (mysqli_num_rows($check_log_id) > 0){
                if(mysqli_num_rows($check_exist) > 0){
                    echo "<script>alert('This person of this id ".basename($log_id)." is alredy baptised');</script>";
                }else{
                    $query_system_ins = $conn->query("INSERT INTO sacrament_issuing(issue,parish_id,believer_id) VALUES('Baptism','".$_SESSION['id']."','$log_id')");
                    if($query_system_ins){
                        echo "<script>alert('Data inserted.');</script>";
                    }else{
                       // echo "<script>alert('Something went wrong.');</script>";
                        echo "string".mysqli_error($conn);
                    }
                }
        }else{
            echo "<script>alert('Data not found to person of this system number ".$log_id."');</script>";
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
        <title>Baptise christian</title>
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
                                <h3>Add To Baptism</h3>
                            </div>
                            <div class="module-body">

                                <form method="POST">
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <div class="form-group">
                                                <label class="control-label" for="basicinput">Enter system Id</label>
                                                <input type="text" id="regno" name='sys_id' id="basicinput"
                                                    placeholder="Type first Id" class="span8 form-control">
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <div class="form-group">
                                                <label class="control-label" for="basicinput"></label>
                                                <button style="margin-top:20px;" id="chech-regno"
                                                    class="btn btn-primary"><i class="fa fa-search"></i> Click to search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="disp-result"></div>
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
        $("#chech-regno").on('click', function() {
            var reg = $("#regno").val();
            if (reg == '') {
                alert('Please enter system identification number.')
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
    })
    </script>
</body>
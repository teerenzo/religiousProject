<?php
    include("../includes/connect.php");
    include("protector.php");

        if (isset($_POST["submit"])){
            $name  = $_POST["parish_name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            // checking if fields are not empy
            if(empty($name)){
                $p_id = $_GET["p_id"];
                echo '<script>alert("Field must be filled.");</script>';
                echo "<script>window.location.href='edit-parish?p_id=".$p_id."'</script>";
            }else{
            // query declaration and variables for validating and updating data.
            $select_p = $conn->query("SELECT * FROM parishes WHERE parish_name='$name'");
            $id_valid = mysqli_fetch_array($select_p);
            $id_data = $id_valid["id"];
            if ($id_data != $_GET["p_id"]){
                if (mysqli_num_rows($select_p) > 0){
                    echo '<script>alert("Parish of the same name is already exist, Please try different.");</script>';
                    echo "<script>window.location.href='edit-parish?p_id=".$p_id."'</script>";
                }else{
                    $update_parish_data = $conn->query("UPDATE parishes SET parish_name='$name',email='$email',phone='$phone' WHERE id='".$_GET['p_id']."'");
                    header("location:parishes?change=Parish updated successfully.");  
                }
            }else{
                $update_parish_data = $conn->query("UPDATE parishes SET parish_name='$name',email='$email',phone='$phone' WHERE id='".$_GET['p_id']."'");
                echo '<script>alert("Parish info still thesame.");</script>';
                echo "<script>window.location.href='parishes';</script>";      
            } 
            
            } 
        }
        
    $parish_data_query = mysqli_query($conn,"SELECT * FROM parishes WHERE id='".$_GET['p_id']."'");
    $data = mysqli_fetch_array($parish_data_query);
    $p_name = $data["parish_name"];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit parish <?php echo $p_name; ?></title>
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
                                <h3>Edit <?php echo $p_name; ?> parish info.</h3>
                            </div>
                            <?php 
                                $query_religion_data = $conn->query("SELECT * FROM parishes WHERE id='".$_GET['p_id']."'");
                                $p_data = mysqli_fetch_array($query_religion_data);
                            ?>
                            <div class="module-body">

                                <form method="POST">

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Parish name </label>
                                        <input type="text" name='parish_name' id="basicinput" placeholder="Parish name"
                                            required="" value="<?php echo $p_data["parish_name"];  ?>"
                                            class="span8 form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Email </label>
                                        <input type="text" name='email' id="basicinput" placeholder="Email address"
                                            required="" value="<?php echo $p_data["email"];  ?>"
                                            class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Phone </label>
                                        <input type="text" name='phone' id="basicinput" placeholder="Phone number"
                                            required="" value="<?php echo $p_data["phone"];  ?>"
                                            class="span8 form-control">
                                    </div>



                                    <div class="control-group">
                                        <div class="controls">
                                            <button name="submit" class="btn btn-primary" type="submit"
                                                class="btn">Update</button>
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
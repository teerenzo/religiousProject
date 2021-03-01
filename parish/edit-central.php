<?php
  include("../includes/connect.php");
    include("includes/session.php");

        if (isset($_POST["submit"])){
            $name  = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["tel"];
            // checking if fields are not empy
            if(empty($name)){
                $p_id = $_GET["c_id"];
                echo '<script>alert("Field must be filled.");</script>';
                echo "<script>window.location.href='edit-central?c_id=".$c_id."'</script>";
            }else{
            // query declaration and variables for validating and updating data.
            $select_p = $conn->query("SELECT * FROM centrals WHERE central_name='$name'");
            $id_valid = mysqli_fetch_array($select_p);
            $id_data = $id_valid["id"];
            if ($id_data != $_GET["c_id"]){
                if (mysqli_num_rows($select_p) > 0){
                    echo '<script>alert("Central of the same name is already exist, Please try different.");</script>';
                    echo "<script>window.location.href='edit-parish?p_id=".$c_id."'</script>";
                }else{
                    $update_parish_data = $conn->query("UPDATE centrals SET central_name='$name',email='$email',phone='$phone' WHERE id='".$_GET['c_id']."'");
                    header("location:parishes?change=Central updated successfully.");  
                }
            }else{
                $update_parish_data = $conn->query("UPDATE centrals SET central_name='$name',email='$email',phone='$phone' WHERE id='".$_GET['c_id']."'");
                echo '<script>alert("Central info still thesame.");</script>';
                echo "<script>window.location.href='#';</script>";      
            } 
            
            } 
        }
        
    $parish_data_query = mysqli_query($conn,"SELECT * FROM centrals WHERE id='".$_GET['c_id']."'");
    $data = mysqli_fetch_array($parish_data_query);
    $p_name = $data["central_name"];
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
                                <h3>Edit <?php echo $p_name; ?> Central info.</h3>
                            </div>
                            <?php 
                                $query_religion_data = $conn->query("SELECT * FROM centrals WHERE id='".$_GET['c_id']."'");
                                $p_data = mysqli_fetch_array($query_religion_data);
                            ?>
                            <div class="module-body">

                                <form method="POST">

                                     <div class="form-group">
                                        <label class="control-label" for="basicinput">Central Name</label>
                                        <input type="text" value="<?php echo $p_data['central_name'] ?>" name='name' id="basicinput" placeholder="Type name"
                                            required="" class="span8 form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Email</label>
                                        <input type="email" name='email' value="<?php echo $p_data['email'] ?>" id="basicinput"
                                            placeholder="Enter email" required="" class="span8 form-control">
                                    </div>

                                       <div class="form-group">
                                        <label class="control-label"  for="basicinput">Phone</label>
                                        <input type="number" value="<?php echo $p_data['phone'] ?>" name='tel' id="basicinput" placeholder="Type tel Number"
                                            required="" class="span8 form-control">
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
<?php
    include("../includes/connect.php");
    include("includes/session.php");
    $church_id = $_SESSION["id"];

    if (isset($_POST["submit"])){
        $name  = $_POST["name"];
        $phone = $_POST["phone"];
        $email=$_POST['email'];
        if(empty($name) || empty($email) || empty($phone)){
            echo '<script>alert("Field must be filled.");</script>';
            //echo "<script>window.location.href='new-ctg';</script>";
        }else{
            $query = $conn->query("UPDATE sucursals SET suc_name='$name',email='$email',phone='$phone' WHERE id='".$_GET['sac_id']."'");
            $id1=$_GET['sac_id'];
           if($query){
            echo '<script>alert("Sucursal updated successful.");</script>';
                   echo "<script>window.location.href='edit-sucursal?sac_id=$id1'</script>";
           }else{
            echo "string".mysqli_error($conn);
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
        <title>Register Sucursal</title>
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
                                <h3>Sucursal registration</h3>
                            </div>
                            <div class="module-body">

                                <form method="POST">
                                   <?php
                                   $sel=mysqli_query($conn,"SELECT * FROM sucursals where id='".$_GET['sac_id']."'");
                                    $result=mysqli_fetch_array($sel);

                                        ?>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">name</label>
                                        <input type="text" value="<?php echo $result['suc_name'] ?>" name='name' id="basicinput" placeholder="Type name"
                                            required="" class="span8 form-control">
                                    </div>
                                   


                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Email</label>
                                        <input type="email" value="<?php echo $result['email'] ?>" name="email" id="" required placeholder="Email address"
                                            class="form-control span8">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Phone number</label>
                                        <input type="number" value="<?php echo $result['phone'] ?>" maxlength="10" name="phone" id="" required placeholder="Phone number"
                                            class="form-control span8">
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
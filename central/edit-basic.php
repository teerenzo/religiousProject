<?php
    include("../includes/connect.php");
    include("includes/session.php");
    $church_id = $_SESSION["id"];
    $bid = $_GET['basic_id'];
    error_reporting(0);
    if (isset($_POST["submit"])){
        $name  = $_POST["name"];
        $sac = $_POST["sac"];
        if(empty($name)){
            echo '<script>alert("Field must be filled.");</script>';
            //echo "<script>window.location.href='new-ctg';</script>";
        }else{
            if($sac == 'None'){
                $get_parQuery = $conn->query("SELECT * FROM centrals WHERE id='".$_SESSION["id"]."'");
                $par_data = mysqli_fetch_array($get_parQuery);
                $query = $conn->query("UPDATE basic_churches SET name='$name',sucursal_id=0,central_id='".$_SESSION["id"]."',parish_id='".$par_data["parish_id"]."' WHERE ((central_id='".$_SESSION["id"]."') AND (id='$bid'))");
                if($query){
                    echo '<script>alert("Basic- church info updated successful.");</script>';
                           echo "<script>window.location.href='basic';</script>";
                    }else{
                     echo "string".mysqli_error($conn);
                    }
                
            }else{
                $query1=$conn->query("SELECT id FROM sucursals WHERE suc_name='$sac'");
                $result=mysqli_fetch_array($query1);
                $get_parQuery = $conn->query("SELECT * FROM centrals WHERE id='".$_SESSION["id"]."'");
                $par_data = mysqli_fetch_array($get_parQuery);
                $query = $conn->query("UPDATE basic_churches SET name='$name',sucursal_id='".$result[0]."',central_id='".$_SESSION["id"]."',parish_id='".$par_data["parish_id"]."' WHERE ((central_id='".$_SESSION["id"]."') AND (id='$bid'))");
                if($query){
                    echo '<script>alert("Basic- church info updated successful.");</script>';
                           echo "<script>window.location.href='basic';</script>";
                    }else{
                     echo "string".mysqli_error($conn);
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
        <title>Edit Basic Churches</title>
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
                                <h3>Sucursal Edit</h3>
                            </div>
                            <div class="module-body">

                                <form method="POST">
                                    <?php 

                               $select=$conn->query("SELECT * FROM basic_churches WHERE id ='".$_GET['basic_id']."'");
                               $result=mysqli_fetch_array($select);

                               ?>
                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">name</label>
                                        <input type="text" value="<?php echo $result[1] ?>" name='name' id="basicinput"
                                            placeholder="Type name" required="" class="span8 form-control">
                                    </div>



                                    <div class="form-group">
                                        <label class="control-label" for="basicinput">Sucursal</label>
                                        <select name="sac">
                                            <?php  ?>
                                            <option>
                                                <?php $sel=$conn->query("SELECT * FROM sucursals WHERE id='".$result["sucursal_id"]."'");
                                                  $result1=mysqli_fetch_array($sel);
                                                  echo $result1[3];
                                                 ?></option>
                                            <option>None</option>
                                            <?php
                                           $sel=$conn->query("SELECT * FROM sucursals WHERE central_id='".$_SESSION['id']."' AND suc_name != '".$result1[3]."' ");
                                           while($result=mysqli_fetch_array($sel)){
                                            ?>
                                            <option><?php echo $result[3]; ?></option>
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
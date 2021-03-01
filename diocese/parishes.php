<?php
    include("protector.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Religious computerized services system</title>
    <link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="../css/theme.css" rel="stylesheet">
    <link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
</head>

<body>

    <?php include("includes/nav-top.php"); ?>
    <?php  
    
    if(isset($_GET['change'])){ ?>
    <script>
    alert('<?php echo $_GET["change"]; ?>');
    </script>
    <?php } ?>


    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <?php include("includes/sidebar.php"); ?>
                    <!--/.sidebar-->
                </div>
                <!--/.span3-->
                <div class="span9">
                    <div class="content">

                        <div style="overflow-x: scroll;" class="module">
                            <div class="module-head">
                                <h3>Manage Parishes</h3>
                            </div>
                            <div class="module-body col-lg-12">
                                <table cellpadding="0" cellspacing="0" border="0"
                                    class="datatable-1 table-responsive table table-bordered table-striped	 display"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                Logo
                                            </th>
                                            <th>Parish</th>
                                            <th>Username</th>
                                            <th>Reset password</th>
                                            <th>Edit</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $qr_religions = mysqli_query($conn,"SELECT * FROM parishes WHERE diocese_id = '$id'");
                                            while($row = mysqli_fetch_array($qr_religions)){
                                        ?>
                                        <tr>
                                            <td>
                                                <?php if($row[0]!="parish.png"){ ?>
                                                <img class="user-img" style="height:80px;width:100px;"
                                                    src="../images/accounts/parish.png" title="no image uploaded">
                                                </><?php } else {?>
                                                <a href="#" data-toggle="modal" data-target="#ViewProf"><img
                                                        class="user-img" style="height:80px;width:100px;"
                                                        src="../images/accounts/<?php echo htmlentities($row['logo']);?>"
                                                        title="<?php echo $row["name"]; ?>&nbsp;logo"></a>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $row["parish_name"] ?></td>
                                            <td>
                                                <?php 
                                                $fetch_user = $conn->query("SELECT * FROM users WHERE ((user_id='".$row["id"]."')and(user_type='parish'))");
                                                while($rows = mysqli_fetch_array($fetch_user)){
                                                    echo $rows["username"];
                                                    $disp_username = $rows["username"];
                                                    $base_username = $rows["username"]; 
                                                    $disp_id = $rows["id"];
                                                } ?>

                                            </td>
                                            <?php 
                                              
                                                //$base_name = $row["name"];
                                            ?>
                                            <td><a class="btn btn-info btn-xs"
                                                    onclick="return confirm('Are you sure you want to reset password for this account?')"
                                                    href="reset-parish-pass?p_id=<?php echo $disp_id; ?>"> <i
                                                        class="fa fa-cog" aria-hidden="true"></i> Reset</a>
                                            </td>
                                            <td><a onclick="return confirm('Do you want to edit this record ?')"
                                                    class="btn btn-success btn-xs"
                                                    href="edit-parish?p_id=<?php echo $row["id"];  ?>"> <i
                                                        class="fa fa-edit" aria-hidden="true"></i> Edit</a></td>
                                            <td><a onclick="return confirm('Do you want to delete this record ?')"
                                                    class="btn btn-danger btn-xs"
                                                    href="delete-parish?p_id=<?php echo $row["id"];  ?>"> <i
                                                        class="fa fa-remove" aria-hidden="true"></i> Remove</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/.module-->

                        <br />

                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->

    <?php include("includes/footer.php"); ?>

    <script src="../scripts/jquery-1.9.1.min.js"></script>
    <script src="../scripts/jquery-ui-1.10.1.custom.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../scripts/datatables/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function() {
        $('.datatable-1').dataTable();
        $('.dataTables_paginate').addClass("btn-group datatable-pagination");
        $('.dataTables_paginate > a').wrapInner('<span />');
        $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
        $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    });
    </script>
</body>
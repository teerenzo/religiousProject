<?php include("urls.php"); 

?>
<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a><a class="brand" href="<?php echo $index; ?>">
                <div class="img-rounded">
                    <img class="user-img" style="height:80px;width:80px;" src="../images/accounts/parish.png"
                        title="no image uploaded">Diocese <?php echo $name_top; ?>
                </div>
            </a>
            <div class="nav-collapse collapse navbar-inverse-collapse">
                <!--
                <ul class="nav nav-icons">
                    <li class="active"><a href="#"><i class="icon-envelope"></i></a></li>
                    <li><a href="#"><i class="icon-eye-open"></i></a></li>
                    <li><a href="#"><i class="icon-bar-chart"></i></a></li>
                </ul>-->

                <ul class="nav pull-right">

                    <li><a href="#"><?php echo $email_top; ?> </a></li>
                    <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="../images/user.png" class="nav-avatar" />
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile">Your Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $logout; ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<?php include("urls.php"); ?>
<?php
// $qry = $conn->query("SELECT * FROM religion WHERE religionId='".$_SESSION['id']."'");
// $query_data = mysqli_fetch_array($qry);
// $category_data = $query_data["status"]; 
?>
<div class="sidebar">
    <ul class="widget widget-menu unstyled">
        <li class="active"><a href="homepage"><i class="menu-icon icon-dashboard"></i>Dashboard
            </a></li>

    </ul>
    <!--/.widget-nav-->





    <ul class="widget widget-menu unstyled">
        <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                </i>Certificates </a>
            <ul id="togglePages" class="collapse unstyled">
                <li><a href="baptism_cert"><i class="icon-inbox"></i>Baptism </a></li>
                <li><a href="eucharist_cert"><i class="icon-inbox"></i>Euchrist</a></li>
                <li><a href="sustenance_cert"><i class="icon-inbox"></i>Sustanance</a></li>
                <li><a href="mariage_cert"><i class="icon-inbox"></i>Marriage</a></li>
            </ul>
        </li>
    </ul>




    <!--
    <ul class="widget widget-menu unstyled">
        <li><a class="collapsed" data-toggle="collapse" href="#toggleSacra"><i class="menu-icon icon-cog">
                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                </i>Offerings </a>
            <ul id="toggleSacra" class="collapse unstyled">
                <li><a href="new-sacra"><i class="icon-inbox"></i>New </a></li>
                <li><a href="sacraments"><i class="icon-inbox"></i>Registered </a></li>
            </ul>
        </li>
    </ul>
-->



</div>
    <?php include("urls.php"); ?>

    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li class="active"><a href="<?php echo $index; ?>"><i class="menu-icon icon-dashboard"></i>Dashboard
                </a></li>
        </ul>
        <!--/.widget-nav-->


        <ul class="widget widget-menu unstyled">
            <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                    </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                    </i>Parishes </a>
                <ul id="togglePages" class="collapse unstyled">
                    <li><a href="<?php echo $new_parish; ?>"><i class="icon-inbox"></i>Register Parish </a></li>
                    <li><a href="<?php echo $parishes; ?>"><i class="icon-inbox"></i>All Parish </a></li>
                </ul>
            </li>
        </ul>

       <!--  <ul class="widget widget-menu unstyled">
            <li><a class="collapsed" data-toggle="collapse" href="#toggleReportChrist"><i class="menu-icon icon-cog">
                    </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                    </i>Report </a>
                <ul id="toggleReportChrist" class="collapse unstyled">
                    <li><a href="#"><i class="icon-inbox"></i>Parishes </a></li>
                    <li><a href="#"><i class="icon-inbox"></i>Christians </a></li>
                </ul>
            </li>
        </ul> -->


    </div>
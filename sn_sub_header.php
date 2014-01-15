<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><?php echo $db_labels[$db_name]; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li <?php if ($sn_subname == 'sn_profile') echo 'class="active"'; ?>><a href="sn_profile.php?db_name=<?php echo $db_name; ?>">按语义类型浏览</a></li>
            <li <?php if ($sn_subname == 'sn_relation_search') echo 'class="active"'; ?>><a href="sn_relation_search.php?db_name=<?php echo $db_name; ?>">语义关系搜索</a></li> 
            <li <?php if ($sn_subname == 'sn_report_class_list') echo 'class="active"'; ?>><a href="sn_report_class_list.php?db_name=<?php echo $db_name; ?>">语义类型列表</a></li>    
            <li <?php if ($sn_subname == 'sn_report_objproperty_list') echo 'class="active"'; ?>><a href="sn_report_objproperty_list.php?db_name=<?php echo $db_name; ?>">语义关系列表</a></li>    
            <li <?php if ($sn_subname == 'sn_report_litproperty_list') echo 'class="active"'; ?>><a href="sn_report_litproperty_list.php?db_name=<?php echo $db_name; ?>">文字属性列表</a></li>       
        </ul>          
    </div><!-- /.navbar-collapse -->
</nav>


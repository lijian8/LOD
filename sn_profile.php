<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");
include_once ("./sn_helper.php");

function render_class_table($dbc, $db_name, $active_class) {
    $query = "select value, count from cls order by count desc";
    $result = mysqli_query($dbc, $query) or die('Error querying database: ' . $query);

    while ($row = mysqli_fetch_array($result)) {
        $value = $row[0];
        $count = $row[1];
        echo '<li ';
        if (isset($active_class) && ($active_class == $value)) {
            echo 'class = "active"';
        }
        echo '><a href = "sn_profile.php?';

        echo 'db_name=' . $db_name . '&active_class=' . $value . '">' . $value . '&nbsp;<span class="badge">' . $count . '</span>' . '</a></li>';
    }
}

if (isset($_GET['active_class'])) {
    $active_class = $_GET['active_class'];
}

$num_of_cls = sn_get_num_cls($dbc);
$num_of_props = sn_get_num_of_props($dbc);
?>

<script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-146052-10']);
    _gaq.push(['_trackPageview']);
    (function() {
        var ga = document.createElement('script');
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>

<div class="container">
    <?php
    $sn_name = $db_name;
    include_once ("sn_header.php");
    ?>  
   
    <br>
   

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
                <li class="active"><a href="#">按语义类型浏览</a></li>
        <li><a href="sn_relation_search.php?db_name=<?php echo $db_name; ?>">语义关系搜索</a></li>                   
            </ul>          
        </div><!-- /.navbar-collapse -->
    </nav>
 <p>该语义网络包括<?php echo $num_of_cls; ?>个语义类型，<?php echo $num_of_props; ?>种语义关系：</p>

    <p></p>







    <div>

        <div class="row">
            <div class="col-md-6">
                <ul  class="well nav nav-pills">  
                    <?php render_class_table($dbc, $db_name, $active_class, true); ?>
                </ul>
            </div>
            <div class="col-md-6" role="main">     
                <div class="panel-group" id="accordion">

                    <?php
                    if (isset($active_class)) {

                        $query = "select * from semantic_network where subject = '$active_class' and property != '上位词' and property != '下位词' order by count desc";

                        $result = mysqli_query($dbc, $query) or die('Error querying database: ' . $query);
                        while ($row = mysqli_fetch_array($result)) {
                            ?>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#<?php echo 'x' . $row[id]; ?>">
                                            <?php
                                            echo $row['property'] . '&nbsp;' . $row['object'] . '&nbsp;<span class="badge">' . $row['count'] . '</span>';
                                            ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="<?php echo 'x' . $row[id]; ?>" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <table class="table table-hover">
                                            <tbody>

                                                <?php
                                                $ids = explode('|', $row['instances']);
                                                $i = 0;
                                                $color = true;
                                                while ($i < min(array(10, count($ids)))) {
                                                    if ($color) {
                                                        echo '<tr>';
                                                    } else {
                                                        echo '<tr class="info">';
                                                    }
                                                    $color = !$color;


                                                    $q1 = "select * from graph where id = '$ids[$i]'";
                                                    //$q1 = "select * from graph where id = '$ids[0]'";

                                                    $r1 = mysqli_query($dbc, $q1) or die('Error querying database:' . $q1);
                                                    if ($row1 = mysqli_fetch_array($r1)) {
                                                        //echo '<p>' . $row1[0] . '</p>';
                                                        echo '<td width = "35%">' . render_value($dbc, $db_name, $row1['subject'], false) . '</td>';
                                                        echo '<td width = "30%">' . $row1['property'] . '</td>';
                                                        echo '<td width = "35%">' . render_value($dbc, $db_name, $row1['value'], false) . '</td>';
                                                        //echo '<td width = "12%">';
                                                        //echo '<a class="btn btn-primary btn-xs" href="relation.php?id=' . $row['id'] . '"><span class="glyphicon glyphicon-search"></span>&nbsp;查看</a>';
                                                        //echo '&nbsp
                                                        //echo '</td>';
                                                        echo '</tr>';
                                                    }
                                                    $i = $i + 1;
                                                }
                                                ?>


                                            </tbody>
                                        </table>

                                        <a target="blank" href="sn_triple_type.php?db_name=<?php echo $db_name; ?>&type=<?php echo $row[id]; ?>">查看更多>></a>
                                    </div>
                                </div>
                            </div>




                            <?php
                        }
                    } else {
                        render_warning('<<请在右侧选择类型以查看其实例');
                    }
                    ?>
                </div>






            </div>    
        </div>
    </div>

</div>


<?php
include_once ("./foot.php");
?>

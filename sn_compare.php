<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_array.php");
include_once ("./sn_helper.php");


function get_cls($dbc) {
    $query = "select value from cls order by count desc";
    $result = mysqli_query($dbc, $query) or die('Error querying database: ' . $query);
    $classes = array();
    while ($row = mysqli_fetch_array($result)) {
        $value = $row[0];
        $classes[] = $value;
    }
    return $classes;
}

if (isset($_GET['active_class'])) {
    $active_class = $_GET['active_class'];
}

if (isset($_POST['sdb_name'])) {
    $sdb_name = trim($_POST['sdb_name']);
} elseif (isset($_GET['sdb_name'])) {
    $sdb_name = trim($_GET['sdb_name']);
} else {
    $sdb_name = 'tcmls';
}

if (isset($_POST['tdb_name'])) {
    $tdb_name = trim($_POST['tdb_name']);
} elseif (isset($_GET['tdb_name'])) {
    $tdb_name = trim($_GET['tdb_name']);
} else {
    $tdb_name = 'tcmls';
}


$sdb = $dbs["$sdb_name"];
$sdbc = mysqli_connect($sdb[0], $sdb[1], $sdb[2], $sdb[3]) or die('Error connecting to MySQL server:' . $sdb_name);
//define('PREFIX', $sdb_name . ':o');

$tdb = $dbs["$tdb_name"];
$tdbc = mysqli_connect($tdb[0], $tdb[1], $tdb[2], $tdb[3]) or die('Error connecting to MySQL server:' . $tdb_name);
//define('PREFIX', $tdb_name . ':o

$s_cls = get_cls($sdbc);
$t_cls = get_cls($tdbc);
$common_cls = array_intersect($s_cls, $t_cls);

$only_s_cls = array_diff($s_cls, $t_cls);
$only_t_cls = array_diff($t_cls, $s_cls);
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
    <h1><?php echo $db_labels[$sdb_name] . '&nbsp;vs.&nbsp;' . $db_labels[$tdb_name]; ?></h1>










    <div>

        <div class="row">
            <div class="col-md-6">

                
                <ul  class="well nav nav-pills">  
                    <li><a href="#"> 共同的类:</a></li>
                    <?php
                    foreach ($common_cls as $value) {
                        echo '<li ';
                        if (isset($active_class) && ($active_class == $value)) {
                            echo 'class = "active"';
                        }
                        echo '><a href = "sn_profile.php?';

                        echo 'db_name=' . $db_name . '&active_class=' . $value . '">' . $value . '&nbsp;' . '</a></li>';
                    }
                    ?>
                </ul>
                
                 <ul  class="well nav nav-pills">  
                    <li><a href="#"> 前者的类:</a></li>
                    <?php
                    foreach ($only_s_cls as $value) {
                        echo '<li ';
                        if (isset($active_class) && ($active_class == $value)) {
                            echo 'class = "active"';
                        }
                        echo '><a href = "sn_profile.php?';

                        echo 'db_name=' . $db_name . '&active_class=' . $value . '">' . $value . '&nbsp;' . '</a></li>';
                    }
                    ?>
                </ul>
                  <ul  class="well nav nav-pills">  
                    <li><a href="#"> 后者的类:</a></li>
                    <?php
                    foreach ($only_t_cls as $value) {
                        echo '<li ';
                        if (isset($active_class) && ($active_class == $value)) {
                            echo 'class = "active"';
                        }
                        echo '><a href = "sn_profile.php?';

                        echo 'db_name=' . $db_name . '&active_class=' . $value . '">' . $value . '&nbsp;' . '</a></li>';
                    }
                    ?>
                </ul>
                
                
            </div>
            <div class="col-md-6" role="main">     
                <div class="panel-group" id="accordion">

                    <?php
                    /*
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

                      <a target="blank" href="sn_triple_type.php?type=<?php echo $row[id]; ?>">查看更多>></a>
                      </div>
                      </div>
                      </div>




                      <?php
                      }
                      } else {
                      render_warning('<<请在右侧选择类型以查看其实例');
                      } */
                    ?>
                </div>






            </div>    
        </div>
    </div>

</div>


<?php
include_once ("./foot.php");
?>

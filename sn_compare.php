<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_array.php");
include_once ("./sn_helper.php");

function render_cls_list($cls, $active_class, $url) {
    if (count($cls) == 0) echo '<li>无</li>';
                        
    foreach ($cls as $value) {
        echo '<li ';
        if (isset($active_class) && ($active_class == $value)) {
            echo 'class = "active"';
        }
        echo '><a href = "' . $url . '&' . 'active_class=' . $value . '">' . $value . '&nbsp;' . '</a></li>';
    }
}

function render_pvs($pv_list, $url) {
    if (count($pv_list) == 0) {
        echo '<li>无</li>';
    }
    foreach ($pv_list as $pv) {
        $pv_array = split('\\|', $pv);
        $property = $pv_array[0];
        $value = $pv_array[1];
        echo '<li><a href = "' . $url . '&' . 'active_class=' . $value . '">' . $property . '&nbsp;' . $value . '</a></li>';
    }
}

function get_pv_pairs($dbc, $active_class) {
    $query = "select * from semantic_network where subject = '$active_class' and property != '上位词' and property != '下位词' order by count desc";
    $result = mysqli_query($dbc, $query) or die('Error querying database: ' . $query);
    $pv_pairs = array();
    while ($row = mysqli_fetch_array($result)) {
        $pv_pairs[] = $row[property] . '|' . $row[object];
    }
    return $pv_pairs;
}

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

$url = $_SERVER[PHP_SELF] . '?sdb_name=' . $sdb_name . '&tdb_name=' . $tdb_name;
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
                <div  class="well">
                    <p>在<?php echo $db_labels[$sdb_name]; ?>和<?php echo $db_labels[$tdb_name]; ?>中均出现的类:</p>
                    <ul  class="nav nav-pills">  

                        <?php
                        render_cls_list($common_cls, $active_class, $url);
                        ?>
                    </ul>
                    <hr>
                    <p>仅在<?php echo $db_labels[$sdb_name]; ?>中出现的类:</p>
                    <ul  class="nav nav-pills">  

                        <?php
                        render_cls_list($only_s_cls, $active_class, $url);
                        ?>
                    </ul>
                    <hr>
                    <p>仅在<?php echo $db_labels[$tdb_name]; ?>中出现的类:</p>
                    <ul  class="nav nav-pills">  

                        <?php
                        render_cls_list($only_t_cls, $active_class, $url);
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-6" role="main">     
                <div class="well">
                    <?php
                    if (isset($active_class)) {
                        $s_pv_pairs = get_pv_pairs($sdbc, $active_class);
                        $t_pv_pairs = get_pv_pairs($tdbc, $active_class);

                        $common_pv_pairs = array_intersect($s_pv_pairs, $t_pv_pairs);
                        $only_s_pv_pairs = array_diff($s_pv_pairs, $t_pv_pairs);
                        $only_t_pv_pairs = array_diff($t_pv_pairs, $s_pv_pairs);
                        
                        echo '<p>在"' . $db_labels[$sdb_name] . '"和"' . $db_labels[$tdb_name] . '"中均出现的语义关系&nbsp;<span class="badge">' . count($common_pv_pairs) . '</span>:</p>';
                        
                        if (count($common_pv_pairs) == 0) {
                            echo '<li>无</li>';
                        } else {
                            echo '<table width="100%">';
                            echo '<tr>';
                            echo '<td width="48%">' . $db_labels[$sdb_name] . '</td>';
                            echo '<td/>';
                            echo '<td width="48%">' . $db_labels[$tdb_name] . '</td>';
                            echo '</tr>';
                            foreach ($common_pv_pairs as $pv) {
                                $pv_array = split('\\|', $pv);
                                $property = $pv_array[0];
                                $value = $pv_array[1];
                                echo '<tr>';
                                echo '<td><a href = "sn_relation_search.php?db_name=' . $sdb_name . '&subject=' . $active_class . '&predicate=' . $property . '&object=' . $value . '">' . $property . '&nbsp;' . $value . '</a></td>';
                                echo '<td>=</td>';
                                echo '<td><a href = "sn_relation_search.php?db_name=' . $tdb_name . '&subject=' . $active_class . '&predicate=' . $property . '&object=' . $value . '">' . $property . '&nbsp;' . $value . '</a></td>';
                                echo '</tr>';
                            }
                            echo ' </table>';
                        }
                        ?>

                        <hr>
                        <?php 
                        echo '<p>仅在' . $db_labels[$sdb_name] . '中出现的语义关系&nbsp;<span class="badge">' . count($only_s_pv_pairs) . '</span>:</p>';                  
                        
                        ?>
                        <ul  class="nav nav-pills">  
                            <?php
                            render_pvs($only_s_pv_pairs, '');
                            ?>
                        </ul>
                        <hr>
                        
                        <?php echo '<p>仅在' . $db_labels[$tdb_name] . '中出现的语义关系&nbsp;<span class="badge">' . count($only_t_pv_pairs) . '</span>:</p>'; ?>                 
                        <ul  class="nav nav-pills">  
                            <?php
                            render_pvs($only_t_pv_pairs, '');
                            ?>
                        </ul>
                        <?php
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

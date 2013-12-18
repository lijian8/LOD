<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_array.php");
include_once ("./sn_helper.php");

function render_cls_list($cls, $active_class, $url) {
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
    $tdb_name = 'docs';
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
    <h1><?php echo $db_labels[$sdb_name] . '与' . $db_labels[$tdb_name]; ?>语义网络比较报表</h1>
    <table class="table-bordered" width="100%">
        <thead>
            <tr>
                <th width="15%">
                    语义类型（主体）
                </th>
                <th width="17%">
                    <?php echo $db_labels[$sdb_name]; ?>语义类型间的语义关系 
                </th>
                <th width="17%">
                    <?php echo $db_labels[$tdb_name]; ?>语义类型间的语义关系 
                </th>
                <th width="17%">
                    共同的
                </th>
                <th width="17%">
                    仅在<?php echo $db_labels[$sdb_name]; ?>里出现的
                </th>
                <th width="17%">
                    仅在<?php echo $db_labels[$tdb_name]; ?>里出现的
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($common_cls as $active_class){
                 $s_pv_pairs = get_pv_pairs($sdbc, $active_class);
                 $t_pv_pairs = get_pv_pairs($tdbc, $active_class);

                 $common_pv_pairs = array_intersect($s_pv_pairs, $t_pv_pairs);
                 $only_s_pv_pairs = array_diff($s_pv_pairs, $t_pv_pairs);
                 $only_t_pv_pairs = array_diff($t_pv_pairs, $s_pv_pairs);
                 
                 echo '<tr>';
                 echo '<td>' . $active_class . '</td>';                
                 echo '<td>' . count($s_pv_pairs) . '</td>';
                 echo '<td>' . count($t_pv_pairs) . '</td>';
                 echo '<td>' . count($common_pv_pairs) . '</td>';
                 echo '<td>' . count($only_s_pv_pairs) . '</td>';
                 echo '<td>' . count($only_t_pv_pairs) . '</td>';
                 
                 echo '</tr>';
            }
            ?>
            
                <td>
                    11
                </td>
                 <td>
                    11
                </td>
                <td>
                    11
                </td>
                <td>
                    11
                </td>
                <td>
                    11
                </td>
                <td>
                    11
                </td>
            </tr>
        </tbody>

    </table>
    <p></p>
   

</div>


<?php
include_once ("./foot.php");
?>

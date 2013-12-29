<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");
include_once ("./sn_helper.php");

$classes_array = array();
$classes_counts = array();
$total_classes_counts = 0;

$properties_array = array();
$properties_counts = array();
$total_properties_counts = 0;

$dbs = array("tcmls" => $tcmls, "tcmct" => $tcmct, "clan" => $clan, "spleen" => $spleen);

foreach ($dbs as $db_id => $db) {

    $dbc = mysqli_connect($db[0], $db[1], $db[2], $db[3]) or die('Error connecting to MySQL server.');

    $classes_array[$db_id] = get_classes_from_sn($dbc);
    // print_r($classes_array[$db_id]);
    $classes_counts[$db_id] = count($classes_array[$db_id]);

    $total_classes_counts = $total_classes_counts + $classes_counts[$db_id];

    $properties_array[$db_id] = get_properties_from_sn($dbc);

    $properties_counts[$db_id] = count($properties_array[$db_id]);

    $total_properties_counts = $total_properties_counts + $properties_counts[$db_id];
    
    $num_triples[$db_id] = sn_get_num_triples($dbc);
}
arsort($classes_counts);
?>


<div class="container">


    <div class="jumbotron" align ="center">
        <h1><?php echo $total_classes_counts; ?>个类型,<?php echo $total_properties_counts ?>个属性</h1>       
    </div>
    <h1>该系统已集成了如下的语义网络：</h1>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th width="10%">语义网络</th>
                <th width="40%">语义类型</th>
                <th width="40%">语义关系（属性）</th>
                <th width="10%">网络边数</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($classes_array as $db_id => $classes) {
                echo '<tr>';
                echo '<td><a href="sn_profile.php?db_name=' . $db_id . '">' . $db_labels[$db_id] . '</a></td>';
                echo '<td>';

                echo $classes_counts[$db_id] . '个语义类型（';

                $i = 0;

                foreach ($classes_array[$db_id] as $c) {
                    if ($i++ > 10) {
                        echo '...';
                        break;
                    }
                    echo '<a href="sn_profile.php?db_name=' . $db_id . '&active_class=' . $c . '">' . $c . "</a>&nbsp;";
                }
                echo '）';
                echo '</td>';
                echo '<td>';
                echo $properties_counts[$db_id] . '种语义关系（';

                $i = 0;

                foreach ($properties_array[$db_id] as $c) {
                    if ($i++ > 10) {
                        echo '...';
                        break;
                    }
                    echo '<a href="sn_relation_search.php?db_name=' . $db_id . '&predicate=' . $c . '">' . $c . "</a>&nbsp;";
                }


                echo '</td>';
                echo '<td>' . $num_triples[$db_id] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include_once ("./foot.php");
?>
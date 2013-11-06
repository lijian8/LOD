<?php
include_once ("./header.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_array.php");

$classes_array = array();
$classes_counts = array();
$total_classes_counts = 0;

$properties_array = array();
$properties_counts = array();
$total_properties_counts = 0;

$dbs = array("tcmls" => $tcmls);

foreach ($dbs as $db_id => $db) {

    $dbc = mysqli_connect($db[0], $db[1], $db[2], $db[3]) or die('Error connecting to MySQL server.');

    $classes_array[$db_id] = get_classes_from_sn($dbc);
    // print_r($classes_array[$db_id]);
    $classes_counts[$db_id] = count($classes_array[$db_id]);

    $total_classes_counts = $total_classes_counts + $classes_counts[$db_id];

    $properties_array[$db_id] = get_properties_from_sn($dbc);

    $properties_counts[$db_id] = count($properties_array[$db_id]);
    $total_properties_counts = $total_properties_counts + $properties_counts[$db_id];
}
arsort($classes_counts);
?>


<div class="container">


    <div class="jumbotron" align ="center">
        <h1><?php echo $total_classes_counts; ?>个类型,<?php echo $total_properties_counts ?>个属性</h1>
        <p>一个关于中医药领域人、事、物的知识整合平台。</p>
    </div>
    <h1>该系统已集成了如下的知识资源：</h1>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>语义网络</th>
                <th>类型</th>
                <th>属性</th>
                <th>边数</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($classes_array as $db_id => $classes) {
                echo '<tr>';
                echo '<td><a href="sn_profile.php?db_name=' . $db_id . '">' . $db_labels[$db_id] . '</a></td>';
                echo '<td>';
                echo '<ul class="nav nav-pills">';

               
                
                foreach($classes_array[$db_id] as $c){
                    echo '<li><a>' . $c . "</a></li>";
                    
                }


             
                echo '</ul>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include_once ("./foot.php");
?>
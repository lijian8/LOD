<?php
include_once ("./header.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_array.php");

$entity_counts = array();
$total_entity_counts = 0;
foreach ($dbs as $db_id => $db) {
    $dbc = mysqli_connect($db[0], $db[1], $db[2], $db[3]) or die('Error connecting to MySQL server.');
    $entity_counts[$db_id] = get_num_of_entities($dbc);
    $total_entity_counts = $total_entity_counts + $entity_counts[$db_id];
}

$fact_counts = array();
$total_fact_counts = 0;
foreach ($dbs as $db_id => $db) {
    $dbc = mysqli_connect($db[0], $db[1], $db[2], $db[3]) or die('Error connecting to MySQL server.');
    $fact_counts[$db_id] = get_num_of_facts($dbc);
    $total_fact_counts = $total_fact_counts + $fact_counts[$db_id];
}
arsort($entity_counts);
?>


<div class="container">


    <div class="jumbotron" align ="center">
        <h1><?php echo $total_entity_counts; ?>个实体,<?php echo $total_fact_counts ?>条陈述</h1>
        <p>一个关于中医药领域人、事、物的知识整合平台。</p>
    </div>
    <h1>该系统已集成了如下的知识资源：</h1>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>知识库</th>
                <th>实体</th>
                <th>陈述</th>            
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($entity_counts as $db_id => $entity_count) {
                echo '<tr>';
                echo '<td><a href="db_profile.php?db_name=' . $db_id . '">' . $db_labels[$db_id] . '</a></td>';
                echo '<td>' . $entity_count . '</td>';
                echo '<td>' . $fact_counts[$db_id] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include_once ("./foot.php");
?>
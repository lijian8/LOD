<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");

function render_relation_table($dbc, $db_name, $active_class, $active_relation) {
    $query = "select property, count(*) c from graph group by property order by c desc";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');
    echo '<ul class = "nav nav-pills">';

    while ($row = mysqli_fetch_array($result)) {
        $value = $row[0];
        $count = $row[1];
        echo '<li ';
        if (isset($active_relation) && ($active_relation == $value)) {
            echo 'class = "active"';
        }
        echo '><a href = "db_profile.php?';
        if (isset($active_class)) {
            echo 'active_class=' . $active_class . '&';
        }
        echo 'db_name=' . $db_name . '&active_relation=' . $value . '">' . $value . '&nbsp;<span class="badge">' . $count . '</span>' . '</a></li>';
    }
    echo '</ul>';
}

function render_class_table($dbc, $db_name, $active_class, $active_relation) {
    $query = "select value,count(*) c from graph where property='类型' group by value order by c desc";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');
    echo '<ul class = "nav nav-pills">';

    while ($row = mysqli_fetch_array($result)) {
        $value = $row[0];
        $count = $row[1];
        echo '<li ';
        if (isset($active_class) && ($active_class == $value)) {
            echo 'class = "active"';
        }
        echo '><a href = "db_profile.php?';
        if (isset($active_relation)) {
            echo 'active_relation=' . $active_relation . '&';
        }
        echo 'db_name=' . $db_name . '&active_class=' . $value . '">' . $value . '&nbsp;<span class="badge">' . $count . '</span>' . '</a></li>';
    }
    echo '</ul>';
}

if (isset($_GET['active_class'])) {
    $active_class = $_GET['active_class'];
}

if (isset($_GET['active_relation'])) {
    $active_relation = $_GET['active_relation'];
}
?>
<div class="container">
    <h1><?php echo $db_labels[$db_name]; ?></h1>
    <p>
        包括<?php echo get_num_of_entities($dbc); ?>个实体，分为如下类型：</p>
    <div class="panel panel-info">
        <div class="panel-heading">
            <?php render_class_table($dbc, $db_name, $active_class, $active_relation); ?>        

        </div>

        <div class = "panel-body">
            <?php
            if (isset($active_class)) {

                $query = "select * from graph where property = '" . ENTITY_TYPE . "' and value = '$active_class' limit 20";
                $result = mysqli_query($dbc, $query) or die('Error querying database2.');
                $n = 0;
                while ($row = mysqli_fetch_array($result)) {
                    echo render_value($dbc, $db_name, $row[subject], false) . "&nbsp;|&nbsp;";
                    $n = $n + 1;
                }
                
                if ($n == 20) echo '更多>>';
            }
            ?>
        </div>
    </div>

    <p>
        包括<?php echo get_num_of_facts($dbc); ?>条陈述，分为如下类型：</p>

    <div class="panel panel-info">
        <div class="panel-heading">
            <?php render_relation_table($dbc, $db_name, $active_class, $active_relation); ?>  
        </div>


    </div>



</div>





<?php
include_once ("./foot.php");
?>

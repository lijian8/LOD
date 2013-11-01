<?php

function render_syndrome($dbc, $db_name, $id) {
    echo '<p>证候：';
    $diseases = array();
    $values = array_merge(get_values($dbc, PREFIX . $id, "证候（调整）"));
    foreach ($values as $value) {
        if (array_key_exists($value, $diseases)) {
            $diseases[$value] = $diseases[$value] + 1;
        } else {
            $diseases[$value] = 1;
        }
    }

    arsort($diseases);

    $diseases = array_slice(array_keys($diseases), 0, 5);

    
    foreach ($diseases as $value) {

        //echo '<li class="list-group-item">';   
      
        echo render_value($dbc, $db_name, $value, true);
        echo '&nbsp;<a class="btn btn-xs btn-primary" href="qa.php?db_name=' . $db_name . '&keywords=' . get_entity_name($dbc, $value) . '&question_type=证候" ><span class="glyphicon glyphicon-search"></span></a>';
        echo '&nbsp;';
    }
   echo '</p>';
}

function render_symptom($dbc, $db_name, $id) {
    echo '<p>症状：</p>';
    $diseases = array();
    $values = array_merge(get_values($dbc, PREFIX . $id, "症状加（调整）"));
    foreach ($values as $value) {
        if (array_key_exists($value, $diseases)) {
            $diseases[$value] = $diseases[$value] + 1;
        } else {
            $diseases[$value] = 1;
        }
    }

    arsort($diseases);

    $diseases = array_slice(array_keys($diseases), 0, 5);

    echo '<ol>';
    foreach ($diseases as $value) {

        //echo '<li class="list-group-item">';   
        echo '<li>';
        echo render_value($dbc, $db_name, $value, true);
        echo '&nbsp;<a class="btn btn-xs btn-primary" href="qa.php?db_name=' . $db_name . '&keywords=' . get_entity_name($dbc, $value) . '&question_type=症状" ><span class="glyphicon glyphicon-search"></span></a>';
        echo '<p/></li>';
    }
    echo '</ol>';
}

function render_treatment($dbc, $db_name, $id) {
    echo '<p>系统为您推荐如下的方剂：</p>';
    $formulas = array();

    $values = array_merge(get_values($dbc, PREFIX . $id, "方剂加（调整）"), get_values($dbc, PREFIX . $id, "方剂（调整）"));
    foreach ($values as $value) {
        if (array_key_exists($value, $formulas)) {
            $formulas[$value] = $formulas[$value] + 1;
        } else {
            $formulas[$value] = 1;
        }
    }

    arsort($formulas);

    $formulas = array_slice(array_keys($formulas), 0, 5);

    echo '<ol>';
    foreach ($formulas as $value) {

        //echo '<li class="list-group-item">';   
        echo '<li>';
        echo render_value($dbc, $db_name, $value, true);
        echo '<p/></li>';
    }
    echo '</ol>';
}

$ids = array();
$id = get_entity_of_type($dbc, $keywords, $question_type);
if ($id != '') {
    array_push($ids, $id);
} else {
    $names = get_names($keywords);
    foreach ($names as $name) {
        $id = get_entity_of_type($dbc, $name, $question_type);
        if ($id != '') {
            array_push($ids, $id);
        }
    }
}






if (!empty($ids)) {
    echo '<p>您输入的证候加减为：';
    foreach ($ids as $id) {
        echo '&nbsp;' . render_value($dbc, $db_name, PREFIX . $id, false);
    }
    echo '</p>';

    foreach ($ids as $id) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><?php echo get_entity_name($dbc, PREFIX . $id); ?></strong>
            </div>
            <div class="panel-body">
                <?php render_syndrome($dbc, $db_name, $id); ?>
                <hr/> 
                <?php render_symptom($dbc, $db_name, $id); ?>
                <hr/> 
                <?php render_treatment($dbc, $db_name, $id); ?>
                

                
            </div>

        </div>
        <?php
    }
} else {
    render_warning('对不起！我们的知识库中尚无与"' . $keywords . '"相关的知识！');
}
?>

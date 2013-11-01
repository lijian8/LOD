<?php

function render_syndromes($dbc, $db_name, $id) {
    echo '<p>系统为您推荐如下的证候：</p>';
    $diseases = array();
    $values = array_merge(get_subjects($dbc, PREFIX . $id, "现象表达"));
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
        echo '&nbsp;<a class="btn btn-xs btn-primary" href="qa.php?db_name=' . $db_name . '&keywords=' . get_entity_name($dbc, $value) . '&question_type=疾病" ><span class="glyphicon glyphicon-search"></span></a>';
        echo '<p/></li>';
    }
    echo '</ol>';
}

function render_treatment($dbc, $db_name, $id) {
    echo '<p>系统为您推荐如下的方剂：</p>';
    $formulas = array();

    $values = array_merge(get_subjects($dbc, PREFIX . $id, "治疗"), get_values($dbc, PREFIX . $id, "被...治疗"));
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

$names = get_names($keywords);

$ids = array();
foreach ($names as $name) {
    $id = get_entity_of_type($dbc, $name, $question_type);
    if ($id != '') {
        array_push($ids, $id);
    }
}



if (!empty($ids)) {
    echo '<p>您输入的疾病为：';
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
                <?php render_treatment($dbc, $db_name, $id); ?>
                <hr/>
                <?php render_syndromes($dbc, $db_name, $id); ?>
            </div>

        </div>
        <?php
    }
} else {
    render_warning('对不起！我们的知识库中尚无与"' . $keywords . '"相关的知识！');
}
?>

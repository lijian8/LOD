<?php

$names = get_names($keywords);

$ids = array();
foreach ($names as $name) {
    $id = get_entity_of_type($dbc, $name, $question_type);
    if ($id != '') {
        array_push($ids, $id);
    }
}



if (!empty($ids)) {
    echo '<p>您输入的症状集合为：';
    foreach ($ids as $id) {
        echo '&nbsp;' . render_value($dbc, $db_name, PREFIX . $id, false);
    }
    echo '</p>';
    echo '<hr>';
    echo '<p>&nbsp;下面列出系统推荐的辨证结果：</p>';


    $syndromes = array();
    foreach ($ids as $id) {
        $values = array_merge(get_subjects($dbc, PREFIX . $id, "由...组成"), get_values($dbc, PREFIX . $id, "组成"));
        foreach ($values as $value) {
            if (array_key_exists($value, $syndromes)) {
                $syndromes[$value] = $syndromes[$value] + 1;
            } else {
                $syndromes[$value] = 1;
            }
        }
    }

    arsort($syndromes);
    //print_r($syndromes);
    $syndromes = array_slice(array_keys($syndromes), 0, 5);

    //echo '<ul class="list-group">';
    echo '<ol >';
    foreach ($syndromes as $value) {

        //echo '<li class="list-group-item">';   
        echo '<li>';
        echo render_value($dbc, $db_name, $value, true);
        echo '&nbsp;<a class="btn btn-xs btn-primary" href="qa.php?db_name=' . $db_name . '&keywords=' . get_entity_name($dbc, $value) . '&question_type=证候" ><span class="glyphicon glyphicon-search"></span>&nbsp;提问</a>';
        echo '<p/></li>';
    }
    echo '</ol>';
} else {
    render_warning('对不起！我们的知识库中尚无与"' . $keywords . '"相关的知识！');
}
?>

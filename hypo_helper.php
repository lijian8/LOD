<?php


function hypo_render_treatment($dbc, $db_name, $id) {   
    
    $query = "SELECT subject, count(*) as count FROM hypo where value = '" . PREFIX . "$id' and property = '治疗' group by subject order by count desc";
   
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');
    
    $values = array();
    while ($row = mysqli_fetch_array($result)) { 
        $values[$row[0]] = $row[1];
    }  
    //arsort($values);
    $values = array_slice(array_keys($values), 0, 5);

    
    
    foreach ($values as $value) {
        echo '<li>';
        echo render_value($dbc, $db_name, $value, true);
        $url = 'hypo.php?db_name=' . $db_name . '&subject=' . $value . '&predicate=' . '治疗' . '&object=' . PREFIX . $id;

        echo '&nbsp;<a class="btn btn-primary btn-xs" href="' . $url . '">推理依据</a>';
        echo '<p/></li>';
    }
    
}

?>

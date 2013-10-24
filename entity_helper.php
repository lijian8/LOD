<?php

function render_entity_link($dbc, $name) {
    if (strpos($name, PREFIX) === 0) {
        $id = str_replace(PREFIX, "", $name);
        $query = "select * from def where id ='$id'";
        $result = mysqli_query($dbc, $query) or die('Error querying database1.');
        if ($row = mysqli_fetch_array($result)) {
            $name = $row[name];
            echo '<p><a href="entity.php?id='.$id.'">'. $name .'</a></p>';
        } 
    } 
}

?>

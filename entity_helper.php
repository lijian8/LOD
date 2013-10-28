<?php

function render_graph_by_property($dbc, $name, $property) {
    $query = "select * from graph where subject ='$name' and property='$property'";
    
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');

    if (mysqli_num_rows($result) != 0) {
        echo '<div class="panel panel-info">';
        echo '<div class="panel-heading">';
        echo '<h3 class="panel-title">' . $property . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        while ($row = mysqli_fetch_array($result)) {
            //$property = $row[property];
            $value = $row[value];
            $id = $row[id];
            //echo "<p><strong>$property</strong>:&nbsp;$value";

            echo $value;

            echo '<a href="' . $_SERVER['PHP_SELF'] . '?name=' . $name . '&delete_triple_id=' . $id . '"><span class="glyphicon glyphicon-remove-circle"></span></a>';

            echo "</p>";
        }
        echo '</div></div>';
    }
}

function render_graph($dbc, $id, $ontology) {

    $types = get_types($dbc, $id);
    foreach ($types as $type) {
        $properties = $ontology[$type];
        foreach ($properties as $property) {
            render_graph_by_property($dbc, PREFIX. $id, $property);
        }
    }
}


function render_info_by_property($dbc, $db_name, $name, $property, $with_def = true) {
    $query = "select * from graph where subject ='$name' and property = '$property'";

    $result = mysqli_query($dbc, $query) or die('Error querying database2.');
    $s = '';
    while ($row = mysqli_fetch_array($result)) {
        $value = $row[value];
        $id = $row[id];
       
        $s .= "<p>$value";
        $s .= render_value($dbc, $db_name, $value, $with_def);
        $s .= '<a href="entity.php?name=' . $name . '&delete_triple_id=' . $id . '"><span class="glyphicon glyphicon-remove-circle"></span></a>';
        $s .= "</p>";
    }
    return $s;
}

function get_summary($dbc, $db_name, $name) {
    $s = '';
    $query = "select * from graph where subject ='$name' limit 20";
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');
    if (mysqli_num_rows($result) != 0) {
        $r = get_property_values_from_row($dbc, $db_name, $result, array(), false);
        foreach ($r as $property => $value) {
            $s .= "$property:&nbsp;";
            $s .= implode(',', $value);
            $s .= "&nbsp;";
        }
    }
    
    /*
      $query = "select * from graph where subject ='$name'  limit 10";
      $result = mysqli_query($dbc, $query) or die('Error querying database2.');
      $s = '';
      if (mysqli_num_rows($result) != 0) {
      while ($row = mysqli_fetch_array($result)) {
      $property = $row[property];
      $value = $row[value];
      $s .= "<strong>$property</strong>:&nbsp;";
      $s .= render_value($dbc, $value, false);
      $s .= "&nbsp;";
      }
      }
     */

    return $s;
}

function get_reverse_property_values_from_row($dbc, $db_name, $result, $values, $with_def = true) {
    while ($row = mysqli_fetch_array($result)) {
        $property = $row[property] . '之逆属性';
        $value = $row[subject];
        if (array_key_exists($property, $values)) {
            array_push($values[$property], render_value($dbc, $db_name, $value, $with_def));
        } else {
            $values[$property] = array(render_value($dbc, $db_name, $value, $with_def));
        }
    }
    return $values;
}

function get_property_values_from_row($dbc, $db_name, $result, $values, $with_def = true) {
    while ($row = mysqli_fetch_array($result)) {
        $property = $row[property];
        $value = $row[value];
        if (array_key_exists($property, $values)) {
            array_push($values[$property], render_value($dbc, $db_name, $value, $with_def));
        } else {
            $values[$property] = array(render_value($dbc, $db_name, $value, $with_def));
        }
    }
    return $values;
}

function get_property_values($dbc,  $db_name, $name, $values = array()) {

    $query = "select * from graph where subject ='$name'";
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');
    if (mysqli_num_rows($result) != 0) {
        $values = get_property_values_from_row($dbc,  $db_name, $result, $values);
    }
    return $values;
}

function get_reverse_property_values($dbc,  $db_name, $name, $values = array()) {

    $query = "select * from graph where value ='$name'";
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');
    if (mysqli_num_rows($result) != 0) {
        $values = get_reverse_property_values_from_row($dbc,  $db_name, $result, $values);
    }
    return $values;
}

function get_literals($dbc, $db_name, $name, $filter, $ratio = '10%') {
    $query = "select * from graph where subject ='$name' and not(value like '" . PREFIX . "%')  limit 100";
    
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');

    $values = array();

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            $property = $row[property];
            $value = $row[value];
            

            if (!in_array($property, $filter)) {
               
                if (array_key_exists($property, $values)) {
                    $values[$property] = $values[$property] . ',&nbsp;' . render_value($dbc, $db_name, $value, false);
                } else {
                    $values[$property] = render_value($dbc, $db_name, $value, false);
                }
            }
           
            //echo "<p><strong>$property</strong>:&nbsp;$value";
        }
    }
    return $values;

  
}



function render_links($dbc, $db_name, $name, $ratio = '10%') {
    $query = "select * from graph where subject ='$name' and value like '" . PREFIX . "%'  limit 100";
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');

    $values = array();

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            $property = $row[property];
            $value = $row[value];
            if (array_key_exists($property, $values)) {
                $values[$property] = $values[$property] . ',&nbsp;' . render_value($dbc, $db_name, $value, false);
            } else {
                $values[$property] = render_value($dbc, $db_name, $value, false);
            }

            //echo "<p><strong>$property</strong>:&nbsp;$value";
        }
    }

    foreach ($values as $property => $value) {
        echo "<tr><td width='$ratio'>" . $property . ":</td><td>";
        echo $value;
        echo "</td></tr>";
    }
}

function get_types($dbc, $id) {   
    return get_values($dbc, PREFIX . $id, '类型');
}

function get_values($dbc, $subject, $property) {
    $query = "select * from graph where subject = '$subject' and property = '$property'";
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');
    $types = array();
    while ($row = mysqli_fetch_array($result)) {
        $value = $row[value];
        array_push($types, $value);
    }
    return $types;
}

function get_entity_link($id, $name, $db_name){
    return "<a href=\"entity.php?id=$id&db_name=$db_name\">$name</a>";
}

function render_value($dbc, $db_name, $name, $with_def = true) {
   
    if (strpos($name, PREFIX) === 0) {
        $id = str_replace(PREFIX, "", $name);
        $query = "select * from def where id ='$id'";
        $result = mysqli_query($dbc, $query) or die('Error querying database1.');
        if ($row = mysqli_fetch_array($result)) {
            $name = $row[name];
            $def = $row[def];
            $result = get_entity_link($id, $name, $db_name);
            if ($with_def) {
                if ($def == '')
                    $def = get_summary($dbc, $db_name, PREFIX . $id);
                if ($def != '') {
                    $result .= '&nbsp;<em><small>(' . $def . ')' . '</small></em>';
                }
            }
        } else {
            $result = $name;
        }
    } else {
        $result = $name;
    }
    
    return $result;
}

?>

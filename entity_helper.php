<?php

function render_summary($dbc, $name) {
    echo get_summary($dbc, $name);
}

function get_summary($dbc, $name) {
    $s = '';
    $query = "select * from graph where subject ='$name' limit 10";
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');
    if (mysqli_num_rows($result) != 0) {
        $r = get_property_values_from_row($dbc, $result, array(), false);
        foreach ($r as $property => $value) {
            $s .= "$property:&nbsp;";
            $s .= implode(',', $value);
            $s .= "&nbsp;";
        }
    }
    return $s;





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

function render_entity_link($dbc, $name) {
    if (strpos($name, PREFIX) === 0) {
        $id = str_replace(PREFIX, "", $name);
        $query = "select * from def where id ='$id'";
        $result = mysqli_query($dbc, $query) or die('Error querying database1.');
        if ($row = mysqli_fetch_array($result)) {
            $name = $row[name];
            echo '<p><a href="entity.php?id=' . $id . '">' . $name . '</a></p>';
        }
    }
}

function get_property_values_from_row($dbc, $result, $values, $with_def = true) {
    while ($row = mysqli_fetch_array($result)) {
        $property = $row[property];
        $value = $row[value];
        if (array_key_exists($property, $values)) {
            array_push($values[$property], render_value($dbc, $value, $with_def));
        } else {
            $values[$property] = array(render_value($dbc, $value, $with_def));
        }
    }
    return $values;
}

function get_property_values($dbc, $name, $values = array()) {

    $query = "select * from graph where subject ='$name'";
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');
    if (mysqli_num_rows($result) != 0) {
        $values = get_property_values_from_row($dbc, $result, $values);
    }
    return $values;
}

function render_literals($dbc, $name, $filter, $ratio = '10%') {
    $query = "select * from graph where subject ='$name' and not(value like '" . PREFIX . "%')  limit 100";
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');

    $values = array();

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            $property = $row[property];
            $value = $row[value];

            if (!in_array($property, $filter)) {
                if (array_key_exists($property, $values)) {
                    $values[$property] = $values[$property] . ',&nbsp;' . render_value($dbc, $value, false);
                } else {
                    $values[$property] = render_value($dbc, $value, false);
                }
            }
            //echo "<p><strong>$property</strong>:&nbsp;$value";
        }
    }

    foreach ($values as $property => $value) {
        echo "<h3><a href=\"#\">$property</a></h3>";
        echo $value;
        echo "<hr>";
    }
    /*
      foreach ($values as $property => $value) {
      echo "<tr><td width='$ratio'>" . $property . ":</td><td>";
      echo $value;
      echo "</td></tr>";
      } */
}

function render_links($dbc, $name, $ratio = '10%') {
    $query = "select * from graph where subject ='$name' and value like '" . PREFIX . "%'  limit 100";
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');

    $values = array();

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            $property = $row[property];
            $value = $row[value];
            if (array_key_exists($property, $values)) {
                $values[$property] = $values[$property] . ',&nbsp;' . render_value($dbc, $value, false);
            } else {
                $values[$property] = render_value($dbc, $value, false);
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

function render_value($dbc, $name, $with_def = true) {

    if (strpos($name, PREFIX) === 0) {
        $id = str_replace(PREFIX, "", $name);
        $query = "select * from def where id ='$id'";
        $result = mysqli_query($dbc, $query) or die('Error querying database1.');
        if ($row = mysqli_fetch_array($result)) {
            $name = $row[name];
            $def = $row[def];
            $result = '<a href="' . $_SERVER['PHP_SELF'] . '?id=' . $id . '">' . $name . '</a>';
            if ($with_def) {
                if ($def == '')
                    $def = get_summary($dbc, PREFIX . $id);
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

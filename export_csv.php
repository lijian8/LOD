+<?php

include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");

function entity_label($dbc, $id) {
    $query = "select name from def where id = '$id'";
    $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);
    if ($row = mysqli_fetch_array($result)) {
        return $row[name];
    } else {
        return $id;
    }
}

function entity_def($dbc, $id) {
    $query = "select def from def where id = '$id'";
    $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);
    if ($row = mysqli_fetch_array($result)) {
        return $row[name];
    } else {
        return $id;
    }
}

function startsWith($haystack, $needle) {
    return $needle === "" || strpos($haystack, $needle) === 0;
}

set_time_limit(0);
if (isset($_POST['submit'])) {

    $id_array = $_POST['keyword_array'];

    $ids = explode("$", $id_array);
    $properties = array();
    $classes = array();
    $obj_ids = array();

    $fp_graph = fopen("graph.csv", "wb");
    foreach ($ids as $id) {
        //$fp_graph = fopen("graph" . $id . ".csv", "wb");
        $name = PREFIX . $id;
        $query = "select * from graph where subject = '$name' or value = '$name'";
        $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);

        while ($row = mysqli_fetch_array($result)) {

            $row_subject = preg_replace('/\\r?\\n|\\r/', '', $row['subject']);
            $row_property = preg_replace('/\\r?\\n|\\r/', '', $row['property']);
            $row_value = preg_replace('/\\r?\\n|\\r/', '', $row['value']);


            $ttl_segment = $row_subject . "|" . $row_property . "|" . $row_value . " \n";
            fwrite($fp_graph, $ttl_segment);

            if (startsWith($row[subject], $db_name)) {
                $sid = substr($row[subject], strlen($db_name . ':o'));
                if (!in_array($sid, $obj_ids))
                    $obj_ids[] = $sid;
            }

            if (startsWith($row[value], $db_name)) {
                $oid = substr($row[value], strlen($db_name . ':o'));
                if (!in_array($oid, $obj_ids))
                    $obj_ids[] = $oid;
            }
        }
        //fclose($fp_graph);
    }
    fclose($fp_graph);

    $fp_def = fopen("def.csv", "wb");
    foreach ($obj_ids as $id) {
        //$fp_def = fopen("def" . $id . ".csv", "wb");
        $query = "select name, def from def where id = '$id'";
        $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);
        if ($row = mysqli_fetch_array($result)) {
            $row_name = preg_replace('/\\r?\\n|\\r/', '', $row['name']);
            $row_def = preg_replace('/\\r?\\n|\\r/', '', $row['def']);

            fwrite($fp_def, $id . "|" . $row_name . "|" . $row_def . "\n");
        }
        //fclose($fp_def);
    }
    fclose($fp_def);

    echo '<div class="container">';
    echo '<h1><font face="微软雅黑">中医药子本体抽取工具</font></h1>';
    echo '<hr>';
    echo '<p><a href = "graph.csv">graph.csv</a></p>';
    echo '<p><a href = "def.csv">def.csv</a></p>';
    echo '<p><a href = "subontology.php">返回</a></p>';
    echo '</div>';
}



include_once ("./foot.php");
?>

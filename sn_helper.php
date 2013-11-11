<?php

function sn_get_num_triples($dbc) {
    $query = "select count(*) from semantic_network";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');
    $classes = array();
    if ($row = mysqli_fetch_array($result)) {
        return $row[0];
    } else {
        return 0;
    }
}

function sn_get_num_cls($dbc) {
    $query = "select count(*) from cls order by count desc";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');
    $classes = array();
    if ($row = mysqli_fetch_array($result)) {
        return $row[0];
    } else {
        return 0;
    }
}

function sn_get_num_of_props($dbc) {
    $query = "select count(*) from properties";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');

    if ($row = mysqli_fetch_array($result)) {
        return $row[0]; 
    }else{
        return 0;
    }
}
?>

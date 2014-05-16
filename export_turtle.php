<?php

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
    $ttl_segments = array();

    foreach ($ids as $id) {
        $name = PREFIX . $id;
        $ttl_segment = $name . ' ';

        $query = "select * from graph where subject = '$name'";
        $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);

        while ($row = mysqli_fetch_array($result)) {

            if (startsWith($row[value], $db_name)) {

                if (!in_array($row[property], $properties)) {
                    $properties[] = $row[property];
                }
                $oid = substr($row[value], strlen($db_name . ':o'));
                if (!in_array($oid, $ids) && !in_array($oid, $obj_ids))
                    $obj_ids[] = $oid;

                $p_id = array_keys($properties, $row[property]);

                $ttl_segment .= " :p" . $p_id[0] . " " . $row[value] . "; \n";
            }elseif ($row[property] == '类型') {
                if (!in_array($row[value], $classes))
                    $classes[] = $row[value];
                $c_id = array_keys($classes, $row[value]);
                $ttl_segment .= "rdf:type :c" . $c_id[0] . "; \n";
            }elseif ($row[property] == '注释') {
                $ttl_segment .= " rdfs:comment \"" . $row[value] . "\"; \n";
            } elseif ($row[property] == '中文正名') {
                $ttl_segment .= " rdfs:label \"" . $row[value] . "\";  \n";
            } elseif ($row[property] == '英文异名') {
                $ttl_segment .= " rdfs:label \"" . $row[value] . "\"@en;  \n";
            } elseif ($row[property] == '中文异名') {
                $ttl_segment .= " rdfs:label \"" . $row[value] . "\";  \n";
            } elseif ($row[property] == '英文正名') {
                $ttl_segment .= " rdfs:label \"" . $row[value] . "\"@en;  \n";
            } elseif ($row[property] == '定义') {
                $ttl_segment .= " rdfs:comment \"" . $row[value] . "\";  \n";
            }
        }

        $def = entity_def($dbc, $id);
        if (isset($def) && ($def != '')) {
            $ttl_segment .= " rdfs:comment \"" . $def . "\". \n";
        }

        $ttl_segment .= " rdfs:label \"" . entity_label($dbc, $id) . "\"@zh. \n";
        $ttl_segments[] = $ttl_segment;
    }

    $fp = fopen("subontology.owl", "wb");

    fwrite($fp, "@prefix xsd: <http://www.w3.org/2001/XMLSchema#> . \n");
    fwrite($fp, "@prefix tcmls: <http://www.example.com/> .  \n");
    fwrite($fp, "@prefix owl: <http://www.w3.org/2002/07/owl#> . \n");
    fwrite($fp, "@prefix : <http://www.example.com/> . \n");
    fwrite($fp, "@prefix xml: <http://www.w3.org/XML/1998/namespace> . \n");
    fwrite($fp, "@prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> . \n");
    fwrite($fp, "@prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> . \n");
    fwrite($fp, "@base <http://www.example.com/2014/3/Ontology1398753433956.owl> . \n");

    foreach ($classes as $localname => $label) {
        fwrite($fp, ":c$localname rdf:type owl:Class ;  rdfs:label \"$label\" . \n");
        // fwrite($fp, $id . ", ");
        //fflush($fp);
    }

    foreach ($properties as $localname => $label) {

        fwrite($fp, ":p$localname rdf:type owl:ObjectProperty ;  rdfs:label \"$label\" . \n");
        //fflush($fp);
    }

    foreach ($obj_ids as $id) {
        fwrite($fp, PREFIX . $id . " rdfs:label \"" . entity_label($dbc, $id) . "\". \n");
        //fflush($fp);
    }

    foreach ($ttl_segments as $ttl_segment) {
        fwrite($fp, $ttl_segment);
    }

    fclose($fp);
    echo '<div class="container">';
    echo '<h1><font face="微软雅黑">中医药子本体抽取工具</font></h1>';
    echo '<hr>';
    echo '<p><a href = "subontology.owl">下载文件</a></p>';     
    echo '<p><a href = "subontology.php">返回</a></p>';
    echo '</div>';
}



include_once ("./foot.php");
?>

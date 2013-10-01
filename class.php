<?php
include_once ("./header.php");

require 'vendor/autoload.php';
require_once "html_tag_helpers.php";

function list_instances($graph, $type) {
    foreach ($graph->allOfType($type) as $p) {
        $label = $p->label('zh');
        if (!$label)
            $label = $p->getUri();

        if ($p->isBnode()) {
            //echo "&nbsp;$label&nbsp;";
        } else {
            echo "&nbsp;" . link_to_self($label, 'uri=' . urlencode($p)) . "&nbsp;|";
        }
    }
}

function num_of_instances($graph, $type) {
    $instances = $graph->allOfType($type);
    return count($instances);
}



$localname = isset($_GET['localname']) ? $_GET['localname'] : 'Syndrome';


$graph = new EasyRdf_Graph("http://localhost/lod/tcmdemoen.rdf");
$graph->load();
?>
<div class="container">
    
    <div class="well">
        <?php
        echo '<p>|';
        list_instances($graph, 'http://www.example.com/'.$localname);
        echo '</p>';
        echo '<p>|';
        list_instances($graph, 'http://www.example.com/'.$localname);
        echo '</p>';

       
        ?>
    </div>
    <h1>TCMLS概述</h1>

    <h1>TCMLS-SN的文件</h1>

    <hr>
    <?php    
    $data = $graph->serialise('ntriples');
    if (!is_scalar($data)) {
        $data = var_export($data, true);
    }
    print htmlspecialchars($data);
    ?>
    </hr>
    <?php
    //$me = $graph->resource('http://www.example.com/Huperzia_Serrata');
    $me = $graph->resource('http://www.example.com/fourGentlemenDecoction');

    echo "<p>http://www.example.com/Huperzia_Serrata 的标签是: " . $me->get('rdfs:label') . "</p>";
    echo "<p>http://www.example.com/Huperzia_Serrata 的中文标签是: " . $me->label('zh') . "</p>";
    echo "<p>http://www.example.com/Huperzia_Serrata 的英文标签是: " . $me->label('en') . "</p>";

    $hasMinister = $graph->resource('http://www.example.com/hasMinister');
    echo "<p>http://www.example.com/hasMinister 的标签是: " . $hasMinister->get('rdfs:label') . "</p>";

    $graph->allResources($me, $hasMinister);
    foreach ($me->all($hasMinister) as $type) {
        echo 'start';
        $label = $type->label('zh');
        if (!$label) {
            $label = $type->getUri();
        }
        if ($type->isBnode()) {
            echo "<li>$label</li>";
        } else {
            echo "<li>" . link_to_self($label, 'uri=' . urlencode($friend)) . "</li>";
        }
    }

    foreach ($me->toArray() as $type => $value) {
        echo $type . ':' . $value;
    }
    print_r($me->propertyUris());
    foreach ($me->propertyUris() as $p) {
        echo "<p>" . $p . "</p>";
        $pp = $graph->resource($p);

        foreach ($me->all($pp) as $o) {
            echo "<p>$me,&nbsp;$p,&nbsp;$o</p>";
        }
    }




    echo "<li>";

    echo "</li>";


    echo "<li>";
    foreach ($graph->allOfType('http://www.example.com/Syndrome') as $p) {

        $label = $p->label('zh');
        if (!$label)
            $label = $p->getUri();



        if ($p->isBnode()) {
            echo "&nbsp;$label&nbsp;";
        } else {
            echo "&nbsp;" . link_to_self($label, 'uri=' . urlencode($p)) . "&nbsp;";
        }
    }
    echo "</li>";
    ?>

</div>

<?php
include_once ("./foot.php");
?>
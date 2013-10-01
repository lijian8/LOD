<?php
include_once ("./header.php");

require 'vendor/autoload.php';
require_once "html_tag_helpers.php";

function get_label($p) {
    $label = $p->label('zh');
    if (!$label)
        $label = $p->label();

    if (!$label)
        $label = $p->shorten();

    if (!$label)
        $label = $p->getUri();

    return $label;
}

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

function render_property($graph, $me, $p) {

    $property = $graph->resource($p);

    //echo "<p>" . $property->label('zh') . ":&nbsp;";
    echo "<p>" . get_label($property) . ":&nbsp;";



    foreach ($me->all($property) as $o) {
        $label = $o->label();
        if (!$label)
            $label = $o->getUri();

        if ($o->isBnode()) {
            //echo "&nbsp;$label&nbsp;";
        } else {
            echo "&nbsp;" . link_to_self($label, 'uri=' . urlencode($o)) . "&nbsp;";
        }
    }

    echo "</p>";
}

function render_literals($graph, $me, $p) {
    $property = $graph->resource($p);
    //echo "<p>属性名称: " . $property;
//$graph->allResources($me, $property);

    foreach ($me->allLiterals($property, 'zh') as $lit) {
        echo '<p>' . $lit . '</p>';
    }

    foreach ($me->allLiterals($property, 'en') as $lit) {
        echo '<p>' . $lit . '</p>';
    }
}

function num_of_instances($graph, $type) {
    $instances = $graph->allOfType($type);
    return count($instances);
}

$localname = isset($_GET['localname']) ? $_GET['localname'] : 'kideny_yang_deficiency';


$graph = new EasyRdf_Graph("http://localhost/lod/tcmdemoen.rdf");
$graph->load();
?>
<div class="container">


    <?php
    echo "<h1>实例:&nbsp;" . $localname . "</h1>";

    $me = $graph->resource('http://www.example.com/' . $localname);
//echo "<p>" . $me->get('rdfs:comment') . "</p>";

    render_literals($graph, $me, 'rdfs:comment');

    echo "<p>中文标签: " . $me->label('zh') . "</p>";
    echo "<p>英文标签: " . $me->label('en') . "</p>";
//echo "<p>http://www.example.com/Huperzia_Serrata 的标签是: " . $me->get('rdfs:label') . "</p>";
    render_property($graph, $me, 'rdf:type');

//print_r($me->propertyUris());
    foreach ($me->propertyUris() as $p) {

        $pp = $graph->resource($p);
        echo "<p>" . get_label($pp) . "</p>";

        foreach ($me->all($pp) as $o) {
            echo "<p>$me,&nbsp;$p,&nbsp;$o</p>";
        }

        echo '<div class="panel panel-success">';
        echo '<div class="panel-heading">';
        echo '<h3 class="panel-title">' . get_label($pp) . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        foreach ($me->all($pp) as $o) {
          echo "<p>$me,&nbsp;$p,&nbsp;$o</p>";
        }
        echo '</div></div>';
    }
    ?>

</div>

<?php
include_once ("./foot.php");
?>
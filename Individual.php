<?php
include_once ("./header.php");

require 'vendor/autoload.php';
require_once "html_tag_helpers.php";
include_once ("./rdf_helper.php");

function render_thing($o) {
    if ($o instanceof EasyRdf_Resource) {
        $label = get_label($o);
        if ($o->isBnode()) {
            echo "&nbsp;\"$label\"&nbsp;";
        } else {
            echo "&nbsp;" . link_to_self($label, 'localname=' . $o->localName()) . "&nbsp;";
        }
    } else {
        echo "&nbsp;\"" . $o . "\"&nbsp;";
    }
}

function render_property_values($me, $property) {
    foreach ($me->all($property) as $o) {
        render_thing($o);
    }
}

function render_matching_values($graph, $me, $property) {
    $rp = $graph->resource($property);
    foreach ($graph->resourcesMatching($rp, $me) as $r) {
        //echo "<p>" . $rp . $r . "</p>";
        render_thing($r);
    }
}

function render_property($graph, $me, $property) {

    $property = $graph->resource($property);
    echo "<p>" . get_label($property) . ":&nbsp;";
    render_property_values($me, $property);
    echo "</p>";
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
    $me = $graph->resource('http://www.example.com/' . $localname);
//echo "<p>" . $me->get('rdfs:comment') . "</p>";


    echo "<h1>" . $localname . "</h1>";


    render_literals($graph, $me, 'rdfs:comment');

    echo '<div class="panel panel-info">';
    echo '<div class="panel-heading"> 基本信息 </div>';
    echo "<table class=\"table table-bordered\"><tbody>";

    echo "<tr><td width='10%'>中文标签:</td><td>" . $me->label('zh') . "</td></tr>";
    echo "<tr><td>英文标签:</td><td>" . $me->label('en') . "</td></tr>";
    echo "<tr><td>类型:</td><td>";
    render_property_values($me, 'rdf:type');
    echo "</td></tr>";

    if ($me->is_a("owl:Class")) {
        echo "<tr><td>父类:</td><td>";
        render_property_values($me, 'rdfs:subClassOf');
        echo "</td></tr>";
        echo "<tr><td>子类:</td><td>";
        render_matching_values($graph, $me, "rdfs:subClassOf");
        echo "</td></tr>";
    }

    if ($me->is_a("owl:ObjectProperty")) {
        echo "<tr><td>父属性:</td><td>";
        render_property_values($me, "rdfs:subPropertyOf");
        echo "</td></tr>";
        echo "<tr><td>子属性:</td><td>";
        render_matching_values($graph, $me, "rdfs:subPropertyOf");
        echo "</td></tr>";
    }


    echo "</tbody></table></div>";



//echo "<p>http://www.example.com/Huperzia_Serrata 的标签是: " . $me->get('rdfs:label') . "</p>";

    if ($me->is_a("owl:Class")) {


        echo '<div class="panel panel-info">';
        echo '<div class="panel-heading">';
        echo '<h3 class="panel-title">' . 实例 . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        //list_instances($graph, 'http://www.example.com/' . $localname);
        foreach ($graph->allOfType('http://www.example.com/' . $localname) as $p) {
           render_thing($p); 
        }


        echo '</div></div>';
    }



//print_r($me->propertyUris());


    foreach ($me->propertyUris() as $p) {

        $pp = $graph->resource($p);

        echo '<div class="panel panel-info">';
        echo '<div class="panel-heading">';
        echo '<h3 class="panel-title">' . render_thing($pp) . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        render_property_values($me, $pp);
        /* foreach ($me->all($pp) as $o) {

          if ($o instanceof EasyRdf_Resource) {
          $label = get_label($o);
          if ($o->isBnode()) {
          echo "&nbsp;$label&nbsp;";
          } else {
          echo "&nbsp;" . link_to_self($label, 'localname=' . $o->localName()) . "&nbsp;";
          }
          } else {
          echo "&nbsp;" . $o . "&nbsp;";
          }
          } */
        echo '</div></div>';
    }

    foreach ($me->reversePropertyUris() as $rp) {
        $rp = $graph->resource($rp);
        //echo get_label($rp);
        echo '<div class="panel panel-info">';
        echo '<div class="panel-heading">';
        echo '<h3 class="panel-title">';
        render_thing($rp);
        echo '&nbsp;之逆属性</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        render_matching_values($graph, $me, $rp);
        echo '</div></div>';
    }
    ?>

</div>

<?php
include_once ("./foot.php");
?>
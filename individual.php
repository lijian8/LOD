<?php
include_once ("./header.php");

require 'vendor/autoload.php';
require_once "html_tag_helpers.php";
include_once ("./rdf_helper.php");

function get_title($me) {
    $labels = array();
    $labels[] = $me->label('zh');
    $labels[] = $me->label('en');
    $title = implode(' ', $labels);
    return $title;
}

function render_thing($o, $onto_file) {
    if ($o instanceof EasyRdf_Resource) {
        $label = get_label($o);
        if ($o->isBnode()) {
            echo "&nbsp;\"$label\"&nbsp;";
        } else {
            echo "&nbsp;" . link_to_self($label, 'onto_file=' . $onto_file . '&localname=' . $o->localName()) . "&nbsp;";
        }
    } else {
        echo "&nbsp;\"" . $o . "\"&nbsp;";
    }
}

function render_property_values($me, $property, $onto_file) {
    foreach ($me->all($property) as $o) {
        render_thing($o, $onto_file);
    }
}

function render_matching_values($graph, $me, $property, $onto_file) {
    $rp = $graph->resource($property);
    foreach ($graph->resourcesMatching($rp, $me) as $r) {
        render_thing($r, $onto_file);
    }
}

function render_property($graph, $me, $property) {

    $property = $graph->resource($property);
    echo "<p>" . get_label($property) . ":&nbsp;";
    render_property_values($me, $property, $onto_file);
    echo "</p>";
}

if (isset($_GET['localname'])) {
    $localname = $_GET['localname'];
}


if (isset($_GET['onto_file'])) {
    $onto = $_GET['onto_file'];

    if ($onto === 'herbnet') {
        $onto_file = "herbnet.rdf";
        $namespace = 'http://www.semanticweb.org/ontologies/2014/3/Ontology1397720026234.owl#';
    } elseif ($onto === 'tcmls') {
        $onto_file = "tcmdemoen.rdf";
        $namespace = 'http://www.example.com/';
    } elseif ($onto === 'tcmlm') {
        $onto_file = 'tcmlm-zhuling.rdf';
        $namespace = 'http://www.example.com/';
    } 
} else {
    $onto_file = "tcmdemoen.rdf";
    $namespace = 'http://www.example.com/';
}



$graph = new EasyRdf_Graph("http://localhost/lod/" . $onto_file);
$graph->load();

if (isset($_GET['label'])) {
    $first = true;
    foreach ($graph->resourcesMatching("rdfs:label", $_GET['label']) as $r) {
        if ($first) {
            $localname = $r->localname();
        } else {
            echo "<p>" . $r . "</p>";
        }
    }
}


if (!isset($localname)) {
    render_warning("对不起！本系统没有相关实体的信息！下面显示的是'kideny_yang_deficiency(肾阳虚)'这一示例实体。");
    $localname = 'kideny_yang_deficiency';
}
?>
<div class="container">


    <?php
    $me = $graph->resource($namespace . $localname);

//echo "<h1>" . $localname . "</h1>";
    echo "<h1>" . get_title($me) . "</h1>";


    render_literals($graph, $me, 'rdfs:comment');

    echo '<div class="panel panel-info">';
    echo '<div class="panel-heading"> 基本信息 </div>';
    echo "<table class=\"table table-bordered\"><tbody>";

    echo "<tr><td width='10%'>中文标签:</td><td>" . $me->label('zh') . "</td></tr>";
    echo "<tr><td>英文标签:</td><td>" . $me->label('en') . "</td></tr>";
    echo "<tr><td>类型:</td><td>";
    render_property_values($me, 'rdf:type', $onto_file);
    echo "</td></tr>";

    if ($me->is_a("owl:Class")) {
        echo "<tr><td>父类:</td><td>";
        render_property_values($me, 'rdfs:subClassOf', $onto_file);
        echo "</td></tr>";
        echo "<tr><td>子类:</td><td>";
        render_matching_values($graph, $me, "rdfs:subClassOf", $onto_file);
        echo "</td></tr>";
    }

    if ($me->is_a("owl:ObjectProperty")) {
        echo "<tr><td>父属性:</td><td>";
        render_property_values($me, "rdfs:subPropertyOf", $onto_file);
        echo "</td></tr>";
        echo "<tr><td>子属性:</td><td>";
        render_matching_values($graph, $me, "rdfs:subPropertyOf", $onto_file);
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

        foreach ($graph->allOfType($namespace . $localname) as $p) {
            render_thing($p, $onto_file);
        }


        echo '</div></div>';
    }



//print_r($me->propertyUris());


    foreach ($me->propertyUris() as $p) {

        $pp = $graph->resource($p);

        echo '<div class="panel panel-info">';
        echo '<div class="panel-heading">';
        echo '<h3 class="panel-title">' . render_thing($pp, $onto_file) . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        render_property_values($me, $pp, $onto_file);
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
        render_thing($rp, $onto_file);
        echo '&nbsp;之逆属性</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        render_matching_values($graph, $me, $rp, $onto_file);
        echo '</div></div>';
    }
    ?>

</div>

<?php
include_once ("./foot.php");
?>
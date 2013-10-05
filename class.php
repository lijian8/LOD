<?php
include_once ("./header.php");

require 'vendor/autoload.php';
require_once "html_tag_helpers.php";

include_once ("./rdf_helper.php");


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

function num_of_instances($graph, $type) {
    $instances = $graph->allOfType($type);
    return count($instances);
}

$localname = isset($_GET['localname']) ? $_GET['localname'] : 'Syndrome';


$graph = new EasyRdf_Graph("http://localhost/lod/tcmdemoen.rdf");
$graph->load();
?>
<div class="container">


<?php
echo "<h1>类:&nbsp;" . $localname . "</h1>";

$me = $graph->resource('http://www.example.com/' . $localname);
//echo "<p>" . $me->get('rdfs:comment') . "</p>";

render_literals($graph, $me, 'rdfs:comment');

echo "<p>中文标签: " . $me->label('zh') . "</p>";
echo "<p>英文标签: " . $me->label('en') . "</p>";
//echo "<p>http://www.example.com/Huperzia_Serrata 的标签是: " . $me->get('rdfs:label') . "</p>";
render_property($graph, $me, 'rdfs:subClassOf');

echo '<div class="well"><p>实例：&nbsp;|';
list_instances($graph, 'http://www.example.com/' . $localname);
echo '</p>';
echo '</div>';








print_r($me->propertyUris());
foreach ($me->propertyUris() as $p) {
    echo "<p>" . $p . "</p>";
    $pp = $graph->resource($p);

    foreach ($me->all($pp) as $o) {
        echo "<p>$me,&nbsp;$p,&nbsp;$o</p>";
    }
}
?>

</div>

    <?php
    include_once ("./foot.php");
    ?>
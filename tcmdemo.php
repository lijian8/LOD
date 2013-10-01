<?php

include_once ("./header.php");

require 'vendor/autoload.php';
require_once "html_tag_helpers.php";

$graph = new EasyRdf_Graph("http://localhost/lod/tcmdemoen.rdf");
$graph->load();

echo "The count is: " . $graph->countTriples();
$data = $graph->serialise('ntriples');
if (!is_scalar($data)) {
    $data = var_export($data, true);
}
//print htmlspecialchars($data);
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

   foreach($me->all($pp) as $o){
       echo "<p>$me,&nbsp;$p,&nbsp;$o</p>";
   }
   
   
   
}


echo "<li>";
foreach ($graph->allOfType('owl:ObjectProperty') as $p) {

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

echo "<li>";
foreach ($graph->allOfType('owl:Class') as $p) {

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


echo "<li>";
foreach ($graph->allOfType('http://www.example.com/Herb') as $p) {

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


include_once ("./foot.php");
?>
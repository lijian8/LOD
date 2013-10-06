<?php

function get_graph() {
    if (!isset($GLOBALS['rdf_graph'])) {
        echo "RDF图初始化...";
        $GLOBALS['rdf_graph'] = new EasyRdf_Graph("http://localhost/lod/tcmdemoen.rdf");
        $GLOBALS['rdf_graph']->load();
    }else{
        echo "直接使用已初始化的RDF图...";
    }
    
    return $GLOBALS['rdf_graph'];
}

function render_property_as_row($graph, $me, $p) {
    $property = $graph->resource($p);
    echo "<p>" . get_label($property) . ":&nbsp;";
    foreach ($me->all($property) as $o) {
        $label = get_label($o);
        if (!($o->isBnode())) {
            echo "&nbsp;" . link_to($label, 'uri=' . urlencode($o)) . "&nbsp;";
        }
    }

    echo "</p>";
}

function get_label($p) {

    if ($p instanceof EasyRdf_Resource) {
        $label = $p->label('zh');
        if (!$label)
            $label = $p->label();

        if (!$label)
            $label = $p->shorten();

        if (!$label)
            $label = $p->getUri();
    }else {
        $label = $p;
    }
    return $label;
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

?>

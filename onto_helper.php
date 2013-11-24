<?php

include_once ("./rdf_helper.php");

function render_nav($graph) {
    render_class_nav($graph);
    render_object_property_nav($graph);
}

function render_details($graph, $onto_file){
    render_class_list($graph, $onto_file);
    render_object_property_list($graph, $onto_file);
}

function render_class_list($graph, $onto_file){
    foreach ($graph->allOfType('owl:Class') as $me) {
        if (!($me->isBnode())) {
            echo '<div class="well-sm" id="' . $me->localName() . '">';
            echo "<h3>类:&nbsp;<a href='individual.php?onto_file=" . $onto_file . "&localname=" . $me->localName() . "'>" . $me->localName() . "</a></h3>";

            render_literals($graph, $me, 'rdfs:comment');
            echo "<table class=\"table table-bordered\"><tbody>";

            echo "<tr><td width='10%'>中文标签:</td><td>" . $me->label('zh') . "</td></tr>";
            echo "<tr><td>英文标签:</td><td>" . $me->label('en') . "</td></tr>";

            echo "<tr><td>父类:</td><td>";
            render_property_values($graph, $me, "rdfs:subClassOf");
            echo "</td></tr>";

            echo "<tr><td>子类:</td><td>";
            render_matching_values($graph, $me, "rdfs:subClassOf");
            echo "</td></tr>";

            echo "</tbody></table>";


            echo '<p style="float: right; font-size: small;">[<a href="#sec-glance">回到顶部</a>]</p>';
            echo '</div>';
        }
    }
}

function render_object_property_list($graph, $onto_file){
     foreach ($graph->allOfType('owl:ObjectProperty') as $me) {
        if (!($me->isBnode())) {
            echo '<div class="well-sm" id="' . $me->localName() . '">';
            echo "<h3>对象属性:&nbsp;<a href='individual.php?onto_file=" . $onto_file . "&localname=" . $me->localName() . "'>" . $me->localName() . "</a></h3>";

            render_literals($graph, $me, 'rdfs:comment');
            echo "<table class=\"table table-bordered\"><tbody>";

            echo "<tr><td width='10%'>中文标签:</td><td>" . $me->label('zh') . "</td></tr>";
            echo "<tr><td>英文标签:</td><td>" . $me->label('en') . "</td></tr>";

            echo "<tr><td>父属性:</td><td>";
            echo render_property_values($graph, $me, "rdfs:subPropertyOf");
            echo "</td></tr>";

            echo "<tr><td>子属性:</td><td>";
            render_matching_values($graph, $me, "rdfs:subPropertyOf");
            echo "</td></tr>";

            echo "</tbody></table>";


            echo '<p style="float: right; font-size: small;">[<a href="#sec-glance">回到顶部</a>]</p>';
            echo '</div>';
        }
    }
}

function render_object_property_nav($graph) {
    echo '<p>对象属性&nbsp;<span class="badge">' . num_of_instances($graph, 'owl:ObjectProperty') . '</span>：&nbsp;|';
//list_instances($graph, 'owl:ObjectProperty');
    foreach ($graph->allOfType('owl:ObjectProperty') as $p) {
        if (!($p->isBnode())) {
            echo "&nbsp;" . link_to(get_label($p), '#' . $p->localname()) . "&nbsp;|";
        }
    }
    echo '</p>';
}

function render_class_nav($graph) {
    echo '<p>类&nbsp;<span class="badge">' . num_of_instances($graph, 'owl:Class') . '</span>：&nbsp;|';

    foreach ($graph->allOfType('owl:Class') as $p) {
        if (!($p->isBnode())) {
            echo "&nbsp;" . link_to(get_label($p), '#' . $p->localname()) . "&nbsp;|";
        }
    }
    echo '</p>';
}

function render_thing($o) {
    $label = get_label($o);
    if (!($o->isBnode())) {
        echo "&nbsp;<a href='#" . $o->localname() . "'>" . $label . "</a>&nbsp;";
    }
}

function render_matching_values($graph, $me, $property) {
    $rp = $graph->resource($property);
    foreach ($graph->resourcesMatching($rp, $me) as $r) {
        render_thing($r);
    }
}

function render_property_values($graph, $me, $property) {
    $property = $graph->resource($property);

    foreach ($me->all($property) as $o) {
        render_thing($o);
    }
}
?>

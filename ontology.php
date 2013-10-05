<?php
include_once ("./header.php");

require 'vendor/autoload.php';
require_once "html_tag_helpers.php";

include_once ("./rdf_helper.php");

function num_of_instances($graph, $type) {
    $instances = $graph->allOfType($type);
    return count($instances);
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

$graph = new EasyRdf_Graph("http://localhost/lod/tcmdemoen.rdf");
$graph->load();
?>
<div class="container">
    <h1>介绍</h1>
    待续。
    <h1>TCMLS Semantic Network概览</h1>
    <div class="well-sm" id="sec-glance">
        <table  class="table table-bordered">
            <tbody>
                <tr>
                    <td>类</td>
                    <td><?php echo num_of_instances($graph, 'owl:Class'); ?></td>            
                </tr>
                <tr>
                    <td>属性</td>
                    <td><?php echo num_of_instances($graph, 'owl:ObjectProperty'); ?></td>           
                </tr>
                <tr>
                    <td>陈述</td>
                    <td><?php echo $graph->countTriples(); ?></td>

                </tr>
            </tbody>
        </table>
    </div>
    <p>待续。</p>
    <div class="well">
        <?php
        echo '<p>类&nbsp;<span class="badge">' . num_of_instances($graph, 'owl:Class') . '</span>：&nbsp;|';
//list_instances($graph, 'owl:Class');
        foreach ($graph->allOfType('owl:Class') as $p) {
            if (!($p->isBnode())) {
                echo "&nbsp;" . link_to(get_label($p), '#' . $p->localname()) . "&nbsp;|";
            }
        }
        echo '</p>';

        echo '<p>属性&nbsp;<span class="badge">' . num_of_instances($graph, 'owl:ObjectProperty') . '</span>：&nbsp;|';
//list_instances($graph, 'owl:ObjectProperty');
        foreach ($graph->allOfType('owl:ObjectProperty') as $p) {
            if (!($p->isBnode())) {
                echo "&nbsp;" . link_to(get_label($p), '#' . $p->localname()) . "&nbsp;|";
            }
        }
        echo '</p>';
        ?>
    </div>
    <h1>TCMLS概述</h1>

    <?php
    foreach ($graph->allOfType('owl:Class') as $me) {
        if (!($me->isBnode())) {
            echo '<div class="well-sm" id="' . $me->localName() . '">';
            echo "<h3>类:&nbsp;<a href='individual.php?localname=" . $me->localName() . "'>" . $me->localName() . "</a></h3>";

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

    foreach ($graph->allOfType('owl:ObjectProperty') as $me) {
        if (!($me->isBnode())) {
            echo '<div class="well-sm" id="' . $me->localName() . '">';
            echo "<h3>对象属性:&nbsp;<a href='individual.php?localname=" . $me->localName() . "'>" . $me->localName() . "</a></h3>";

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
    ?>




</div>

<?php
include_once ("./foot.php");
?>
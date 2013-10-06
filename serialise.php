<?php
include_once ("./header.php");
require 'vendor/autoload.php';
require_once "html_tag_helpers.php";
include_once ("./rdf_helper.php");
$graph = new EasyRdf_Graph("http://localhost/lod/tcmdemoen.rdf");
$graph->load();
?>
<div class="container">
<h2>TCMLS Semantic Network概览</h2>
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
</div>
<?php
include_once ("./foot.php");
?>
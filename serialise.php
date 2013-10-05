<?php
include_once ("./header.php");
require 'vendor/autoload.php';
require_once "html_tag_helpers.php";
include_once ("./rdf_helper.php");
$graph = new EasyRdf_Graph("http://localhost/lod/tcmdemoen.rdf");
$graph->load();
?>
<div class="container">
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
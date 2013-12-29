<?php
$values = get_property_values($dbc, $db_name, PREFIX . $id);

echo '<hr>';

include("pv_panel.php");

$values = get_reverse_property_values($dbc, $db_name, PREFIX . $id);
include("pv_panel.php");
?>

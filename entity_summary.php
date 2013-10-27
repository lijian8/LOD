


<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">基本信息</h3>
    </div>
    <?php
    echo "<table class=\"table\"><tbody>";
    //echo "<tr><td width='10%'>代码:</td><td>" . $id . "</td></tr>";


    echo "<tr><td width='10%'>英文名:</td><td>";

    render_info_by_property($dbc, PREFIX . $id, '英文正名');
    render_info_by_property($dbc, $name, '英文正名');
    render_info_by_property($dbc, PREFIX . $id, '英文异名');
    render_info_by_property($dbc, $name, '英文异名');
    echo "</td></tr>";

    echo "<tr><td width='10%'>异名:</td><td>";

    render_info_by_property($dbc, PREFIX . $id, '中文异名');
    render_info_by_property($dbc, $name, '中文异名');
    render_info_by_property($dbc, PREFIX . $id, '英文异名');
    render_info_by_property($dbc, $name, '英文异名');
    render_info_by_property($dbc, PREFIX . $id, '异名');
    render_info_by_property($dbc, $name, '异名');
    echo "</td></tr>";

    // echo "<tr><td width='10%'>类型:</td><td>" . implode(',', get_types($dbc, $name, $id)) . "</td></tr>";


    echo "</tbody></table>";
    ?>  
</div>

<?php
render_graph($dbc, $id, $ontology);
?>
   

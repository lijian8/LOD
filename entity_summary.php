<div class="media">
    <?php
    $width = 300;
    $image_file = 'img/' . $name . '.jpg';
    if (is_file(iconv('utf-8', 'gb2312', $image_file))) {
        //$image_file = 'img/NA.jpg';
        echo '<a class="pull-right" href="search.php?keywords=' . $name . '">';
        echo '<img width="' . $width . '" class="media-object" src="' . $image_file . '" data-src="holder.js/64x64">';
        echo '</a>';
    }
    ?>
    <div class="media-body"  align ="left">
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
</div>

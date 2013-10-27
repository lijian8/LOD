<div class="row">
    <div class="col-md-8">
        <?php
        
        $filter = array_merge($type_labels, $names);

        $values = get_literals($dbc,$db_name, PREFIX . $id, $filter, $ratio = '10%');
        foreach ($values as $property => $value) {
            echo "<h3><a href=\"#\">$property</a></h3>";
            echo $value;
            echo "<hr>";
        }
        ?>
    </div>
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $name; ?></h3>
            </div>
            <div class="panel-body" align="center">
                <?php
                $image_file = 'img/' . $name . '.jpg';
                if (is_file(iconv('utf-8', 'gb2312', $image_file))) {
                    echo '<a class="thumbnail" href="search.php?keywords=' . $name . '">';
                    echo '<img width="' . $width . '" class="img-thumbnail" src="' . $image_file . '" alt="' . $name . '" data-src="holder.js/64x64">';
                    echo $name;
                    echo '</a>';
                }
                ?>   
            </div>

            <table class="table">
                <tbody>

                    <?php
                    // echo "<tr><td width='10%'>代码:</td><td>" . $id . "</td></tr>";
                    //  echo "<tr><td width='10%'>类型:</td><td>" . implode(',', get_types($dbc, $name, $id)) . "</td></tr>";

                   
                    
                    $s = '';
                    foreach ($names as $name_property) {
                        $s .= render_info_by_property($dbc, $db_name, PREFIX . $id, $name_property, false);                        
                    }
                    if ($s != '')  echo "<tr><td width='30%'>相关术语:</td><td>$s</td></tr>";
                   
                    render_links($dbc, $db_name, PREFIX . $id, '30%');
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>





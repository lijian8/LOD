<?php

function render($dbc, $db_name, $name, $property) {
    $query = "select * from graph where subject ='$name' and property='$property'";

    $result = mysqli_query($dbc, $query) or die('Error querying database2.');

    if (mysqli_num_rows($result) != 0) {
        echo '<p><a href="#">[' . $property . ']</a>&nbsp;';
        while ($row = mysqli_fetch_array($result)) {
            //$property = $row[property];
            $value = $row[value];


            echo render_value($dbc, $db_name, $value, false);
        }
        echo "</p>";
    }
}
?>

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
       
        $types = get_types($dbc, $id);
      
        foreach ($types as $type) {
            $properties = $ontology[$type];
            foreach ($properties as $property) {
                render($dbc, $db_name, PREFIX . $id, $property);
            }
        }
        ?>
    </div>
</div>

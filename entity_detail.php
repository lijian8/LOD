<?php
$values = get_property_values($dbc, $db_name, PREFIX . $id);
$values = get_reverse_property_values($dbc, $db_name, PREFIX . $id, $values);
echo '<hr>';
foreach ($values as $property => $value) {
    ?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $property; ?></h3>
        </div>

        <ul class="list-group">
            <?php
            foreach ($value as $v) {
                echo '<li class="list-group-item">' . $v . '</li>';
            }
            ?>
        </ul>
    </div>
<?php
}
?>

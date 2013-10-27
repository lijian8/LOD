<?php
$values = get_property_values($dbc,  $db_name, PREFIX . $id);

foreach ($values as $property => $value) {
    ?>
    <div class ="container">
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
    </div>
    <?php
}
?>

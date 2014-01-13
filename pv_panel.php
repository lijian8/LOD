<?php
foreach ($values as $property => $value) {
    
    //if (count($values) < 100) {
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
    //} else {
    ?>
<!--
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"> //echo $property; </h3>
            </div>

            <ul class="nav nav-pills">
                ?php
                //foreach ($value as $v) {
                  //  echo '<li>' . $v . '</li>';
                //}
                ?>
            </ul>
        </div>
       
   // }
}
?>

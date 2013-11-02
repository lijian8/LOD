<?php

function render_big_warning($warning) {
    echo '<div class = "alert alert-warning alert-dismissable"><button type = "button" class = "close" aria-hidden="true" data-dismiss = "alert">&times;</button><h2>' . $warning .
    '</h2></div>';
}


function render_warning($warning) {
    echo '<div class = "alert alert-warning alert-dismissable"><button type = "button" class = "close" aria-hidden="true" data-dismiss = "alert">&times;</button>' . $warning .
    '</div>';
}

function render_success($str) {
    echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'. $str . '</div>';
}


?>
 
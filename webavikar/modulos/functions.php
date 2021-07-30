<?php 


function replaceLn($html) {
    return preg_replace('#<br\s*/?>#i', "\n", $html);
}

function showEror($msg) {
    return '<div class="alert alert-error fade in center"><button class="close" type="button" data-dismiss="alert">x</button>' . $msg . '</div>';
}


?>
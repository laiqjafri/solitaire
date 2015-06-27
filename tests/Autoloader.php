<?php
spl_autoload_register('autoload_func');
function autoload_func($class_name) {
    include "../" . $class_name.'.php';
}
?>

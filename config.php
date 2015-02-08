<?php

function my_autoloader($class) {
    include 'classes/' . strtolower($class) . '_class.php';
}

spl_autoload_register('my_autoloader');

?>
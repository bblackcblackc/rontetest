<?php
/**
 * Bootstrap for tests
 */

require_once 'defines.php';

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});
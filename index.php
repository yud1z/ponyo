<?php

function __autoload($class_name) {
    include "system/bootstrap/" . $class_name . '.php';
}

new Bootstrap();
new Route();
new Uri();

<?php

spl_autoload_register(function ($class) {
    // $class ) Model\Vehicule;
    // Pour Linux et Mac
    // $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    $class = str_replace('\\', '/', $class);

    require 'src/'.$class.'.php';
});
<?php

spl_autoload_register(function ($class) {
    // $class = 'Model\Vehicule';
    // Pour Linux et Mac
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require 'src/'.$class.'.php';
});
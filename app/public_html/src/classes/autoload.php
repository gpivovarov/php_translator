<?php

if (file_exists($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'.env')) {
    $arVariables = parse_ini_file($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'.env');
    foreach ($arVariables as $variableKey => $variableValue) {
        if (defined($variableKey)) {
            continue;
        }
        define($variableKey, $variableValue);
    }
}

spl_autoload_register(function ($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    $file = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $file;

    if (file_exists($file)) {
        require_once $file;
        return true;
    }
    return false;
});

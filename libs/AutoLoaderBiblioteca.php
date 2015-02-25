<?php

function loadBibliotecas($className) 
{
    //echo ('passou');
    //echo ($className);
    $logicalPath = str_replace('\\', '/', $className);
    //echo ($logicalPath);
    $fullPath = __DIR__ . '/' . $logicalPath . '.php';
    $fullPath2 = __DIR__ . '/' . $logicalPath . '.class.php';
    //echo ($fullPath);
    if (file_exists($fullPath)) {
       //echo ($fullPath . 'Encontrou');
        require_once $fullPath;
    }elseif (file_exists($fullPath2)) {
        require_once $fullPath2;
    }
}
spl_autoload_register('loadBibliotecas');

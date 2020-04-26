<?php
spl_autoload_register('ClassAutoloader');

function ClassAutoloader($className){
    $folder = "classes/";
    $extension = ".class.php";
    $fullPath = $folder. $className. $extension;
    if(!file_exists($fullPath))
        return false;
    include_once ($fullPath);
}
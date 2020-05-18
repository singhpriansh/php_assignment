<?php
spl_autoload_register('myautoloader');
function myautoloader($className){
    $path = "class/";
    $extension = ".class.php";
    $fullpath = $path. $className. $extension;
    if(!file_exists($fullpath)){
        return false;
    }
    include_once $fullpath;
}
?>

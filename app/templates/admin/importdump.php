<?php
$target_dir = dirname(__FILE__).'/../../../public/dumps/import/';
$target_file = $target_dir . basename($_FILES["dumpimport"]["name"]);
$output = '';
$return = '';
$username = $app->config('db')['username'];
$password = $app->config('db')['password'];
$database = $app->config('db')['dbName'];
if (move_uploaded_file($_FILES["dumpimport"]["tmp_name"], $target_file)) {
    exec('mysql -u '.$username.' -p'.$password.' '.$database.' < '.$target_file,$output, $return);
    if(!$return) {
        unlink($target_file);
    }

} else {
    //@TODO flash error message
}


?>
<?php
use IIA\Lang\Lang as Lang;

$target_dir = dirname(__FILE__).'/../../../public/dumps/import/';
$target_file = $target_dir . basename($_FILES["dumpimport"]["name"]);
$output = '';
$return = '';
$username = $app->config('db')['username'];
$password = $app->config('db')['password'];
$database = $app->config('db')['dbName'];
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Allow certain file formats
if($imageFileType == "sql") {
    if (move_uploaded_file($_FILES["dumpimport"]["tmp_name"], $target_file)) {

        $localhostNames = ['iia.dev','localhost:8888','192.168.88.88'];
        if(!in_array($_SERVER['HTTP_HOST'],$localhostNames)) {
            exec('/usr/local/bin/mysql -u'.$username.' -p'.$password.' '.$database.' < '.$target_file,$output, $return);
        } else {
            exec('mysql -u'.$username.' -p'.$password.' '.$database.' < '.$target_file,$output, $return);
        }

        if(!$return) {

            $app->flash('message', Lang::get('messages_dumpimportsuccess'));
        } else {
            $app->flash('message', Lang::get('messages_dumpimportfail'));
        }
        unlink($target_file);

    }
} else {
    $app->flash('message', Lang::get('messages_dumpimportnotsql'));
}

$app->redirect($app->urlFor('admin.settings'));

?>
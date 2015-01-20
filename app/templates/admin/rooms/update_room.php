<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);


 $id = $_POST['id'];
 $name =  $_POST ['newname'];

 $data = Array(
    'name' => $name
);

// var_dump($id);
// var_dump($data);

$db->where ('id', $id);

//$db->update ('rooms', $data);

if($db->update ('rooms', $data)) {
    $message = Lang::get('messages_crud-e-success');
} else {
    $message = Lang::get('messages_crud-e-fail');
}


$app->flash('message',$message);
$app->redirect($app->urlFor('admin.rooms'));


?>
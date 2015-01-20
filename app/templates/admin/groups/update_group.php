<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);


 // var_dump($_POST);

 $id = $_POST['id'];
 $name =  $_POST ['name'];
 $code = $_POST['code'];

	$data = Array(
	    'name' => $name,
	    'code' => $code
	);

	// var_dump($data);

	$db->where ('id', $id);

	

if($db->update ('groups', $data)) {
    $message = Lang::get('messages_crud-e-success');
} else {
    $message = Lang::get('messages_crud-e-fail');
}


$app->flash('message',$message);
$app->redirect($app->urlFor('admin.groups'));



?>
<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);


	// var_dump($_POST); 

	$id = $_POST['id'];

	if ($_POST['create'] == "on") $create = 1;
	else $create = 0;

	if ($_POST['read'] == "on") $read =1 ;
	else $read = 0;

	if ($_POST['update'] == "on") $update = 1;
	else $update = 0;

	if ($_POST['delete'] == "on") $delete = 1;
	else $delete = 0;

	// var_dump($create);
	// var_dump($read);
	// var_dump($update);
	// var_dump($delete);

	$data = ["name" => $_POST['name'],"create" => $create,
	"read" => $read, "update" => $update,
	"delete" => $delete ];


	// var_dump($data);

	
	$db->where ('id', $id);

	



if($db->update ('roles', $data)) {
    $message = Lang::get('messages_crud-e-success');
} else {
    $message = Lang::get('messages_crud-e-fail');
}


$app->flash('message',$message);
$app->redirect($app->urlFor('admin.roles'));

?>
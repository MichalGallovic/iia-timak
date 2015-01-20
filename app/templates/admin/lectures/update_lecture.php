<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

			$id = $_POST['id'];
	
	
	$data = Array( 
		'subject_id' => $_POST['subject_id'],
		'start_time' => $_POST['start_time'],
		'end_time' => $_POST['end_time'],
		'user_id' => $_POST['user_id'],
		'room_id' => $_POST['room_id'],
		'day' => $_POST['day'] 
	 );


// var_dump($_POST);


	$db->where ('id', $id);

if($db->update ('lectures', $data)) {
    $message = Lang::get('messages_crud-e-success');
} else {
    $message = Lang::get('messages_crud-e-fail');
}


$app->flash('message',$message);
$app->redirect($app->urlFor('admin.lectures'));


?>

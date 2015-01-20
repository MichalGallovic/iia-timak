<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

			// $name = ["name" => $_POST['room_name']]; 

	 // var_dump($_POST);
			
			 $id = $db->insert ('lectures', $_POST);
			
		$message = '';
if($id) {
    $message = Lang::get('messages_crud-c-success');
} else {
    $message = Lang::get('messages_crud-c-fail');
}
$app->flash('message',$message);
$app->redirect($app->urlFor('admin.lectures'));

?>

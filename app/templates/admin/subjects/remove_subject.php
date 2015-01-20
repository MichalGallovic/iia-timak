<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

$id = $_POST['id']	; 

 //var_dump($id);
	
	 $db->where('id', $id);
     $db->delete('subjects');
    
   
$message = Lang::get('messages_crud-d-success');

$app->flash('message',$message);
$app->redirect($app->urlFor('admin.subjects'));
   
?>
<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

$id = $_POST['id']	; 

 // var_dump($id);
 // var_dump($_POST);
	
	  $db->where('id', $id);
      $db->delete('consultations');
    
		// $app->flash("echo messages_deleteok",Lang::get);
		// $app->redirect($app->urlFor('teacher.consultations'));   


?>
<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

$id = $_POST['id']	; 

<<<<<<< HEAD
 //var_dump($id);
 var_dump($id);
=======
 // var_dump($id);
 // var_dump($_POST);
>>>>>>> 09d484c226cb9c35edae4f7c0f1beba15694ef5b
	
	  $db->where('id', $id);
      $db->delete('consultations');
    
<<<<<<< HEAD
=======
		// $app->flash("echo messages_deleteok",Lang::get);
		// $app->redirect($app->urlFor('teacher.consultations'));   

>>>>>>> 09d484c226cb9c35edae4f7c0f1beba15694ef5b

?>
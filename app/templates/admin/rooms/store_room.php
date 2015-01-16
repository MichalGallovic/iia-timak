<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

			$name = ["name" => $_POST['room_name']]; 


			
			$id = $db->insert ('rooms', $name);
			
			//$app->flash('error_message','Zleje');
			//$app->redirect($app->urlFor('admin.rooms.create'));

?>

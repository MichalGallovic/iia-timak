<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

	

	 // var_dump($_POST);
			
			 $id = $db->insert ('consultations', $_POST);
			
	
?>

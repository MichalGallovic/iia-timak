<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

			$id = $_POST['id'];
	
var_dump($_POST);


	// $db->where ('id', $id);
	// $db->update ('lectures', $data);



?>

<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

	$id = $_POST['id'];
	
	
	$data = Array( 
		'start_time' => $_POST['start_time'],
		'end_time' => $_POST['end_time'],
		'day' => $_POST['day'],
		'note' => $_POST['note'] 
	 );


// var_dump($data);


	$db->where ('id', $id);
	$db->update ('consultations', $data);



?>

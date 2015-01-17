<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);


 // var_dump($_POST);

 $id = $_POST['id'];
 $name =  $_POST ['name'];
 $code = $_POST['code'];

	$data = Array(
	    'name' => $name,
	    'code' => $code
	);

	// var_dump($data);

	$db->where ('id', $id);

	$db->update ('groups', $data);

?>
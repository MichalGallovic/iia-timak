<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);


	//var_dump($_POST); 

	$data = ["code" => $_POST['code'], "name" => $_POST['name'],"acronym" => $_POST['acronym'],
	"lecture_duration" => (int)$_POST['lecture_duration'],"exercise_duration" => (int)$_POST['exercise_duration'],
	"color" => $_POST['color'],"term" => $_POST['term']];


	//var_dump($data);

	$id = $db->insert ('subjects', $data);

?>
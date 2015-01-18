<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);


	//var_dump($_POST);

	$id = $_POST['id'];


$data = ["code" => $_POST['code'], "name" => $_POST['newname'],"acronym" => $_POST['acronym'],
	"lecture_duration" => (int)$_POST['lecture_duration'],"exercise_duration" => (int)$_POST['exercise_duration'],
	"color" => $_POST['color'],"term" => $_POST['term']];


 // var_dump($id);
 // var_dump($data);

$db->where ('id', $id);

$db->update ('subjects', $data);

?>
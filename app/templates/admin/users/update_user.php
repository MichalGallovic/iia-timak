<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);


	// var_dump($_POST);

	$id = $_POST['id'];


$data = ["role_id" => $_POST['role_id'], "google" => $_POST['google'],"firstname" => $_POST['firstname'],
	"surname" => $_POST['surname'],"title1" => $_POST['title1'],
	"title2" => $_POST['title2'],"ldap" => $_POST['ldap'],"group_id" => $_POST['group_id'] ];

 // var_dump($id);
 // var_dump($data);

$db->where ('id', $id);

$db->update ('users', $data);

?>
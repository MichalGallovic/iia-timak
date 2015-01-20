<?php

use IIA\Lang\Lang as Lang;

$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'], $credentials['password'], $credentials['dbName']);

$id = $_POST['id'];

// var_dump($id);
// var_dump($_POST);

$db->where('id', $id);
$db->delete('consultations');


$message = Lang::get('messages_crud-d-success');

$app->flash('message',$message);
$app->redirect($app->urlFor('teacher.consultations'));

?>
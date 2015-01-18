<?php
use IIA\Auth\Auth as Auth;

$auth = new Auth($app);
$auth->loginLDAP($_POST['username'],$_POST['password']);

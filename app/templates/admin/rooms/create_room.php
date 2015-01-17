<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Create Room</h1>

	<form  method="POST">
		<p>Room name: </p>
		<input type="text" name="room_name" />
		<input type="submit" name="add" />
	</form>
</body>
</html>
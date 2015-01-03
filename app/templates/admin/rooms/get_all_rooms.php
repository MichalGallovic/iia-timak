<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$rooms = $db->get('rooms');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Rooms</h1>
	<ul>
		<?php foreach($rooms as $room): ?>
			<li><?php echo $room['name'] ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
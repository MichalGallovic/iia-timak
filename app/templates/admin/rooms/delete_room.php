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
	<title>Delete room</title>
</head>
<body>
	<h1>Delete Room</h1>
	
	<form action="<?php echo $app->urlFor('admin.rooms.remove') ?>" method="POST">
	<select value="id" name="id">
		<?php foreach($rooms as $room): ?>
			<option name="<?php echo $room['id'] ?>" value="<?php echo $room['id'] ?>" > <?php echo $room['name'] ?> </option>
		<?php endforeach; ?>
	</select>

	<input type="submit" value="remove" />
	</form>

</body>
</html>
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
	<title>Update room</title>
</head>
<body>
	<h1>Edit Room</h1>
	<p>Select room to edit</p>
	<form action="<?php echo $app->urlFor('admin.rooms.update'); ?>" method="POST">
	<select value="id" name="id">
		<?php foreach($rooms as $room): ?>
			<option name="<?php echo $room['id'] ?>" value="<?php echo $room['id'] ?>" > <?php echo $room['name'] ?> </option>
		<?php endforeach; ?>

	</select>

	<input type="text" name="newname" />

	<input type="submit" value="edit" />
	</form>

</body>
</html>
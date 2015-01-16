<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$subjects = $db->get('subjects');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update room</title>
</head>
<body>
	<h1>Edit Subject</h1>
	<p>Select room to edit</p>
	<form action="<?php echo $app->urlFor('admin.rooms.update') ?>" method="POST">
	<select value="id" name="id">
		<?php foreach($subjects as $subject): ?>
			<option name="<?php echo $subject['id'] ?>" value="<?php echo $subject['id'] ?>" > <?php echo $subject['name'] ?> </option>
		<?php endforeach; ?>

	</select>

	<input type="text" name="newname" />

	<input type="submit" value="edit" />
	</form>

</body>
</html>
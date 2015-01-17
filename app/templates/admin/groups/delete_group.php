<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$groups = $db->get('groups');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Delete Group</title>
</head>
<body>
	<h1>Delete Group</h1>

	<form action="<?php echo $app->urlFor('admin.groups.remove') ?>" method="POST">
	<select value="id" name="id">
		<?php foreach($groups as $group): ?>
			<option name="<?php echo $group['id'] ?>" value="<?php echo $group['id'] ?>" > <?php echo $group['name']; echo $group['code']; ?> </option>
		<?php endforeach; ?>

	</select>

	<input type="submit" value="delete" />
	</form>

</body>
</html>
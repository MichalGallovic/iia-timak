<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$roles = $db->get('roles');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Delete Role</title>
</head>
<body>
	<h1>Delete Role</h1>
	<p>Select Role to delete</p>
	<form action="<?php echo $app->urlFor('admin.roles.remove') ?>" method="POST">
	<select value="id" name="id">

		<?php foreach($roles as $role): ?>
			<option name="<?php echo $role['id'] ?>" value="<?php echo $role['id'] ?>" > <?php echo $role['name'] ?> </option>
		<?php endforeach; ?>

	</select>


	<input type="submit" value="Delete" />
	</form>

</body>
</html>
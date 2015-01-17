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
	<title>Document</title>
</head>
<body>
	<h1>Roles</h1>
	<ul>
		<?php foreach($roles as $role): ?>
			<li><?php echo $role['name']; echo ", create:"; echo $role['create']; echo ", read:"; echo $role['read'];  echo ", update:"; echo $role['update'];  echo ", delete:"; echo $role['delete']; ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
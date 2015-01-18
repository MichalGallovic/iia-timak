<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$users = $db->get('users');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Users</h1>
	<ul>
		<?php foreach($users as $user): ?>
			<li><?php echo $user['title1']; echo " "; echo $user['firstname']; echo " ";
			 echo $user['surname']; echo " "; echo $user['title2']; ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
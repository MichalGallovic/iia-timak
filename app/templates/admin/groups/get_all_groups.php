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
	<title>Document</title>
</head>
<body>
	<h1>Groups</h1>
	<ul>
		<?php foreach($groups as $group): ?>
			<li><?php echo $group['code']; echo ", "; echo $group['name']; ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
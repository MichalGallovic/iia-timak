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
	<title>Document</title>
</head>
<body>
	<h1>Subjects</h1>
	<ul>
		<?php foreach($subjects as $subjects): ?>
			<li><?php echo $subjects['name']; echo ", "; echo $subjects['code']; ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
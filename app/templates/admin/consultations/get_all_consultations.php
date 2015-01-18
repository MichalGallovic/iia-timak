<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$consultations = $db->get('consultations');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Consultations</h1>
	<ul>
		<?php foreach($consultations as $consultation): ?>
			<li><?php echo "day: ";echo $consultation['day']; echo ", note: "; echo $consultation['note'];
			echo ", start "; echo $consultation['start_time'];echo ", "; echo $consultation['end_time']; ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
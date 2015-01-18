<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$lectures = $db->get('lectures');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Lectures</h1>
	<ul>

		<?php foreach($lectures as $lecture): ?>
			<li>subject <?php echo $lecture['subject_id']; echo ", start time: "; 
			echo $lecture['start_time']; echo ", end time: "; echo $lecture['end_time']; 
			echo ", user id: "; echo $lecture['user_id']; echo ", room id: "; 
			echo $lecture['room_id']; echo ", day "; echo $lecture['day']; ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
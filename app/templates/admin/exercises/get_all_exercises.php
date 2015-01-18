<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$groups = $db->get('exercises');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Exercises</h1>
	<ul>
		<?php foreach($groups as $group): ?>
			<li><?php echo  "subject "; echo $group['subject_id']; echo ", user"; echo $group['user_id']; 
		 	echo ", room "; echo $group['room_id']; echo ", day "; 
			echo $group['day']; echo ", time "; 
			echo $group['start_time']; echo "-"; echo $group['end_time']; ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
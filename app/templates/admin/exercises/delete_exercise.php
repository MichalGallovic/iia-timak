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
	

<form action="<?php echo $app->urlFor('admin.exercises.remove') ?>" method="POST">

	<select value="id" name="id">
		<?php foreach($groups as $group): ?>
			<option name="<?php echo $group['id'] ?>" value="<?php echo $group['id'] ?>" > 
			<?php echo "subject"; echo $group['subject_id']; echo ", room "; echo $group['room_id']; 
			echo ", user ";echo $group['user_id']; echo ", day"; echo $group['day']; ?>


			 </option>
		<?php endforeach; ?>

	</select>


	<input type="submit" value="delete" />
	</form>



</body>
</html>
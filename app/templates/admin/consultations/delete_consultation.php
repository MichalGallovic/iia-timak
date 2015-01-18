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
	<title>Delete Consultation</title>
</head>
<body>
	<h1>Delete Consultation</h1>

	<form action="<?php echo $app->urlFor('admin.consultations.remove') ?>" method="POST">
	<select value="id" name="id">
		<?php foreach($consultations as $consultation): ?>
			<option name="<?php echo $consultation['id'] ?>" value="<?php echo $consultation['id'] ?>" >
<?php echo "day: ";echo $consultation['day']; echo ", note: "; echo $consultation['note'];
			echo ", start "; echo $consultation['start_time'];echo ", "; echo $consultation['end_time']; ?>
			 </option>
		<?php endforeach; ?>

	</select>

	<input type="submit" value="delete" />
	</form>

</body>
</html>
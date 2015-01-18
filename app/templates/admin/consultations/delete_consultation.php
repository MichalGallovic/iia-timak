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
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
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
					<div>
					<input class="btn btn-primary" type="submit" value="delete" />
					</div>
					</form>
			</div>
		</div>
	</div>

	

</body>
</html>
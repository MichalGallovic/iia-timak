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
	<title>Update room</title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">

</head>
<body>
	<div class="container">
			<div class="row">
				<div class="col-md-4">
					
					<h1>Delete Subject</h1>
					
					<form action="<?php echo $app->urlFor('admin.subjects.remove') ?>" method="POST">
					<select class='form-control' value="id" name="id">
						<?php foreach($subjects as $subject): ?>
							<option name="<?php echo $subject['id'] ?>" value="<?php echo $subject['id'] ?>" > <?php echo $subject['name']; echo ", ";echo $subject['acronym']; echo ", "; echo $subject['code'] ?> </option>
						<?php endforeach; ?>

					</select>

					<input class='btn btn-primary' type="submit" value="delete" />
					</form>
					
				</div>
			</div>
		</div>
	

</body>
</html>
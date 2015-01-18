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
	<title>Delete Group</title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">

</head>
<body>
	<div class="container">
			<div class="row">
				<div class="col-md-5">
					<h1>Delete Group</h1>

					<form action="<?php echo $app->urlFor('admin.groups.remove') ?>" method="POST">
					<select class='form-control' value="id" name="id">
						<?php foreach($groups as $group): ?>
							<option name="<?php echo $group['id'] ?>" value="<?php echo $group['id'] ?>" > <?php echo $group['code']; echo " - "; echo $group['name'];  ?> </option>
						<?php endforeach; ?>

					</select>

					<input class='btn btn-primary' type="submit" value="delete" />
					</form>
					
					
				</div>
			</div>
		</div>
	

</body>
</html>
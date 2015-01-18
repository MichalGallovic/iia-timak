<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$roles = $db->get('roles');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Delete Role</title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h1>Delete Role</h1>
				<p>Select Role to delete</p>
				<form action="<?php echo $app->urlFor('admin.roles.remove') ?>" method="POST">
				<select class="form-control" value="id" name="id">

					<?php foreach($roles as $role): ?>
						<option name="<?php echo $role['id'] ?>" value="<?php echo $role['id'] ?>" > <?php echo $role['name'] ?> </option>
					<?php endforeach; ?>

				</select>
				<div>
					<input class="btn btn-primary" type="submit" value="Delete" />
				</div>
				
			</div>
		</div>
	</div>
	
	
	


	
	</form>

</body>
</html>
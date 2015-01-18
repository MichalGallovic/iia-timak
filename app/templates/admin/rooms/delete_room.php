<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$rooms = $db->get('rooms');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Delete room</title>

		<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h1>Delete Room</h1>
				<form action="<?php echo $app->urlFor('admin.rooms.remove') ?>" method="POST">
				<select class="form-control" value="id" name="id">
					<?php foreach($rooms as $room): ?>
						<option name="<?php echo $room['id'] ?>" value="<?php echo $room['id'] ?>" > <?php echo $room['name'] ?> </option>
					<?php endforeach; ?>
				</select>
				<div>
					<input class="btn btn-primary" type="submit" value="remove" />
				</div>
				</form>
				
				
			</div>
		</div>
	</div>
	
	
	

</body>
</html>
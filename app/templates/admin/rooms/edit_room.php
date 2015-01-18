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
	<title>Update room</title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
</head>
<body>
	<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h1>Edit Room</h1>
					<p>Select room to edit</p>
					<form action="<?php echo $app->urlFor('admin.rooms.update'); ?>" method="POST">
					<select class='form-control' value="id" name="id">
						<?php foreach($rooms as $room): ?>
							<option name="<?php echo $room['id'] ?>" value="<?php echo $room['id'] ?>" > <?php echo $room['name'] ?> </option>
						<?php endforeach; ?>

					</select>

<!-- 					<input class='form-control' type="text" name="newname" />
 -->
					<div class="form-group">
					   <label >New Name:</label>
					   <input type="text" class="form-control" name="newname"/>
					 </div>
					<div>
					<input class="btn btn-primary" type="submit" value="edit" />
					</div>
					</form>
					
					
				</div>
			</div>
		</div>
	

</body>
</html>
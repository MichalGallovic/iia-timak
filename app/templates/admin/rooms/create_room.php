<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">

</head>
<body>
	<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h1>Create Room</h1>
					<form  method="POST">
						<div class="form-group">
						   <label >Room name:</label>
						   <input type="text" class="form-control" name="room_name"/>
						 </div>
						<div>
						<input class="btn btn-primary" type="submit" name="add" />
						</div>

					</form>
					
					
				</div>
			</div>
		</div>
	

	
</body>
</html>
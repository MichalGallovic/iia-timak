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
	<title>Document</title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
				<h1>Rooms</h1>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Miestnosť</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($rooms as $room): ?>
							<tr><td><?php echo $room['name'] ?></td></tr>
						<?php endforeach; ?>
						
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
	
</body>
</html>
<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$lectures = $db->get('lectures');

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
					<h1>Lectures</h1>
					<!-- <ul> -->
					<table class="table table-striped">
						<thead>
							<tr>
								<th>subject</th>
								<th>start time</th>
								<th>end time</th>
								<th>user</th>
								<th>room</th>
								<th>day</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($lectures as $lecture): ?>
								<tr><td> <?php echo $lecture['subject_id'];?></td><td> <?php echo $lecture['start_time'];?></td><td><?php echo $lecture['end_time']; ?></td><td><?php echo $lecture['user_id'];?></td><td><?php echo $lecture['room_id'];?></td><td> <?php  echo $lecture['day']; ?></td></tr>
							<?php endforeach; ?>
						</tbody>
					</table>

						
					<!-- </ul> -->
					
					
				</div>
			</div>
		</div>
	
</body>
</html>
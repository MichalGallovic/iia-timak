<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$groups = $db->get('exercises');

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
					<h1>Exercises</h1>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									subject
								</th>
								<th>
									user
								</th>
								<th>
									room
								</th>
								<th>
									day
								</th>
								<th>
									start time
								</th>
								<th>
									end time
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($groups as $group): ?>
								<tr><td><?php  echo $group['subject_id']; ?></td><td><?php echo $group['user_id'];?></td><td><?php echo $group['room_id']; ?></td><td><?php echo $group['day'];?></td><td><?php echo $group['start_time']; ?> </td><td><?php echo $group['end_time']; ?></td></tr>
							<?php endforeach; ?>
							
						</tbody>
					</table>
						
					
					
					
				</div>
			</div>
		</div>
	
</body>
</html>
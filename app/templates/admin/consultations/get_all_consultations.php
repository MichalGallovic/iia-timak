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
	<title>Document</title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">

</head>
<body>
<<<<<<< HEAD
	<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Consultations</h1>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Day</th>
								<th>Note</th>
								<th>Start</th>
								<th>End</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($consultations as $consultation): ?>
								<tr><td><?php echo $consultation['day'];?></td><td><?php echo $consultation['note'];?></td><td><?php echo $consultation['start_time'];?></td><td><?php echo $consultation['end_time'];?></td></tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					
					
				</div>
			</div>
		</div>
	
		
=======
	<h1>Consultations</h1>
	<ul>
		<?php foreach($consultations as $consultation): ?>
			<li><?php echo "room: ";echo $consultation['room_id']; echo ", note: "; echo $consultation['note'];
			echo ", start "; echo $consultation['start_time'];echo ", "; echo $consultation['end_time'];
			echo ", day "; echo $consultation['day']; ?></li>
		<?php endforeach; ?>
	</ul>
>>>>>>> 4bd62468476633e91a3c0459f8c911506610ad8f
</body>
</html>
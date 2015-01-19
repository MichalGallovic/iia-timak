<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$lectures = $db->get('lectures');

$dayNames = array(
    
    0=>'Monday', 
    1=>'Tuesday', 
    2=>'Wednesday', 
    3=>'Thursday', 
    4=>'Friday', 
    5=>'Saturday', 
    6=>'Sunday'
 );

$dni = array(
    
    0=>'Pondelok', 
    1=>'Utorok', 
    2=>'Streda', 
    3=>'Štvrtok', 
    4=>'Piatok', 
    5=>'Sobota', 
    6=>'Nedeľa'
 );

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo Lang::get('navbar_brand') ?></title>
	<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">

</head>
<body>
	
<div class="nav navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo Lang::get('navbar_brand') ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $app->urlFor('login') ?>"><?php echo Lang::get('navbar_logout') ?></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</div>
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

								<?php

									// join na subjects
									$db->join("subjects s", "l.subject_id=s.id", "LEFT");
                                    $db->where("s.id", $lecture['subject_id']);

                                    $exers = $db->get ("lectures l", null, "s.acronym, s.name");

                                    $acro = $exers[0][ 'acronym'];
                                    $name = $exers[0][ 'name'];
                                    

                                    // join na users
                                    $db->join("users u", "l.user_id=u.id", "LEFT");
                                    $db->where("u.id", $lecture['user_id']);

                                    $usrs = $db->get ("lectures l", null, "u.title1, u.title2, u.firstname, u.surname");

                                    $surname = $usrs[0]['surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0]['title1'];
                                    $t2 = $usrs[0]['title2'];


                                    // join na rooms
                                    $db->join("rooms r", "l.room_id=r.id", "LEFT");
                                    $db->where("r.id", $lecture['room_id']);

                                    $rms = $db->get ("lectures l", null, "r.name");

                                    $rname = $rms[0]['name'];

                                   ?>






								<tr><td> <?php echo $acro; echo ", "; echo $name; ?></td>
									<td> <?php echo $lecture['start_time'];?></td>
									<td><?php echo $lecture['end_time']; ?></td>
									<td><?php echo $t1; echo " "; echo $firstname;  echo " "; 
									echo $surname; echo " "; echo $t2; ?></td>
									<td><?php echo $rname;?></td>
									<td> <?php  echo $dni[$lecture['day']]; ?></td></tr>
							<?php endforeach; ?>
						</tbody>
					</table>

						
					<!-- </ul> -->
					
					
				</div>
			</div>
		</div>
	
</body>
</html>
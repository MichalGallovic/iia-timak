<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$groups = $db->get('exercises');


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
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
	<div class="container">
			<div class="row">
				<div class="col-md-12">
 			  <?php if($flash['message']): ?>
                        <div class="alert alert-info" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Info:</span>
                            <?php echo $flash['message'] ?>
                        </div>
                    <?php endif; ?>

					<h1><?php echo Lang::get('exercises_header') ?></h1>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									<?php echo Lang::get('common_subject') ?>
								</th>
								<th>
									<?php echo Lang::get('common_teacher') ?>
								</th>
								<th>
									<?php echo Lang::get('common_room') ?>
								</th>
								<th>
									<?php echo Lang::get('common_day') ?>
								</th>
								<th>
									<?php echo Lang::get('common_start') ?>
								</th>
								<th>
									<?php echo Lang::get('common_end') ?>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($groups as $group): ?>

								<?php
									// join na subjects 
									$db->join("subjects s", "e.subject_id=s.id", "LEFT");
                                    $db->where("s.id", $group['subject_id']);

                                    $exers = $db->get ("exercises e", null, "s.acronym, s.name");

                                    $acro = $exers[0][ 'acronym'];
                                    $name = $exers[0][ 'name'];
                                    

                                    // join na exercises
                                    $db->join("users u", "e.user_id=u.id", "LEFT");
                                    $db->where("u.id", $group['user_id']);

                                    $usrs = $db->get ("exercises e", null, "u.title1, u.title2, u.firstname, u.surname");

                                    $surname = $usrs[0]['surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0]['title1'];
                                    $t2 = $usrs[0]['title2'];


                                    // join na rooms
                                    $db->join("rooms r", "e.room_id=r.id", "LEFT");
                                    $db->where("r.id", $group['room_id']);

                                    $rms = $db->get ("exercises e", null, "r.name");

                                    $rname = $rms[0]['name'];
                                   

								?>


								<tr><td><?php  echo $acro; echo ", "; echo $name ?></td>
									<td><?php echo $t1; echo " "; echo $firstname; echo " "; echo $surname; echo " "; echo $t2; ?></td>
									<td><?php echo $rname; ?></td><td><?php echo $dni[$group['day']]; ?></td>
									<td><?php echo $group['start_time']; ?> </td><td><?php echo $group['end_time']; ?></td></tr>
							<?php endforeach; ?>
							
						</tbody>
					</table>
						
					
					
					
				</div>
			</div>
		</div>
	
 <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	
</body>
</html>
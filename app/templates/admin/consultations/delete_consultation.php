<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$consultations = $db->get('consultations');

$dayNames = Lang::get('consultations_days');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo Lang::get('navbar_brand') ?></title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
    <link rel="stylesheet" href="/style/admin.css"/>
</head>
<body>
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h1><?php echo Lang::get('consultations_deleteheader') ?></h1>
					<form action="<?php echo $app->urlFor('admin.consultations.remove') ?>" method="POST">
					



					<select class="form-control" value="id" name="id">
						<?php foreach($consultations as $consultation): ?>




                                 <?php
                                    
                                    $db->join("subjects s", "c.subject_id=s.id", "LEFT");
                                    $db->where("s.id", $consultation['subject_id']);

                                    $subs = $db->get ("consultations c", null, "s.acronym, s.name");
                                  // var_dump($subs[0]);

                                    $sub= $subs[0][ 'name'];
                                    $acro = $subs[0]['acronym'];


                                    $db->join("users u", "c.user_id=u.id", "LEFT");
                                    $db->where("u.id", $consultation['user_id']);

                                    $usrs = $db->get ("consultations c", null, "u.title1, u.firstname, u.surname, u.title2");

                                    $surname = $usrs[0][ 'surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0][ 'title1'];
                                    $t2 = $usrs[0][ 'title2'];
                                    
                            
                                    ?>   




							<option name="<?php echo $consultation['id'] ?>" value="<?php echo $consultation['id'] ?>" >
								
								<?php echo $dayNames[$consultation['day']];
                                    echo ", "; echo $consultation['start_time']; echo "-"; echo $consultation['end_time']; 
                                    echo ", "; echo $acro; echo ", "; echo $t1; echo " "; echo $firstname; echo " "; echo $surname;
                                    echo ", "; echo $t2;  ?>

							</option>

						<?php endforeach; ?>

 					</select>

					<div class="margin-20">
					<input class="btn btn-primary" type="submit" value="<?php echo Lang::get('consultations_delete') ?>" />
					</div>
					</form>
			</div>
		</div>
	</div>

 <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	

</body>
</html>
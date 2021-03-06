<?php
use IIA\Auth\Auth as Auth;
use IIA\Lang\Lang as Lang;
$auth = new Auth($app);
if(isset($_GET['code'])) {
    $auth->linkGoogle();
}
$email = $auth->getUserEmail();

$authUrl = '';
if(!$email) {
    $authUrl = $auth->getGoogleLinkUrl();
}
$username = $auth->getFullName();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>IIA</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/admin.css"/>
</head>
<body>
<!--HEADER-->
<?php $app->render('teacher/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
<div class="container">
    <div class="row margin-20">
        <div class="col-md-12">
            <?php if($flash['message']): ?>
                <div class="alert alert-info" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Info:</span>
                    <?php echo $flash['message'] ?>
                </div>
            <?php endif; ?>
            <h3>Settings</h3>
            <?php if($authUrl): ?>
                <p>
                    <?php echo Lang::get('settings_googlelink') ?>
                    <a href="<?php echo $authUrl ?>" class="btn btn-default"><i class="glyphicon glyphicon-link"></i></a>
                </p>
            <?php else: ?>
                <p>
                    <?php echo Lang::get('settings_googlelinked')?>
                    <strong><?php echo $email?></strong>
                    <a href="<?php echo $app->urlFor('unlink.google') ?>" class="btn btn-warning"><?php echo Lang::get('settings_gplusunlink') ?></a>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="/js/libs/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="/js/index/index.js"></script>
</body>
</html>
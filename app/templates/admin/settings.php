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
            <a class="navbar-brand" href="<?php echo $app->urlFor('admin.index')?>">FEI Timetable</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_exercises') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.exercises') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.exercises.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.exercises.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.exercises.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_subjects') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.subjects') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.subjects.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.subjects.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.subjects.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_lectures') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.lectures') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.lectures.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.lectures.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.lectures.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_consultations') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.consultations') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.consultations.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.consultations.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.consultations.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_rooms') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.rooms') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.rooms.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.rooms.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.rooms.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_users') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.users') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.users.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.users.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.users.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_roles') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.roles') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.roles.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.roles.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.roles.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_groups') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.groups') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.groups.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.groups.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.groups.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $username ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.index') ?>"><i class="glyphicon glyphicon-user"></i> <?php echo Lang::get('navbar_profile') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.settings')?>"><i class="glyphicon glyphicon-wrench"></i> <?php echo Lang::get('navbar_settings')?></a></li>
                        <li><a href="<?php echo $app->urlFor('logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <?php echo Lang::get('navbar_logout')?></a></li>
                    </ul>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</div>
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
            <p>
                <?php echo Lang::get('settings_dumpdownload') ?>
                <a href="<?php echo $app->urlFor('admin.dump') ?>" class="btn btn-default" download><i class="glyphicon glyphicon-download"></i></a>
            </p>

            <p>
                <?php echo Lang::get('settings_dumpimport') ?>

                <form action="<?php echo $app->urlFor('admin.dump.import')?>" method="post" enctype="multipart/form-data">
                    <input style="display:inline;" type="file" name="dumpimport">
                    <button type="submit" name="submit" class="btn btn-default"><i class="glyphicon glyphicon-upload"></i></button>
                </form>
            </p>
        </div>
    </div>
</div>
<script src="/js/libs/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="/js/index/index.js"></script>
</body>
</html>
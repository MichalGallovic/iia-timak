<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();
?>
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
            <a class="navbar-brand" href="<?php echo $app->urlFor('admin.index')?>"><?php echo Lang::get('navbar_brand') ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_schedules') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.schedules.check') ?>"><?php echo Lang::get('crud_check') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.schedules.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                    </ul>
                </li>
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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::getLang() ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('lang.change') ?>"><?php echo Lang::getOther() ?></a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</div>

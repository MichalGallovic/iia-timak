<?php

// most simple lang changing - no time sorry

$resource = str_replace('http://'.$_SERVER['HTTP_HOST'],'',$app->request()->getReferer());
$newurl = '';
if(substr($resource,1,2) == 'sk') {
    $newurl = str_replace('sk','en',$resource);
} else {
    $newurl = str_replace('en','sk',$resource);
}


$app->redirect($newurl);
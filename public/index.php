<?php
// Include application bootstrap
require_once dirname(__FILE__) . '/../bootstrap/autoload.php';

$app = require_once dirname(__FILE__) . '/../bootstrap/start.php';

require_once dirname(__FILE__) . '/../app/routes.php';

$app->run();

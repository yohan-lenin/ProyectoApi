<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

define("SPECIALCONSTANT", true);
require 'app/libs/connect.php';
require 'app/routes/api.php';
require 'app/routes/api2.php';
require 'app/routes/api3.php';
require 'app/routes/api4.php';
require 'app/routes/api5.php';
require 'app/routes/api6.php';
require 'app/routes/api7.php';
require 'app/routes/api8.php';

$app->run();
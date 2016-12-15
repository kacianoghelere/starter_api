<?php

require 'vendor/autoload.php';
require_once('app/controllers/base.controller.php');
require_once('app/controllers/home.controller.php');
require_once('app/controllers/test.controller.php');
require_once('app/controllers/user.controller.php');
require_once('app/core/route.config.php');

$app = new Slim\App();

$router = new RouteConfig($app);
$router->load('routes.json');

$app->run();
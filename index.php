<?php

include 'shared/Router.php';
require_once('shared/Router.php');
require_once('shared/functions.php');
$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);
$makeRoute = $router->startRouting();
if(!$makeRoute)
    error_log("could not start routing request $request");

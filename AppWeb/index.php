<?php
session_start();

require 'controlers/Router.php';

$router = new Router();
$router->routerRequest();
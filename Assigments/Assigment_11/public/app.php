<?php
require '../vendor/autoload.php';
require '../generated-conf/config.php';

//////////////////////
// Slim Setup
//////////////////////

$settings = ['displayErrorDetails' => true];

$app = new \Slim\App(['settings' => $settings]);

$container = $app->getContainer();
$container['view'] = function($container) {
	$view = new \Slim\Views\Twig('../templates');
	
	$basePath = rtrim(str_ireplace('index.php', '', 
	$container->get('request')->getUri()->getBasePath()), '/');

	$view->addExtension(
	new Slim\Views\TwigExtension($container->get('router'), $basePath));
	
	return $view;
};

//////////////////////
// Routes
//////////////////////

// home page route
$app->get('/', function ($request, $response, $args) {
	$this->view->render($response, 'home.html');
	return $response;
});

//////////////////////
// AJAX Handlers
//////////////////////

$app->post('/userLogin/', function ($request, $response, $args) {

	$default_username = $request->getParam('username');
	$default_password = $request->getParam('password');

	$userObj = new User;
	
	//$userObj->setPassword($default_userName,$default_password);
	$userData = $userObj->login($default_username,$default_password);

	return $response->withJson($userData);
	
});




//////////////////////
// App run
//////////////////////

$app->run();

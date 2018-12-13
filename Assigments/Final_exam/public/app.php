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

	$enemies = EnemyQuery::create()->orderById(); //display the recent list of enemies

	$this->view->render($response, 'thelist.html',["enemies" => $enemies]);
	return $response;
});

// add enemy route
$app->post('/add', function ($request, $response, $args) {


	$priority = $request->getParam('priority');
	$username = $request->getParam('username');
	$justification = $request->getParam('justification');

	if(!empty($priority) & !empty($username) & !empty($justification)) //test none are empty
	{
		$enemy = new Enemy();
		$enemy->SetPriority($priority);
		$enemy->SetUsername($username);
		$enemy->SetJustification($justification);
		$enemy->save();

		$enemies = EnemyQuery::create()->orderById();

		$this->view->render($response, 'thelist.html',["enemies" => $enemies]);
		return $response;
		
	}
	else //if one of them is empty
	{
		$enemies = EnemyQuery::create()->orderById();
		$return = "You have empty fields";
		$this->view->render($response, 'thelist.html',["priority" => $priority, "username" => $username,"justification"=> $justification, "success" => $return, "enemies" => $enemies]);
		return $response;
	}
	
});

//////////////////////
// AJAX Handlers
//////////////////////

$app->post('/delete', function ($request, $response, $args) {

	$userId = $request->getParam('userId'); //get the user by ID

	$enemies = EnemyQuery::create()->findPk($userId); //find the user by ID

	if($enemies)// if exists
	{
		$enemies->delete(); //delete
	}

	$this->view->render($response, 'thelist.html',["enemies" => $enemies]);
	return $response;
});




//////////////////////
// App run
//////////////////////

$app->run();

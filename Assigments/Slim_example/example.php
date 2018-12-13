<?php

require '../vendor/autoload.php';



$app = new \Slim\App();


$app->get('/', function($request, $response, $args)
{
	$response->getBody()->write("hello there");
});
//echo("hello world");

$app->run();

?>
<?php

require "../vendor/autoload.php";
require "../generated-conf/config.php";

$app = new \Slim\App(["settings" => ["displayErrorDetails" => true]]); // create the app and set it up to display errors
$container = $app->getContainer(); // create the container object

$container['view'] = function ($container) //create the container to set up the view routes for the templates.
{
    $view = new \Slim\Views\Twig('../templates/', [
        'cache' => false
    ]);

    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new Slim\Views\TwigExtension($router, $uri));
    return $view;
};

$app->get('/', function($request, $response, $args) // get the root directory and create the data from our databse
{
	$recipes = RecipeQuery::create()->orderByName(); // create the recipes object using propel and order them by alphabetical order(name)
	$response = $this->view->render($response,"viewRecipes.html",["recipes" => $recipes]); // render the information to the viewRecipes.html pass all objects.
	return $response;
});

$app->get('/id={recipeId}', function($request, $response, $args) // listen to the get request of a recipie, and search using the args{recipe.id} to find the recipe.
{
	$recipeId = $args['recipeId'];
	$recipe = RecipeQuery::create()->filterById($recipeId)->findOne(); //we still need information of that recipe in the viewSteps.html so query to find that recipe.
	$steps = StepsQuery::create()->filterByRecipeId($recipeId)->orderById(); //find steps for that specific recipe.id and order them so you print the steps in order.
	$response = $this->view->render($response,"viewSteps.html",["recipe" => $recipe, "steps"=>$steps]); // render both queries to viewSteps.html and pass them.
	return $response;
});

$app->run(); // run the app

?>
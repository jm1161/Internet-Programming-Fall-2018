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
	$response = $this->view->render($response,"viewRecipes-template.html",["recipes" => $recipes]); // render the information to the viewRecipes.html pass all objects.
	return $response;
});

$app->get('/id={recipeId}', function($request, $response, $args) // listen to the get request of a recipie, and search using the args{recipe.id} to find the recipe.
{
	$recipeId = $args['recipeId'];
	$recipe = RecipeQuery::create()->filterById($recipeId)->findOne(); //we still need information of that recipe in the viewSteps.html so query to find that recipe.
	$steps = StepsQuery::create()->filterByRecipeId($recipeId)->orderByStepNumber(); //find steps for that specific recipe.id and order them so you print the steps in order.
	$response = $this->view->render($response,"viewSteps.html",["recipe" => $recipe, "steps"=>$steps]); // render both queries to viewSteps.html and pass them.
	return $response;
});

$app->get('/updateTitle/rid={recipeId}&rt={recipeTitle}', function($request, $response, $args) 
{
	$recipeId = $args['recipeId']; //extract the recipeId from the args
	$recipeName = $args['recipeTitle']; //extrat the recipeName from the args
	$recipe = RecipeQuery::create()->filterById($recipeId)->findOne(); //locate the recipe name from the stepsQuery and create the object
	$recipe->setName($recipeName); //update the new name to the stepsQuery
	$recipe->save(); //save the update
	return $response;
});

$app->get('/updateDescription/sid={stepId}&sd={stepDescription}', function($request, $response, $args) 
{
	$stepId = $args['stepId']; //extract the stepId from the args
	$stepDescription = $args['stepDescription']; //extract the stepDescriptiion from the args

	$steps = StepsQuery::create()->filterById($stepId)->findOne(); //create a query for the steps and find the step by id.
	$steps->setDescription($stepDescription); //update the description of the step.
	$steps->save(); //save the update.
	return $response;
});

$app->get('/addDescription/rid={recipeId}&sn={stepNumber}&sd={stepDescription}', function($request, $response, $args) 
{
	$recipeId = $args['recipeId']; //get the recipeId from the args
	$stepDescription = $args['stepDescription']; //get the description of the step from the args
	$stepNumber = $args['stepNumber']; //get the step number from the args

	$steps = new Steps(); //create a new step
	$steps->setDescription($stepDescription); //set the description
	$steps->setRecipeId($recipeId); //set the recipe id that it belongs to
	$steps->setStepNumber($stepNumber); //give it a step number
	$steps->save(); // save the update
	return $response;
});

$app->get('/editSteps/sid={stepId}&sn={stepNumber}', function($request, $response, $args) 
{
	$stepId = $args['stepId']; //get the step id from the args 
	$stepNumber = $args['stepNumber']; //get the step number from the args

	$steps = StepsQuery::create()->filterById($stepId)->findOne(); //locate the step by filtering by step_id
	$steps->setStepNumber($stepNumber); //update the description
	$steps->save(); //save the update
	return $response;
});

$app->run(); // run the app

?>
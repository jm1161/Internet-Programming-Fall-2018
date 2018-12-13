<?php
require '../vendor/autoload.php';
require '../generated-conf/config.php';

//////////////////////
// Slim Setup
//////////////////////

$settings = ['displayErrorDetails' => true];
$app = new \Slim\App(['settings' => $settings]);
$container = $app->getContainer();
$container['view'] = function($container) 
{
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


$app->get('/', function ($request, $response, $args) //home page route
{
	$comments = CommentQuery::create()->orderByCreateTime(); //order the comments by created time
	$this->view->render($response, 'post.html',["comments" => $comments]); //render the array of existing comments from the DB to the HTML using twig syntax
	return $response;
});

//////////////////////
// AJAX Handlers
//////////////////////

$app->post('/userLogin/', function ($request, $response, $args) //user login ajax route handler 
{
	$default_username = $request->getParam('username'); //extract the username from the form sent from the post request in HTML
	$default_password = $request->getParam('password'); //extract the password from the form sent from the post request in HTML
	$userObj = new User; //create a new User object to have access to our User.php model methods
	$userData = $userObj->login($default_username,$default_password);  //use our login method to validate if the user exists and password is valid
	return $response->withJson($userData); //return the response to the ajax handler returning the Json containing the array of userData to be displayed in the HTML
});

$app->post('/submit/', function ($request, $response, $args) //user comment submit ajax route handler
{
	$body = $request->getParam('body'); //extract the comment typed by the user
	$userId = $request->getParam('userId'); //extract the userId from the user that was signed in

	if(!empty($body)) //check if the body is empty "Never Trust The Client"(Tomai 2018)
	{
		$commentObj = new Comment; //create a new comment object
		$commentObj->setBody($body); //set the body with the user comment
		$commentObj->setAuthorId($userId); //set the author id using the user id
		$commentObj->save(); //save it to the DB
		return $response->withJson(array("success" => true)); //return just to confirm the comment was properly saved
	}
	else
	{
		return $response->withJson(array("success" => false)); //is something is wrong return success false meaning that something went wrong
	}
});

$app->get('/update/', function ($request, $response, $args) //ajax handler to update the comment board if new comments are posted in the DB
{
	$commentId = $request->getParam('commentId'); //retrieve the latest comment id present in the HTML comment board

	$commentQuery = CommentQuery::create()->filterById(array("min" => $commentId + 1))->findOne(); //find comments greater than that last commentId 
	
	if(isset($commentQuery)) //if there are comments greater than the last comment
	{
		$userQuery = UserQuery::create()->findPk($commentQuery->getAuthorId()); //using the commentQuery get the authorId to find the data from that user
		$user = $userQuery->getUsername(); //extract the username
		$comment_body = $commentQuery->getBody(); //extract the comment to be displayed in the HTML
		$comment_date = $commentQuery->getCreateTime(); //extract the created time
		$comment_id = $commentQuery->getId(); //extract the comment id
		return $response->withJson(array("username"=> $user , "comment" => $comment_body, "date" => $comment_date, "comment_id" => $comment_id, "success" => true)); //return the json with the apropiate data to display the newest comment.(username, comment,date and commentId)
	}
	else //if there is no updates available 
	{
		return $response->withJson(array("success"=> false)); //return a false if no updates availabe
	}
});

$app->get('/logout/', function ($request, $response, $args) //user logout ajax route handler
{
	return $response->withJson(array("success" => true)); //just return that you succesfully got the request to logout
});


//////////////////////
// App run
//////////////////////

$app->run();

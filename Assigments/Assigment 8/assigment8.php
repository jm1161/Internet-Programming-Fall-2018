

<?php 

// invoke autoload to get access to the propel generated models
require_once 'vendor/autoload.php';

// require the config file that propel init created with your db connection information
require_once 'generated-conf/config.php';

$recipe = RecipeQuery::create();
$steps = StepsQuery::create();


foreach ($recipe as $value) 
{
	
	echo("<p>Recipes Name: ".$value->getName()."</p>");
	echo("<img src='".$value->getImageUrl()."'/img>");
	echo("<p>Recipes Description: ".$value->getDescription()."</p>");
	foreach ($steps as $key)
	{
		echo("<p>Step #: ".$key->getStepNumber()."</p>");
		echo("<p>".$key->getDescription()."</p>");
	}
}
 ?>

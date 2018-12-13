<?php 
	
	$password = "mysecretpassword";

	//echo $password;

	$hash = password_hash($password, PASSWORD_DEFAULT);

	//echo $hash;





 ?>

 <p>password is: <?= $password?></p>

 <p>hast total is: <?= $hash?></p>

 <p>hash type: <?= substr($hash, 0,4)?></p>

 <p>hash type: <?= substr($hash, 4,2)?></p>

 <p>hash salt: <?= substr($hash, 7,22)?></p>

 <p>hash: <?= substr($hash,strlen($hash)-31,31)?></p>

<?php 

 	$userInput = "mysecretpasswor";

	if(password_verify($userInput,$hash))
	{
		echo "succeesful";
	}
	else
	{
		echo "fake user";
	}





 ?>
<?php

use Base\User as BaseUser;

/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class User extends BaseUser
{

	//setPassword method creates a new user on the database by username and password
	function setPassword($userName, $userPassword)
	{
		$hashed_password = password_hash($userPassword, PASSWORD_DEFAULT); //hash the given password before saving it to the database
		$objuser = new User; //create the new user object
		$objuser->setUsername($userName); //set the username field with the given username
		$objuser->setPasswordHash($hashed_password); //set the hashed_password with the password given
		$objuser->save(); //save our new user to the database
	}

	//login method searches for a user and verifies the typed password
	function login($userName, $userPassword)
	{
		$userQuery = UserQuery::create()->filterByUsername($userName)->findOne(); //find the user

		//verify if the user exists and the password is correct
		if($userQuery && password_verify($userPassword,$userQuery->getPasswordHash()))
		{		
			$userData = array("userID" => $userQuery->getId(), "username" => $userName, "success" => true );
			return $userData;
		}
		else
		{
			return $userData = array("success" => false );
		}
		
		
	}

}

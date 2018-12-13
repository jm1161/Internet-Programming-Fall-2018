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
	function setPassword($userName, $userPassword)
	{
		$hashed_password = password_hash($userPassword, PASSWORD_DEFAULT);

		$objuser = new User;
		$objuser->setUsername($userName);
		$objuser->setPasswordHash($hashed_password);
		$objuser->save();
	}

	function login($userName, $userPassword)
	{
		$userQuery = UserQuery::create()->filterByUsername($userName)->findOne();
		$username = $userQuery->getUsername();

		if(password_verify($userPassword,$userQuery->getPasswordHash()))
		{
			$hashed_password = $userQuery->getPasswordHash();
			$userData = array("username" => $username, "hashed_password" => $hashed_password, "verified_password" => true );
			return $userData;
		}
		else
		{
			$userData = array("username" => $username, "hashed_password" => null, "verified_password" => false );
			return $userData;	
		}
		
		
	}
}

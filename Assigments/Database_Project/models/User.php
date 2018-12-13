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

	public function setPasswordHash($p){

        if ($p !== null) {
            $p = (string) $p;
        }

         $hash = password_hash($p,PASSWORD_DEFAULT);
         //echo $hash;

         return $hash;

	}

	public function login($p){
		  if ($p !== null) {
            $p = (string) $p;
        }
		return password_verify($p, $this->getUserPassword());


	}

}

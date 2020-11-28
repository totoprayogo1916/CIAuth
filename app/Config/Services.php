<?php

namespace Config;

use CodeIgniter\Config\Services as CoreServices;
use PHPAuth\Config as PHPAuthConfig;
use PHPAuth\Auth as PHPAuth;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends CoreServices
{

	//    public static function example($getShared = true)
	//    {
	//        if ($getShared)
	//        {
	//            return static::getSharedInstance('example');
	//        }
	//
	//        return new \CodeIgniter\Example();
	//    }

	public static function authenticator(bool $getShared = true, PHPAuthConfig $authenticatorconfig = null)
	{
		if ($getShared) {
			return self::getSharedInstance('authenticator');
		}

		if (empty($authenticatorconfig)) {
			// Use PDO, assume default db
			$dbconfig = new \Config\Database();
			$dsn  = $dbconfig->default['DSN'];
			$user = $dbconfig->default['username'];
			$pass = $dbconfig->default['password'];
			$dbh  = new \PDO($dsn, $user, $pass);

			$authenticatorconfig = new \Config\Authenticator();
			$phpauthcfg = new PHPAuthConfig($dbh, 'array', $authenticatorconfig->authconfig);
		}
		$authenticator = new PHPAuth($dbh, $phpauthcfg);
		return $authenticator;
	}
}

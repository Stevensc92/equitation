<?php

Class Perms
{
	const
		READ   = 1,
		EDIT   = 2,
		POST   = 4,
		DELETE = 8;

	public static $roles = [];
	public static $flags = [];

	public static function getFlags()
	{
		return self::$flags = 
		[
			'read'   => self::READ,
			'edit'   => self::EDIT,
			'post'   => self::POST,
			'delete' => self::DELETE
		];
	}

	public static function getRoles()
	{
		$user     = self::READ;
		$operator = $user     | self::EDIT;
		$manager  = $operator | self::POST;
		$root     = $manager  | self::DELETE;

		return self::$roles = 
		[
			'user'     => $user,
			'operator' => $operator,
			'manager'  => $manager,
			'root'     => $root
		];
	}

	public static function check($access)
	{
		if(self::getRoles()[$_SESSION['user']->permissions]
		& self::getFlags()[strtolower($access)])
			return true;
		else
			return false;
	}
}

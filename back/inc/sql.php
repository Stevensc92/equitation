<?php

if(	empty(DB_HOST)
	|| empty(DB_USER)
	// || empty(DB_PASS)
	|| empty(DB_NAME)
)
	Error::fatal('Missing sql credentials');

try
{
	$bdd =
	new PDO
	(
		'mysql:host='.DB_HOST.';
		dbname='.DB_NAME,
		DB_USER,
		DB_PASS,
		[
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		]
	);
}
catch(Exception $e)
{
	Error::fatal($e->getMessage());
}
?>

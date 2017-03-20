<?php

class User
{
	public static function checkAccount($mail)
	{
		global $bdd;

		$sql = "SELECT
					u.id,
					u.username,
					u.password,
					u.access
				FROM
					users u
				WHERE
					u.email = :email";

		$req = $bdd->prepare($sql);
		$req->bindValue('email', $mail, PDO::PARAM_STR);
		$req->execute();

		return $req->fetch();
	}

	public static function logIn($data)
	{
		$_SESSION['admin'] = [
			'id' 		=> $data->id,
			'username' 	=> $data->username,
			'access' 	=> $data->access
		];
	}

	public static function logOut()
	{
		unset($_SESSION['admin']);
		session_destroy();
		header('Location: index.php');
		exit;
	}

	public static function isLogged()
	{
		return (isset($_SESSION['admin'])) ? true : false;
	}

	public static function ifHasAccess()
	{
		return ($_SESSION['admin']['access'] == 1) ? true : false;
	}
}

?>

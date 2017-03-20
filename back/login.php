<?php
include TEMPLATES.DS.'header.php';

if (isset($_POST['loginForm']))
{
	$user = User::checkAccount($_POST['mail']);
	if ($user) // If user exist
	{
		$passwordIsValid = password_verify($_POST['password'], $user->password);

		if ($passwordIsValid) // If password is correct = user logged
		{
			User::logIn($user);
			header('Location: index.php');
			exit;
		}
		else
			$error = 'Identifiant incorrect';
	}
	else
		$error = 'Identifiant incorrect';
}

include VIEW.DS.'login-form.php';

include TEMPLATES.DS.'footer.php';
?>

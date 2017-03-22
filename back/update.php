<?php
if (isset($_GET['update']) && !empty($_GET['update']))
{
	$toUpdate = ucfirst($_GET['update']);
	if (file_exists(CONTROLLER.DS.$toUpdate.'Controller.php') && file_exists(MODEL.DS.$toUpdate.'.php'))
	{
		$modelName = $toUpdate;
		$controllerName = $toUpdate.'Controller';
		$model = new $modelName();
		$controller = new $controllerName();

		if (isset($_POST['updateForm']))
		{
			if (!$controller->submitForm($_POST))
			{
				$message = new Object();
				$message->type = 'danger';
				$message->content = 'Aucun champ ne doit être vide.';
			}
			else
			{
				if ($model->UpdateContent($_POST))
				{
					$message = new Object();
					$message->type = 'success';
					$message->content = 'Les modifications ont bien été prise en compte';
				}
				else
				{
					$message = new Object();
					$message->type = 'danger';
					$message->content = 'Erreur lors de la modification';
				}
			}
		}

		include VIEW.DS.'update.php';
	}
	else
		header('Location: index.php');
}
else
	header('Location: index.php');
?>

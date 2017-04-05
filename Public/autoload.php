<?php
function autoloader($name)
{
	if (file_exists(INC.DS.$name.'.php'))
		require_once INC.DS.$name.'.php';

	if (file_exists(MODEL.DS.$name.'.php'))
		require_once MODEL.DS.$name.'.php';

	if (file_exists(CONTROLLER.DS.$name.'.php'))
		require_once CONTROLLER.DS.$name.'.php';
}

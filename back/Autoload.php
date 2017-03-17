<?php
function __autoload($name)
{
	if(file_exists(INC.DS.$name.'.php'))
		require_once INC.DS.$name.'.php';
}

<?php
// Configuration of constant
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__));
define('DS',   DIRECTORY_SEPARATOR);

define('INC', 		ROOT.DS.'inc');
define('CONFIG', 	ROOT.DS.'config');
define('TEMPLATES', ROOT.DS.'templates');
define('VIEW', 		ROOT.DS.'view');
define('MODEL', 	ROOT.DS.'models');
define('CONTROLLER',ROOT.DS.'controllers');

require_once CONFIG.DS.'database.php';
require_once INC.DS.'sql.php';
require_once MODEL.DS.'AppModel.php';

require_once 'Autoload.php';

// spl_autoload_register('Autoloader');


// Content of each/current page
if (!User::isLogged())
{
	include 'login.php';
	die;
}

if (!User::ifHasAccess())
{
	User::logOut();
	include 'login.php';
	die;
}

include TEMPLATES.DS.'header.php';

if (count($_GET) > 0)
{
    if (isset($_GET['action']))
    {
    	if (file_exists('./'.$_GET['action'].'.php'))
    		include './'.$_GET['action'].'.php';
    	else
    		include './404.php';
    }
    else if (isset($_GET['update']))
        include 'update.php';
}
else
	include VIEW.DS.'index.php';

include TEMPLATES.DS.'footer.php';
?>

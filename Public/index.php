<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


define('ROOT', dirname(dirname(__FILE__)));
define('DS',   DIRECTORY_SEPARATOR);

define('APP',        ROOT.DS.'Application');
define('FRAMEWORK',  ROOT.DS.'Framework');
define('CORE',       FRAMEWORK.DS.'Core');
define('SERVICES',   FRAMEWORK.DS.'Services');
define('COMPONENTS', FRAMEWORK.DS.'Components');

define('CONTROLLERS', APP.DS.'Controllers');
define('MODELS',      APP.DS.'Models');
define('VIEWS',       APP.DS.'Views');
define('LAYOUTS',     APP.DS.'Layouts');

define('WEB', dirname(__FILE__));
define('VENDORS', ROOT.DS.'Vendors');
define('PLUGINS', ROOT.DS.'Plugins');
define('CONFIG',  ROOT.DS.'Config');
define('CACHE',   ROOT.DS.'Cache');
define('UPLOADS', ROOT.DS.'Public'.DS.'uploads');
define('LOCALE',  ROOT.DS.'Locale');

require_once FRAMEWORK.DS.'Autoload.php';
require_once COMPONENTS.DS.'Parser.php';
require_once COMPONENTS.DS.'Mandrill.php';

new Request();

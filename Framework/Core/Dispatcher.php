<?php

class Dispatcher
{
	public
		$db,
		$route,
		$controller,
		$action,
		$model,
		$hooks;

	public function init($route)
	{
		$this->route  = $route;
		Config::loadDbConfig();
		$this->db = SQL::init();

		Config::loadRemote();
		Config::loadAppConfig();


		$this->dispatch();
	}

	public function dispatch()
	{
		if(!$this->route)
			Error::fatal('La route n\'a pas été touvée');
		else
		{ 
			list($this->controller, $this->action) = explode('.', $this->route->callback);
			$model = ucfirst($this->controller);
			$controller = $this->controller.'Controller';

			$this->call(
				$controller,
				$model,
				$this->action,
				$this->route->params,
				$this->route
			);
		}
	}

	public function call($controller, $model, $action, $params, $route, $hooks = null)
	{
		if(class_exists($controller))
			$switch = new $controller($controller, $model, $action, $params, $this->route->url, $this->route->method, $hooks);
		else
			Error::fatal($controller.' not found.');

		if((int)method_exists($switch, $action))
			return call_user_func_array(array($switch, $action), (array)$params);
		else
			Error::fatal('La méthode '.$action.' du controller '.$controller.' n\'existe pas');
	}
}

?>
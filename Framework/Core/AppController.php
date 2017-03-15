<?php

class AppController extends Request
{
	public
		$vars,
		$template,
		$request,
		$query,
		$cache,
		$layout = 'default.ctp',
		$rendered = false,

		$get,
		$post,
		$files;

	/**
	*
	* Method __construct:
	* Init Model with some parameters :
	* - (string) controller : Controller passed from the dispatcher.
	* - (string) model      : The name of the model passed for init a new object.
	* - (string) action     :
	* - (object) params     :
	* - (object) request    :
	* - (object) method     :
	*
	* @param empty;
	*
	* @return true | false;
	*
	**/

	public function __construct($controller, $model, $action, $params, $request, $method)
	{
		// Create new empty $query object.
		if(!is_object($this->query))
			$this->query = new Object();

		if(isset($controller))
		{
			// Init method args to class attributes
			foreach(Utils::get_args_names($this) as $k => $v)
				$this->$v = $$v;

			// Init template and vars.
			$this->template = new Template();
			$this->request  = $request;
			$this->method   = $method;


			// Init Model to attribute var.
			if(class_exists($model))
				$this->$model = new $model($this->request);
		}


		$obj = new Object();

		$this->getHooks();

		// Extract Super-vars and convert it to object attribute class.
		if(!empty($_POST))
			$this->post = $obj->convert($_POST);
		elseif(!empty($_GET))
			$this->get = $obj->convert($_GET);
		elseif(!empty($_FILES))
			$this->files= $obj->convert($_FILES);


		if(empty($_SESSION['lang']))
			$_SESSION['lang'] = isset(Config::$remote->lang) ? Config::$remote->lang : 'en';

		if(!empty($_SESSION['user']->id))
        {
        	foreach($_SESSION['user'] as $k => $v)
                $this->set('session_'.$k, $v);
        }

        if(!empty($_SESSION['flash']))
        {
            $this->set('flash_message', $_SESSION['flash']['message']);
            $this->set('flash_status', $_SESSION['flash']['status']);
            unset($_SESSION['flash']);
        }
	}


	public function loadModel($model)
	{
		if(!empty($model))
		{
			require_once MODELS.DS.ucfirst(strtolower($model)).'.php';
			return new $model($model);
		}
	}

	/**
	*
	* Method set:
	* Associate var to $this->vars before replacing into view.
	*
	* @param $name string           : The name of the var in the view.
	* @param $value string | array   :The value of the var, array or string arg.
	* @param $prexfix string        : The prefix for the key in the array.
	*
	* @return empty
	*
	**/

	public function set($name, $value, $prefix = null)
	{
		if(is_array($value) || is_object($value))
			foreach($value as $k => $v)
				$this->vars[$name][$k] = $v;
		else
			$this->vars[$name] = $value;
	}

	/**
	*
	* Method setLayout:
	* Change current layout in the called controller.
	*
	* @param $layout string : Name of the layout file, in the "Application/Layouts" dir.
	*
	* @return empty
	*
	**/

	public function setLayout($layout)
	{
		if(file_exists(LAYOUTS.DS.$layout.'.ctp'))
			$this->layout = $layout.'.ctp';
	}

	public function parseLayout($layout, $data)
	{
		if(file_exists(LAYOUTS.DS.$layout.'.ctp'))
		{
			$template = file_get_contents(LAYOUTS.DS.$layout.'.ctp');
			foreach($data as $k => $v) $this->set($k, $v);

			return $this->template->process($template, $this->vars);
		}
	}

	/**
	*
	* Method render:
	* Render a view and return the parsed html.
	*
	* @param empty;
	*
	* @return string $html;
	*
	**/

	public function render()
	{
		if($this->rendered == false)
		{
			if(in_array($this->action, get_class_methods($this->controller)))
			{
				if(file_exists(VIEWS.DS.str_replace('Controller', '', $this->controller).DS.$this->action.'.tpl'))
				{
					$this->set('viewsFolder', VIEWS);
					foreach(Config::$remote as $k => $v)
						$this->set('config_'.$k, $v);




					$this->set('page_name', ucfirst(!empty($this->vars['page_name']) ? $this->vars['page_name'] : $this->action));
					// Debug bar
					if(Config::$app->environment == 'DEV')
					{
						$this->loadDebugBar();
						$debug = file_get_contents(LAYOUTS.DS.'debug.ctp');
						$this->set('debug_bar', $this->template->process($debug, $this->vars));
					}

					$header = file_get_contents(LAYOUTS.DS.'header.ctp');
					$footer = file_get_contents(LAYOUTS.DS.'footer.ctp');

					$layout = file_get_contents(LAYOUTS.DS.$this->layout);
					$layout = $header.$layout.$footer;
					$view   = file_get_contents(VIEWS.DS.str_replace('Controller', '', $this->controller).DS.$this->action.'.tpl');



					$this->set('content_for_layout', $this->template->process($view, $this->vars));
					Locale::scan($this->template->data);

					$html = $this->template->process($layout, $this->vars);

					if($this->method == 'JSON')
						echo json_encode($this->vars);
					else
						echo Config::$remote->minify_html == 'true' ? $this->minify($html, 'html') : $html;
					$this->rendered = true;

				}
				else
					Error::fatal('Vue Manquante ('.$this->action.') pour le controller '.$this->controller);
			}
		}
	}

	/**
	*
	* Method minify:
	* Minify content depend on the parameter passed
	*
	*
	* @param string output;
	* @param string type ;
	*
	* @return string output
	*
	**/

	private function minify($output, $type)
	{
		if($type == 'html')
		{
			return preg_replace(
			[
				'/ {2,}/',
				'/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'
			],
			[' ', ''], $output
			);
		}
	}


    public function setFlash($message, $status = 'info')
    {
        if(!empty($message))
        {
            $_SESSION['flash']['message'] = $message;
            $_SESSION['flash']['status']  = $status;
        }
    }



	/**
	*
	* Method isAjax:
	* Detect if the current request is ajax or not
	*
	* @param empty;
	*
	* @return true | false;
	*
	**/

	public function isAjax()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
		&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
			return true;
		else
			return false;
	}

	/**
	*
	* Method loadDebugBar:
	* Send to template queue parse the debug bar;
	* Load Stats::getExecution time for request time and SQL::nbQueries.
	*
	* @param empty;
	*
	* @return true | false;
	*
	**/

	public function loadDebugBar()
	{
		$this->set('time', Stats::getExecutionTime(4));
		$this->set('requests', SQL::$nbQueries);
	}


	public function registerClass($class)
	{
		if(!empty($class) && !is_numeric($class) && file_exists(CONTROLLERS.DS.$class.'Controller.php'))
		{
			$class      = $class.'Controller';
			$reflection = new ReflectionClass($class);
			$instance   = $reflection->newInstanceWithoutConstructor();

			return $instance;
		}
	}

	public function getHooks()
	{
		$obj   = new Object;
		$hooks = $obj->convert(@yaml_parse_file(CONFIG.DS.'Hooks.yml'));


		if($hooks)
		{
			foreach($hooks as $name => $hook)
			{
				if($name == str_replace('Controller', '', $this->controller))
				{
					foreach($hook->methods as $method => $params)
					{
						if($method == $this->action)
						{
							$controller     = $this->registerClass($name);
							$callback       = $hook->callback;
							$params->action = $this->action;
							return $controller->$callback($params);
						}
					}
				}
			}
		}
	}
}

?>
<?php

class Config extends Dispatcher
{
	public static $database;
	public static $remote;
	public static $app;
	public static $plugins = [];

	public static function loadRemote()
	{
		$c = new Object();
		$cache = new Cache(CACHE, 50000);

		if(!$cache->read('remote_config'))
		{
			$config = SQL::query('SELECT config.* FROM config;')->fetchAll();
			$cache->write('remote_config', $config);
		}
		else
			$config = $cache->read('remote_config');

		foreach($config as $k => $v)
			$c->{$v->keys} = $v->values;

		self::$remote = $c;
	}

	public static function getRemoteFormated()
	{
		$config = SQL::query('SELECT config.* FROM config;')->fetchAll();
		$c = [];
		foreach($config as $k => $v)
			$c[] = $v;
		return $c;
	}

	public static function loadAppConfig()
	{
		$obj = new Object();
		$conf = yaml_parse_file(CONFIG.DS.'Parameters.yml');

		if($conf)
			self::$app = $obj->convert($conf);
	}

	public static function loadDbConfig()
	{
		$obj = new Object();
		$conf = yaml_parse_file(CONFIG.DS.'Database.yml');

		if($conf)
			self::$database = $obj->convert($conf);
	}

	public function loadPlugins()
	{
		$obj = new Object();

		foreach(new DirectoryIterator(CONFIG) as $file)
		{
		    if($file->isDot()) continue;
		    if(strstr($file->getFilename(), '_config'))
		    	$this->plugins[] = $file->getFilename();
		}

		$this->plugins = $obj->convert($this->plugins);

		foreach($this->plugins as $k => $v)
		{
			$conf = @yaml_parse_file(CONFIG.DS.$v);

			if(!empty($conf['name']) && $conf['activated'] == true)
				$this->plugins[] = $conf;
			elseif($conf['activated'] == false)
				$this->plugins[] = $conf;

			unset($this->plugins[$k]);
		}

		return
		[
			'pluginList'  => Utils::aasort($this->plugins, 'order'),
			'nbPlugins'   => count($this->plugins)
		];
	}

	public function loadPlugin($name)
	{
		if(!file_exists(CONFIG.DS.$name.'_config.yml'))
			return false;

		$obj = new Object();
		return $obj->convert(@yaml_parse_file(CONFIG.DS.$name.'_config.yml'));
	}

	public function saveConfig($file)
	{
		if(!empty($file))
		{

		}
	}
}

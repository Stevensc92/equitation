<?php

class Locale
{
	public static $exts =
	[
		'zip', 'jpg', 'png',
		'gif', 'bmp', 'tar',
		'php', 'htm', 'htm',
		'so',  'exe', 'tar.gz'
	];

	private static $exclude =
	[
		'session_',
		'config_',
		'content_for_layout',
		'password'
	];

	public static function translate($key)
	{
		$conf = self::load();
		$tr   = @$conf[str_replace('}', '', str_replace('{', '', $key))];
		Locale::scan([$key]);
		return !empty($tr) ? $tr : $key;
	}

	public static function load($file = null)
	{
		return json_decode(file_get_contents(LOCALE.DS.$file.$_SESSION['lang']. '.json'), true);
	}

	public static function getToTranslate()
	{
		$tr = self::load();
        $to_tr = [];

        foreach($tr as $k => $v)
            if(empty($v))
                $to_tr[] = $k;

        return $to_tr;
	}

	public static function getAlreadyTranslate()
	{
		$tr = self::load();
		$al_tr = [];

		foreach ($tr as $k => $v)
			if (!empty($v))
				$al_tr[$k] = $v;

		return $al_tr;
	}

	private static function recursiveScan($data)
	{
		$t  = [];
		foreach($data as $x => $y)
			foreach(self::$exclude as $rule)
				if(!preg_match('/'.$rule.'/', $x))
					if(is_array($y) || is_object($y))
						$t = self::recursiveScan($y);
					else
						foreach(self::$exclude as $r)
							if(!preg_match('/'.$r.'/', $y))
								$t[] = $y;

		return $t;
	}

	public static function scan($data)
	{
		$t       = [];
		$tmp     = [];
		$t       = self::recursiveScan($data);
		$current = self::load();

		foreach($t as $k => $v)
		{
			if(!isset($tmp[$v]) // is not already exists
			&& !empty($v) //is not empty
			&& !is_numeric($v) // is not numeric
			&& @preg_match('/^[a-zA-Z0-9_\\\\:.-]+/', $v) //is not path
			&& !preg_match('/(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $v) // is not datetime
			&& !filter_var($v, FILTER_VALIDATE_EMAIL) // is not email
			&& !in_array(end(explode('.', $v)), self::$exts) // is not contains extension
			&& ($v != 'false' && $v != 'true')) //is not bool
			{
				self::write($v);
			}
		}

		// foreach($tmp as $k => $v)
		// 	$current[$v] = '';

		// file_put_contents(LOCALE.DS.$_SESSION['lang'].'.json', json_encode($current));
	}

	public static function write($data)
	{
		$current = self::load();

		if (is_array($data) || is_object($data))
		{
			foreach ($data as $k => $v)
			{
				if (!empty($v))
					$current[$k] = $v;
				else if (empty($v) && !empty($current[$k]))
					$current[$k] = $v;
			}
		}
		elseif (!empty($current[$data]))
			$current[$data] = $current[$data];
		else
			$current[$data] = '';

		file_put_contents(LOCALE.DS.$_SESSION['lang'].'.json', json_encode($current));
	}

	public static function addBlackList($data)
	{
		$current = self::load('blackList_');

		foreach ($data as $k => $v)
			if (!in_array($v, $current))
				array_push($current, $v);

		file_put_contents(LOCALE.DS.'blackList_'.$_SESSION['lang'].'.json', json_encode($current));
	}

	public static function removeBlackList($data)
	{
		$current = self::load('blackList_');

		foreach ($current as $k => $v)
		{
			if (in_array($v, $data))
			{
				unset($current[$k]);
				$current = array_values($current);
			}
		}

		file_put_contents(LOCALE.DS.'blackList_'.$_SESSION['lang'].'.json', json_encode($current));
	}
}

?>
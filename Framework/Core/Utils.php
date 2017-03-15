<?php

class Utils
{
	public static function get_args_names($function)
	{
		$rc   = new ReflectionClass($function);
		$ctor = $rc->getConstructor();

		$r = [];
		foreach($ctor->getParameters() as $rp)
			$r[] = $rp->getName();

		return $r;
	}

	public static function aasort(&$array, $key)
	{
		$sorter = [];
		$return = [];

		reset($array);
		foreach ($array as $i => $value)
			$sorter[$i] = $value[$key];

		asort($sorter);
		foreach ($sorter as $i => $value)
			$return[$i] = $array[$i];

		return $array = $return;
	}


	public static function random($length = 10)
	{
	    $characters   = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++)
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];

	    return $randomString;
	}

	public static function memoryUsage()
	{

	    $free = shell_exec('free');
	    $free = (string) trim($free);
	    $free_arr = explode("\n", $free);
	    $mem = explode(" ", $free_arr[1]);
	    $mem = array_filter($mem);
	    $mem = array_merge($mem);
	    $memory_usage = $mem[2]/$mem[1]*100;

	    return $memory_usage;
	}

	public static function cpuUsage()
	{
	    $load = sys_getloadavg();
	    return $load[0];
	}


	public static function parseCSV($filename = '', $delimiter = ',')
	{
	    if(!file_exists($filename) || !is_readable($filename))
	        return false;

	    $header = null;
	    $data   = array();

	    if(($handle = fopen($filename, 'r')) !== false)
	    {
	        while(($row = fgetcsv($handle, 1000, $delimiter)) !== false)
	        {
	            if(!$header)
	                $header = $row;
	            else
	                $data[] = array_combine($header, $row);
	        }

	        fclose($handle);
	    }

	    return $data;
	}

	public static function arrayToLower(&$arr)
	{
		$arr = self::objectToArray($arr);

	    foreach($arr as $k=>$v)
	    {
	        if(is_array($v))
	            $arr[$k] = self::arrayToLower($v);
	        else if(is_string($v))
	             $arr[$k] = ucfirst(mb_strtolower($v, 'UTF-8'));
	        else
	        	throw new \LogicException("The value is neither a string nor an array");
	    }

	    return $arr;
	}

	public static function objectToArray($object)
	{
	    if(is_array($object) or is_object($object))
	    {
	        $result = array();
	        foreach($object as $key => $value)
	            $result[$key] = self::objectToArray($value);
	        return $result;
	    }

	    return $object;
	}

	public static function withoutAccents($str){
	  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
	  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
	  return str_replace($a, $b, $str);
	}

	public static function convert_to($text)
    {
		$map = array(
	        chr(0x8A) => chr(0xA9),
	        chr(0x8C) => chr(0xA6),
	        chr(0x8D) => chr(0xAB),
	        chr(0x8E) => chr(0xAE),
	        chr(0x8F) => chr(0xAC),
	        chr(0x9C) => chr(0xB6),
	        chr(0x9D) => chr(0xBB),
	        chr(0xA1) => chr(0xB7),
	        chr(0xA5) => chr(0xA1),
	        chr(0xBC) => chr(0xA5),
	        chr(0x9F) => chr(0xBC),
	        chr(0xB9) => chr(0xB1),
	        chr(0x9A) => chr(0xB9),
	        chr(0xBE) => chr(0xB5),
	        chr(0x9E) => chr(0xBE),
	        chr(0x80) => '&euro;',
	        chr(0x82) => '&sbquo;',
	        chr(0x84) => '&bdquo;',
	        chr(0x85) => '&hellip;',
	        chr(0x86) => '&dagger;',
	        chr(0x87) => '&Dagger;',
	        chr(0x89) => '&permil;',
	        chr(0x8B) => '&lsaquo;',
	        chr(0x91) => '&lsquo;',
	        chr(0x92) => '&rsquo;',
	        chr(0x93) => '&ldquo;',
	        chr(0x94) => '&rdquo;',
	        chr(0x95) => '&bull;',
	        chr(0x96) => '&ndash;',
	        chr(0x97) => '&mdash;',
	        chr(0x99) => '&trade;',
	        chr(0x9B) => '&rsquo;',
	        chr(0xA6) => '&brvbar;',
	        chr(0xA9) => '&copy;',
	        chr(0xAB) => '&laquo;',
	        chr(0xAE) => '&reg;',
	        chr(0xB1) => '&plusmn;',
	        chr(0xB5) => '&micro;',
	        chr(0xB6) => '&para;',
	        chr(0xB7) => '&middot;',
	        chr(0xBB) => '&raquo;',
	    );

	    return html_entity_decode(mb_convert_encoding(strtr($text, $map), 'UTF-8', 'ISO-8859-2'), ENT_QUOTES, 'UTF-8');
    }
}

?>
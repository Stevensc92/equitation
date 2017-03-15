<?php

class Html extends Template
{
 	protected static $doctypes =
 	[
        '5'             => '<!DOCTYPE html>',
        'html'          => '<!DOCTYPE html>',
        'xml'           => '<?xml version="1.0" encoding="utf-8" ?>',
        'default'       => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        'transitional'  => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        'strict'        => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
        'frameset'      => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
        '1.1'           => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
        'basic'         => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">',
        'mobile'        => '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">'
    ];

	public static function paginate($actuel, $nbEntity, $linkModel, $nbEntityPerPage = 15)
	{
		if(!isset($actuel))
			$actuel = 1;
		$nbPage = ceil($nbEntity / $nbEntityPerPage);
		if($actuel > $nbPage) $actuel = $nbPage;
		if($actuel <= 0) $actuel = 1;

		$xhtml = ''; $i = 1;
		if($actuel > 1)
			$xhtml .= '<li><a href="'.str_replace('*', $actuel - 1, $linkModel).'">«</a></li>';
		while($i <= $nbPage)
		{
			if(($i < 5) || ($i > $nbPage - 5) || (($i < $actuel + 5) && ($i > $actuel - 5)))
			{
				if($i == $actuel)
					$xhtml .= ' <li class="current"><a href="#">'.$i.'</a></li>';
				else
					$xhtml .= '<li><a href="'.str_replace('*', $i, $linkModel).'">'.$i.'</a></li>';
			}
			else
			{
				$xhtml = substr($xhtml, 0, strlen($xhtml)-2);
				if($i >= 2 && $i <= $actuel - 2)
					$i = $actuel - 2;
				elseif($i >= $actuel + 2 && $i <= $nbPage - 2)
					$i = $nbPage - 2;
				$xhtml .= '<li><a href="#" onclick="var goToPage = prompt(\''.str_replace('%n', $nbPage, 'Aller à la page : ').'\', 1); if(goToPage != null && goToPage &gt;= 1 && goToPage &lt;= '.$nbPage.' && !isNaN(goToPage)) document.location.href = \''.str_replace('*', '\'+goToPage+\'', $linkModel).'\'; return false;">...</a></li>';
			}

			if($i == $nbPage)
				$xhtml = substr($xhtml, 0, strlen($xhtml)-2);
			$i++;
		}

		if($actuel < $nbPage)
			$xhtml .= '</li><li><a href="'.str_replace('*', $actuel + 1, $linkModel).'">»</a></li>';

		return array(
			'nbPage' => $nbPage,
			'actuel' => $actuel,
			'nbItems' => $nbEntity,
			'xhtml' => '<li><a href="#" onclick="var goToPage = prompt(\''.str_replace('%n', $nbPage, 'Aller à la page : ').'\', 1); if(goToPage != null && goToPage &gt;= 1 && goToPage &lt;= '.$nbPage.' && !isNaN(goToPage)) document.location.href = \''.str_replace('*', '\'+goToPage+\'', $linkModel).'\'; return false;">Pages</a></li> '.$xhtml,
			'limit' => $nbEntityPerPage.' OFFSET '.(($actuel - 1) * $nbEntityPerPage),
			'sub'  => array('end' => $nbEntityPerPage, 'start' => (($actuel - 1) * $nbEntityPerPage))
		);
	}


	public function doctype($doc)
	{
		if(isset(self::$doctypes[$doc]))
			return self::$doctypes[$doc]."\n";
	}

	public function brand($a_class)
	{
		if(!empty($a_class))
		{
			if(empty(Config::$remote->appName))
				$a_class = 'fix-nabar-brand';


			return $output = '<a href="/" class="'.$a_class.'">'.Config::$remote->appName.'<br>'.Config::$remote->appSubName.'</a>';
		}
	}

	public function inc($template)
	{
		if(file_exists($this->data['viewsFolder'].DS.$template))
		{
			$tpl = file_get_contents($this->data['viewsFolder'].DS.$template);
			return $this->process($tpl, $this->data);
		}
	}

	public function layout($layout)
	{
		if(file_exists(LAYOUTS.DS.$layout))
		{
			$tpl = file_get_contents(LAYOUTS.DS.$layout);
			return $this->process($tpl, $this->data);
		}
	}


	public function menu($section_class = null, $ul_class)
	{
		$menu = new Menu();
		return $menu->get(null, $ul_class);
	}

	public static function title($title = null)
	{
		if(is_null($title))
			return '<title>'.Config::$remote->appName.'</title>';
		else
			return '<title>'.$title.'</title>';
	}

	public static function meta($name, $content = null)
	{
		if(is_null($content))
		{
			switch ($name)
			{
				case 'viewport':
					$out = '<meta name="'.$name.'" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">';
					break;

				case 'charset':
					$out = '<meta charset="utf-8">';
					break;
			}

			return $out."\n";
		}
		else
			return '<meta name="'.$name.'" content="'.$content.'">'."\n";
	}

	public static function css($href, $rel = null)
	{
		return '<link rel="'.(!is_null($rel) ? $rel : 'stylesheet').'" href="'.(strstr($href, 'http://') || strstr($href, 'https://') ? '' : '/css/').$href.'">'."\n";
	}

	public static function script($href, $type = null)
	{
		return '<script async type="'.(!is_null($type) ? $type : 'text/javascript').'" src="'.(strstr($href, 'http://') || strstr($href, 'https://') ? '' : '/js/').$href.'"></script>'."\n";
	}

	public static function withoutAccents($str){
	  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
	  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
	  return str_replace($a, $b, $str);
	}
}
?>
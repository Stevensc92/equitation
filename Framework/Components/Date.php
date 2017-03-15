<?php

class Date
{
	public static function ago($Time)
	{
		if(strstr($Time, '-'))
		{
			$date = new DateTime($Time);
			$Time = $date->getTimestamp();
		}

		$t = time() - $Time;
		if($t < 0)
			return;
		$Seconds = $t;
		$Minutes = round($t / 60);
		$Hours 	 = round($t / 3600);
		$Days    = round($t / 86400);
		$Weeks 	 = round($t / 604800);
		$Months  = round($t / 2419200);
		$Years   = round($t / 29030400);

		if( $Seconds==0 )
			return 'à l\'instant';
		elseif($Seconds < 60)
			return 'il y a '.$Seconds.' s';
		elseif($Minutes < 60)
			return 'il y a '.$Minutes.' m';
		elseif($Hours < 24)
			return 'il y a '.$Hours.' h';
		elseif($Days == 1)
			return 'hier';
		elseif($Days < 7)
			return 'il y a '.$Days.' j';
		elseif($Weeks < 4)
			return 'il y a '.$Weeks.' semaine'.($Weeks>1 ? 's' : '');
		elseif($Months < 12)
			return 'il y a '.$Months.' mois';
		elseif($Years > 1 && $Years < 100)
			return 'il y a '.$Years.' an'.($Years>1 ? 's' : '');
		else
			return 'error';
	}

	public static function format($date, $full = false)
	{

		date_default_timezone_set('Europe/Paris');

		$listMonths = array
			(
				'01' => 'janvier',
				'02' => 'février',
				'03' => 'mars',
				'04' => 'avril',
				'05' => 'mai',
				'06' => 'juin',
				'07' => 'juillet',
				'08' => 'août',
				'09' => 'Septembre',
				'10' => 'octobre',
				'11' => 'novembre',
				'12' => 'décembre'
			 );

			$listDays = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");

			$items = explode(' ', $date);

			$a = $items[0];
			$b = $items[1];

			$days = explode('-', $a);

			$y = $days[0];
			$m = $days[1];
			$d = $days[2];

			$hours = explode(':', $b);

			$h = $hours[0];
			$mi = $hours[1];
			$s = $hours[2];


			$timestamp = mktime(0, 0, 0, $m, $d, $y);

			$wd = date("w", $timestamp);

			$strDay = $listDays[$wd];

			if($full == true)
				return (int) $d.' '.$listMonths[$m].' à '.(int) $h.':'.$mi;
			else if(date('d') == $d && date('m') == $m && date('Y') == $y)
				return 'à '.(int) $h.':'.$mi;
			elseif(((int)date('d')) == (int)$d && date('m') == $m && date('Y') == $y)
				return 'hier à '. (int)$h.':'.$mi;
			elseif(date('Y') == $y && date('m') == $m && (int)date('d') !== $d)
				return $strDay.' '.(int) $d.' '.$listMonths[$m];
			else
				return $strDay.' '.(int) $d.' '.$listMonths[$m];
	}
}

?>
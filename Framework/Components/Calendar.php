<?php

class Calendar
{
	private static 
	$daysLabels = 
	[
		'Lun', 
		'Mar', 
		'Mer', 
		'Jeu', 
		'Ven', 
		'Sam', 
		'Dim'
	],
	$monthsLabels = 
	[
		1  => 'Janvier', 
		2  => 'Février', 
		3  => 'Mars', 
		4  => 'Avril', 
		5  => 'Mai', 
		6  => 'Juin', 
		7  => 'Juillet',
		8  => 'Août',
		9  => 'Septembre',
		10 => 'Octobre',
		11 => 'Novembre',
		12 => 'Décembre'
	],
	$daysInMonth = 0;

	public static function get($id, $year = null)
	{
		if(!isset($year)) $year = date('Y');
		$events = self::getEvents($id, $year);

		for($i = 1; $i < 13; $i++)
		{
			$months      .= str_replace($i, self::$monthsLabels[$i], $i).'.';
			$currentDays  = implode('</th><th>', self::$daysLabels);
			$daysInMonth  = cal_days_in_month(CAL_GREGORIAN, $i, $year);
			$days   = '';
			$ends   = [];

			for($x = 1; $x < $daysInMonth + 1; $x++)
			{
				$ends[]     = $daysInMonth;
				$time       = strtotime($year.'-'.$i.'-'.$x);
				$dow        = str_replace('0', '7', date('w', $time));
				
				$days .= 
					(($x == 1 && ($dow) > 1) ? '
					<td colspan="'.($dow-1).'" class="padding"></td>' : '').'
					<td>
						<span '.(isset($events[$time]) ? 'class="active"' : '').'>
							'.$x.'
							'.(isset($events[$time]) ?
							'<div class="callout border-callout">
								<dl><dd>'.implode('</dd><dd>', $events[$time]).'</dd></dl>' : '').'
							    <b class="notch"></b>
							</div>
						</span>
					</td>
					'.(
						($dow == 7)
						? '</tr><tr>'
						: ''
					);
				}

				$calendar .= '
				<table class="openDoors" style="display:none" month="'.$i.'" id="month_'.$i.'">
				<thead>
					<tr>
						<th>'.$currentDays.'</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						'.$days.'
					</tr>
				</tbody>
			</table>';
		}

		$months = array_filter(explode('.', $months));

		foreach($months as $k => $v)
			$m .= '<span class="linkM" style="display:none" month="'.($k+1).'" id="linkMonth_'.($k+1).'"><b>'.$v.'</b></span>';

		$calendar = '
		<div class="calendar-header">
			<a class="btn btn-prev" id="prevMonth">
       			 <i class="fa fa-arrow-left"></i>
			</a>
			'.$m.'
			<a class="btn btn-next" id="nextMonth">
				<i class="fa fa-arrow-right"></i>
			</a>
		</div>'.$calendar;

		return $calendar;
	}


	private function getEvents($id, $year)
	{
		$events = SQL::query('
		SELECT 
			  events.id,
			  events.start,
			  events.end,
			  events.property
		FROM  events
		WHERE YEAR(start) = '.$year.'
		AND   events.property = '.abs((int)$id).';
		')->fetchAll();


		$r = [];
		foreach($events as $k => $v)
		{
			$start  = strtotime($v->start);
			$end    = strtotime($v->end);
			$cursor = $start;

			while($cursor <= $end)
			{
				list($date, $hour)  = explode(' ', $v->start);
				$r[strtotime($date)][$v->id] = 'Portes ouvertes<br> le '.Date::format($v->start, true);
				$cursor += 86400;
			}
		}

		return $r;
	}
}

?>
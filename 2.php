<?
if(empty($argv[1])) {
	$symbol = $_GET['symbol'];
} else {
	$symbol = $argv[1];
}
if(empty($argv[2])) {
	$day = $_GET['day'];
} else {
	$day = $argv[2];
}

if(empty($symbol)) {
	echo 'Не задан параметр "symbol" ';
}
if(empty($day)) {
	echo 'Не задан параметр "day" ';
}

if(empty($symbol) || empty($day)) {
	die();
}


function ProfitYear($symbol, $day) {
	$day_1 = strtotime($day);
	$day_2 = strtotime('+2 year', $day_1);
	$day_2 = strtotime('+2 month', $day_2);
	$day_3 = strtotime('+1 year', $day_1);
	
	if(copy("https://query1.finance.yahoo.com/v7/finance/download/SPY?period1=" .$day_1. "&period2=" .$day_2. "&interval=1d&events=history&includeAdjustedClose=true", $_SERVER["DOCUMENT_ROOT"] . '/symbol.csv')) {
		$history_arr = file($_SERVER["DOCUMENT_ROOT"] . '/symbol.csv');
		//echo "<pre>history_arr: "; print_r($history_arr); echo "</pre>";
	}

	for($i = 1; $i < count($history_arr); $i++) {
		$str = trim($history_arr[$i]);
		$str_arr = explode(',', $str);
		$date_unix[strtotime($str_arr[0])]['Date'] = trim($str_arr[0]);
		$date_unix[strtotime($str_arr[0])]['Open'] = trim($str_arr[1]);
		$date_unix[strtotime($str_arr[0])]['Close'] = trim($str_arr[4]);
	}

	$number_day = 0;
	foreach($date_unix as $date => $value) {
		if($date > $day_1 && $date < $day_3) {
			$date_plus_year = $date + 31556926;
			foreach($date_unix as $datee => $valuee) {
				if($datee > $date_plus_year) {
					$key = $datee;
					break;
				}
			}
/* 			echo "<pre>date_unix[date]: "; print_r($date_unix[$date]); echo "</pre>";
			echo "<pre>date_unix[key]: "; print_r($date_unix[$key]); echo "</pre>";
			echo '<hr>'; */
			$profit[$date_unix[$date]['Date']] = ($date_unix[$key]['Close'] - $date_unix[$date]['Open'])*100/$date_unix[$key]['Close'];
			$number_day++;
		}
	}
	
	$count = 0;
	foreach($profit as $value) {
		if($value > 0) {
			$count++;
		}
	}
	//echo "<pre>date_unix: "; print_r($date_unix); echo "</pre>";
	//echo "<pre>number_day: "; print_r($number_day); echo "</pre>";
	//echo "<pre>count: "; print_r($count); echo "</pre>";
	//echo "<pre>percent: "; print_r($percent); echo "</pre>";
	//echo "<pre>profit: "; print_r($profit); echo "</pre>";
	return round($count*100/$number_day, 2);
}

echo ProfitYear('SPY', '01.01.2017') . ' %';
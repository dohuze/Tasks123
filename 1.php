<?
if(empty($argv[1])) {
	$Y = $_GET['Y'];
} else {
	$Y = $argv[1];
}
if(empty($Y)) {
	echo 'Не задан параметр "год"';
	die();
}

function converter($Y) {
	$dt_msk = strtotime('01.01.' .$Y. ' 12:00:00');
	$dt_local = strtotime('01.01.' .$Y. ' 12:00:00');
	
	$Y_plus = strtotime('+1 year', $dt_msk);
	$Y_plus = strtotime('+1 month', $Y_plus);
	$Y_plus = date('Y', $Y_plus);
	//echo "<pre>Y_plus: "; print_r($Y_plus); echo "</pre>";
	
	$period = 0;
	
	while(true) {
		$dt_msk = $dt_msk + 3600;
		$period = 1;
		if($Y_plus == date('Y', $dt_local)) {
			break;
		}
		$dt_msk = $dt_msk + 3600;
		$dt_local = $dt_local - 3600;
		if($Y_plus == date('Y', $dt_local)) {
			$dt_local = $dt_local - 3600;
			break;
		}
/////////////////////////////////////////////////////////		
		$dt_msk = $dt_msk + 3600;
		$dt_local = $dt_local + 3600;
		if($Y_plus == date('Y', $dt_local)) {
			break;
		}
		$dt_msk = $dt_msk + 3600;
		$dt_local = $dt_local + 3600;
		if($Y_plus == date('Y', $dt_local)) {
			break;
		}
		$dt_msk = $dt_msk + 3600;
		$dt_local = $dt_local + 3600;
		if($Y_plus == date('Y', $dt_local)) {
			break;
		}
		$dt_msk = $dt_msk + 3600;
		$dt_local = $dt_local + 3600;
		if($Y_plus == date('Y', $dt_local)) {
			break;
		}
		$dt_msk = $dt_msk + 3600;
		$dt_local = $dt_local + 3600;
		if($Y_plus == date('Y', $dt_local)) {
			break;
		}
		$dt_msk = $dt_msk + 3600;
		$dt_local = $dt_local + 3600;
		if($Y_plus == date('Y', $dt_local)) {
			break;
		}
/////////////////////////////////////////////////////////
		$dt_msk = $dt_msk + 3600;
		$period = 2;
		if($Y_plus == date('Y', $dt_local)) {
			break;
		}
		$dt_msk = $dt_msk + 3600;
		$dt_local = $dt_local - 3600;
		$period = 3;
		if($Y_plus == date('Y', $dt_local)) {
			break;
		}
	}
	//echo $Y_plus . ': ' . $period . ' ----> ' . date('d.m.Y H:i:s', $dt_msk) . '<br>';
	
	if($period == 1) {
		$dt_msk = $dt_msk + 3600;
	}
	if($period == 2) {
		$dt_msk = $dt_msk + 3*3600;
	}
	if($period == 3) {
		$dt_msk = $dt_msk + 2*3600;
	}
	
	return date('d.m.Y H:i:s', $dt_msk);
	
}

echo converter($Y);

/* for($i = 1900; $i < 3050; $i++) {
	converter($i);
} */
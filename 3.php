<?
header("Content-Type: text/html; charset=windows-1251");

if(empty($argv[1])) {
	$word = $_GET['word'];
} else {
	$word = $argv[1];
}
if(empty($word)) {
	echo 'Не задан параметр "word"';
	die();
}

if(!file_exists($_SERVER["DOCUMENT_ROOT"] . '/russian.txt')) {
	copy('https://raw.githubusercontent.com/danakt/russian-words/master/russian.txt', $_SERVER["DOCUMENT_ROOT"] . '/russian.txt');
}

function is_words($word) {
	$letters_arr = str_split($word);
	$words_arr = file($_SERVER["DOCUMENT_ROOT"] . '/russian.txt', FILE_SKIP_EMPTY_LINES);
	
	$letters_arr = array_diff($letters_arr, array_diff_assoc($letters_arr, array_unique($letters_arr)));
	echo "<pre>letters_arr: "; print_r($letters_arr); echo "</pre>";

	foreach($words_arr as $key => $str) {
		$str = trim($str);
		//echo 'str=' . $str . '<br>';

		$str_vspom = $str;
		foreach($letters_arr as $value) {
			$str_vspom = str_ireplace($value, '', $str_vspom);
			//echo 'str_vspom=' . $str_vspom . '<br>';
		}
		
		if($str_vspom == '') {
			$arResult[] = $str;
		}
	}
	return $arResult;
}

$arResult = is_words('самолет');
echo "<pre>arResult: "; print_r($arResult); echo "</pre>";











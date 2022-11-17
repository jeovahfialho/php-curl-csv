<?php

function curl($feed_url){

	$ch = curl_init();

	$feed_url = htmlspecialchars_decode($feed_url);
	curl_setopt($ch, CURLOPT_URL,$feed_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$curl_data = curl_exec($ch);
	curl_close($ch);
	return $curl_data;
}

function convertXLMtoObject($xml_data){

    return simplexml_load_string($xml_data);

}

function convertObjectToArray($dataObject){

	$json = json_encode($dataObject);
	$array = json_decode($json,TRUE);

	return $array['Cube']['Cube']['Cube'];
	
}


function getTodayDate($dataObject){

	return $dataObject->Cube->Cube['time'];

}


function saveToCSV($dataArray, $date){

	$delimiter = ","; 
    $filename = "usd_currency_rates_" . $date . ".csv"; 
	$f = fopen($filename, 'w'); 

	if ($f === false) {
		die('Error opening the file ' . $filename);
	}
    
	fputcsv($f, ['Currency Code', 'Rate'], $delimiter, '"', "\0"); 

	foreach($dataArray as $data){

		fputcsv($f, array($data['@attributes']['currency'], $data['@attributes']['rate']), $delimiter); 

	}

	

}

?>

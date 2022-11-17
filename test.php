<?php

include_once('request.php');

$url = "https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml?5105e8233f9433cf70ac379d6ccc5775";
$xmlData = curl($url);
$dataObject = convertXLMtoObject($xmlData);
$dataArray = convertObjectToArray ($dataObject);
saveToCSV($dataArray, getTodayDate($dataObject));

?>
<?php
require_once 'datasource.php';
echo  $_SERVER['REQUEST_URI'];

$typeChart = !empty($_GET['typeChart']) ? $_GET['typeChart'] : 'scatter';
$startDate = !empty($_GET['startDate']) ? $_GET['startDate'] : '2019-05-23';
$endDate = !empty($_GET['endDate']) && is_string($_GET['endDate']) ? $_GET['endDate'] : '2020-01-02';
$typeCal = !empty($_GET['typeCal']) && is_string($_GET['typeCal']) ? $_GET['typeCal'] : 'BMI';

$timeStartDate = strtotime($startDate);
$timeEndDate = strtotime($endDate);

$dataList = array();

for($i = 0; $i < sizeof($spreadsheet_data); $i++) {
    $timestamp = explode(' ', $spreadsheet_data[$i]['timestamp']);
    $timestamp = strtotime($timestamp[0]);
    if($timestamp >= $timeStartDate && $timestamp <= $timeEndDate) {
        array_push($dataList, $spreadsheet_data[$i]);
    }
}

session_start();
$_SESSION["dataList"] = $dataList;
$_SESSION["typeCal"] = $typeCal;

if($typeChart == "scatter") {
    header( 'Location: scatterDisplay.php' );
} else {
    header( 'Location: boxplotDisplay.php' );
}

?>
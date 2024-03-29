<?php
require_once 'datasource.php';
date_default_timezone_set('UTC');
echo "<script> if(history.replaceState) history.replaceState({}, '', '/'); </script>";

$typeChart = !empty($_GET['typeChart']) ? $_GET['typeChart'] : 'scatter';
$startDate = !empty($_GET['startDate']) ? $_GET['startDate'] : '2019-05-23';
$endDate = !empty($_GET['endDate']) && is_string($_GET['endDate']) ? $_GET['endDate'] : date('Y-m-d');
$typeCal = !empty($_GET['typeCal']) && is_string($_GET['typeCal']) ? $_GET['typeCal'] : 'fat';

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

$male = 0;
$female = 0;
for($i=0; $i< sizeof($spreadsheet_data) ; $i++) {
  if($spreadsheet_data[$i]['sex'] == 'Male') {
    $male++;
  } else {
    $female++;
  }
}

$_SESSION["dataList"] = $dataList;
$_SESSION["typeChart"] = $typeChart;
$_SESSION["typeCal"] = $typeCal;
$_SESSION["startDate"] = $startDate;
$_SESSION["endDate"] = $endDate;
$_SESSION["male"] = $male;
$_SESSION["female"] = $female;

if($typeChart == "scatter") {
    echo("<script>location.href = 'scatterPlot.php';</script>");
} else {
    echo("<script>location.href = 'boxPlot.php';</script>");
}

?>
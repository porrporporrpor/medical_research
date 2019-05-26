<?php
echo  $_SERVER['REQUEST_URI'];

session_start();
$dataList = $_SESSION['dataList'];
$dataPoints = array();
$typeCal = 'BMI';

for($i = 0; $i < sizeof($dataList); $i++) {
    $result = 0;
    switch($typeCal) {
        case "fat":
            $result = $dataList[$i]['fat'] / $dataList[$i]['mmr'];
            break;
        case "BMI":
            $result = $dataList[$i]['weight'] / pow($dataList[$i]['height'] / 100 , 2);
            break;
        case "muscle":
            //code
            break;
        case "handGlip":
            //code
            break;
        case "meterTime":
            //code
            break;
        default:
        echo "--------------".$typeCal."out of condition--------------<br>";
    }

    $mapping = array("x" => $dataList[$i]['age'] , "y" => $result);
    array_push($dataPoints, $mapping);
}

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();

?>
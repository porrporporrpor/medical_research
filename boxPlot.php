<?php
include 'datasource.php';

$typeCal = "BMI";
$typeChart = "scatter";

$dataSize = sizeof($spreadsheet_data);
$age1_19 = array();
$age20_29 = array();
$age30_39 = array();
$age40_49 = array();
$age50_59 = array();
$age60 = array();

// for check value (such as fat, BMI, etc.) each age range
for($i=0; $i<$dataSize; $i++) {
    // choose option of value to calculate
    $result = 0;
    switch($typeCal) {
        case "fat":
            $result = $spreadsheet_data[$i]['fat'] / $spreadsheet_data[$i]['mmr'];
            break;
        case "BMI":
            $result = $spreadsheet_data[$i]['weight'] / pow($spreadsheet_data[$i]['height'] / 100 , 2);
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

    $age = $spreadsheet_data[$i]['age'];
 
    // separate value after calculate to each age range
    switch($age) {
        case ($age >= 0 && $age <=19):
            array_push($age1_19 , $result);
            break;
        case ($age >= 20 && $age <=29):
            array_push($age20_29 , $result);
            break;
        case ($age >= 30 && $age <=39):
            array_push($age30_39 , $result);
            break;
        case ($age >= 40 && $age <=49):
            array_push($age40_49 , $result);
            break;
        case ($age >= 50 && $age <=59):
            array_push($age50_59 , $result);
            break;
        case ($age > 60):
            array_push($age60 , $result);
            break;
        default:
        echo "--------------".$age."out of condition--------------<br>";
    }
}

// box plot
$dataPoints = array();
$mapping = calValuePlot("1-19 years old", $age1_19);
array_push($dataPoints, $mapping);
$mapping = calValuePlot("20-29 years old", $age20_29);
array_push($dataPoints, $mapping);
$mapping = calValuePlot("30-39 years old", $age30_39);
array_push($dataPoints, $mapping);
$mapping = calValuePlot("40-49 years old", $age40_49);
array_push($dataPoints, $mapping);
$mapping = calValuePlot("50-59 years old", $age50_59);
array_push($dataPoints, $mapping);
$mapping = calValuePlot("over 60 years old", $age60);
array_push($dataPoints, $mapping);

function calValuePlot($label, $dataList) {
    sort($dataList);
    $median = findMedian($dataList);
    $minimum = min($dataList);
    $maximum = max($dataList);
    $q1 = findQuatile(1, $dataList);
    $q3 = findQuatile(3, $dataList);
    $mapping = array("label" => $label, "y" => array($minimum, $q1, $q3, $maximum, $median));
    return $mapping;
}

function findQuatile($k, $dataList) {
    $position = $k * ((sizeof($dataList) + 1) / 4) - 1; //quatile formula = k(n+1)/4 // -1 because index start at 0
    return ruleOfThree($position, $dataList);
}

function findMedian($dataList) {
    $position = ((sizeof($dataList) + 1) / 2) - 1; //median formula = (n+1)/2 // -1 because index start at 0
    return ruleOfThree($position, $dataList);
}

function ruleOfThree($position, $dataList) {
    $floorNum = $dataList[floor($position)];
    $ceilNum = $dataList[ceil($position)];
    $ratio = fmod($position,1);
    return $floorNum + ($ratio * ($ceilNum - $floorNum));
}

?>

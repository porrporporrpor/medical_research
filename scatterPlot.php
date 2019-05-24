<?php
include 'datasource.php'; 

$typeCal = "BMI";
$dataPoints = array();

for($i = 0; $i < sizeof($spreadsheet_data); $i++) {
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

    $mapping = array("x" => $spreadsheet_data[$i]['age'] , "y" => $result);
    array_push($dataPoints, $mapping);
}

?>
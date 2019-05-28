<?php
echo  $_SERVER['REQUEST_URI'];

session_start();

if(empty($_SESSION['dataList']) && empty($_SESSION['typeCal'])) {
    header( 'Location: setDefault.php');
}

$dataList = $_SESSION['dataList'];
$typeCal = $_SESSION['typeCal'];

$dataPoints = array();

for($i = 0; $i < sizeof($dataList); $i++) {
    $result = 0;
    switch($typeCal) {
        case "fat":
            $result = $dataList[$i]['fat'] / $dataList[$i]['muscle'];
            break;
        case "BMI":
            $result = $dataList[$i]['weight'] / pow($dataList[$i]['height'] / 100 , 2);
            break;
        case "muscle":
            $result = $dataList[$i]['muscle'];
            break;
        case "handGrip":
            $result = $dataList[$i]['handGrip'];
            break;
        case "meterTime":
            $result = $dataList[$i]['meterTime'];
            break;
        default:
        echo "--------------".$typeCal."out of condition--------------<br>";
    }

    $mapping = array("x" => $dataList[$i]['age'] , "y" => $result);
    array_push($dataPoints, $mapping);
}

$_SESSION['dataPoints'] = $dataPoints;
header( 'Location: index.php' );
?>
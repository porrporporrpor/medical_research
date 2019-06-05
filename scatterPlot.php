<?php
echo "<script> if(history.replaceState) history.replaceState({}, '', '/'); </script>";
if(empty($_SESSION['dataList']) && empty($_SESSION['typeCal'])) {
    echo "pass";
    echo("<script>location.href = 'setDefault.php';</script>");
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
        echo "--------------typeCal ".$typeCal." out of condition--------------<br>";
    }

    $mapping = array("x" => $dataList[$i]['age'] , "y" => $result);
    array_push($dataPoints, $mapping);
}

$_SESSION['dataPoints'] = $dataPoints;

echo("<script>location.href = 'index.php';</script>");
?>
<?php
echo "<script> if(history.replaceState) history.replaceState({}, '', '/'); </script>";
$dataList = $_SESSION['dataList'];
$typeCal = $_SESSION['typeCal'];

$age1_19 = array();
$age20_29 = array();
$age30_39 = array();
$age40_49 = array();
$age50_59 = array();
$age60 = array();

// for check value (such as fat, BMI, etc.) each age range
for($i=0; $i < sizeof($dataList); $i++) {
    // choose option of value to calculate
    $result = $dataList[$i];
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

    $age = $dataList[$i]['age'];
 
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
        case ($age >= 60):
            array_push($age60 , $result);
            break;
        default:
        echo "--------------age ".$age." out of condition--------------<br>";
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

$_SESSION['dataPoints'] = $dataPoints;
echo("<script>location.href = 'index.php';</script>");

function calValuePlot($label, $dataList) {
    if (sizeof($dataList) >= 4) { //boxplot must have least 4 values
        sort($dataList);
        $median = findMedian($dataList);
        $minimum = min($dataList);
        $maximum = max($dataList);
        $q1 = findQuatile(1, $dataList);
        $q3 = findQuatile(3, $dataList);
        $mapping = array("label" => $label, "y" => array($minimum, $q1, $q3, $maximum, $median));
        return $mapping;
    } else {
        return array("label" => $label, "y" => null);;
    }
    
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

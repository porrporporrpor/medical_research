<?php include 'scatterPlot.php' ?>

<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light2", 
	title:{
		text: "ScatterPlot",
        fontFamily: "Geneva"
	},
	axisX:{
		title: "Age",
        titleFontFamily: "Geneva"
	},
	axisY:{
		title: "<?php echo $typeCal; ?>",
        titleFontFamily: "Geneva",
		includeZero: false
	},
	data: [{
		type: "scatter",
		markerType: "circle",
		markerSize: 10,
		toolTipContent: "<?php echo $typeCal; ?>: {y}<br>Age: {x}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> 
<div id="chartContainer" style="height: 370px; width: 100%"></div>
<script>
let typeChart = "<?php echo $_SESSION['typeChart'] ?>";

if(typeChart == 'scatter') {
    scatterPlot();
} else {
    boxplot();
}

function scatterPlot() {
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light2",
	title:{
		text: "ScatterPlot",
        fontFamily: "Geneva"
	},subtitles:[
		{
			text: "<?php echo $_SESSION['startDate'].' to '.$_SESSION['endDate']; ?>",
            fontFamily: "Geneva",
            margin: 30
		}
		],
	axisX:{
		title: "Age",
        titleFontFamily: "Geneva"
	},
	axisY:{
		title: "<?php echo $_SESSION['typeCal']; ?>",
        titleFontFamily: "Geneva",
		includeZero: false
	},
	data: [{
		type: "scatter",
		markerType: "circle",
		markerSize: 5,
		toolTipContent: "<?php echo $_SESSION['typeCal']; ?>: {y}<br>Age: {x}",
		dataPoints: <?php echo json_encode($_SESSION['dataPoints'], JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}

function boxplot() {
	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		exportEnabled: true,
		theme: "light2", 
		title: {
			text: "BoxPlot",
			fontFamily: "Geneva"
		},subtitles:[
		{
			text: "<?php echo $_SESSION['startDate'].' to '.$_SESSION['endDate']; ?>",
            fontFamily: "Geneva",
            margin: 30
		}
		],
		axisX: {
			title: "Age",
			titleFontFamily: "Geneva"
		},
		axisY: {
			title: "<?php echo $_SESSION['typeCal']; ?>",
			titleFontFamily: "Geneva"
		},
		data: [{
			type: "boxAndWhisker",
			color: "#3C4D2D",
			upperBoxColor: "#e9635e",
			lowerBoxColor: "#f4d4d3",
			dataPoints: <?php echo json_encode($_SESSION['dataPoints'], JSON_NUMERIC_CHECK); ?>
		}]
	});
	chart.render();
}

</script>
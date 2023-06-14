<!DOCTYPE html>
<html>
<head>
    <title>DashBoard SC1A</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    
<body>
	<div style="overflow-x:auto;">
		<table style="width:100%; padding:30px;">
			<tr>
				<td style="width:50%">
					<canvas id="sc1a" ></canvas>
				</td>
				<td style="width:50%;">
					<div class="chart-container" style="position: relative; height:400px; display: flex;justify-content: center;align-items: center;">
						<canvas id="sc1b"></canvas>
					</div>
				</td>
			</tr>
		</table>
	</div>
</body>
  
<script src="/jquery.min.js" ></script>
<script src="/chart.js"></script>
  
<script type="text/javascript">
  
	var labels =  {{ Js::from($labels) }};
	var users =  {{ Js::from($data) }};

	const data = {
	labels: labels,
	datasets: [{
		label: 'SOUS-PROJETS PAR DISTRICTS',
		backgroundColor: 'rgb(255, 99, 132)',
		borderColor: 'rgb(255, 99, 132)',
		data: users,
	}]
	};

	const config = {
		type: 'bar',
		data: data,
		options: {}
	};

	const sc1a = new Chart(
		document.getElementById('sc1a'),
		config
	);
	  
	  
	const dataPie = {
		labels: [
			'Red',
			'Blue',
			'Yellow'
		],
		datasets: [{
			label: 'My First Dataset',
			data: [300, 50, 100],
			backgroundColor: [
				'rgb(255, 99, 132)',
				'rgb(54, 162, 235)',
				'rgb(255, 205, 86)'
			],
			hoverOffset: 4
		}]
	};
	
	const config1b = {
	  type: 'pie',
	  data: dataPie,
	};
	
	const sc1b = new Chart(
		document.getElementById('sc1b'),
		config1b
	);
  
</script>
</html>
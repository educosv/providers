$(document).ready(function(){

	const d = new Date();

	const date = d.getDate() + "/" + (d.getMonth() +1) + "/" + d.getFullYear();

	const year = d.getFullYear();

	$('#current_date').html(date);

	$.ajax({
		type: 'post',
		url: 'internal_data',
		dataType: 'json',
		data: 'get_dash_chart=&date='+year
	}).done(function(data){

		/******************* Chart *******************/

		var chartCanvas = $('#dashChart').get(0).getContext('2d')

		var chartData = {
			labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			datasets: [
				{
					label: 'Total',
					backgroundColor: 'rgba(108,180,140,0.4)',
					borderColor: 'rgba(9,157,139,0.8)',
					pointRadius: true,
					pointColor: '#099D8B',
					pointStrokeColor: 'rgba(60,141,188,1)',
					pointHighlightFill: '#fff',
					pointHighlightStroke: 'rgba(60,141,188,1)',
					data: [
						data[0],
						data[1],
						data[2],
						data[3],
						data[4],
						data[5],
						data[6],
						data[7],
						data[8],
						data[9],
						data[10],
						data[11]
					]
				}
			]
		}

		var chartOptions = {
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false
			},
			scales: {
				xAxes: [{
					gridLines: {
				  	display: true
				}
				}],
				yAxes: [{
					gridLines: {
					  	display: true
					}
				}]
			},
			hover: {
				mode: 'index',
				intersect: false
			}
		}

		// This will get the first returned node in the jQuery collection.
		// eslint-disable-next-line no-unused-vars
		var chart = new Chart(chartCanvas, {
			type: 'line',
			data: chartData,
			options: chartOptions
		});
	});

});
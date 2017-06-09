$(document).ready(function(){
	$.ajax({
		url : "http://localhost/project/chartdata.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var date = [];
			var sales = [];
			

			for(var i in data) {
				date.push(data[i].date);
				sales.push(data[i].sales);
				
			}

			var chartdata = {
				labels: date,
				datasets: [
					{
						label: "Sales",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: sales
					},
					
				]
			};

			var ctx = $("#mycanvas");

			var LineGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error : function(data) {

		}
	});
});
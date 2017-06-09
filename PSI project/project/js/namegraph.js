$(document).ready(function(){
	$.ajax({
		url : "http://localhost/project/graphbyname.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var item = [];
			var sales = [];
			

			for(var i in data) {
				item.push(data[i].item);
				sales.push(data[i].sales);
				
			}

			var chartdata = {
				labels: item,
				datasets: [
					{
						label: " Product Sales",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(29, 202, 255, 0.75)",
						borderColor: "rgba(29, 202, 255, 1)",
						pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
						pointHoverBorderColor: "rgba(29, 202, 255, 1)",
						data: sales
					},
					
				]
			};

			var ctx = $("#mycanvas2");

			var LineGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error : function(data) {

		}
	});
});
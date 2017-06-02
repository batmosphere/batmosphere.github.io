var clickedtime;
	var createdtime;
	var react;

	function makebox()
	{

		createdtime = Date.now();

		var x = Math.random();
		x = x*3000;
		x = Math.floor(x);

		var topp = Math.random();
		topp = topp*500;
		topp = Math.floor(topp);

		var leftp = Math.random();
		leftp = leftp*500;
		leftp = Math.floor(leftp);


		
		setTimeout(function(){ 

			document.getElementById("box").style.display = "block";
			document.getElementById("box").style.top = topp + "px";
			document.getElementById("box").style.left = leftp + "px";

			if(Math.random() > 0.5)
			{
			document.getElementById("box").style.borderRadius = "50%";
			}
			else
			{
				document.getElementById("box").style.borderRadius = "0%";
			}
		}, x) ;
	}


	document.getElementById("box").onclick = function()
	{	
		clickedtime = Date.now();
		 react = (clickedtime-createdtime)/1000;
		this.style.display = "none";
		document.getElementById("answer").innerHTML = "The time taken by you is = "  +react+ " seconds";
		makebox();
	}

	makebox();


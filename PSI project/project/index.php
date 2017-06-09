<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Inventory Management System</title>

    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body style="background-color: #f9f9f9;">


	<div id="page" style="background-color: #efefef;">
		

		<h2 style="color: black;">Welcome to Inventory Management System</h2>

		<button onclick="document.getElementById('adminlogin').style.display='block'" style="width: 200px; margin-left: 170px" >Admin Login</button>
		<button onclick="document.getElementById('employeelogin').style.display='block'" style="width: 200px;" >Employee Login</button>


	</div>
	



    <div id="adminlogin" class="modal" >
			  
			  <form class="modal-content animate" method="post" action="adminlogin.php">
			    <div class="imgcontainer">
			      <span onclick="document.getElementById('adminlogin').style.display='none'" class="close" title="Close Modal">&times;</span>
			      
			    </div>

			    <div class="container">
			      <label style="font-size: 1.2em;"><b>Username</b></label>
			      <input type="text" placeholder="Enter Username" name="username" required>

			      <label style="font-size: 1.2em;"><b>Password</b></label>
			      <input type="password" placeholder="Enter Password" name="password" required>
			        
			      <input class="sub" name="submit" type="submit" style="margin-left: 0px;" />		      
			    </div>

			    <div class="container" style="background-color:#f1f1f1">
			      <button type="button" onclick="document.getElementById('adminlogin').style.display='none'" class="cancelbtn">Cancel</button>
			      
			    </div>
			  </form>
	</div>




	<div id="employeelogin" class="modal">
			  
			  <form class="modal-content animate" method="post" action="employeelogin.php">
			    <div class="imgcontainer">
			      <span onclick="document.getElementById('employeelogin').style.display='none'" class="close" title="Close Modal">&times;</span>
			      
			    </div>

			    <div class="container">
			      <label style="font-size: 1.2em;"><b>Username</b></label>
			      <input type="text" placeholder="Enter Username" name="username" required>

			      <label style="font-size: 1.2em;"><b>Password</b></label>
			      <input type="password" placeholder="Enter Password" name="password" required>
			        
			      <input class="sub" name="submit" type="submit" style="margin-left: 0px;" />
			      
			    </div>

			    <div class="container" style="background-color:#f1f1f1">
			      <button type="button" onclick="document.getElementById('employeelogin').style.display='none'" class="cancelbtn">Cancel</button>
			      
			    </div>
			  </form>
	</div>



<script>
// Get the modal
var modal = document.getElementById('adminlogin');
var modal1 = document.getElementById('employeelogin');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal ) {
        modal.style.display = "none";
    }

     if (event.target == modal1 ) {
        modal1.style.display = "none";
    }
}
</script>


</body>
</html>
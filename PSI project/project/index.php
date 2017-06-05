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
<style>
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 20px ;
    border: none;
    cursor: pointer;
    width: 100%;
    border-radius: 5px;
    font-size: 1.1em;
    border: 1px #077200 solid;
}

button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: 100%;
    margin: 0px;
    padding: 10px 20px;
    background-color: #f44336;
    border: 1px #bc0000 solid;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}

h2
{
	margin: 50px ;
	margin-bottom: 15px;
	font-weight: bold;
	font-family: Helvetica;
	font-style: italic;
	font-size: 2em;

}

#page
{
	border: 1px solid black;
	border-radius: 10px;
	background-color: #c6c4c4;
	margin: 180px auto auto 300px;
	width: 770px;
	height: 200px;
}

body
{
	background-color: #333232;
    color: #303030;
}

.sub
{
     background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 20px ;
    border: none;
    cursor: pointer;
    width: 100%;
    border-radius: 5px;
    font-size: 1.1em;
    border: 1px #077200 solid;
}
</style>
<body>


	<div id="page">
		

		<h2>Welcome to Inventory Management System</h2>

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
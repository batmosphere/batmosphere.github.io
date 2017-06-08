
<?php
include('db.php');

   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


session_start();
   
   $user_check = $_SESSION['username'];
   
   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventory System</title>
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>


<link rel="stylesheet" type="text/css" href="style2.css" media="screen" />

</head>

<body style="background-color:#dedede; margin: 0;padding: 0;">


<div style="border-bottom: 1px solid black;">
		<h1>Welcome <?php echo $login_session; ?></h1> 
</div>


<div>
		<ol style=" margin: 10px auto 10px 0px; width: 320px">
		    
		    
		   <li><button onclick="document.getElementById('addproitem').style.display='block'" style="width: 200px; " >Update stock</button></li>


		    <li><button onclick="document.getElementById('addpro').style.display='block'" style="width: 200px; " >Add a new product in the inventory</button></li>


		    <li><button onclick="document.getElementById('editprice').style.display='block'" style="width: 200px; " >Change price of an existing product</button></li>


		    <li><button onclick="document.getElementById('addemployee').style.display='block'" style="width: 200px; " >Add a new Employee</button></li>


		    <li><button onclick="document.getElementById('deleteemployee').style.display='block'" style="width: 200px; background-color: #f44336; border: 1px #bc0000 solid;" >Remove an Existing employee</button></li>


		    <li><button onclick="document.getElementById('addadmin').style.display='block'" style="width: 200px; " >Create a new Admin</button></li>


		   <li><button onclick="document.getElementById('deleteproduct').style.display='block'" style="width: 200px; background-color: #f44336; border: 1px #bc0000 solid;" >Remove an exiting product from inventory</button></li>

		   <li>
		   <form method="post" action="logout.php">
		   <button  style="width: 200px; background-color: #f44336; border: 1px #bc0000 solid;" ><a href="logout.php">Logout</a></button>
		   </form></li>
		</ol>
		
</div>
<!--


<div style="position: relative;
	bottom: 550px;
	left: 300px;
	font-size: 1.5em;">
   <ul>
   

   <?php
   //$CRITICAL=10;
   //$sql2=mysqli_query($db,"select * from inventory where qtyleft<='$CRITICAL'");
   
   //if($sql2)
   {	//echo "<p>These Inventory items are low in stock. Update stock in the inventory Immediately</p>";
		//echo "<p>$sql2</p>";
	   //	while($row2=mysqli_fetch_array($sql2,MYSQLI_ASSOC))
	   {
	   //echo '<li style="list-style:none;">'.$row2['item'].'</li>';
	   }
   }
   //else
   {
   		//echo "<p> hellooooo</p>";
   }

   
   ?>
   </ul>
</div>
   
-->


<?php
$da=date("Y-m-d");

   
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


?>



			<div class=" modal" id="addproitem">
			<form action="updateproduct.php" class="modal-content animate" method="post">
			   <div class="imgcontainer">
    		      <span onclick="document.getElementById('addproitem').style.display='none'" class="close" title="Close Modal">&times;</span>
			    </div>

			   <div style="margin-left: 48px;">
			   Product name :<?php
			   $name= mysqli_query($db,"select * from inventory");
			   
			   echo '<select name="ITEM" id="user" class="textfield1">';
			    while($res= mysqli_fetch_assoc($name))
			   {
			   echo '<option value="'.$res['id'].'" ">';
			   echo $res['item'];
			   echo'</option>';
			   }
			   echo'</select>';
			   ?>
			   </div>
			   <br />
			   Number of Item To Add : <input  name="itemnumber" type="text" /><br />
			   <div style="margin-left: 200px; margin-top: 14px;"><input style="width: 115px; background-color: #4CAF50; color: white; " name="" type="submit" value="Add" /></div>
			</form>
			</div>




<div class=" modal" id="addpro">
<form action="saveproduct.php" class="modal-content animate" method="post">
   <div class="imgcontainer">
    		      <span onclick="document.getElementById('addpro').style.display='none'" class="close" title="Close Modal">&times;</span>
			    </div>

   <div style="margin-left: 48px;">
   Product name :<input style="margin-left: 20px;" name="proname" type="text" />
   </div>
   <br />
   <div style="margin-left: 97px;">
   Price :<input style="margin-left: 40px;" name="price" type="text" />
   </div>
   <br />
   <div style="margin-left: 80px;">
   Quantity :<input style="margin-left: 30px;" name="qty" type="text" />
   </div>
   <div style="margin-left: 127px; margin-top: 14px;">
   <input style=" margin-left: 60px; width: 255px; background-color: #4CAF50; color: white;" name="" type="submit" value="Add" />
   </div>
</form>
</div>




			<div class=" modal" id="editprice">
			<form action="updateprice.php" class="modal-content animate" method="post">
			   <div class="imgcontainer">
    		      <span onclick="document.getElementById('editprice').style.display='none'" class="close" title="Close Modal">&times;</span>
			    </div>

			   <div style="margin-left: 48px;">
			   Product name:<?php
			   $name= mysqli_query($db,"select * from inventory");
			   
			   echo '<select name="ITEM" id="user" class="textfield1">';
			    while($res= mysqli_fetch_assoc($name))
			   {
			   echo '<option value="'.$res['id'].'" style="margin-left:-60px;">';
			   echo $res['item'];
			   echo'</option>';
			   }
			   echo'</select>';
			   ?>
			   </div>
			   <br />
			   <div style="margin-left: 97px;">Price:<input style="margin-left: 45px;" name="itemprice" type="text" /></div>
			   <div style="margin-left: 127px; margin-top: 14px;"><input style=" margin-left: 60px; width: 255px; background-color: #4CAF50; color: white;" name="" type="submit" value="Update" /></div>
			</form>
			</div>



<div class=" modal" id="addemployee">
<form action="addemployee.php" class="modal-content animate" method="post">
  <div class="imgcontainer">
    		      <span onclick="document.getElementById('addemployee').style.display='none'" class="close" title="Close Modal">&times;</span>
			    </div>

   <div style="margin-left: 48px;">
   Employee name:<input name="username" type="text" />
   </div>
   <br />
   <div style="margin-left: 97px;">
   Password:<input name="password" type="text" />
   </div>
   <br />
   <div style="margin-left: 127px; margin-top: 14px;">
   <input style=" margin-left: 63px; margin-top: -20px; width: 255px; background-color: #4CAF50; color: white;" name="" type="submit" value="Add" />
   </div>
</form>
</div>


			<div class=" modal" id="deleteemployee">
			<form action="deleteemployee.php" class="modal-content animate" method="post">
			   <div class="imgcontainer">
    		      <span onclick="document.getElementById('deleteemployee').style.display='none'" class="close" title="Close Modal">&times;</span>
			    </div>

			   <div style="margin-left: 48px;">
			   Employee name:<?php
			   $name= mysqli_query($db,"select * from employee");
			   
			   echo '<select name="username" id="user" class="textfield1">';
			    while($res= mysqli_fetch_assoc($name))
			   {
			   echo '<option value="'.$res['id'].'">';
			   echo $res['username'];
			   echo'</option>';
			   }
			   echo'</select>';
			   ?>
			   </div>
			   <br />
			   
			   <div style="margin-left: 127px; margin-top: 14px;"><input style=" margin-left: 95px; margin-top: -10px; width: 100px; background-color: #f44336; color: white;" name="" type="submit" value="Delete" /></div>
			</form>
			</div>



<div class=" modal" id="addadmin">
<form action="addadmin.php" class="modal-content animate" method="post">
   <div class="imgcontainer">
    		      <span onclick="document.getElementById('addadmin').style.display='none'" class="close" title="Close Modal">&times;</span>
			    </div>

   <div style="margin-left: 48px;">
   New Admin name:<input name="username" type="text" />
   </div>
   <br />
   <div style="margin-left: 110px;">
   Password:<input name="password" type="text" />
   </div>
   <br />
   <div style="margin-left: 127px; margin-top: 14px;">
   <input style=" margin-left: 75px; margin-top: -10px; width: 255px; background-color: #4CAF50; color: white;" name="" type="submit" value="Add" />
   </div>
</form>
</div>




			<div class=" modal" id="deleteproduct">
			<form action="deleteproduct.php" class="modal-content animate" method="post">
			   <div class="imgcontainer">
    		      <span onclick="document.getElementById('deleteproduct').style.display='none'" class="close" title="Close Modal">&times;</span>
			    </div>

			   <div style="margin-left: 48px;">
			   Product name:<?php
			   $name= mysqli_query($db,"select * from inventory");
			   
			   echo '<select name="item" id="user" class="textfield1">';
			    while($res= mysqli_fetch_assoc($name))
			   {
			   echo '<option value="'.$res['id'].'">';
			   echo $res['item'];
			   echo'</option>';
			   }
			   echo'</select>';
			   ?>
			   </div>
			   <br />
			   
			   <div style="margin-left: 127px; margin-top: 14px;"><input style=" margin-left: 80px; margin-top: -10px; width: 100px; background-color: #f44336; color: white;" name="" type="submit" value="Delete" /></div>
			</form>
			</div>


<script type="text/javascript">

	// Get the modal
var modal1 = document.getElementById('addproitem');
var modal2 = document.getElementById('addpro');
var modal3 = document.getElementById('addemployee');
var modal4 = document.getElementById('addadmin');
var modal5 = document.getElementById('deleteproduct');
var modal6 = document.getElementById('deleteemployee');
var modal7 = document.getElementById('editprice');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1 ) {
        modal1.style.display = "none";
    }
    if (event.target == modal2 ) {
        modal2.style.display = "none";
    }
    if (event.target == modal3 ) {
        modal3.style.display = "none";
    }
    if (event.target == modal4 ) {
        modal4.style.display = "none";
    }
    if (event.target == modal5 ) {
        modal5.style.display = "none";
    }
    if (event.target == modal6 ) {
        modal6.style.display = "none";
    }
    if (event.target == modal7 ) {
        modal7.style.display = "none";
    }


}

</script>
</body>
</html>

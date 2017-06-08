
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


<script type="text/javascript">

var popupWindow=null;
var popupWindow2=null;


function childtotal_open()
{ 

popupWindow =window.open('printsales.php',"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=1000, height=700,top=100,left=200 bottom=100 ");

}


			function childproduct_open()
			{ 

			popupWindow2 =window.open('itemsoldbyname.php',"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=1000, height=700,top=100,left=200 bottom=100 ");

			}


function childdate_open()
{ 

popupWindow2 =window.open('itemsoldbydate.php',"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=1000, height=700,top=100,left=200 bottom=100 ");

}
</script>

<link rel="stylesheet" type="text/css" href="stylesheet2.css">

</head>

<body style="background-color:#dedede; margin: 0;padding: 0;">


<div style="border-bottom: 1px solid black;">
		<h1>Welcome <?php echo $login_session; ?></h1> 
</div>


<div style="margin-left: 80px; margin-top: 50px; width: 1200px; height: 80px">
		
		  <button onclick="document.getElementById('addadmin').style.display='block'" style="width: 200px; height: 80px ;float: left; " >Create a new Admin</button>

		  <button onclick="document.getElementById('showinventory').style.display='block'" style="width: 200px; float: left; height: 80px;" >Show Inventory</button>

		  <button onclick="document.getElementById('showemployee').style.display='block'" style="width: 200px; float: left; height: 80px;" >Show Employees</button>

		  <button onclick="document.getElementById('showsales').style.display='block'" style="width: 200px; float: left; height: 80px;" >Show Sales</button>

		  
		   <form method="post" action="logout.php" style="float: left;">
		   <button  style="width: 200px; background-color: #f44336; border: 1px #bc0000 solid; height: 80px;" ><a href="logout.php">Logout</a></button>
		   </form>
		
		
</div>




			<div class=" modal" id="showinventory">

				<div class=" modal-content animate"  style="  width: 1000px; height: 400px; margin-left: 160px; margin-top: 30px;">
					<div class="imgcontainer">
		      				<span onclick="document.getElementById('showinventory').style.display='none'" class="close" title="Close Modal" style="position: relative;  left: 480px; ">&times;</span>
		    		</div>


					<table width="100%">
					               <tr class="head">
					               <th style="background-color: #bababa;">ID</th>
					               <th style="background-color: #bababa;">Item</th>
					               <th style="background-color: #bababa;">Quantity Left</th>
					               <th style="background-color: #bababa;">Price</th>
					               <th style="background-color: #bababa;"> Total Sales</th>
					               </tr>
					               <?php
					               $da=date("Y-m-d");

					                  
					                  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
					               $query = "select * from inventory order by id";
					               $sql=mysqli_query($db, $query);
					               $i=1;
					               while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC))
					                        {
					                        $id=$row['id'];
					                        $item=$row['item'];
					                        $qtyleft=$row['qtyleft'];
					                        $qty_sold=$row['qty_sold'];
					                        $price=$row['price'];
					                        $sales=$row['sales'];

					                        if($i%2)
					                        {
					                        ?>
					                        <tr id="<?php echo $id; ?>" class="edit_tr">
					                                 <?php } 

					                                 else { ?>
					                                 <tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">
					                                 <?php 
					                                 }
					                                 ?>
					                                 <td>
					                                          <span class="text" style="padding-left: 50px;"><?php echo $id; ?></span> 
					                                 </td>
					                                 <td>
					                                          <span class="text" style="padding-left: 120px;"><?php echo $item; ?></span> 
					                                 </td>
					                                 <td>
					                                          <span class="text" style="padding-left: 90px;"><?php echo $qtyleft; ?></span>
					                                 </td>
					                                 <td>
					                                          <span class="text" style="padding-left: 70px;"><?php echo $price; ?></span>
					                                 </td>
					                                 <td>
					                                          <span class="text" style="padding-left: 90px;"><?php echo $sales; ?></span>
					                                 </td>
					                        </tr>

					                        <?php
					                        $i++;
					               }

					               ?>

					</table>
					<div style="padding: 30px;">
						<button onclick="document.getElementById('addproitem').style.display='block'" style="width: 200px; " >Update stock of an existing Product</button>


			   			<button onclick="document.getElementById('addpro').style.display='block'" style="width: 200px; " >Add a new product in the inventory</button>


			  			<button onclick="document.getElementById('editprice').style.display='block'" style="width: 200px; " >Change price of an existing product</button>

						<button onclick="document.getElementById('deleteproduct').style.display='block'" style="width: 200px; background-color: #f44336; border: 1px #bc0000 solid;" >Remove an exiting product from inventory</button>

					</div>
				</div>
			</div>






			<div class=" modal" id="showemployee">

							<div class=" modal-content animate" style="width: 700px; height: 400px; margin-left: 300px; margin-top: 30px;">
								<div class="imgcontainer">
		    		      				<span onclick="document.getElementById('showemployee').style.display='none'" class="close" title="Close Modal" style="position: relative;  left: 300px;  bottom: 50px;">&times;</span>
					    		</div>


								<table width="100%">
								               <tr class="head">
								               <th style="background-color: #bababa;">ID</th>
								               <th style="background-color: #bababa;">Username</th>
								               <th style="background-color: #bababa;">Password</th>
								               </tr>
								               <?php
								               $da=date("Y-m-d");

								                  
								                  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
								               $query = "select * from employee order by id";
								               $sql=mysqli_query($db, $query);
								               $i=1;
								               while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC))
								                        {
								                        $id=$row['id'];
								                        $username=$row['username'];
								                        $password=$row['password'];

								                        if($i%2)
								                        {
								                        ?>
								                        <tr id="<?php echo $id; ?>" class="edit_tr">
								                                 <?php } 

								                                 else { ?>
								                                 <tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">
								                                 <?php 
								                                 }
								                                 ?>
								                                 <td>
								                                          <span class="text" style="padding-left: 10px;"><?php echo $id; ?></span> 
								                                 </td>
								                                 <td>
								                                          <span class="text" style="padding-left: 50px;"><?php echo $username; ?></span> 
								                                 </td>
								                                 <td>
								                                          <span class="text" style="padding-left: 50px;"><?php echo $password; ?></span>
								                                 </td>
								                        </tr>

								                        <?php
								                        $i++;
								               }

								               ?>

								</table>

									<div style="padding: 30px; margin-left: 80px;">
										<button onclick="document.getElementById('addemployee').style.display='block'" style="width: 200px; " >Add a new Employee</button>


				   						<button onclick="document.getElementById('deleteemployee').style.display='block'" style="width: 200px; background-color: #f44336; border: 1px #bc0000 solid;" >Remove an Existing employee</button>
				   					</div>
								
							</div>
						</div>





						<div class=" modal" id="showsales">

							<div class=" modal-content animate" style="width: 800px; height: 400px; margin-left: 270px; margin-top: 30px;">
								<div class="imgcontainer">
		    		      				<span onclick="document.getElementById('showsales').style.display='none'" class="close" title="Close Modal" style="position: relative;  left: 380px;  bottom: 50px;">&times;</span>
					    		</div>


								<table width="100%">
								               <tr class="head">
								               <th style="background-color: #bababa;">Date</th>
								               <th style="background-color: #bababa;">Product ID</th>
								               <th style="background-color: #bababa;">Quantity</th>
								               <th style="background-color: #bababa;">Sales</th>
								               </tr>
								               <?php
								               $da=date("Y-m-d");

								                  
								                  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
								               $query = "select * from sales order by date";
								               $sql=mysqli_query($db, $query);
								               $i=1;
								               while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC))
								                        {
								                        
								                        $prodid=$row['product_id'];
								                        $qty=$row['qty'];
								                        $date=$row['date'];
								                        $sales=$row['sales'];

								                        if($i%2)
								                        {
								                        ?>
								                        <tr id="<?php echo $id; ?>" class="edit_tr">
								                                 <?php } 

								                                 else { ?>
								                                 <tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">
								                                 <?php 
								                                 }
								                                 ?>
								                                <td>
								                                          <span class="text" style="padding-left: 100px;"><?php echo $date; ?></span>
								                                 </td>
								                                 <td>
								                                          <span class="text" style="padding-left: 60px;"><?php echo $prodid; ?></span> 
								                                 </td>
								                                 <td>
								                                          <span class="text" style="padding-left: 60px;"><?php echo $qty; ?></span>
								                                 </td>
								                                 <td>
								                                          <span class="text" style="padding-left: 60px;"><?php echo $sales; ?></span>
								                                 </td>
								                        </tr>

								                        <?php
								                        $i++;
								               }

								               ?>

								</table>

									<div style="padding: 20px; margin-left: 30px;">

									<button onclick="document.getElementById('productsoldbyname').style.display='block'" style="width: 200px; " >Calculate Sales of a particular Product</button>

				   						<button onclick="document.getElementById('itemsoldbydate').style.display='block'" style="width: 200px; " >Calculate Sales on a particular Date</button>

										<button onclick="document.getElementById('totalsales').style.display='block'" style="width: 200px; " >Calculate Total sales</button>


				   						
				   					</div>
								
								
							</div>
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
	   //echo '<li style="list-style:none;">'.$row2['item'].'';
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



			<div class="modal" id="addproitem" >
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



<div class=" modal" id="totalsales">
<form action="adminsignedin.php" class="modal-content animate" method="post">
   <div class="imgcontainer">
    		      <span onclick="document.getElementById('totalsales').style.display='none'" class="close" title="Close Modal">&times;</span>
			    <div style="padding: 30px;">
					  	
					    <p style="position: relative; left: 50px; font-size: 1.2em; width: 140px;">Total Sales = </p> 
					    </div>
					       
					       <?php
					function formatMoney($number, $fractional=false) {
					    if ($fractional) {
					        $number = sprintf('%.2f', $number);
					    }
					    while (true) {
					        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
					        if ($replaced != $number) {
					            $number = $replaced;
					        } else {
					            break;
					        }
					    }
					    return $number;
					}     
					$result1 = mysqli_query($db,"select sum(sales) from sales ");
					while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC))
					{
					    $rrr=$row['sum(sales)'];
					    $x = formatMoney($rrr, true);
					    echo "
					    <div class='totalsales' style='position:relative; bottom: 95px;'>
					   <p ><strong>Rupees $x</strong></p>
					 	</div>";
					 }

					?>

					<button onclick="javascript:childtotal_open()" style="width: 200px; position: relative; right: 130px; bottom: 90px;" > Print Receipt</button>
				</div>
				</form>
</div>




				<div id="itemsoldbydate" class="modal" >
			  
			  <form class="modal-content animate" method="post" action="itemsoldbydate.php">
			    <div class="imgcontainer">
			      <span onclick="document.getElementById('itemsoldbydate').style.display='none'" class="close" title="Close Modal">&times;</span>
			      
			    </div>

			    <div class="container">
			      <label style="font-size: 1.2em;"><b> Please enter the Date to be searched</b></label>
			      <input type="text" placeholder="Enter Date" name="date" required>

			        
			      <input class="sub" name="submit" type="submit"  style="margin-left: 20px; width: 140px;" />		      
			    </div>

			  	 
			      
			    </div>
			  </form>
			</div>





<div class=" modal" id="productsoldbyname">
	<form action="itemsoldbyname.php" class="modal-content animate" method="post">
			   <div class="imgcontainer">
    		      <span onclick="document.getElementById('productsoldbyname').style.display='none'" class="close" title="Close Modal">&times;</span>
			    </div>

			   <div style="margin-left: 48px;">
			   Product name: <?php
			   $name= mysqli_query($db,"select * from inventory");
			   
			   echo '<select name="ID" id="user" class="textfield1">';
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
			   
			   <div style="margin-left: 127px; margin-top: 14px;">
			   <input class="sub" name="submit" type="submit"  style="margin-left: -80px; margin-bottom: 40px; width: 170px;" /> 
			   </div>



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
var modal8 = document.getElementById('showinventory');
var modal9 = document.getElementById('showemployee');
var modal10 = document.getElementById('showsales');
var modal11 = document.getElementById('productsoldbyname');
var modal12 = document.getElementById('itemsoldbydate');
var modal13 = document.getElementById('totalsales');

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
    if (event.target == modal8 ) {
        modal8.style.display = "none";
    }
    if (event.target == modal9 ) {
        modal9.style.display = "none";
    }
    if (event.target == modal10 ) {
        modal10.style.display = "none";
    }
    if (event.target == modal11 ) {
        modal11.style.display = "none";
    }
    if (event.target == modal12 ) {
        modal12.style.display = "none";
    }
    if (event.target == modal13 ) {
        modal13.style.display = "none";
    }


}

</script>
</body>
</html>

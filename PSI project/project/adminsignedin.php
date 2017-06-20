
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
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Inventory System</title>



<link href = "https://code.jquery.com/ui/1.10.4/themes/hot-sneaks/jquery-ui.css"
         rel = "stylesheet">
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      
      <!-- Javascript -->
     <script type="text/javascript">
		    $.noConflict();
		    jQuery(document).ready(function ($) {
		        $('#datepicker').datepicker({
		        	dateFormat:"yy-mm-dd"
		        });
		    });
</script>




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



			<script type="text/javascript" src="js/jquery.min.js"></script>
			<script type="text/javascript" src="js/Chart.min.js"></script>
			<script type="text/javascript" src="js/dategraph.js"></script>
			<script type="text/javascript" src="js/namegraph.js"></script>



<link rel="stylesheet" type="text/css" href="stylesheet2.css">



<style>
			.chart-container {
				width: 590px;
				height: auto;
				float: left;
				
			}
</style>




</head>

<body style="background-color:#333333; margin: 0;padding: 0;">



			<div style="width: 15%; height: 100%;  float: left; padding: 20px; margin-right: 20px;">


						<h2 style="color: white; float: left; font-size: 2.3em; margin-left: 40px; margin-top: 0px; margin-bottom: 20px; ">   <?php echo $login_session; ?>'s Dashboard</h2> 
				

							<button onclick="document.getElementById('addadmin').style.display='block'" style="width: 200px; height: 80px ;float: left;  font-size: 1.3em;" 	><strong>Create a new Admin</strong></button>

						  <button onclick="document.getElementById('showinventory').style.display='block'" style="width: 200px; float: left; height: 80px; font-size: 1.3em;" ><strong>Show Inventory</strong></button>

						  <button onclick="document.getElementById('showemployee').style.display='block'" style="width: 200px; float: left; height: 80px; font-size: 1.3em;" ><strong>Show Employees</strong></button>

						  <button onclick="document.getElementById('showsales').style.display='block'" style="width: 200px; float: left; height: 80px; font-size: 1.3em;" ><strong>Show Sales</strong></button>

						  
						   <form method="post" action="logout.php" style="float: left;">
						   <button  style="width: 200px; background-color: #f44336; border: 1px #bc0000 solid; height: 80px;" ><a href="logout.php"><strong>Logout</strong></a></button>
						   </form>


			</div>





			<div style="width: 45%; height: 100%;  padding: 10px; float: left; background-color: white; border: 1px solid #E9EBEE; border-radius: 15px; margin-left: 10px; margin-top: 10px;" >
				
				<div  class="chart-container" style=" margin-bottom: 10px;  ">
								<canvas id="mycanvas"></canvas>
					</div>




					<div class="chart-container" style=" margin-top:  10px;  ">
								<canvas id="mycanvas2"></canvas>
					</div>

			</div>







			<div style="width: 32%; height: 100%; float: left; margin-top: 20px; margin-left: 15px;">
				<div style="background-color: #FDDFDF; border: 1px solid #F1A899;  margin-top: 20px; margin-bottom: 20px; margin-left: 5px; margin-right: 20px;  border-radius: 8px; padding: 10px;">
					<h2 style="margin-left: 30px; margin-bottom: -10px;">Products low on Stock </h2>
					<p style="margin-left: 30px;">(Less than 50 Units)</p>


					<ul>
   

				   <?php
				   $CRITICAL=50;
				   $sql2=mysqli_query($db,"select * from inventory where qtyleft<='$CRITICAL'");
				   $num2=mysqli_num_rows($sql2);
				   if($num2)
				   {	
						
					   	while($row2=mysqli_fetch_array($sql2,MYSQLI_ASSOC))
					   {
					   echo '<li style="list-style:none; font-size: 1.7em; margin-left: 10px; ">'.$row2['item'].' = '.$row2['qtyleft'].' Units';
					   }
				   }
				   else
				   {
				   		echo '<p style="font-size: 1.7em; ">None. All products are properly stocked.</p>';
				   }

				   
				   ?>
   </ul>



				</div>

				<div style="background-color: #FFFA90; border: 1px solid #DAD55E;  margin-top: 20px; margin-bottom: 20px; margin-left: 5px; margin-right: 20px;  border-radius: 8px; padding: 10px;">
					<h2 style="margin-left: 30px;">Sales Trends</h2>

					<ul>
   

				   <?php
				   $sql3=mysqli_query($db,"select max(sales) as max from inventory");
				   $row3=mysqli_fetch_array($sql3,MYSQLI_ASSOC);
				   $max = $row3['max'];
				   $sql2=mysqli_query($db,"select item from inventory where sales = '$max'");
				   $num2=mysqli_num_rows($sql2);

				   $sql4=mysqli_query($db,"select min(sales) as min from inventory");
				   $row4=mysqli_fetch_array($sql4,MYSQLI_ASSOC);
				   $min = $row4['min'];
				   $sql=mysqli_query($db,"select item from inventory where sales = '$min'");
				   $num=mysqli_num_rows($sql);

				   if($num2>0 || $num > 0)
				   {	
						
					   	while($row2=mysqli_fetch_array($sql2,MYSQLI_ASSOC))
					   {
					   echo '<li style="list-style:none; font-size: 1.5em; margin-left: -10px; ">Stock more <u><strong>'.$row2['item'].'</strong></u> to generate more profits based on sales trends';
					   }
					   echo '<br />';
					  	while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC))
					   {
					   echo '<li style="list-style:none; font-size: 1.5em; margin-left: -10px; margin-top: 10px">Stock less <u><strong>'.$row['item'].'</strong></u> to reduce losses based on sales trends';
					   }
				   }
				   else
				   {
				   		echo '<p style="font-size: 1.5em; ">No sales trends generated.</p>';
				   }

				   
				   ?>
   </ul>
				</div>

			</div>








			<div class=" modal" id="showinventory">

				<div class=" modal-content animate"  style="  width: 1000px; height: 400px; margin-left: 160px; margin-top: 30px;">
					<div class="imgcontainer" style="position: relative; bottom: 20px;">
		      				<span onclick="document.getElementById('showinventory').style.display='none'" class="close" title="Close Modal" style="position: relative;  left: 480px; ">&times;</span>
		    		</div>







<form method='get' style="position: relative; bottom: 20px;">

								               
								               <?php
								               $da=date("Y-m-d");

								                  
								                  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} else {
  $startrow = (int)$_GET['startrow'];
}


$fetch = mysqli_query($db, "select * from inventory order by id LIMIT $startrow, 6")or
die(mysql_error());
   $num=mysqli_num_rows($fetch);
        if($num>0)
        {
        echo "<table width='100%'>";
        echo "<tr class='head'>
								               <th style='background-color: #bababa;'>ID</th>
								               <th style='background-color: #bababa;'>Item</th>
								               <th style='background-color: #bababa;'>Quantity Left</th>
								               <th style='background-color: #bababa;'>Quantity Sold</th>
								               <th style='background-color: #bababa;'>Price</th>
								               <th style='background-color: #bababa;'> Total Sales</th>
								               </tr>";
        for($i=0;$i<$num;$i++)
        {
        $row=mysqli_fetch_array($fetch,MYSQLI_ASSOC);
        $id=$row['id'];
        $item=$row['item'];
        $qtyleft=$row['qtyleft'];
        $qty_sold=$row['qty_sold'];
        $price=$row['price'];
        $sales=$row['sales'];
        echo "<tr>";
        echo"<td style='padding-left: 45px;'>$id</td>";
        echo"<td style='padding-left: 110px;'>$item</td>";
        echo"<td style='padding-left: 65px;'>$qtyleft</td>";
        echo"<td style='padding-left: 70px;'>$qty_sold</td>";
        echo"<td style='padding-left: 50px;'>$price</td>";
        echo"<td style='padding-left: 50px;'>$sales</td>";
        echo"</tr>";
        }//for
        echo"</table>";
        }
//now this is the link..
        if($startrow+6 <= $num){
			echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+6).'" style="color: green; float: right; margin-right: 5px; margin-top: 5px;">Next</a>';
		}
$prev = $startrow - 6;

//only print a "Previous" link if a "Next" was clicked
if ($prev >= 0)
    echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'" style="color: red; float: left; margin-left: 5px; margin-top: 5px; ">Previous</a>';

?>
</form>








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
								<div class="imgcontainer" style="position: relative; bottom: 20px;">
		    		      				<span onclick="document.getElementById('showemployee').style.display='none'" class="close" title="Close Modal" style="position: relative;  left: 300px;  bottom: 50px;">&times;</span>
					    		</div>






<form method='get' style="position: relative; bottom: 20px;">

								               
								               <?php
								               $da=date("Y-m-d");

								                  
								                  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} else {
  $startrow = (int)$_GET['startrow'];
}


$fetch = mysqli_query($db, "select * from employee order by id LIMIT $startrow, 6")or
die(mysql_error());
   $num=mysqli_num_rows($fetch);
        if($num>0)
        {
        echo "<table width='100%'>";
        echo "<tr class='head'>
								               <th style='background-color: #bababa;'>ID</th>
								               <th style='background-color: #bababa;'>Udername</th>
								               <th style='background-color: #bababa;'>Password</th>
								               </tr>";
        for($i=0;$i<$num;$i++)
        {
        $row=mysqli_fetch_array($fetch,MYSQLI_ASSOC);
        $id=$row['id'];
        $username=$row['username'];
        $password=$row['password'];
        echo "<tr>";
        echo"<td style='padding-left: 10px;'>$id</td>";
        echo"<td style='padding-left: 50px;'>$username</td>";
        echo"<td style='padding-left: 50px;'>$password</td>";
        
        echo"</tr>";
        }//for
        echo"</table>";
        }
//now this is the link..
        if($startrow+6 <= $num){
			echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+6).'" style="color: green; float: right; margin-right: 5px; margin-top: 5px;">Next</a>';
		}
$prev = $startrow - 6;

//only print a "Previous" link if a "Next" was clicked
if ($prev >= 0)
    echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'" style="color: red; float: left; margin-left: 5px; margin-top: 5px; ">Previous</a>';

?>
</form>












								

									<div style="padding: 30px; margin-left: 80px;">
										<button onclick="document.getElementById('addemployee').style.display='block'" style="width: 200px; " >Add a new Employee</button>


				   						<button onclick="document.getElementById('deleteemployee').style.display='block'" style="width: 200px; background-color: #f44336; border: 1px #bc0000 solid;" >Remove an Existing employee</button>
				   					</div>
								
							</div>
						</div>









						<div class=" modal" id="showsales">

							<div class=" modal-content animate" style="width: 800px; height: 400px; margin-left: 270px; margin-top: 30px;">
								<div class="imgcontainer" style="position: relative; bottom: 20px;">
		    		      				<span onclick="document.getElementById('showsales').style.display='none'" class="close" title="Close Modal" style="position: relative;  left: 380px;  bottom: 50px;">&times;</span>
					    		</div>


								
								<form method='get' style="position: relative; bottom: 20px;">

								               
								               <?php
								               $da=date("Y-m-d");

								                  
								                  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} else {
  $startrow = (int)$_GET['startrow'];
}


$fetch = mysqli_query($db, "select * from sales order by date LIMIT $startrow, 6")or
die(mysql_error());
   $num=mysqli_num_rows($fetch);
        if($num>0)
        {
        echo "<table width='100%'>";
        echo "<tr class='head'>
								               <th style='background-color: #bababa;'>Date</th>
								               <th style='background-color: #bababa;'>Product ID</th>
								               <th style='background-color: #bababa;'>Quantity</th>
								               <th style='background-color: #bababa;'>Sales</th>
								               </tr>";
        for($i=0;$i<$num;$i++)
        {
        $row=mysqli_fetch_array($fetch,MYSQLI_ASSOC);
        $id=$row['product_id'];
		$qty=$row['qty'];
		$sales=$row['sales'];
		$date=$row['date'];
        echo "<tr>";
        echo"<td style='padding-left: 100px;'>$date</td>";
        echo"<td style='padding-left: 80px;'>$id</td>";
        echo"<td style='padding-left: 75px;'>$qty</td>";
        echo"<td style='padding-left: 80px;'>$sales</td>";
        echo"</tr>";
        }//for
        echo"</table>";
        }
//now this is the link..
        if($startrow+6 <= $num){
			echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+6).'" style="color: green; float: right; margin-right: 5px; margin-top: 5px;">Next</a>';
		}
$prev = $startrow - 6;

//only print a "Previous" link if a "Next" was clicked
if ($prev >= 0)
    echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'" style="color: red; float: left; margin-left: 5px; margin-top: 5px; ">Previous</a>';

?>
</form>




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
			      <label style="font-size: 1.2em;"><b> Please enter the Date to be searched for</b></label>
			      <input id="datepicker"  type="text"  name="date" required >

			        
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


<?php
include('db.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventory System</title>
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
$("#first_"+ID).show();
$("#last_"+ID).hide();
$("#last_input_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var first=$("#first_input_"+ID).val();
var last=$("#last_input_"+ID).val();
var dataString = 'id='+ ID +'&price='+first+'&qty_sold='+last;
$("#first_"+ID).html('<img src="load.gif" />');


if(first.length && last.length>0)
{
$.ajax({
type: "POST",
url: "ajax.php",
data: dataString,
cache: false,
success: function(html)
{

$("#first_"+ID).html(first);
$("#last_"+ID).html(last);
}
});
}
else
{
alert('Enter something.');
}

});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});
</script>
<style>
body
{
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
padding:10px;
}
.editbox
{
display:none
}
td
{
padding:7px;
border-left:1px solid #fff;
border-bottom:1px solid #fff;
}
table{
border-right:1px solid #fff;
}
.editbox
{
font-size:14px;
width:29px;
background-color:#ffffcc;

border:solid 1px #000;
padding:0 4px;
}
.edit_tr:hover
{
background:url(edit.png) right no-repeat #80C8E5;
cursor:pointer;
}
.edit_tr
{
background: none repeat scroll 0 0 #D5EAF0;
}
th
{
font-weight:bold;
text-align:left;
padding:7px;
border:1px solid #fff;
border-right-width: 0px;
}
.head
{
background: none repeat scroll 0 0 #91C5D4;
color:#00000;

}

</style>
<link rel="stylesheet" href="reset.css" type="text/css" media="screen" />

<link rel="stylesheet" href="tab.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<link href="tabs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

var popupWindow=null;

function child_open()
{ 

popupWindow =window.open('printform.php',"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=950, height=400,top=200,left=200");

}
</script>
</head>

<body bgcolor="#dedede">
 
<h1>Inventory System </h1>
<ol id="toc">
    
    
   <li><a href="#addproitem"><span>Add Item</span></a></li>
    <li><a href="#addpro"><span>Add Product</span></a></li>
    <li><a href="#editprice"><span>Edit Price</span></a></li>
    <li><a href="#addemployee"><span>Add Employee</span></a></li>
    <li><a href="#deleteemployee"><span>Delete Employee</span></a></li>
    <li><a href="#addadmin"><span>Add a new Admin</span></a></li>
    <li><a href="#deleteproduct"><span>Delete a Product</span></a></li>
   <li><a href="index.php"><span>Logout</span></a></li>
</ol>




<?php
$da=date("Y-m-d");

   
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
session_start();

?>



			<div class="content" id="addproitem">
			<form action="updateproduct.php" method="post">
			   <div style="margin-left: 48px;">
			   Product name:<?php
			   $name= mysqli_query($db,"select * from inventory");
			   
			   echo '<select name="ITEM" id="user" class="textfield1">';
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
			   Number of Item To Add:<input name="itemnumber" type="text" /><br />
			   <div style="margin-left: 127px; margin-top: 14px;"><input name="" type="submit" value="Add" /></div>
			</form>
			</div>




<div class="content" id="addpro">
<form action="saveproduct.php" method="post">
   <div style="margin-left: 48px;">
   Product name:<input name="proname" type="text" />
   </div>
   <br />
   <div style="margin-left: 97px;">
   Price:<input name="price" type="text" />
   </div>
   <br />
   <div style="margin-left: 80px;">
   Quantity:<input name="qty" type="text" />
   </div>
   <div style="margin-left: 127px; margin-top: 14px;">
   <input name="" type="submit" value="Add" />
   </div>
</form>
</div>




			<div class="content" id="editprice">
			<form action="updateprice.php" method="post">
			   <div style="margin-left: 48px;">
			   Product name:<?php
			   $name= mysqli_query($db,"select * from inventory");
			   
			   echo '<select name="ITEM" id="user" class="textfield1">';
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
			   <div style="margin-left: 97px;">Price:<input name="itemprice" type="text" /></div>
			   <div style="margin-left: 127px; margin-top: 14px;"><input name="" type="submit" value="Update" /></div>
			</form>
			</div>



<div class="content" id="addemployee">
<form action="addemployee.php" method="post">
   <div style="margin-left: 48px;">
   Employee name:<input name="username" type="text" />
   </div>
   <br />
   <div style="margin-left: 97px;">
   Password:<input name="password" type="text" />
   </div>
   <br />
   <div style="margin-left: 127px; margin-top: 14px;">
   <input name="" type="submit" value="Add" />
   </div>
</form>
</div>


			<div class="content" id="deleteemployee">
			<form action="deleteemployee.php" method="post">
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
			   
			   <div style="margin-left: 127px; margin-top: 14px;"><input name="" type="submit" value="Delete" /></div>
			</form>
			</div>



<div class="content" id="addadmin">
<form action="addadmin.php" method="post">
   <div style="margin-left: 48px;">
   New Admin name:<input name="username" type="text" />
   </div>
   <br />
   <div style="margin-left: 97px;">
   Password:<input name="password" type="text" />
   </div>
   <br />
   <div style="margin-left: 127px; margin-top: 14px;">
   <input name="" type="submit" value="Add" />
   </div>
</form>
</div>




			<div class="content" id="deleteproduct">
			<form action="deleteproduct.php" method="post">
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
			   
			   <div style="margin-left: 127px; margin-top: 14px;"><input name="" type="submit" value="Delete" /></div>
			</form>
			</div>





<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['inventory', 'alert', 'sales', 'addproitem', 'addpro', 'editprice']);
</script>
</body>
</html>

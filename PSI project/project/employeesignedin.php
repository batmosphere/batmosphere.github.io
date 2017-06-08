<?php
include('db.php');

   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


session_start();
   
   $user_check = $_SESSION['username'];
   
   $ses_sql = mysqli_query($db,"select username from employee where username = '$user_check' ");
   
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


<link rel="stylesheet" type="text/css" href="stylesheet2.css" media="screen">
<link rel="stylesheet" type="text/css" href="stylesheet4.css" media="screen">

<style>

</style>

<script type="text/javascript">

var popupWindow=null;

function child_open()
{ 

popupWindow =window.open('printform.php',"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=1000, height=700,top=100,left=200 bottom=100 ");

}
</script>
</head>

<body bgcolor="#dedede">



               <div style="border-bottom: 1px solid black;">
                     <h1>Welcome <?php echo $login_session; ?></h1> 
               </div>


<br />
<table width="100%">
               <tr class="head">
               <th>ID</th>
               <th>Item</th>
               <th>Quantity Left</th>
               <th>Price</th>
               <th> Total Sales</th>
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
                                          <span class="text"><?php echo $id; ?></span> 
                                 </td>
                                 <td>
                                          <span class="text"><?php echo $item; ?></span> 
                                 </td>
                                 <td>
                                          <span class="text"><?php echo $qtyleft; ?></span>
                                 </td>
                                 <td>
                                          <span class="text"><?php echo $price; ?></span>
                                 </td>
                                 <td>
                                          <span class="text"><?php echo $sales; ?></span>
                                 </td>
                        </tr>

                        <?php
                        $i++;
               }

               ?>

</table>

<br />


<button onclick="document.getElementById('addsales').style.display='block'" style="width: 200px; position: relative; left: 20px; " >Purchase Inventory item</button>


               <div class=" modal" id="addsales" >
               <form action="addsales.php" class="modal-content animate" method="post">
                  <div class="imgcontainer">
                     <span onclick="document.getElementById('addsales').style.display='none'" class="close" title="Close Modal">&times;</span>
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
                  <div style="margin-left: 97px;">Quantity:<input style="margin-left: 37px;" name="qty" type="text" /></div>
                  <div style="margin-left: 127px; margin-top: 14px;"><input style=" margin-left: 60px; width: 255px; background-color: #4CAF50; color: white;" name="" type="submit" value="Purchase" /></div>
               </form>
               </div>




<?php
   
   echo "<br />";

?>





                           <div style="padding: 20px; margin-left: 30px; position: relative; bottom: 102px; left: 245px; width: 700px;">

                           <button onclick="document.getElementById('productsoldbyname').style.display='block'" style="width: 200px; " >Calculate Sales of a particular Product</button>

                                 <button onclick="document.getElementById('itemsoldbydate').style.display='block'" style="width: 200px; " >Calculate Sales on a particular Date</button>

                              <button onclick="document.getElementById('totalsales').style.display='block'" style="width: 200px; " >Calculate Total sales</button>


                                 
                              </div>




<div class=" modal" id="totalsales">
<form action="employeesignedin.php" class="modal-content animate" method="post">
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
           
           <form class="modal-content animate" method="post" action="Employeeitemsoldbydate.php">
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
   <form action="Employeeitemsoldbyname.php" class="modal-content animate" method="post">
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
</div >

<div style="position: absolute; bottom: -15px;">

<p style="position: relative; left: 50px; font-size: 1.2em; width: 190px;">Total Sales of <?php echo "<p style='position: relative; left: 162px; font-size: 1.2em; bottom: 37px; width: 90px;'>$da</p>" ?> :</p> 
       <?php

$result1 = mysqli_query($db,"select sum(sales) from sales where date='$da' order by date");
while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC))
{
    $rrr=$row['sum(sales)'];
    $x = formatMoney($rrr, true);
   echo "<p class='dailysales'><strong>Rupees $x</strong></p>";
 }

?></b><br /><br />

<button onclick="javascript:child_open()" style="width: 200px; position: relative; left: 20px; bottom: 70px;" >Print Receipt</button>
</div>



<div style="position: relative; top: 145px; right: 20px;">

<form method="post" action="logout.php">
<button name="logout" style="width: 220px; float: right; background-color: #f44336; border: 1px #bc0000 solid; margin-right: 30px; position: relative; bottom: 350px; " >Logout</button>
</form>

</div>




<div class="content" id="sales" style="position: relative; bottom: 100px; left: 360px; width: 600px; height: 45px; ">
   <p style="font-size: 1.2em; font-family: helvetica;">Sales between Two Dates. Please enter two dates in YYYY-MM-DD format.</p>
   <form action="" method="post">
   From: <input name="from" type="text" class="tcal"/>
      To: <input name="to" type="text" class="tcal"/>
     <button name="submit" type="submit">Search</button>
     </form><br />
     <?php
     if(isset($_POST['submit']))
     {      
            echo "<p style='width: 100px; font-size: 1.2em;'> Total Sales : </p>";
            $a=$_POST['from'];
            $b=$_POST['to'];
            $result1 = mysqli_query($db,"select sum(sales) FROM sales where date BETWEEN '$a' AND '$b'");
            while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC))
            {
               $rrr=$row['sum(sales)'];
               $x = formatMoney($rrr, true);
               echo "<p style='position: relative;  left: 100px; bottom: 38px; width: 220px; font-size: 1.2em;'><strong>Rupees $x</strong></p>";
             }
            }
      ?>
</div>



<script type="text/javascript">

   // Get the modal
var modal1 = document.getElementById('addsales');
var modal2 = document.getElementById('productsoldbyname');
var modal3 = document.getElementById('itemsoldbydate');
var modal4 = document.getElementById('totalsales');


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
}

</script>

</body>
</html>

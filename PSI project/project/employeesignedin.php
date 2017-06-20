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
<link href = "https://code.jquery.com/ui/1.10.4/themes/hot-sneaks/jquery-ui.css"
         rel = "stylesheet">
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      
      <!-- Javascript -->
     <script type="text/javascript">
          $.noConflict();
          jQuery(document).ready(function ($) {
              $('#from').datepicker({
               dateFormat:"yy-mm-dd"
              });

              $('#to').datepicker({
               dateFormat:"yy-mm-dd"
              });

              $('#datepicker').datepicker({
               dateFormat:"yy-mm-dd"
              });
          });
</script>


<link rel="stylesheet" type="text/css" href="stylesheet2.css" media="screen">
<link rel="stylesheet" type="text/css" href="stylesheet4.css" media="screen">

         <script type="text/javascript" src="js/jquery.min.js"></script>
         <script type="text/javascript" src="js/Chart.min.js"></script>
         <script type="text/javascript" src="js/dategraph.js"></script>
         <script type="text/javascript" src="js/namegraph.js"></script>

<style>
   .chart-container {
            width: 50%;
            height: auto;
            float: left;
            
         }
</style>

<script type="text/javascript">

var popupWindow=null;

function child_open()
{ 

popupWindow =window.open('printform.php',"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=1000, height=700,top=100,left=200 bottom=100 ");

}
</script>
</head>

<body style="background-color:#333333; margin: 0;padding: 0;">



                  <div style="width: 15%; height: 100%;  float: left; padding: 20px; margin-right: 20px;">


                     <h2 style="color: white; float: left; font-size: 2.3em; margin-left: 30px; margin-top: 0px; margin-bottom: 20px; ">   <?php echo $login_session; ?>'s Dashboard</h2> 
            

                    <button onclick="document.getElementById('addsales').style.display='block'" style="width: 200px; float: left;  font-weight: bold;" >Purchase Inventory item</button>

                     <button onclick="document.getElementById('productsoldbyname').style.display='block'" style="width: 200px; float: left; font-weight: bold;" >Calculate Sales of a particular Product</button>

                     <button onclick="document.getElementById('itemsoldbydate').style.display='block'" style="width: 200px; float: left; font-weight: bold;" >Calculate Sales on a particular Date</button>

                     <button onclick="document.getElementById('totalsales').style.display='block'" style="width: 200px; float: left; font-weight: bold;" >Calculate Total sales</button>

                     <button onclick="document.getElementById('twodates').style.display='block'" style="width: 200px; float: left; font-weight: bold;" >Calculate sales between two dates</button>

                     
                     <form method="post" action="logout.php">
                     <button name="logout" style="width: 200px; float: right; background-color: #f44336; border: 1px #bc0000 solid; font-weight: bold; float: left;" >Logout</button>
                     </form>


               </div>





               <div style="float: left; width: 60%; background-color: white; border-radius: 15px; margin: 10px; padding-top: 20px; padding-bottom: 20px;">
                  
                  
               
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
                       echo "<table style='width:100%; border: none; '>";
                       echo "<tr class='head'>
                                                      <th style='background-color: #bababa; padding-left: 35px;'>ID</th>
                                                      <th style='background-color: #bababa; padding-left: 50px;'>Item</th>
                                                      <th style='background-color: #bababa; padding-left: 40px;'>Quantity Left</th>
                                                      <th style='background-color: #bababa; padding-left: 40px;'>Quantity Sold</th>
                                                      <th style='background-color: #bababa; padding-left: 30px;'>Price</th>
                                                      <th style='background-color: #bababa; padding-left: 30px;'> Total Sales</th>
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
                       echo"<td style='padding-left: 30px;'>$id</td>";
                       echo"<td style='padding-left: 50px;'>$item</td>";
                       echo"<td style='padding-left: 65px;'>$qtyleft</td>";
                       echo"<td style='padding-left: 70px;'>$qty_sold</td>";
                       echo"<td style='padding-left: 40px;'>$price</td>";
                       echo"<td style='padding-left: 50px;'>$sales</td>";
                       echo"</tr>";
                       }//for
                       echo"</table>";
                       }
               //now this is the link..
                       if($startrow+6 < $num){
                        echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+6).'" style="color: green; float: right; margin-right: 5px; margin-top: 5px;">Next</a>';
                     }
               $prev = $startrow - 6;

               //only print a "Previous" link if a "Next" was clicked
               if ($prev >= 0)
                   echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'" style="color: red; float: left; margin-left: 5px; margin-top: 5px; ">Previous</a>';

               ?>
               </div>






               <div style="width: 16%; margin-top: 50px; float: left; background-color: white; border-radius: 15px; padding: 10px; margin-left: 7px;">
                  <p style=" font-size: 1.4em; margin-left: 40px;">Total Sales of <?php echo "<p style='font-size: 1.4em; margin-left: 40px; font-weight: bold; '>$da</p>" ?></p> 
                         <?php

                  $result1 = mysqli_query($db,"select sum(sales) from sales where date='$da' order by date");
                  while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC))
                  {
                      $rrr=$row['sum(sales)'];
                      $x = formatMoney($rrr, true);
                     echo "<p style='font-weight: bold; font-size: 1.4em; margin-left: 40px;'><strong>Rupees $x</strong></p>";
                   }
                   ?>

                   <button onclick="javascript:child_open()" style="width: 200px; float: left; margin-left: 10px; font-weight: bold;" >Print Today's Receipt</button>

               </div>



               <div style="width: 77%;   padding: 10px; float: left; background-color: white; border: 1px solid #E9EBEE; border-radius: 15px; margin-left: 10px; margin-top: 10px;" >
            
            <div  class="chart-container" style=" margin-bottom: 10px;  ">
                        <canvas id="mycanvas"></canvas>
               </div>




               <div class="chart-container" style=" margin-top:  10px;  ">
                        <canvas id="mycanvas2"></canvas>
               </div>

         </div>



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
               <input id="datepicker" type="text" placeholder="Enter Date" name="date" required>

                 
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


<div id="twodates" class="modal" >
           
           <form class="modal-content animate" method="post" action="">
             <div class="imgcontainer">
               <span onclick="document.getElementById('twodates').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

             <div class="container">
               <p style="font-size: 1.2em; font-family: helvetica;">Sales between Two Dates.</p>
            
            From: <input id="from" name="from" type="text" class="tcal"/> <br />
               To: <input id="to" name="to" type="text" class="tcal"/>
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

             
               
             </div>
           </form>
         </div>



<script type="text/javascript">

   // Get the modal
var modal1 = document.getElementById('addsales');
var modal2 = document.getElementById('productsoldbyname');
var modal4 = document.getElementById('totalsales');
var modal3 = document.getElementById('itemsoldbydate');
var modal5 = document.getElementById('twodates');


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
}

</script>

</body>
</html>

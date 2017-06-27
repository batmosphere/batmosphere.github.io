<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'xxxx');
   define('DB_DATABASE', 'ims');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") 
{
      // username and password sent from form 
      
      $sql3=mysqli_query($db,"select max(id) as max from sales");
               $row3=mysqli_fetch_array($sql3,MYSQLI_ASSOC);
               $max = $row3['max'];


               $query = "select * from sales where id = '$max'";
               $sql=mysqli_query($db, $query);

               $row=mysqli_fetch_array($sql,MYSQLI_ASSOC);

               $proid=$row['product_id'];
               $qty=$row['qty'];
               $dailysales = $row['sales'];

               $query1 = "select * from inventory where id = '$proid'";
               $sql1=mysqli_query($db, $query1);

              
               $row1=mysqli_fetch_array($sql1,MYSQLI_ASSOC); 

               $id=$row1['id']; 
               $item=$row1['item'];
               $qtyleft=$row1['qtyleft'];
               $qty_sold=$row1['qty_sold'];
               $sales = $row1['sales'];

               $qtyleft = $qtyleft + $qty;
               $qty_sold = $qty_sold - $qty;

               
               $sales = $sales - $dailysales;

               
               mysqli_query($db,"update inventory set qtyleft='$qtyleft', qty_sold='$qty_sold', sales='$sales' where id='$proid'");

               mysqli_query($db,"delete from sales where id = '$max'");

               unset($_POST);
               header("Location: employeesignedin.php");


  }
?>
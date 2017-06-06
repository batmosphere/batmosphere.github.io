<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'xxxx');
   define('DB_DATABASE', 'ims');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $proid=$_POST['ITEM'];
      $qty=$_POST['qty'];
      $da=date("Y-m-d");  	
      $query = "select * from inventory where id = '$proid'";
      $sql=mysqli_query($db, $query);

      $row=mysqli_fetch_array($sql,MYSQLI_ASSOC);
      $id=$row['id'];
      $price = $row['price'];
      $item=$row['item'];
      $qtyleft=$row['qtyleft'];
      $qty_sold=$row['qty_sold'];
      $sales = $row['sales'];

      $qtyleft = $qtyleft - $qty;
      $qty_sold = $qty_sold + $qty;

      $dailysales = $qty * $price;
      $sales = $sales + $dailysales;

      echo  $qtyleft."<br />";
      echo $qty_sold."<br />";
      echo $sales."<br />";


      mysqli_query($db,"insert into sales (product_id, qty, date, sales) VALUES ('$id', '$qty','$da', '$dailysales')");

      mysqli_query($db,"update inventory set qtyleft='$qtyleft', qty_sold='$qty_sold', sales='$sales' where id='$proid'");
      
      header("location: employeesignedin.php");



  }
?>
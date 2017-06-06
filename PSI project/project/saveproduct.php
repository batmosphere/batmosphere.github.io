<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'xxxx');
   define('DB_DATABASE', 'ims');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
  	    $proname=$_POST['proname'];
		$price=$_POST['price'];
		$qty=$_POST['qty'];
      
      mysqli_query($db,"insert into inventory (item, price, qtyleft, qty_sold) VALUES ('$proname', '$price','$qty', 0)");
      header("location: adminsignedin.php");

  }
?>
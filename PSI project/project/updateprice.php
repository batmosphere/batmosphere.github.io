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
      $itemprice=$_POST['itemprice'];
      
  	  mysqli_query($db,"update inventory SET price='$itemprice' where id='$proid'");
      header("location: adminsignedin.php");

  }
?>
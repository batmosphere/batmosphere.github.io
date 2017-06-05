<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'xxxx');
   define('DB_DATABASE', 'ims');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
  	    $username = $_POST['username'];
    		$password = md5($_POST['password']);

      
      mysqli_query($db,"insert into admin (username, password) VALUES ('$username', '$password')");
      header("location: adminsignedin.php");

  }
?>
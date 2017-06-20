<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'xxxx');
   define('DB_DATABASE', 'ims');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']); 
      $mypassword = md5($password);
      
      $sql = "SELECT id FROM admin WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['username'] = $myusername;
         
         header("location: adminsignedin.php");
      }else {
         $error = "Your Login Name or Password is invalid";

         echo "

         <html>
         <style>
         h2{
         	margin: 200px 210px auto 210px;
         	color: black;
         	font-size: 2em;
         	border: 1px solid #ff0000;
         	padding: 20px;
         	padding-right: 20px;
         	border-radius: 8px;
         	background-color: #ffdbdb;
         	
         }

         a:hover{
         	color: black;
         }

         a{
         	color: red;
         	font-style:italic;
         }
         </style>
         <body style='background-color: #333333'>

         <h2>Wrong Credentials entered. <a href='index.php' ><u>Click Here</u></a> to go back to Login Page.</h2>
        
        </body>
         </html>

         ";
         

         

      }
   }
?>
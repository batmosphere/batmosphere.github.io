<?php
   session_start();
   if(!isset($_SESSION['username']) && !isset($_SESSION['id']))
   {
   	header("Location: index.php");
   }
   else
   {
   
   	session_destroy();
   	session_unset();
   	header("Location: index.php");
   }

   
   
   

    
   
?>

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
        
        $query = "select qtyleft from inventory WHERE id='$proid'";
        $sql=mysqli_query($db, $query);

        $row=mysqli_fetch_array($sql,MYSQLI_ASSOC);
 
        $itemnumber=$_POST['itemnumber'] + $row['qtyleft'];
        mysqli_query($db,"update inventory SET qtyleft='$itemnumber'
        WHERE id='$proid'");
        header("location: adminsignedin.php");

  }
?>
<?php
include('db.php');


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Receipt of Inventory Management System</title>


<link rel="stylesheet" href="style3.css" type="text/css" media="screen" />

</head>

<body bgcolor="#dedede" style="width: 939px;">
 
<h1 style="margin: 15px auto 13px 280px;
    font-family: Helvetica;
    font-style: italic;
    font-size: 40px;">Receipt Dated <?php echo date("Y-m-d"); ?></h1>



<div id="box1">
<ul id="boxes">
<li id="inventory" class="box">
<table width="912px">
<tr class="head">
<th>Date</th>
<th>ID</th>
<th>Item Name</th>
<th>Qty Sold </th>
<th>Qty Left </th>
<th>Price</th>
<th>Sales</th>
</tr>
                    <?php
               $da=date("Y-m-d");

                  
                  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
               $query = "select * from sales ";
               $sql=mysqli_query($db, $query);
               $i=1;
               while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC))
                        {
                        $id=$row['product_id'];
                        $qty=$row['qty'];
                        $sales=$row['sales'];
                        $date=$row['date'];

                         $query1 = "select item,price,qtyleft from inventory where id='$id'";
                         $sql1=mysqli_query($db, $query1);
                         $row2=mysqli_fetch_array($sql1,MYSQLI_ASSOC);
                         $price = $row2['price'];
                         $item = $row2['item'];
                         $qtyleft = $row2['qtyleft'];

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
                                          <span class="text"><?php echo $date; ?></span> 
                                 </td>
                                 <td>
                                          <span class="text"><?php echo $id; ?></span> 
                                 </td>
                                 <td>
                                          <span class="text"><?php echo $item; ?></span> 
                                 </td>
                                 <td>
                                          <span class="text"><?php echo $qty; ?></span>
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
<div style="float:left;  margin-top: 10px; font-size: 1.3em;">
<p >Total Sales :<p>
	    <b> <?php
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
$result1 = mysqli_query($db,"SELECT sum(sales) FROM sales ");
while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC))
{
    $rrr=$row['sum(sales)'];
	echo formatMoney($rrr, true);
 }

?></b>
</div><br /><br />

<button style="position: relative; top: 65px; right: 130px;" onclick="javascript:window.print()">Print</button>
</li>
</ul>
</div>

</body>
</html>

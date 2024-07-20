<?php

include 'config.php';

session_start();
$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];


if(isset($_GET['update'])){

    $order_update_id = $_GET['update'];
    mysqli_query($conn, "UPDATE orders SET payment_status = 'completed' WHERE order_id = '$order_update_id'") or die('query failed');
    $message[] = 'payment status has been updated!';
    }
    
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM orders WHERE order_id = '$delete_id'") or die('query failed');
    header('location:admin_orders.php');
}
if(isset($message)){
    foreach($message as $message){
       echo '
       <div class="message">
          <span>'.$message.'</span>
          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
       </div>
       ';
    }
 }
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="adminStyle.css">
    <title>Admin Page</title>
</head>
<body>
    
<?php
include('admin_header.php');
?>

<section class="orders">

<h1 class="title">Placed orders</h1>

<div class="box-container">
   <?php
   if($select_orders = mysqli_query($conn, "SELECT * FROM orders") or die('query failed'))
   {
   if(mysqli_num_rows($select_orders) > 0){
    echo"<table class='table'";
        echo"<tr>";
            echo"<th>Order ID</th>";
            echo"<th>User ID</th>";
            echo"<th>Name</th>";
            echo"<th>Method</th>";
            echo"<th>Address</th>";
            echo"<th>Total product</th>";
            echo"<th>Total price</th>";
            echo"<th>Placed On</th>";
            echo"<th>Payment status</th>";
            echo "<th>Action</th>";
        echo"</tr>";
        while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            echo"<tr>";
                echo"<td>$fetch_orders[order_id]</td>";
                echo"<td>$fetch_orders[r_id]</td>";
                echo"<td>$fetch_orders[name]</td>";
                echo"<td>$fetch_orders[method]</td>";
                echo"<td>$fetch_orders[address]</td>";
                echo"<td>$fetch_orders[total_products]</td>";
                echo"<td>$fetch_orders[total_price]</td>";
                echo"<td>$fetch_orders[placed_on]</td>";
                echo"<td>$fetch_orders[payment_status]</td>";
                echo"<td><a href='admin_orders.php?update=$fetch_orders[order_id];' class='btn'>Update</a>
                <a href='admin_orders.php?delete=$fetch_orders[order_id];' class='btn'>Delete</a></td>";
            echo"</tr>";
        }
    echo"</table>";
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
}
   ?>
</div>

</section>

</body>
</html>
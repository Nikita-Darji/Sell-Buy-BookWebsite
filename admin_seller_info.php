<?php

include 'config.php';

session_start();
$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM seller_info WHERE info_id = '$delete_id'") or die('query failed');
    header('location:admin_seller_info.php');
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

<h1 class="title">Seller Information</h1>

<div class="box-container">
   <?php
   if($select_orders = mysqli_query($conn, "SELECT * FROM seller_info") or die('query failed'))
   {
   if(mysqli_num_rows($select_orders) > 0){
    echo"<table class='table'";
        echo"<tr>";
            echo"<th>No</th>";
            echo"<th>User ID</th>";
            echo"<th>Name</th>";
            echo"<th>Method</th>";
            echo"<th>Address</th>";
            echo "<th>Action</th>";
        echo"</tr>";
        while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            echo"<tr>";
                echo"<td>$fetch_orders[info_id]</td>";
                echo"<td>$fetch_orders[r_id]</td>";
                echo"<td>$fetch_orders[name]</td>";
                echo"<td>$fetch_orders[method]</td>";
                echo"<td>$fetch_orders[address]</td>";
                echo"<td><a href='admin_seller_info.php?delete=$fetch_orders[info_id];' class='btn'>Delete</a></td>";
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

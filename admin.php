<?php

include 'config.php';

session_start();
$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Page</title>
</head>
<body>
    
<?php
include('admin_header.php');
?>
<section class="dashboard">

<h1 class="title">Dashboard</h1>

<div class="box-container">

   <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM orders WHERE payment_status = 'pending'") or die('query failed');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
     
      <h3>₹ <?php echo $total_pendings; ?>/- </h3>
      <p>total pendings</p>
   </div>

   <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM orders WHERE payment_status = 'completed'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
      
      <h3>₹<?php echo $total_completed; ?>/-</h3>
      <p>completed payments</p>
   </div>

   <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM orders") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
      
      <h3><?php echo $number_of_orders; ?></h3>
      <p>order placed</p>
   </div>

   <div class="box">
         <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM img") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
      <p>products added</p>
   </div>

   <div class="box">
      <?php 
         $select_users = mysqli_query($conn, "SELECT * FROM registration WHERE user = 'user'") or die('query failed');
         $number_of_users = mysqli_num_rows($select_users);
      ?>
      <h3><?php echo $number_of_users; ?></h3>
      <p>normal users</p>
   </div>

   <div class="box">
      <?php 
         $select_admins = mysqli_query($conn, "SELECT * FROM registration WHERE user = 'admin'") or die('query failed');
         $number_of_admins = mysqli_num_rows($select_admins);
      ?>
      <h3><?php echo $number_of_admins; ?></h3>
      <p>admin users</p>
   </div>

   <div class="box">
         <?php 
            $select_account = mysqli_query($conn, "SELECT * FROM registration") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>total accounts</p>
      </div>

   <div class="box">
          <?php 
            $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <h3><?php echo $number_of_messages; ?></h3>
      <p>new messages</p>
   </div>

</div>

</section>
</body>
</html>
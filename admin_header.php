

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="adminStyle.css">
      
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="admin.php">Dashboard</a></li>
        <li><a href="admin_seller_info.php">Seller Info</a></li>
        <li><a href="admin_orders.php">Orders</a></li>
        <li><a href="admin_products.php">Products</a></li>
        <li><a href="admin_message.php">Messages</a></li>
    </ul>
</div>

<div class = "contant">
    <div class="account-box">
         <span class="admin-name"><?php echo $_SESSION['admin_name']; ?></span>
         <div class="log-style">
          <button onclick="window.location.href='logout.php'">logout</button>
         </div>
         
    </div>
</div>

</body>
</html>

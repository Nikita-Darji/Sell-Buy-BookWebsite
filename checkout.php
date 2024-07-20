<?php

include 'config.php';

session_start();
$r_id = $_SESSION['r_id'];

if(!isset($r_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE r_id = '$r_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE name = '$name' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO orders(r_id, name, method, address, total_products, total_price, placed_on) VALUES('$r_id', '$name','$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'Order placed successfully!';
         mysqli_query($conn, "DELETE FROM cart WHERE r_id = '$r_id'") or die('query failed');
      }
   }
   
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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="style.css">


   <script>
        function validateForm() {
            var name = document.forms["myForm"]["name"].value;
            var method = document.forms["myForm"]["method"].value;
            var pinCode = document.forms["myForm"]["pin_code"].value;
            var flat = document.forms["myForm"]["flat"].value;
            var street = document.forms["myForm"]["street"].value;
            var city = document.forms["myForm"]["city"].value;
            var state = document.forms["myForm"]["state"].value;
            var country = document.forms["myForm"]["country"].value;

            // Check if name is empty and contains only letters and spaces
            if (name.trim() == "" || !/^[a-zA-Z\s]+$/.test(name)) {
                alert("Name must be filled out and contain only letters and spaces");
                return false;
            }

            // Check if payment method is selected
            if (method == "") {
                alert("Please select a payment method");
                return false;
            }

            
            // Check if flat number is not empty and contains only numbers
            if (flat.trim() == "" || !/^\d+$/.test(flat)) {
                alert("Flat number should be filled out and should contain only numbers");
                return false;
            }

            // Check if street contains only letters, numbers, and spaces
            if (street.trim() == "" || !/^[a-zA-Z0-9\s]+$/.test(street)) {
                alert("Street must be filled out and name should contain only letters, numbers, and spaces");
                return false;
            }

            // Check if city contains only letters and spaces
            if (city.trim() == "" || !/^[a-zA-Z\s]+$/.test(city)) {
                alert("City must be filled out and should contain only letters and spaces");
                return false;
            }

            // Check if state contains only letters and spaces
            if (state.trim() == "" || !/^[a-zA-Z\s]+$/.test(state)) {
                alert("State must be filled out and should contain only letters and spaces");
                return false;
            }

            // Check if country contains only letters and spaces
            if (country.trim() == "" || !/^[a-zA-Z\s]+$/.test(country)) {
                alert("Country must be filled out and should contain only letters and spaces");
                return false;
            }

             // Check if PIN code is empty or not a 6-digit number
             if (pinCode.trim() == "" || !/^\d{6}$/.test(pinCode)) {
                alert("PIN code must be filled out and should be a 6-digit number");
                return false;
            }
        }
    </script>
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE r_id = '$r_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '₹'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span>₹<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Name :</span>
            <input type="text" name="name" placeholder="Enter your name">
         </div>
         <div class="inputBox">
            <span>Payment method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <input type="number" min="0" name="flat" placeholder="Flat no">
         </div>
         <div class="inputBox">
            <input type="text" name="street" placeholder="Street name">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" placeholder="e.g. mumbai">
         </div>
         <div class="inputBox">
            <span>State :</span>
            <input type="text" name="state" placeholder="e.g. maharashtra">
         </div>
         <div class="inputBox">
            <span>Country :</span>
            <input type="text" name="country" placeholder="e.g. india">
         </div>
         <div class="inputBox">
            <span>Pin code :</span>
            <input type="number" min="0" name="pin_code" placeholder="e.g. 123456">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>



<?php include 'footer.php'; ?>


</body>
</html>
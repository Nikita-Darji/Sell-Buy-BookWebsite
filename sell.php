<?php

include 'config.php';

session_start();

$r_id = $_SESSION['r_id'];

if(!isset($r_id)){
   header('location:login.php');
}

if(isset($_POST['submit_info'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);

      $seller_info = mysqli_query($conn, "SELECT * FROM seller_info WHERE r_id = '$r_id' AND name = '$name'") or die('query failed');
      if(mysqli_num_rows($seller_info) > 0){
         $message[] = 'Seller info already inserted!'; 
      }else{
         mysqli_query($conn, "INSERT INTO seller_info (r_id , name, method, address) VALUES('$r_id','$name', '$method', '$address')") or die('query failed');

         header('location:sellBook.php');
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
   <title>Seller Information</title>
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

<section class="seller_info">

   <form name="myForm" onsubmit="return validateForm()" method="post">
      <h3>Seller Information</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Name :</span>
            <input type="text" name="name" required placeholder="Enter your name">
         </div>
         <div class="inputBox">
            <span>Payment Method :</span>
            <select name="method">
               <option value="credit card">Credit card</option>
               <option value="paypal">Paypal</option>
               <option value="paytm">Paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <input type="text" name="flat" placeholder="Flat no.">
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
      <input type="submit" value="submit" class="btn" name="submit_info">
   </form>

</section>


<?php include 'footer.php'; ?>


</body>
</html>
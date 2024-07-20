<?php

include 'config.php';

session_start();
if(isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
}
else
    $user=null;

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM message WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'message sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO message(user_id, name, email, number, message) VALUES('$user', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'message sent successfully!';
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
   <title>contact</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <link rel="stylesheet" href="style.css">


   <script>
        function validateForm() {
            var name = document.forms["myForm"]["name"].value;
            var email = document.forms["myForm"]["email"].value;
            var number = document.forms["myForm"]["number"].value;
            var message = document.forms["myForm"]["message"].value;

            // Check if name is empty or contains non-alphabetic characters
            if (name.trim() == "" || !/^[a-zA-Z\s]+$/.test(name)) {
                alert("Name must be filled out and contain only alphabetic characters");
                return false;
            }

            // Check if email is empty or not in proper format
            if (email.trim() == "" || !/\S+@\S+\.\S+/.test(email)) {
                alert("Email must be filled out and in proper format");
                return false;
            }

            // Check if number is empty or not a number
            if (number.trim() == "" || isNaN(number)) {
                alert("Number must be filled out and should be a number");
                return false;
            }

            // Check if message is empty
            if (message.trim() == "") {
                alert("Message must be filled out");
                return false;
            }
        }
    </script>
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="contact">

<form name="myForm" onsubmit="return validateForm()" method="post">
      <h3>say something!</h3>
      <input type="text" name="name" placeholder="enter your name" class="box">
      <input type="email" name="email" placeholder="enter your email" class="box">
      <input type="number" name="number" placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Send" name="send" class="btn">
   </form>

</section>


<?php include 'footer.php'; ?>

</body>
</html>
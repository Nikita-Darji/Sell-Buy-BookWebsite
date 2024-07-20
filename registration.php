 <?php 
   
   include'config.php';

   $name = $email = $pass = $phn = "";
   $name_err = $email_err = $pass_err = $phn_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
        }else{
            $name = trim($_POST["name"]);
            if (!preg_match ("/^[a-zA-z]*$/", $name) ) {  
                $name_err = "Only alphabets and whitespace are allowed.";  
        }
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
        // Check if email address is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format.";
        } else {
            // Check if email contains "gmail.com"
            if (strpos($email, "gmail.com") === false) {
                $email_err = "Only Gmail addresses are allowed.";
            }
        }
    }

    // Validate password
    if (empty(trim($_POST["pass"]))) {
        $pass_err = "Please enter your password.";
    } elseif (strlen(trim($_POST["pass"])) < 6) {
        $pass_err = "Password must have at least 6 characters.";
    } elseif (strlen(trim($_POST["pass"])) > 6) {
        $pass_err = "Password must not exceed 6 characters.";
    } else {
        $pass = trim ($_POST["pass"]);
    }

    // Validate phone number
    if (empty(trim($_POST["phn"]))) {
        $phn_err = "Please enter your phone number.";
    } else {
        $phn = trim($_POST["phn"]);
        // Check if phone number is valid
        if (!preg_match("/^\d{10}$/", $phn)) {
            $phn_err = "Invalid phone number format.";
        }
    }
   
    if (empty($name_err) && empty($email_err) && empty($pass_err) && empty($phn_err)) {
     
        $select_users = mysqli_query($conn,"SELECT * FROM registration WHERE email = '$email' AND pass = '$pass'") or die('query failed');
   
        if(mysqli_num_rows($select_users) > 0){
            $message[] =  'user already exist!';
        }else{

            mysqli_query($conn,"INSERT INTO registration (name, email, pass, phn) VALUES('$name', '$email', '$pass','$phn')") or die('query failed');
            $message[] = 'registered successfully!';

        }
    }
}
 ?>

 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
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

<div class="form-container">

   <form action=" " method="post">
      <h2>register now</h2>
      <input type="text" name="name" placeholder="enter your name " class="box">
      <span> <?php echo isset($name_err) ? $name_err : ''; ?></span>
      <input type="email" name="email" placeholder="enter your email"  class="box">
      <span><?php echo isset($email_err) ? $email_err : '';?></span>
      <input type="password" name="pass" placeholder="enter your password" class="box">
      <span><?php echo isset($pass_err) ? $pass_err : '';?></span>
      <input type="text" name="phn" placeholder="enter your number" class="box">
      <span><?php echo isset($phn_err) ? $phn_err : '';?></span>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>

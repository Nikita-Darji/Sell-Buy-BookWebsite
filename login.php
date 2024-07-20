<?php 
   include'config.php';
    session_start();

    if(isset($_POST['submit'])){

      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $pass = mysqli_real_escape_string($conn, $_POST['pass']);
   
      $select_users = mysqli_query($conn,"SELECT * FROM registration WHERE email = '$email' AND pass = '$pass'") or die('query failed');
   
      if(mysqli_num_rows($select_users) > 0){
   
         $row = mysqli_fetch_assoc($select_users);
   
         if($row['user'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_id'] = $row['r_id'];
            header('location:admin.php');
   
         }elseif($row['user'] == 'user'){
            $_SESSION['user']=$row['name'];
            $_SESSION['r_id'] = $row['r_id'];
            // $_SESSION['user_email'] = $row['email'];
            // $_SESSION['user_phn'] = $row['phn'];
            header('location:home.php');
         }
   
      }else{
         $message[] = 'incorrect email or password!';
      }
   
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        <form action="" method="post">
            <h2>login now</h2>
            <input type="email" name="email" placeholder="enter your email" required class="box">
            <input type="password" name="pass" placeholder="enter your password" required class="box">
            <input type="submit" name="submit" value="login now" class="btn">
            <p>don't have an account? <a href="registration.php" name = "register">register now</a></p>
        </form>

    </div>
</body>
</html>
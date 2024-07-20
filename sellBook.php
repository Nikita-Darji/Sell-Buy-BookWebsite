<?php

include 'config.php';

session_start();

$r_id = $_SESSION['r_id'];

if(isset($_POST['add_book'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $author = $_POST['author'];
    $detail = $_POST['detail'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = ''.$image;
 
    $select_product_name = mysqli_query($conn, "SELECT img_name FROM img WHERE img_name = '$name'") or die('query failed');
    if(mysqli_num_rows($select_product_name) > 0){
       $message[] = 'product name already added';
    }else{
       $add_product_query = mysqli_query($conn, "INSERT INTO img (r_id,img_name, price,author,detail, img) VALUES('$r_id','$name', '$price','$author','$detail', '$image')") or die('query failed');
 
       if($add_product_query){
          if($image_size > 2000000){
             $message[] = 'image size is too large';
 
          }else{
             move_uploaded_file($image_tmp_name, $image_folder);
          }
       }else{
          $message[] = 'product could not be added!';
       }
    }
 }

 if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT * FROM img WHERE img_id = '$delete_id'") or die('query failed');
    mysqli_query($conn, "DELETE FROM img WHERE img_id = '$delete_id'") or die('query failed');
    header('location:sellBook.php');
 }
 
 if(isset($_POST['back_home'])){
   header('location:home.php');
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
   <title>products</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="style.css">

   <script>
        function validateForm() {
            var name = document.forms["myForm"]["name"].value;
            var price = document.forms["myForm"]["price"].value;
            var author = document.forms["myForm"]["author"].value;
            var detail = document.forms["myForm"]["detail"].value;

            // Check if name is empty and contains only letters and spaces
            if (name.trim() == "" || !/^[a-zA-Z\s]+$/.test(name)) {
                alert("Book name must be filled out and contain only letters and spaces");
                return false;
            }

            // Check if price is empty or not a positive number
            if (price.trim() == "" || isNaN(price) || price <= 0) {
                alert("Price must be filled out and contain positive number");
                return false;
            }

            // Check if author name is empty and contains only letters and spaces
            if (author.trim() == "" || !/^[a-zA-Z\s]+$/.test(author)) {
                alert("Author name must be filled out and contain only letters and spaces");
                return false;
            }

            // // Check if detail is empty
            // if (detail.trim() == "" || !/^[a-zA-Z\s]+$/.test(detail)) {
            //     alert("Book description must be filled out ");
            //     return false;
            // }
         }
   </script>
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="add-products">
   <form name="myForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
      <h3>Add your Books </h3>
      <input type="text" name="name" class="box" placeholder="Enter Book name">
      <input type="number" min="0" name="price" class="box" placeholder="Enter Book price">
      <input type="text" name="author" class="box" placeholder="Enter author name">
      <textarea name="detail" class="box" placeholder="Book Description"></textarea>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
      <input type="submit" value="Add book" name="add_book" class="btn">
      <!-- <input type="submit" value="Submit" name="back_home" class="btn"> -->
   </form>
</section>

<!-- Books added  -->

<section class="show-products">

   <div class="box-container">

      <?php
         $select_books = mysqli_query($conn, "SELECT * FROM img where r_id ='$r_id'") or die('query failed');
         if(mysqli_num_rows($select_books) > 0){
            while($fetch_books = mysqli_fetch_assoc($select_books)){
      ?>
      <div class="box">
         <img src="<?php echo $fetch_books['img']; ?>" alt="">
         <div class="name"><?php echo $fetch_books['img_name']; ?></div>
         <div class="price">₹<?php echo $fetch_books['price']; ?>/-</div>
         <div class="price">Author:<?php echo $fetch_books['author']; ?></div>
         <div class="price">Description:<?php echo $fetch_books['detail']; ?></div>
         <a href="sellBook.php?delete=<?php echo $fetch_books['img_id']; ?>" class="dlt_btn">Delete</a>
      </div>
      <?php
         }
      }else{
         echo ' ';
      }
      ?>
   </div>

</section>
<?php include 'footer.php';?>

</body>
</html>
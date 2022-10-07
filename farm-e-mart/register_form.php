<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $contact = mysqli_real_escape_string($conn, $_POST['contact']);
   $user_type = $_POST['user_type'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = "INSERT INTO `user_form` (name, email, password, address,contact , user_type, image) VALUES('$name','$email','$pass','$address','$contact','$user_type', '$image')" or die('query failed');
         mysqli_query($conn, $insert);

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login_form.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">


</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>register now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="enter username" class="box" required>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
      <input type="text" name="address" placeholder="enter address" class="box" required>
      <input type="text" name="contact" placeholder="enter contact no." class="box" required>
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>
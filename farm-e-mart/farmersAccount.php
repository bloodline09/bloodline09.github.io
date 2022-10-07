<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login_form.php');
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/sitestyle.css">

</head>
<body>
<div class="header-2">

<nav class="navbar">
   <a href="farmersite.php">home</a>
   <a href="farmersite.php">category</a>
   <a href="farmersite.php">product</a>
   <a href="farmersite.php">contact</a>
   <a href="dashboard.php">Dashboard</a>
</nav>

</div>
<div class="container" id="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
      <h3><?php echo $fetch['name']; ?></h3>
      <div class="btns">
         <a href="update_profile.php" class="btn btn-space">update profile</a>
         <a href="mycart.php" class="btn btn-space">My Cart</a>
         <a href="logout.php" class="delete-btn btn-space">logout</a>
      </div>
      
   </div>

</div>

</body>
</html>
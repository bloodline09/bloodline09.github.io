<?php
    @include 'config.php';
    session_start();
$user_id = $_SESSION['user_id'];
if(isset($_POST['goback'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    
    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');
    
    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
    
        if($row['user_type'] == 'admin'){
    
            $_SESSION['user_id'] = $row['id'];
            header('location:farmersite.php');
    
        }elseif($row['user_type'] == 'user'){
    
            $_SESSION['user_id'] = $row['id'];
            header('location:customersite.php');
    
        }
}
        }
    if(!isset($user_id)){
        header('location:login_form.php');
    };
    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
        }
        
    if (isset($_GET["action"])){
        if ($_GET["action"] == "empty"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    $_SESSION["cart"] = [];
                }
            }
        }
    }
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
    <link rel="shortcut icon" type="image/jpg" href="images/icon.png">
    <link rel="stylesheet" href="css/cartstyle.css">
    <link rel="stylesheet" href="css/sitestyle.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
    <div style="clear: both"></div>
        <h3 class="title2">Receipt</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Product Name</th>
                    <th width="10%">Quantity</th>
                    <th width="13%">Price Details</th>
                    <th width="10%">Total Price</th>
                </tr>

                <?php
                    if(!empty($_SESSION["cart"])){
                        $total = 0;
                        foreach ($_SESSION["cart"] as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo $value["item_name"]; ?></td>
                                <td><?php echo $value["item_quantity"]; ?></td>
                                <td>₱ <?php echo $value["product_price"]; ?></td>
                                <td>₱ <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                            </tr>
                            <?php
                            $total = $total + ($value["item_quantity"] * $value["product_price"]);
                        }
                            ?>
                            <tr>
                                <td colspan="3" align="right">Total</td>
                                <th align="right">₱ <?php echo number_format($total, 2); ?></th>
                            </tr>
                            <?php
                        }
                ?>
            </table>
                <div class="form-container">

                    <form action="" method="post" enctype="multipart/form-data">
                    <?php
                    if(isset($message)){
                        foreach($message as $message){
                            echo '<div class="message">'.$message.'</div>';
                        }
                    }
                    ?>
                    <div class="info"><?php echo $fetch['name'];?></div>
                    <div class="info"><?php echo $fetch['address'];?></div>
                    <div class="info"><?php echo $fetch['contact'];?></div>
                    </form>

                </div>
            <a href="javascript:history.back(-1);" class="prev bp">Previous page</a>
            <a href="farmersite.php" class="goshop bp">Go to Shop</a>
            <a href="cod.php?action=empty&id=<?php echo $value["product_id"]; ?>" class="checkout bp" onclick="return confirm('thank you for shopping with us!')">Place Order</a>
            
            
        </div>
        <div class="note"> 
            note: if the stated info is wrong please go back and update your info at (my account > update profile), thank you.
        </div>
    </div>
</body>
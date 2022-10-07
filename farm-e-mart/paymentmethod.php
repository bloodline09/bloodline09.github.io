<?php
    @include 'config.php';
    session_start();
    $user_id = $_SESSION['user_id'];

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
        <h3 class="title2">Payment Method</h3>
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
            <div class="method">
                <a href="javascript:history.back(-1);" class="goback">Go Back</a>
                <a href="cod.php" class="cod">Cash on Delivery</a>
                <a href="card.php" class="card">Card</a>
            </div>
            
        </div>
    </div>
</body>

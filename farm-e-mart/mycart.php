<?php
    session_start();
    $database_name = "farm-e-martdb";
    $con = mysqli_connect("localhost","root","",$database_name);

    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){  
            $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="mycart.php"</script>';
            }else{
                echo '<script>window.location="mycart.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }
    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                }
            }
        }
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
        <h3 class="title2">Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Product Name</th>
                    <th width="10%">Quantity</th>
                    <th width="13%">Price Details</th>
                    <th width="10%">Total Price</th>
                    <th width="17%">Remove Item</th>
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
                                <td><a href="mycart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Remove Item</span></a></td>
                            </tr>
                            <?php
                            $total = $total + ($value["item_quantity"] * $value["product_price"]);
                        }
                            ?>
                            <tr>
                                <td colspan="3" align="right">Total</td>
                                <th align="right">₱ <?php echo number_format($total, 2); ?></th>
                                <td></td>
                            </tr>
                            <?php
                        }
                ?>
            </table>
            <a href="javascript:history.back(-1);" class="prev bp">Previous page</a>
            <a href="mycart.php?action=empty&id=<?php echo $value["product_id"]; ?>" class="remove bp">Remove All Item</a>
            <a href="paymentmethod.php" class="checkoutcart bp">Check Out</a>
        </div>
    </div>
</body>

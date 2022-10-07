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
                echo '<script>window.location="cveggies.php"</script>';
            }else{
                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="cveggies.php"</script>';
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
                    echo '<script>window.location="cveggies.php"</script>';
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm-E-Mart: Vegetables</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/sitestyle.css">
    <link rel="stylesheet" href="css/cartstyle.css">
    <link rel="shortcut icon" type="image/jpg" href="images/icon.png">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>

<!-- header section starts  -->

<header>

    <div class="header-1">

        <a href="customersite.php" class="logo"><i class="fas fa-shopping-basket"></i>Farm-E-Mart</a>

        <form action="" class="search-box-container">
            <input type="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </form>

    </div>

    <div class="header-2">

        <div id="menu-bar" class="fas fa-bars"></div>

        <nav class="navbar">
            <a href="customersite.php">home</a>
            <a href="#category">category</a>
            <a href="#product">product</a>
            <a href="#contact">contact</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="customerAccount.php">My Account</a>
        </nav>

    </div>

</header>

<!-- header section ends -->

<!-- category section starts  -->

<section class="category" id="category">

    <h1 class="heading">shop by <span>category</span></h1>

    <div class="box-container">

        <div class="box">
            <h3>vegetables </h3>
            <img src="images/category-1.png" alt="">
            <a href="cveggies.php" class="btn">shop now</a>
        </div>
        <div class="box">
            <h3>fruit</h3>
            <img src="images/category-4.png" alt="">
            <a href="cfruits.php" class="btn">shop now</a>
        </div>

    </div>

</section>

<!-- category section ends -->

<!-- product section starts  -->
<form action="mycart.php" method="post">
<div class="container" style="width: 65%">
    <h1 class="heading">latest <span>products</span></h1>
        <?php
            $query = "SELECT * FROM veggies ORDER BY id ASC ";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    ?>  
                    <div class="col-md-3">

                        <form method="post" action="?action=add&id=<?php echo $row["id"]; ?>">

                            <div class="product">
                                <img src="<?php echo $row["image"]; ?>" class="img-responsive">
                                <h5 class="text-info"><?php echo $row["pname"]; ?></h5>
                                <h5 class="text-danger">₱ <?php echo $row["price"]; ?>/kg</h5>
                                <input type="text" name="quantity" class="form-control" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Add to Cart">
                                <input type="submit" name="buy" style="margin-top: 5px;" class="btn btn-success" value="Buy now">
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
        ?>

<!-- product section ends -->


<!-- contact section starts  -->

<section class="contact" id="contact">

    <h1 class="heading"> <span>contact</span> us </h1>

    <form action="">

        <div class="inputBox">
            <input type="text" placeholder="name">
            <input type="email" placeholder="email">
            <input type="number" placeholder="number">
            <input type="text" placeholder="subject">
        </div>

        <textarea placeholder="message" name="" id="" cols="30" rows="10"></textarea>

        <input type="submit" value="send message" class="btn">

    </form>

</section>

<!-- contact section ends -->


<!-- custom js file link  -->
<script src="script.js"></script>
    
</body>
</html>
<?php
include 'db.php';

$id = $_GET['id'];

$query = $conn->query("SELECT * FROM products WHERE id=$id");

$product = $query->fetch_assoc();

if(!$product){
    die("Product not found");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $product['name']; ?> - Olivian Scent</title>

<link rel="stylesheet" href="home-contact.css">

</head>

<body>

<header class="topbar">

    <div class="wrap">

        <a href="index.php" class="logo">
            Olivian Scent
        </a>

        <nav class="nav-links">

            <a href="contact.php">Contact</a>

            <a href="cart.php">🛒</a>

        </nav>

    </div>

</header>


<div class="container">

    <h1 class="page-title">
        Product Details
    </h1>

    <div style="
    display:flex;
    gap:40px;
    align-items:flex-start;
    background:#fdfaf7;
    border:1px solid #ddd0c6;
    padding:30px;
    flex-wrap:wrap;
    ">

        <div>

            <img
            src="images/<?php echo $product['image']; ?>"
            alt="<?php echo $product['name']; ?>"

            style="
            width:320px;
            height:320px;
            object-fit:contain;
            border:1px solid #ddd;
            background:#fff;
            padding:10px;
            ">

        </div>


        <div style="max-width:540px;">

            <h2>
                <?php echo $product['name']; ?>
            </h2>

            <p class="price" style="font-size:20px;">

                <span style="
                color:black;
                font-weight:bold;
                ">

                    <?php echo $product['price']; ?> SAR

                </span>

            </p>

            <?php if($product['stock'] > 0){ ?>

            <p>
                <b>Stock:</b>
                <?php echo $product['stock']; ?>
            </p>

            <?php } else { ?>

            <p style="
            color:red;
            font-weight:bold;
            font-size:20px;
            ">

                Out of Stock

            </p>

            <?php } ?>


            <p style="
            margin-top:15px;
            line-height:1.8;
            ">

                <?php echo $product['description']; ?>

            </p>

            <div style="
            margin-top:20px;
            background:#fcf8f4;
            border:1px solid #ddd0c6;
            padding:12px;
            border-radius:4px;
            max-width:420px;
            ">

                <h3 style="
                margin-top:0;
                font-size:18px;
                margin-bottom:8px;
                ">

                    Help

                </h3>

                <?php if($product['stock'] > 0){ ?>

                <p style="
                margin:0;
                line-height:1.5;
                font-size:15px;
                font-family:Arial, sans-serif;
                color:#5f5751;
                ">

                    Select the quantity you want, then click “Add to Cart”.

                </p>

                <a href="contact.php"

                style="
                display:inline-block;
                margin-top:12px;
                background:#6b7079;
                color:white;
                padding:8px 16px;
                text-decoration:none;
                border-radius:4px;
                font-size:14px;
                ">

                    Need Help?

                </a>

                <?php } else { ?>

                <p style="
                margin:0;
                line-height:1.6;
                font-size:15px;
                font-family:Arial, sans-serif;
                color:#b22222;
                font-weight:bold;
                ">

                    This perfume is currently unavailable.

                </p>

                <p style="
                margin-top:8px;
                font-size:14px;
                font-family:Arial;
                color:#5f5751;
                ">

                    Please check again later.

                </p>

                <?php } ?>

            </div>

            <?php if($product['stock'] > 0){ ?>

            <form
            action="add_to_cart.php"
            method="get"

            style="margin-top:25px;">

                <label for="qty">
                    Quantity:
                </label>

                <br>

                <input
                id="qty"
                type="number"
                name="qty"
                value="1"
                min="1"
                max="<?php echo $product['stock']; ?>"

                style="
                padding:8px;
                width:90px;
                margin-top:8px;
                ">

                <input
                type="hidden"
                name="id"
                value="<?php echo $product['id']; ?>">

                <br><br>

                <button
                type="submit"
                class="btn"

                style="
                width:100%;
                border:none;
                cursor:pointer;
                ">

                    Add to Cart

                </button>

            </form>

            <?php } ?>

        </div>

    </div>

    <br>

    <a href="index.php"
    class="btn"

    style="
    width:100%;
    text-align:center;
    ">

        ← Back

    </a>

</div>

</body>
</html>
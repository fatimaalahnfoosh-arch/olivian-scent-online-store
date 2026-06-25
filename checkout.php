<?php
session_start();
include 'db.php';

if(isset($_SESSION['cart'])){

    foreach($_SESSION['cart'] as $id => $item){

        $qty = $item['qty'];

        $conn->query("UPDATE products
        SET stock = stock - $qty
        WHERE id = $id");

    }

}



$_SESSION['cart'] = [];



unset($_SESSION['discount']);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Checkout</title>

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


<div style="
max-width:700px;
margin:80px auto;
background:#fdfaf7;
border:1px solid #ddd0c6;
padding:50px;
text-align:center;
">

    <h1 style="margin-bottom:20px;">
        Order Confirmed
    </h1>

    <p style="
    font-size:18px;
    color:#5f5751;
    line-height:1.8;
    ">

        Thank you for shopping with Olivian Scent.

    </p>

    <br>

    <a href="index.php" class="btn">

        Continue Shopping

    </a>

</div>

</body>
</html>
<?php
session_start();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}


/* MODIFY QUANTITY */

if(isset($_POST['update_cart'])){

    $id = $_POST['id'];

    $new_qty = (int) $_POST['qty'];

    if($new_qty < 1){
        $new_qty = 1;
    }

    if($new_qty > $_SESSION['cart'][$id]['stock']){

        $new_qty = $_SESSION['cart'][$id]['stock'];
    }

    $_SESSION['cart'][$id]['qty'] = $new_qty;

    header("Location: cart.php");

    exit();
}



/* DISCOUNT */

$discount = 0;

if(isset($_POST['apply_coupon'])){

    $coupon = trim($_POST['coupon']);

    if($coupon == "olivian20"){

        $_SESSION['discount'] = 20;

    } else {

        $_SESSION['discount'] = 0;
    }
}

if(isset($_SESSION['discount'])){

    $discount = $_SESSION['discount'];
}



/* DELETE ITEM */

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    unset($_SESSION['cart'][$id]);
}



/* DELETE ALL */

if(isset($_GET['delete_all'])){

    $_SESSION['cart'] = [];

    unset($_SESSION['discount']);

    header("Location: cart.php");

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Shopping Cart</title>

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

<div class="cart-page">

    <h1 class="cart-title">
        Shopping Cart
    </h1>

    <?php if(empty($_SESSION['cart'])) { ?>

        <div style="
        max-width:600px;
        margin:60px auto;
        background:#fdfaf7;
        border:1px solid #ddd0c6;
        padding:40px;
        text-align:center;
        ">

            <h2>Your cart is empty</h2>

            <a href="index.php" class="btn">

                Start Shopping

            </a>

        </div>

    <?php } else { ?>

    <div class="cart-layout">

        <div class="cart-items">

            <?php
            $total = 0;

            foreach($_SESSION['cart'] as $id => $item){

            $total += $item['price'] * $item['qty'];
            ?>

            <div class="cart-item">

                <a href="product.php?id=<?php echo $id; ?>">

                    <img
                    src="images/<?php echo $item['image']; ?>"

                    style="
                    cursor:pointer;
                    ">

                </a>


                <div class="cart-item-details">

                    <h3>

                        <a
                        href="product.php?id=<?php echo $id; ?>"

                        style="
                        text-decoration:none;
                        color:inherit;
                        ">

                            <?php echo $item['name']; ?>

                        </a>

                    </h3>

                    <p>
                        <?php echo $item['price']; ?> SAR
                    </p>

                    <p style="
                    margin-top:15px;
                    font-family:Arial;
                    font-size:16px;
                    color:#444;
                    ">

                        Quantity:
                        <b><?php echo $item['qty']; ?></b>

                    </p>

                    <p style="
                    margin-top:8px;
                    font-size:13px;
                    color:#777;
                    font-family:Arial;
                    ">

                        Available stock:
                        <?php echo $item['stock']; ?>

                    </p>

                </div>


                <div class="cart-item-actions">

                    <div class="cart-actions">

                        <button

                        onclick="openModal(
                        <?php echo $id; ?>,
                        <?php echo $item['qty']; ?>,
                        <?php echo $item['stock']; ?>
                        )"

                        style="
                        display:inline-block;
                        padding:6px 12px;
                        border:1px solid #2e5e4e;
                        border-radius:4px;
                        color:#2e5e4e;
                        background:#fdfaf7;
                        font-size:13px;
                        font-family:Arial, sans-serif;
                        cursor:pointer;
                        ">

                            Modify

                        </button>

                        <a
                        href="cart.php?delete=<?php echo $id; ?>"
                        class="delete-btn">

                            Delete

                        </a>

                    </div>

                </div>

            </div>

            <?php } ?>

            <div style="margin-top:20px;">

                <a
                href="cart.php?delete_all=1"
                class="delete-btn">

                    Delete All

                </a>

            </div>

        </div>

        <div class="cart-summary">

            <h2>
                Summary
            </h2>

            <?php

            $final_total = $total;

            if($discount > 0){

                $final_total = $total - ($total * ($discount / 100));
            }
            ?>

            <div class="summary-row">

                <span>Total</span>

                <span>

                    <?php echo $final_total; ?> SAR

                </span>

            </div>


            <?php if($discount > 0){ ?>

            <p style="
            color:#2e5e4e;
            font-family:Arial;
            font-size:14px;
            margin-top:10px;
            ">

                Discount Applied:
                20% OFF

            </p>

            <?php } ?>

            <form method="POST" style="margin-top:20px;">

                <input
                type="text"
                name="coupon"
                placeholder="Discount Code"

                style="
                width:100%;
                padding:10px;
                border:1px solid #ccc;
                box-sizing:border-box;
                ">

                <button
                type="submit"
                name="apply_coupon"
                class="btn"

                style="
                border:none;
                cursor:pointer;
                ">

                    Apply Code

                </button>

            </form>


            <a href="checkout.php" class="btn">

                Buy

            </a>

        </div>

    </div>

    <?php } ?>

</div>


<div
id="qtyModal"

style="
display:none;
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.4);
justify-content:center;
align-items:center;
z-index:999;
">

    <div style="
    background:white;
    padding:30px;
    width:320px;
    border-radius:8px;
    text-align:center;
    ">

        <h3 style="margin-top:0;">
            Modify Quantity
        </h3>

        <form method="POST">

            <input
            type="hidden"
            name="id"
            id="modalProductId">

            <input
            type="number"
            name="qty"
            id="modalQty"
            min="1"

            style="
            width:100px;
            padding:10px;
            border:1px solid #ccc;
            text-align:center;
            ">

            <br><br>

            <button
            type="submit"
            name="update_cart"

            style="
            padding:10px 20px;
            background:#6b7079;
            color:white;
            border:none;
            border-radius:4px;
            cursor:pointer;
            ">

                Save

            </button>

            <button
            type="button"
            onclick="closeModal()"

            style="
            padding:10px 20px;
            margin-left:10px;
            background:#ddd;
            border:none;
            border-radius:4px;
            cursor:pointer;
            ">

                Cancel

            </button>

        </form>

    </div>

</div>


<script>

function openModal(id, qty, stock){

    document.getElementById("qtyModal").style.display = "flex";

    document.getElementById("modalProductId").value = id;

    let qtyInput = document.getElementById("modalQty");

    qtyInput.value = qty;

    qtyInput.min = 1;

    qtyInput.max = stock;
}

function closeModal(){

    document.getElementById("qtyModal").style.display = "none";
}

</script>

</body>
</html>
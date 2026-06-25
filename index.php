<?php
include 'db.php';

$Women = $conn->query("SELECT * FROM products WHERE category='Women'");
$Men = $conn->query("SELECT * FROM products WHERE category='Men'");
$Hair = $conn->query("SELECT * FROM products WHERE category='Hair'");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Olivian Scent</title>

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



<div class="hero-full">

    <div class="hero">

        <img
        src="images/offers2.png"
        class="hero-img"
        alt="Offers">

    </div>

</div>



<div class="container">


    <!-- WOMEN -->

    <h2 class="section-title">
        Women Perfumes
    </h2>

    <div class="products-grid">

        <?php while($row = $Women->fetch_assoc()) { ?>

        <div class="card">

            <a href="product.php?id=<?php echo $row['id']; ?>">

                <div style="position:relative;">

                <?php if($row['stock'] <= 0){ ?>

                    <span style="
                    position:absolute;
                    top:10px;
                    left:10px;
                    background:#b22222;
                    color:white;
                    padding:6px 12px;
                    font-size:12px;
                    font-family:Arial;
                    font-weight:bold;
                    z-index:10;
                    border-radius:4px;
                    ">

                        OUT OF STOCK

                    </span>

                <?php } ?>

                <img
                src="images/<?php echo $row['image']; ?>"
                alt="<?php echo $row['name']; ?>"

                style="
                width:100%;

                <?php if($row['stock'] <= 0){ ?>
                filter: grayscale(100%) opacity(60%);
                <?php } ?>
                ">

                </div>

            </a>


            <div class="card-body">

                <h3>

                    <a href="product.php?id=<?php echo $row['id']; ?>">

                        <?php echo $row['name']; ?>

                    </a>

                </h3>


                <p class="price">

                    <span style="
                    color:black;
                    font-weight:bold;
                    ">

                        <?php echo $row['price']; ?> SAR

                    </span>

                </p>

            </div>


            <?php if($row['stock'] > 0){ ?>

            <div class="add-cart">

                <a href="add_to_cart.php?id=<?php echo $row['id']; ?>">

                    Add to Cart

                </a>

            </div>

            <?php } ?>

        </div>

        <?php } ?>

    </div>



    <!-- MEN -->

    <h2 class="section-title">
        Men Perfumes
    </h2>

    <div class="products-grid">

        <?php while($row = $Men->fetch_assoc()) { ?>

        <div class="card">

            <a href="product.php?id=<?php echo $row['id']; ?>">

                <div style="position:relative;">

                <?php if($row['stock'] <= 0){ ?>

                    <span style="
                    position:absolute;
                    top:10px;
                    left:10px;
                    background:#b22222;
                    color:white;
                    padding:6px 12px;
                    font-size:12px;
                    font-family:Arial;
                    font-weight:bold;
                    z-index:10;
                    border-radius:4px;
                    ">

                        OUT OF STOCK

                    </span>

                <?php } ?>

                <img
                src="images/<?php echo $row['image']; ?>"
                alt="<?php echo $row['name']; ?>"

                style="
                width:100%;

                <?php if($row['stock'] <= 0){ ?>
                filter: grayscale(100%) opacity(60%);
                <?php } ?>
                ">

                </div>

            </a>


            <div class="card-body">

                <h3>

                    <a href="product.php?id=<?php echo $row['id']; ?>">

                        <?php echo $row['name']; ?>

                    </a>

                </h3>


                <p class="price">
                    <span style="
                    color:black;
                    font-weight:bold;
                    ">

                        <?php echo $row['price']; ?> SAR

                    </span>

                </p>

            </div>


            <?php if($row['stock'] > 0){ ?>

            <div class="add-cart">

                <a href="add_to_cart.php?id=<?php echo $row['id']; ?>">

                    Add to Cart

                </a>

            </div>

            <?php } ?>

        </div>

        <?php } ?>

    </div>



    <!-- HAIR -->

    <h2 class="section-title">
        Hair Perfumes
    </h2>

    <div class="products-grid">

        <?php while($row = $Hair->fetch_assoc()) { ?>

        <div class="card">

            <a href="product.php?id=<?php echo $row['id']; ?>">

                <div style="position:relative;">

                <?php if($row['stock'] <= 0){ ?>

                    <span style="
                    position:absolute;
                    top:10px;
                    left:10px;
                    background:#b22222;
                    color:white;
                    padding:6px 12px;
                    font-size:12px;
                    font-family:Arial;
                    font-weight:bold;
                    z-index:10;
                    border-radius:4px;
                    ">

                        OUT OF STOCK

                    </span>

                <?php } ?>

                <img
                src="images/<?php echo $row['image']; ?>"
                alt="<?php echo $row['name']; ?>"

                style="
                width:100%;

                <?php if($row['stock'] <= 0){ ?>
                filter: grayscale(100%) opacity(60%);
                <?php } ?>
                ">

                </div>

            </a>


            <div class="card-body">

                <h3>

                    <a href="product.php?id=<?php echo $row['id']; ?>">

                        <?php echo $row['name']; ?>

                    </a>

                </h3>


                <p class="price">
                    <span style="
                    color:black;
                    font-weight:bold;
                    ">

                        <?php echo $row['price']; ?> SAR

                    </span>

                </p>

            </div>


            <?php if($row['stock'] > 0){ ?>

            <div class="add-cart">

                <a href="add_to_cart.php?id=<?php echo $row['id']; ?>">

                    Add to Cart

                </a>

            </div>

            <?php } ?>

        </div>

        <?php } ?>

    </div>

</div>



<div class="footer-nav">

    <a href="contact.php">Contact</a>

    <a href="admin_login.php">Admin</a>

</div>

</body>
</html>
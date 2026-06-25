<?php
session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php?error=unauthorized");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home - Olivian Scent</title>

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

            <a href="logout.php">Logout</a>

        </nav>

    </div>

</header>

<div class="container">

    <h1 class="page-title">
        Admin Dashboard
    </h1>
    <p> Manage your perfume store from one place.</p>

    <p class="page-subtitle"
    style="
    text-align:center;
    margin-bottom:50px;
    ">
    </p>

    <div

    style="
    display:flex;
    justify-content:center;
    align-items:center;
    gap:70px;
    flex-wrap:wrap;
    width:100%;
    ">


        <div class="card"

        style="
        width:430px;
        min-height:
        ">

            <h3>
                Add Product
            </h3>

            <p class="price">
                Add a new perfume with image, price, stock, and description.
            </p>

            <div class="add-cart">
                <a href="admin_add.php">

                    Go to Add

                </a>

            </div>

        </div>


        <div class="card"

       style="
        width:430px;
        min-height:
        ">

            <h3>
                Modify / Delete
            </h3>

            <p class="price">
                Update product details or remove any product.
            </p>

            <div class="add-cart">

                <a href="admin_manage.php">

                    Manage Products

                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>
```

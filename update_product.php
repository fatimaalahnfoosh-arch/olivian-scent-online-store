<?php
session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php");

    exit();
}
?>

<?php
include 'db.php';

$id = $_GET['id'];

$product = $conn->query("
SELECT * FROM products
WHERE id=$id
");

$row = $product->fetch_assoc();

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $conn->query("
    UPDATE products SET

    name='$name',
    price='$price',
    stock='$stock',
    category='$category',
    description='$description'

    WHERE id=$id
    ");

    header("Location: admin_manage.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Update Product</title>

<link rel="stylesheet" href="home-contact.css">

</head>

<body>

<header class="topbar">

    <div class="wrap">

        <a href="index.php" class="logo">
            Olivian Scent
        </a>

        <nav class="nav-links">

            <a href="admin_home.php">
                Dashboard
            </a>

            <a href="logout.php">
                Logout
            </a>

        </nav>

    </div>

</header>


<div class="container">

    <h1 class="page-title">
        Update Product
    </h1>


    <form method="POST"

    style="
    max-width:600px;
    margin:auto;
    background:#fdfaf7;
    border:1px solid #ddd0c6;
    padding:35px;
    border-radius:6px;
    ">

        <label style="
        display:block;
        margin-bottom:8px;
        font-family:Arial, sans-serif;
        font-size:14px;
        font-weight:bold;
        color:#5a524d;
        ">

            Perfume Name

        </label>

        <input
        type="text"
        name="name"

        value="<?php echo $row['name']; ?>"

        style="
        width:100%;
        padding:12px;
        margin-bottom:20px;
        border:1px solid #d5ccc5;
        ">

        <label style="
        display:block;
        margin-bottom:8px;
        font-family:Arial, sans-serif;
        font-size:14px;
        font-weight:bold;
        color:#5a524d;
        ">

            Price

        </label>

        <input
        type="number"
        name="price"

        value="<?php echo $row['price']; ?>"

        style="
        width:100%;
        padding:12px;
        margin-bottom:20px;
        border:1px solid #d5ccc5;
        ">

        <label style="
        display:block;
        margin-bottom:8px;
        font-family:Arial, sans-serif;
        font-size:14px;
        font-weight:bold;
        color:#5a524d;
        ">

            Stock

        </label>

        <input
        type="number"
        name="stock"

        value="<?php echo $row['stock']; ?>"

        style="
        width:100%;
        padding:12px;
        margin-bottom:20px;
        border:1px solid #d5ccc5;
        ">

        <label style="
        display:block;
        margin-bottom:8px;
        font-family:Arial, sans-serif;
        font-size:14px;
        font-weight:bold;
        color:#5a524d;
        ">

            Category

        </label>

        <input
        type="text"
        name="category"

        value="<?php echo $row['category']; ?>"

        style="
        width:100%;
        padding:12px;
        margin-bottom:20px;
        border:1px solid #d5ccc5;
        ">

        <label style="
        display:block;
        margin-bottom:8px;
        font-family:Arial, sans-serif;
        font-size:14px;
        font-weight:bold;
        color:#5a524d;
        ">

            Description

        </label>

        <textarea
        name="description"

        style="
        width:100%;
        padding:12px;
        margin-bottom:25px;
        height:140px;
        border:1px solid #d5ccc5;
        resize:none;
        "><?php echo $row['description']; ?></textarea>


        <button
        name="update"

        style="
        display:block;
        width:100%;
        max-width:350px;
        margin:0 auto;
        background:#6b7079;
        color:white;
        padding:14px;
        border:none;
        font-size:15px;
        cursor:pointer;
        border-radius:4px;
        ">

            Update Product

        </button>


        <a
        href="admin_manage.php"

        style="
        display:block;
        width:100%;
        max-width:350px;
        margin:15px auto 0;
        text-align:center;
        padding:12px;
        border:1px solid #aaa;
        color:#555;
        text-decoration:none;
        border-radius:4px;
        font-family:Arial, sans-serif;
        ">

            ← Back

        </a>

    </form>

</div>

</body>
</html>
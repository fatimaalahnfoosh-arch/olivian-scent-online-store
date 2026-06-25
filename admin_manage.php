<?php
session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php?error=unauthorized");
    exit();
}
?>
<?php
include 'db.php';

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];

    $products = $conn->query("
        SELECT * FROM products
        WHERE name LIKE '%$search%'
    ");
}
else{
    $products = $conn->query("SELECT * FROM products");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="home-contact.css">
</head>
<body>

<header class="topbar">
    <div class="wrap">

        <a href="index.php" class="logo">
    Olivian Scent
</a>
        <nav class="nav-links">
            <a href="admin_home.php">Dashboard</a>
            <a href="contact.php">Contact</a>
            <a href="logout.php">Logout</a>
        </nav>

    </div>
</header>


<div class="container">

    <h1 class="page-title">
        Manage Products
    </h1>


    <form method="GET" style="margin-bottom:40px; text-align:center;">

        <input type="text"
        name="search"
        placeholder="Search product..."
        value="<?php echo $search; ?>"

        style="
        width:300px;
        padding:12px;
        border:1px solid #ccc;
        ">

        <button class="btn" style="padding:12px 20px;">
            Search
        </button>

    </form>


    <table style="
    width:100%;
    border-collapse:collapse;
    background:white;
    ">

        <tr style="background:black; color:white;">

            <th style="padding:15px;">Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Actions</th>

        </tr>


        <?php while($row = $products->fetch_assoc()) { ?>

        <tr style="text-align:center; border-bottom:1px solid #ddd;">

            <td style="padding:15px;">

                <img
                src="images/<?php echo $row['image']; ?>"
                width="80">

            </td>


            <td>
                <?php echo $row['name']; ?>
            </td>


            <td>
                <?php echo $row['price']; ?> SAR
            </td>


            <td>
                <?php echo $row['category']; ?>
            </td>


            <td>

                <a
                href="update_product.php?id=<?php echo $row['id']; ?>"

                style="
                background:#444;
                color:white;
                padding:8px 14px;
                text-decoration:none;
                margin-right:10px;
                ">
                Update
                </a>


                <a
                href="delete_product.php?id=<?php echo $row['id']; ?>"

                onclick="return confirm('Are you sure you want to delete this product?')"

                style="
                background:#8b0000;
                color:white;
                padding:8px 14px;
                text-decoration:none;
                ">
                Delete
                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
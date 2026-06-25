<?php
session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php?error=unauthorized");
    exit();
}

include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $target = "images/" . basename($image);

    if (move_uploaded_file($tmp, $target)) {

        $sql = "INSERT INTO products
        (name, price, stock, image, category, description)

        VALUES
        ('$name', '$price', '$stock', '$image', '$category', '$description')";

        if ($conn->query($sql) === TRUE) {

            $message = "Product added successfully!";

        } else {

            $message = "Error: " . $conn->error;
        }

    } else {

        $message = "Image upload failed.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="home-contact.css">

    <style>
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .form-group.error input,
        .form-group.error select,
        .form-group.error textarea {
            border: 2px solid red;
        }

        .error-message {
            color: red;
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }
    </style>
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

            <a href="contact.php">
                Contact
            </a>

            <a href="logout.php">
                Logout
            </a>

        </nav>

    </div>

</header>

<div class="container">

    <h1 class="page-title">Add Product</h1>

    <?php if ($message != "") { ?>
        <p style="text-align:center; color:green;"><?php echo $message; ?></p>
    <?php } ?>

    <div style="max-width:500px; margin:40px auto; background:#fdfaf7; border:1px solid #ddd0c6; padding:30px;">

        <form method="POST" enctype="multipart/form-data" id="addProductForm">

            <div class="form-group" id="nameGroup">
                <label>Name</label>
                <input type="text" name="name" id="name">
                <span class="error-message" id="nameError"></span>
            </div>

            <div class="form-group" id="priceGroup">
                <label>Price</label>
                <input type="number" step="0.01" name="price" id="price">
                <span class="error-message" id="priceError"></span>
            </div>

            <div class="form-group" id="stockGroup">
                <label>Stock</label>
                <input type="number" name="stock" id="stock">
                <span class="error-message" id="stockError"></span>
            </div>

            <div class="form-group" id="categoryGroup">
                <label>Category</label>

                <select name="category" id="category">
                    <option value="Women">Women</option>
                    <option value="Men">Men</option>
                    <option value="Hair">Hair</option>
                </select>

            </div>

            <div class="form-group" id="descriptionGroup">
                <label>Description</label>
                <textarea name="description" id="description"></textarea>
                <span class="error-message" id="descriptionError"></span>
            </div>

            <div class="form-group" id="imageGroup">
                <label>Image</label>
                <input type="file" name="image" id="image">
                <span class="error-message" id="imageError"></span>
            </div>

            <button class="btn" type="submit" style="width:100%;">
                Add Product
            </button>

        </form>

    </div>

</div>


<script>

// Run validation after page loads
window.addEventListener("load", start);

// Start validation functions
function start() {

    const form = document.getElementById("addProductForm");

    const fields = ["name", "price", "stock", "description", "image"];

    // Show error message and red border
    function showError(fieldId, message) {

        document.getElementById(fieldId + "Group")
        .classList.add("error");

        document.getElementById(fieldId + "Error")
        .textContent = message;
    }

    // Remove error message and border
    function clearError(fieldId) {

        document.getElementById(fieldId + "Group")
        .classList.remove("error");

        document.getElementById(fieldId + "Error")
        .textContent = "";
    }

    // Validate each field
    function validateField(fieldId) {

        const field = document.getElementById(fieldId);

        const value = field.value.trim();

        clearError(fieldId);

        if (fieldId === "name" && value === "") {

            showError("name", "Please enter product name.");

            return false;
        }

        if (fieldId === "price") {

            if (value === "") {

                showError("price", "Please enter product price.");

                return false;
            }

            if (Number(value) <= 0) {

                showError("price", "Price must be greater than 0.");

                return false;
            }
        }

        if (fieldId === "stock") {

            if (value === "") {

                showError("stock", "Please enter stock quantity.");

                return false;
            }

            if (Number(value) < 0) {

                showError("stock", "Stock cannot be negative.");

                return false;
            }
        }

        if (fieldId === "description" && value === "") {

            showError("description", "Please enter product description.");

            return false;
        }

        if (fieldId === "image" && value === "") {

            showError("image", "Please upload product image.");

            return false;
        }

        return true;
    }

    fields.forEach(function (fieldId) {

        const field = document.getElementById(fieldId);

        field.addEventListener("input", function () {

            validateField(fieldId);

        });

        field.addEventListener("change", function () {

            validateField(fieldId);

        });

    });

    // Prevent submit if fields are invalid
    form.addEventListener("submit", function (e) {

        let valid = true;

        fields.forEach(function (fieldId) {

            if (!validateField(fieldId)) {

                valid = false;
            }

        });

        if (!valid) {

            e.preventDefault();
        }
    });

}

</script>

</body>
</html>
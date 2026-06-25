<?php
session_start();
include 'db.php';

$id = $_GET['id'];
$qty = $_GET['qty'] ?? 1;


$query = $conn->query("SELECT * FROM products WHERE id=$id");

$product = $query->fetch_assoc();


if($qty > $product['stock']){

    echo "

    <div style='
    max-width:600px;
    margin:100px auto;
    background:#fdfaf7;
    border:1px solid #ddd0c6;
    padding:40px;
    text-align:center;
    font-family:Arial;
    '>

        <h2>
            Quantity exceeds available stock
        </h2>

        <p style='margin-top:15px; color:#5f5751;'>

            Available stock:
            ".$product['stock']."

        </p>

        <br>

        <a href='javascript:history.back()'

        style='
        background:#6b7079;
        color:white;
        padding:12px 25px;
        text-decoration:none;
        border-radius:4px;
        '>

            Back

        </a>

    </div>

    ";

    exit();
}


if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}


$_SESSION['cart'][$id] = [

    "name" => $product['name'],
    "price" => $product['price'],
    "image" => $product['image'],
    "qty" => $qty,
    "stock" => $product['stock']

];

header("Location: cart.php");
exit();
?>
<?php

$conn = new mysqli("localhost", "root", "", "olivian_scent", 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<?php
session_start();

$error = "";

if(isset($_GET['error']) && !isset($_POST['login'])){

    $error = "Unauthorized Access. Please login first.";

}

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "1234"){

        $_SESSION['admin'] = $username;

        header("Location: admin_home.php");
        exit();

    } else {

        $error = "Wrong username or password";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Login - Olivian Scent</title>

<link rel="stylesheet" href="home-contact.css">

</head>

<body>

<header class="topbar">

    <div class="wrap">

        <a href="index.php" class="logo">
            Olivian Scent
        </a>

        <nav class="nav-links">

            <a href="contact.php">
                Contact
            </a>

        </nav>

    </div>

</header>


<div class="container">

    <h1 class="page-title"

    style="
    text-align:center;
    margin-bottom:35px;
    ">

        Admin Login

    </h1>


    <div style="
    max-width:400px;
    margin:0 auto;
    background:#fdfaf7;
    border:1px solid #ddd0c6;
    padding:30px;
    text-align:center;
    ">


    <form
    method="POST"
    name="loginForm"
    onsubmit="return validateLoginForm()">

        <p
        id="validationError"

        style="
        color:red;
        margin-bottom:15px;
        font-family:Arial;
        font-size:14px;
        text-align:left;
        display:none;
        ">
        </p>


        <?php if($error != "") { ?>

            <p style="
            color:red;
            margin-bottom:15px;
            font-family:Arial;
            text-align:left;
            ">

                <?php echo $error; ?>

            </p>

        <?php } ?>


        <label style="
        display:block;
        text-align:left;
        margin-bottom:8px;
        font-family:Arial;
        font-size:14px;
        font-weight:bold;
        color:#5a524d;
        ">

            Username

        </label>


        <input
        type="text"
        name="username"
        placeholder="Enter username"

        style="
        width:100%;
        box-sizing:border-box;
        padding:12px;
        margin-bottom:18px;
        border:1px solid #ccc;
        border-radius:4px;
        ">


        <label style="
        display:block;
        text-align:left;
        margin-bottom:8px;
        font-family:Arial;
        font-size:14px;
        font-weight:bold;
        color:#5a524d;
        ">

            Password

        </label>


        <input
        type="password"
        name="password"
        placeholder="Enter password"

        style="
        width:100%;
        box-sizing:border-box;
        padding:12px;
        margin-bottom:25px;
        border:1px solid #ccc;
        border-radius:4px;
        ">

        <button
        class="btn"
        name="login"

        style="
        display:block;
        width:100%;
        max-width:250px;
        margin:0 auto;
        border:none;
        cursor:pointer;
        ">

            Login

        </button>

    </form>

    </div>

</div>


<script>

function validateLoginForm(){

    let username =
    document.forms["loginForm"]["username"].value.trim();

    let password =
    document.forms["loginForm"]["password"].value.trim();

    let error =
    document.getElementById("validationError");

    error.style.display = "block";



    if(username == ""){

        error.innerHTML =
        "Username field is required.";

        return false;
    }


    let usernamePattern = /^[A-Za-z]+$/;

    if(!username.match(usernamePattern)){

        error.innerHTML =
        "Username must contain letters only.";

        return false;
    }



    if(password == ""){

        error.innerHTML =
        "Password field is required.";

        return false;
    }


    let passwordPattern = /^[0-9]+$/;

    if(!password.match(passwordPattern)){

        error.innerHTML =
        "Password must contain numbers only.";

        return false;
    }


    error.style.display = "none";

    return true;
}

</script>

</body>
</html>
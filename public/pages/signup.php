<?php
require_once __DIR__.'/../../app/controller/shared.php';
if(isset($_SESSION['userId'])){
    header('location: ../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Auteur" content="Hicham">
    <meta name="Description"
          content="DevCulture.com is a platform that would focus exclusively on articles and posts related to the culture of software development. It would be a community-driven platform where software developers can share their knowledge, experiences, and insights through written content, such as articles and blog posts.">
    <title>Sign up</title>
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/vendor.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f1ec">
<header class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php">Culture Dev</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../index.php">Contact Us</a>
                </li>
            </ul>
            <div>
                <a href="login.php" class="btn btn-outline-secondary btn-sm">LOGIN</a>
                <a href="signup.html" class="btn btn-secondary btn-sm">SIGN UP</a>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="p-5 shadow rounded bg-white" style="width: min(100%, 600px)">
            <form action="../../index.php" method="post" class="text-start" >
                <h4>SIGN UP</h4>
                <h6 class="mb-4">Welcome to Culture Dev</h6>
                <input type="text" class="form-control mt-3" placeholder="First Name" name="first_name">
                <input type="text" class="form-control mt-3" placeholder="Last Name" name="last_name">
                <input type="text" class="form-control mt-3" placeholder="Email" name="email">
                <div class="input-group mt-3 position-relative">
                    <input id="signup-pass" type="password" class="form-control" name="pass" placeholder="Password">
                    <span class="input-group-text" onclick="togglePassword('signup-pass')"><i id="iconPassword" class="fa fa-eye"></i></span>
                </div>
                <div class="d-flex justify-content-center my-4">
                    <button name="signup" class="btn btn-success w-50">SIGN UP</button>
                </div>
                <p class="text-center fw-w300">Already have an account ? <a href="login.php" class="text-success">LOGIN</a>
                </p>
            </form>
        </div>
    </div>
</main>

<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>
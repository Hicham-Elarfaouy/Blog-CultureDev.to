<?php
require_once __DIR__.'/../../app/controller/shared.php';
if(!isset($_SESSION['userId'])){
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
    <title>DashBoard</title>
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/vendor.min.css" rel="stylesheet">
    <link href="../assets/css/parsley_css.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<header class="navbar navbar-expand-lg bg-header">
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
                    <a class="nav-link" href="./statistics.php">Statistics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./posts.php">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./categorie.php">Categories</a>
                </li>
            </ul>
            <div class="navbar-item navbar-user dropdown">
                <div style="cursor: pointer" class="navbar-link dropdown-toggle d-flex align-items-center"
                     data-bs-toggle="dropdown">
                            <span>
                                <span class="me-1 text-uppercase"><?= $_SESSION['userName'] ?></span>
                                <b class="caret"></b>
                            </span>
                </div>
                <div class="dropdown-menu me-1 dropdown-menu-lg-end">
                    <a href="statistics.php" class="dropdown-item">DashBoard</a>
                    <div class="dropdown-divider"></div>
                    <a href="../../app/controller/logout.php" class="dropdown-item">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</header>
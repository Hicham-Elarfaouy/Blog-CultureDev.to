<?php
require_once './app/controller/shared.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Auteur" content="Hicham">
    <meta name="Description"
          content="DevCulture.com is a platform that would focus exclusively on articles and posts related to the culture of software development. It would be a community-driven platform where software developers can share their knowledge, experiences, and insights through written content, such as articles and blog posts.">
    <title>Culture Dev.to</title>
    <link href="public/assets/css/style.css" rel="stylesheet">
    <link href="public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/assets/css/vendor.min.css" rel="stylesheet">
</head>
<body>
<header class="navbar navbar-expand-lg bg-header">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Culture Dev</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Contact Us</a>
                </li>
            </ul>
            <?php if (isset($_SESSION['userId'])): ?>
            <div class="navbar-item navbar-user dropdown">
                <div style="cursor: pointer" class="navbar-link dropdown-toggle d-flex align-items-center"
                     data-bs-toggle="dropdown">
                            <span>
                                <span class="me-1 text-uppercase"><?= $_SESSION['userName']?></span>
                                <b class="caret"></b>
                            </span>
                </div>
                <div class="dropdown-menu me-1 dropdown-menu-lg-end">
                    <a href="./public/dashboard/statistics.php" class="dropdown-item">DashBoard</a>
                    <div class="dropdown-divider"></div>
                    <a href="./app/controller/logout.php" class="dropdown-item">Log Out</a>
                </div>
            </div>
            <?php else: ?>
            <div>
                <a href="public/pages/login.php" class="btn btn-outline-secondary btn-sm">LOGIN</a>
                <a href="public/pages/signup.php" class="btn btn-secondary btn-sm">SIGN UP</a>
            </div>
            <?php endif ?>
        </div>
    </div>
</header>
<main>
    <div class="row mx-2 my-5">
        <div class=" d-none d-md-block col-lg-3 col-md-3">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <a href="index.php" class="link-light">All Categories</a>
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                    foreach (get_cat() as $cat){
                        echo "<a href='index.php?cat=$cat[id]' class='list-group-item'>$cat[name]</a>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-md-9">
            <div class="col-md-4 col-sm-6">
                <form>
                    <div class="input-group">
                        <input type="text" id="search" class="form-control" placeholder="Search..."
                               value="<?= $_GET['search'] ?? '' ?>"/>
                        <button type="button" onclick="searchPost()" class="input-group-text"><i
                                    class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="row g-3 mt-1 justify-content-center justify-content-md-start">
                <?php
                $cat = isset($_GET['cat']) ? "WHERE c.id = $_GET[cat]" : '';
                $search = isset($_GET['search']) ? "WHERE (p.title LIKE ('%$_GET[search]%') OR p.description LIKE ('%$_GET[search]%') OR c.name LIKE ('%$_GET[search]%'))" : '';
                foreach (get_post("$cat $search") as $post){
                    $image = $post['image'] != '' ? $post['image'] : 'default.jpg';
                    echo "
                    <div class='col-xl-3 col-lg-4 col-md-6 col-sm-8'>
                        <div class='card'>
                            <a target='_blank' href='./public/pages/post.php?post_id=$post[id]'>
                                <img src='./public/assets/images/posts/$image' class='card-img-top align-self-center'
                                     style='height: 150px; object-fit: cover'>
                            </a>
                            <div class='card-body'>
                                <h6 class='card-text post-title'>$post[title]</h6>
                                <span style='font-size: 10px' class='bg-danger rounded p-1 text-white'>#$post[cat]</span>
                                <p class='mb-0 post-description fw-w300'>$post[description]</p>
                            </div>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </div>
    </div>
</main>

<script src="public/assets/js/popper.min.js"></script>
<script src="public/assets/js/bootstrap.min.js"></script>
<script src="public/assets/js/script.js"></script>
</body>
</html>
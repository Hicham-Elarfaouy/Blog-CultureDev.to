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
            <!--<?php
            if (isset($_SESSION['user'])) {
                $name = $_SESSION['user'][1].' '.$_SESSION['user'][2];
                echo '-->
            <div class="navbar-item navbar-user dropdown">
                <div style="cursor: pointer" class="navbar-link dropdown-toggle d-flex align-items-center"
                     data-bs-toggle="dropdown">
                            <span>
                                <span class="me-1">HICHAM</span>
                                <b class="caret"></b>
                            </span>
                </div>
                <div class="dropdown-menu me-1 dropdown-menu-lg-end">
                    <a href="statistics.php" class="dropdown-item">DashBoard</a>
                    <div class="dropdown-divider"></div>
                    <a href="../../app/controller/logout.php" class="dropdown-item">Log Out</a>
                </div>
            </div><!--';
            } else {
                echo '-->
<!--            <div>-->
<!--                <a href="login.php" class="btn btn-outline-secondary btn-sm">LOGIN</a>-->
<!--                <a href="signup.php" class="btn btn-secondary btn-sm">SIGN UP</a>-->
<!--            </div>-->
            <!--';
            }
            ?>-->
        </div>
    </div>
</header>
<main>
    <div class="card shadow my-5 container">
        <div class="d-sm-flex align-items-center justify-content-between m-4 mb-2">
            <h1 class="h5 mb-0">Posts</h1>
            <button onclick="openModal()" class="btn btn-sm shadow-sm bg-success text-white"><i class="fa-solid fa-plus fa-md"></i>
                Add Post
            </button>
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive fw-w300">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Categorie</th>
                        <th>Date</th>
                        <th>Auteur</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach (get_post() as $post){
                        $image = $post['image'] != '' ? $post['image'] : 'default.jpg';
                        echo "
                            <tr class='align-middle'>
                                <td>
                                    <img src='../assets/images/posts/$image' class='rounded' style='width: 40px; height: 40px;'>
                                </td>
                                <td class='text-truncate' style='max-width: 200px;'>$post[title]</td>
                                <td>$post[cat]</td>
                                <td>$post[date]</td>
                                <td>$post[auteur]</td>
                                <td class='text-truncate' style='max-width: 200px;'>$post[description]</td>
                                <td>
                                    <div class='d-flex justify-content-around'>
                                        <i role='button' onclick='openEditPost($post[id])' class='fa-solid fa-pen-to-square text-primary'></i>
                                        <i role='button' onclick='deleteItem($post[id], `delete_post`)' class='fa-solid fa-trash-can text-danger ms-3'></i>
                                    </div>
                                </td>
                            </tr>
                            ";
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Categorie</th>
                        <th>Date</th>
                        <th>Auteur</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</main>

<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../../index.php" method="POST" id="form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="post-id" id="post-id">
                    <input type="text" name="post-auteur" id="post-auteur" value="<?=$_SESSION['userId']?>">
                    <div class="mb-3">
                        <label class="form-label" for="post-img">Image</label>
                        <input id="post-img" type="file" class="form-control" name="post-img" accept="image/png, image/jpeg">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="post-title">Title</label>
                        <input id="post-title" type="text" class="form-control" name="post-title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="post-cat">Categorie</label>
                        <select class="form-control form-select" id="post-cat" name="post-cat">
                            <?php
                            foreach (get_cat() as $cat) {
                                echo "<option value='$cat[id]'>$cat[name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label" for="post-desc">Description</label>
                        <textarea class="form-control" rows="5" id="post-desc" name="post-desc"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-white" data-bs-dismiss="modal">Cancel</a>
                    <button type="submit" name="update_post" class="btn btn-warning" id="modal-update-btn">Update
                    </button>
                    <button type="submit" name="save_post" class="btn btn-primary" id="modal-save-btn">Save
                    </button>
                    <button type="button" name="multi_post" onclick="saveMultiPost()" class="btn btn-primary" id="modal-multi-btn">New Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
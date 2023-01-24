<?php
require_once './header.php';
?>

    <main>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="d-flex justify-content-center">
                <div class="alert alert-secondary alert-dismissible fade show mt-5 w-50">
                    <strong>Message : </strong>
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            </div>
        <?php endif ?>
        <div class="card shadow my-5 container">
            <div class="d-sm-flex align-items-center justify-content-between m-4 mb-2">
                <h1 class="h5 mb-0">Posts</h1>
                <button onclick="openModal()" class="btn btn-sm shadow-sm bg-success text-white"><i
                            class="fa-solid fa-plus fa-md"></i>
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
                        foreach (get_post() as $post) {
                            $image = $post['image'] != '' ? $post['image'] : 'default.jpg';
                            echo "
                            <tr class='align-middle'>
                                <td>
                                    <img src='../assets/images/posts/$image' class='rounded' style='width: 60px; height: 40px;'>
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
                <form action="../../index.php" method="POST" id="form" enctype="multipart/form-data" data-parsley-validate>
                    <div class="modal-header">
                        <h5 class="modal-title">Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="post-id" id="post-id">
                        <input type="hidden" name="post-auteur" id="post-auteur" value="<?= $_SESSION['userId'] ?>">
                        <div class="mb-3">
                            <label class="form-label" for="post-img">Image</label>
                            <input id="post-img" type="file" class="form-control" name="post-img"
                                   accept="image/png, image/jpeg">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="post-title">Title</label>
                            <input id="post-title" type="text" class="form-control mb-2" name="post-title" data-parsley-pattern="[a-zA-Z0-9\s]+"
                                   data-parsley-pattern-message="Title must contain Letters & numbers only."
                                   data-parsley-trigger="keyup" required>
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
                            <textarea class="form-control mb-2" rows="5" id="post-desc" name="post-desc" data-parsley-pattern="[a-zA-Z0-9\s]+"
                                      data-parsley-pattern-message="Description must contain Letters & numbers only."
                                      data-parsley-trigger="keyup" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-white" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" name="update_post" class="btn btn-warning" id="modal-update-btn">Update
                        </button>
                        <button type="submit" name="save_post" class="btn btn-primary" id="modal-save-btn">Save
                        </button>
                        <button type="button" name="multi_post" onclick="saveMultiPost()" class="btn btn-primary"
                                id="modal-multi-btn">New Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
require_once './footer.php';
?>
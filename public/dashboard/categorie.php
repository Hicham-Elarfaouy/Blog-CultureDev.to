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
                <h1 class="h5 mb-0">Categories</h1>
                <button onclick="openModal()" class="btn btn-sm shadow-sm bg-success text-white"><i
                            class="fa-solid fa-plus fa-md"></i>
                    Add Categories
                </button>
            </div>
            <hr>
            <div class="card-body">
                <div class="table-responsive fw-w300">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach (get_cat() as $cat) {
                            $d = $cat['id'];
                            $dd = $cat['name'];
                            echo "
                            <tr>
                                <td>$cat[name]</td>
                                <td>
                                    <div class='d-flex justify-content-around'>
                                        <i role='button' onclick='openEditCat($cat[id], `$cat[name]`)' class='fa-solid fa-pen-to-square text-primary'></i>
                                        <i role='button' onclick='deleteItem($cat[id], `delete_cat`)' class='fa-solid fa-trash-can text-danger ms-3'></i>
                                    </div>
                                </td>
                            </tr>
                            ";
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Name</th>
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
                        <h5 class="modal-title">Categories</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="cat-id" id="cat-id">
                        <div class="mb-3">
                            <label class="form-label" for="cat-name">Name</label>
                            <input id="cat-name" type="text" class="form-control mb-2" name="cat-name" data-parsley-pattern="[a-zA-Z0-9\s]+"
                                   data-parsley-pattern-message="Name must contain Letters & numbers only."
                                   data-parsley-trigger="keyup" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-white" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" name="update_cat" class="btn btn-warning" id="modal-update-btn">Update
                        </button>
                        <button type="submit" name="save_cat" class="btn btn-primary" id="modal-save-btn">Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
require_once './footer.php';
?>
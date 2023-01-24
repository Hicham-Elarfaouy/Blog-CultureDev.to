<?php
require_once './header.php';
?>
<main>
    <div class="container mt-5">
        <div class="row">

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card shadow py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-uppercase mb-1">
                                    Total Posts
                                </div>
                                <div class="h5 mb-0"><?= count(get_post()) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-clipboard fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Total Categories
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= count(get_cat()) ?></div>
                                    </div>
                                    <div class="col">

                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-bars-staggered fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Posts by <?= $_SESSION['userName'] ?>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count(get_post("WHERE u.id = $_SESSION[userId]")) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-paste fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Total users
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count(get_user()) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
<?php
require_once './footer.php';
?>

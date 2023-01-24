<?php
require_once './header.php';

if (!isset($_GET['post_id']) || $_GET['post_id'] == '') {
    header('location: ../../index.php');
}

$post = get_post("WHERE p.id = $_GET[post_id]");
$image = $post[0]['image'] != '' ? $post[0]['image'] : 'default.jpg';
?>

    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div>
                        <div>
                            <img class="rounded shadow" src="../assets/images/posts/<?= $image ?>" alt="imagematch info"
                                 style="width: 100%">
                        </div>

                        <div class="row my-5">
                            <div>
                                <div class="mb-3">
                                    <p class="h1"><?= $post[0]['title']?></p>
                                </div>
                                <div class="mb-3">
                                    <i class="fa-solid fa-bars-staggered me-3"></i>
                                    <span class="bg-danger rounded px-2 py-1 text-white"># <?= $post[0]['cat'] ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="mb-3">
                                        <p class="h4">Description</p>
                                    </div>
                                    <div class="mb-5">
                                        <?= $post[0]['description'] ?>
                                    </div>
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
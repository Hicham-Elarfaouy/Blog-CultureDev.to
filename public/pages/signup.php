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
    <div class="container mt-5 d-flex justify-content-center">
        <div class="p-5 shadow rounded bg-white" style="width: min(100%, 600px)">
            <form id="formAuth" action="../../index.php" method="post" class="text-start" >
                <h4>SIGN UP</h4>
                <h6 class="mb-4">Welcome to Culture Dev</h6>
                <input type="text" class="form-control mt-3" placeholder="First Name" name="first_name">
                <input type="text" class="form-control mt-3" placeholder="Last Name" name="last_name">
                <input type="text" class="form-control mt-3" placeholder="Email" name="email">
                <div class="input-group mt-3 position-relative">
                    <input id="signup-pass" type="password" class="form-control" name="pass" placeholder="Password">
                    <span class="input-group-text" onclick="togglePassword('signup-pass')"><i id="iconPassword" class="fa fa-eye"></i></span>
                </div>
                <div id="validation" class="text-danger mt-2 fw-w300" style="font-size: 13px">

                </div>
                <div class="d-flex justify-content-center my-4">
                    <button type="submit" name="signup" class="btn btn-success w-50">SIGN UP</button>
                </div>
                <p class="text-center fw-w300">Already have an account ? <a href="login.php" class="text-success">LOGIN</a>
                </p>
            </form>
        </div>
    </div>
</main>

<?php
require_once './footer.php';
?>
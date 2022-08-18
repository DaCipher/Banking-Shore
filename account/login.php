<?php

use App\Controllers\LoginController;

require_once realpath("../vendor/autoload.php");
$login = new LoginController;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Secure Login :: Internet Banking - Sterling Unity Bank</title>
    <?php include "../partials/head.php"; ?>


</head>
<style>
    .text-purple {
        color: #054a85 !important;
    }
</style>

<body class="main-login">

    <!-- ======= Top Bar ======= -->


    <main id="main">
        <!-- ======= Header ======= -->
        <?php include "../partials/inner/header.php"; ?>
        <!-- End Header -->

        <!-- ======= Breadcrumbs ======= -->

        <!-- End Breadcrumbs -->

        <!-- ======= Main Section ======= -->
        <div class="container d-flex align-items-center justify-content-center" style="height: 80vh!important;">
            <div class="shadow">
                <div class="bg-light rounded">
                    <div class="pl-5 mt-2 py-3 mx text-center"> <span style="font-weight: bolder ;" class="text-purple">
                            <h3>Secure Login</h3>
                        </span>

                        </a>
                    </div>

                    <form class="px-4 pb-4 mt-2" action="" method="POST">
                        <?= $login->login_error; ?>
                        <div class="mb-3">
                            <label for="userid">User ID</label>
                            <div class="input-group">
                                <div class="input-group-prepend d-flex align-items-center justify-content-center">
                                    <span class="input-group-text fa fa-user text-purple" style="font-size: 1.5em;"></span>
                                </div>
                                <input type="text" name="userid" id="userid" class="form-control" value="<?= $login->userid; ?>" required autofocus>

                            </div>
                            <div class="span help-block text-danger"><?= $login->userid_error; ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="userid">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend d-flex align-items-center justify-content-center">
                                    <span class="input-group-text fa fa-lock text-purple" style="font-size: 1.5em;"></span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control" required>

                            </div>
                            <div class="span help-block text-danger"><?= $login->password_error; ?></div>
                        </div>

                        <div class="text-center my-4 d-grid">
                            <button type="submit" name="login" class="btn btn-outline-purple rounded">Login</button>
                        </div> <input type="hidden" name="csrf_token" value="<?= (isset($_SESSION['csrf_token'])) ? $_SESSION['csrf_token'] : ""; ?>">

                        <div class="my-1 mr-auto">
                            <a href="./forgot-password.php" class="text-purple">Forgot Password?</a>
                        </div>
                        <div class="my-1 mr-auto">
                            <a href="./register.php" class="text-purple"> Open an
                                Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Main Section -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <!-- End Footer -->

    <div id="preloader"></div>
    <?php include "../partials/scripts.php"; ?>

</body>

</html>
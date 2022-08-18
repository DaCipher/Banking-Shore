<?php

use App\Controllers\LoginController;

require_once realpath("../vendor/autoload.php");
$login = new LoginController;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password :: Internet Banking - Sterling Unity Bank</title>
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
                            <h3>Change Password</h3>
                        </span>

                        </a>
                    </div>

                    <form class="px-4 pb-4 mt-2" action="" method="POST">

                        <?php if ((isset($_POST['chkpsw'])) && !empty($login->pass_failed)) : ?>

                            <div class="alert alert-danger text-center"><?= $login->pass_failed; ?></div>

                        <?php endif; ?>

                        <?php if ((isset($_POST['chkpsw'])) && !empty($login->pass_success)) : ?>

                            <div class="alert alert-success text-center"><?= $login->pass_success; ?></div>

                        <?php endif; ?>

                        <div class="mb-3">

                            <label for="userid">New Password</label>

                            <div class="input-group">

                                <input type="password" name="new_pass" id="new_pass" class="form-control" value="<?= $login->userid; ?>" required autofocus>

                            </div>

                            <div class="span help-block text-danger"><?= $login->new_pass_error; ?></div>

                        </div>

                        <div class="mb-3">

                            <label for="userid">Confirm Password</label>

                            <div class="input-group">

                                <input type="password" name="confirm_pass" id="password" class="form-control" required>

                            </div>

                            <div class="span help-block text-danger"><?= $login->confirm_pass_error; ?></div>

                        </div>



                        <div class="text-center my-4 d-grid">

                            <button type="submit" name="chkpsw" class="btn btn-outline-purple rounded">Submit</button>

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
<?php

use App\Controllers\LoginController;

require_once realpath("../vendor/autoload.php");
$login = new LoginController;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create PIN :: Internet Banking - Sterling Unity Bank</title>
    <?php include "../partials/head.php"; ?>


</head>
<style>
    .text-purple {
        color: #054a85 !important;
    }

    input {

        text-security: disc;

        -webkit-text-security: disc;

        -moz-text-security: disc;

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
                            <h3>Create PIN</h3>
                        </span>

                        </a>
                    </div>

                    <form action="" method="post" class="px-4 pb-4 mt-2" id="pass-form">

                        <?php if (isset($_POST['change_pin']) && !empty($login->pin_failed)) : ?>

                            <div class="alert alert-danger text-center"><?= $login->pin_failed; ?></div>

                        <?php endif; ?>

                        <?php if (isset($_POST['change_pin']) && !empty($login->pin_success)) : ?>

                            <div class="alert alert-success text-center"><?= $login->pin_success; ?></div>

                        <?php endif; ?>

                        <div class="mb-3">

                            <label for="mew_pin">New PIN</label>

                            <input class="form-control" type="number" name="new_pin" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" id="new_pin" required autofocus>

                            <span class="help-block text-danger" id="new_pin_error"><?= $login->new_pin_error; ?></span>

                        </div>

                        <div class="mb-3">

                            <label for="confirm-pin">Confirm PIN</label>

                            <input class="form-control" type="number" name="confirm_pin" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" id=" confirm_pin" required>

                            <span class="help-block text-danger" id="confirm_pin_error"><?= $login->confirm_pin_error; ?></span>

                        </div>



                        <div class="text-center my-4 d-grid">

                            <button type="submit" name="change_pin" class="btn btn-outline-purple" id="btn-submit">Submit</button>

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
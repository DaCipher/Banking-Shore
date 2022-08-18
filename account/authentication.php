<?php

use App\Controllers\LoginController;

require_once realpath("../vendor/autoload.php");

$user = new LoginController;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Authentication :: Internet Banking - Sterling Unity Bank</title>
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
                    <div class="pl-5 mt-2 py-3  text-center"> <span style="font-weight: bolder ;" class="text-purple">
                            <h3>Security Question</h3>
                        </span>
                    </div>

                    <form class="p-4 mt-2" action="" method="POST">

                        <div class="form-group">

                            <p class="font-weight-bold" style="font-weight: 600;"><?= $user->question; ?></p>

                            <input type="password" name="answer" id="id" class="form-control" required autofocus>

                            <span class="help-block text-danger"><?= $user->answer_error; ?></span>

                        </div>





                        <div class="text-center my-4 d-grid">

                            <button type="submit" name="authenticate" class="btn btn-block btn-outline-purple rounded">Submit</button>

                        </div>

                        <div>

                            <p>Forgot Answer? Contact Support</p>

                        </div>

                        <div class="my-3 mr-auto">

                            <a href="./login.php?action=logout" class="text-purple">Back to Login</a>

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
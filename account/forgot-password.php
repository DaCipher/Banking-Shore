<?php

use App\Controllers\LoginController;

require_once realpath("../vendor/autoload.php");
$login = new LoginController;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forgot Password :: Internet Banking - Sterling Unity Bank</title>
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
                            <h3>Forgot Password</h3>
                        </span>

                        </a>
                    </div>

                    <form class="p-4 mt-2" action="" method="POST">

                        <div class="form-group">

                            <label for="email">User ID</label>

                            <div class="input-group mt-2">

                                <div class="input-group-prepend d-flex align-items-center justify-content-center">

                                    <span class="input-group-text fa fa-user text-purple" style="font-size: 1.5em;"></span>

                                </div>

                                <input type="text" name="id" id="id" class="form-control" required autofocus>

                            </div>

                            <span class="help-block text-danger"><?= $login->id_error; ?></span>

                        </div>





                        <div class="text-center my-4 d-grid">

                            <button type="submit" name="check_id" class="btn btn-outline-purple rounded">Submit</button>

                        </div>

                        <div>

                            <a href="./forgot-userid.php" class="text-purple">Forgot User ID?</a>

                        </div>

                        <div class="my-3 mr-auto">

                            <a href="./login.php" class="text-purple">Back to Login</a>

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
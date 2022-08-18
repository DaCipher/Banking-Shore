<?php

use App\Controllers\LoginController;
use App\Controllers\PaymentController;

require_once "../../../vendor/autoload.php";
$pay = new PaymentController;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "../../../partials/head.php";
    ?>
    <link rel="stylesheet" href="../assets/css/loader.css">
    <title>Secure Payment Gateway</title>
</head>

<body>

    <!-- ======== Preloader ======= -->
    <div id="loader">
        <div id="loader-container">
            <p id="loadingText">
                <marquee behavior="scroll" direction="left">Processing...</marquee>
            </p>
        </div>
    </div>
    <div class="background-primary">
        <?php include "../../../partials/inner/header.php" ?>
    </div>
    <main id="main">

        <div class="container">
            <div class="my-2">
                <a href="" class="btn text-color-primary">Return to Funds Transfer</a>
            </div>
            <div class="row d-flex justify-content-center align-items-center" style="height: 80vh;">


                <!-- =========== Success =========== -->
                <div class="col-md-6 col-lg-4" data-aos="fadeup">
                    <div class="shadow rounded">
                        <div class="card rounded">
                            <div class="card-body px-3 py-5 text-center">
                                <div data-aos="fadein" data-aos-delay="200">
                                    <?php if ($_SESSION['payment'] == "success") : ?>
                                        <i class="fa fa-check-circle iconn text-success"></i>
                                    <?php elseif ($_SESSION['payment'] == "fail") : ?>
                                        <i class="fa fa-times-circle iconn text-danger"></i>
                                    <?php else : ?>
                                        <i class="fa fa-exclamation-triangle iconn text-danger"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-4" data-aos="fadein" data-aos-delay="300">
                                    <?php if ($_SESSION['payment'] == "success") : ?>
                                        <p style="font-weight: bolder; color: rgba(5, 87, 158, 0.9)">Transfer Successful!</p>
                                    <?php elseif ($_SESSION['payment'] == "fail") : ?>
                                        <p class="text-danger" style="font-weight: bolder;">Error: Transfer Unsuccessful!</p>
                                    <?php else : ?>
                                        <p class="text-danger" style="font-weight: bolder;">Unkown Error!</p>
                                    <?php endif; ?>
                                    <?php unset($_SESSION['payment']); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        </div>
    </main>
    <?php include "../../../partials/scripts.php"; ?>

    <script src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
            $("#loader").remove();
            }, 5000);

        });
    </script>
</body>

</html>
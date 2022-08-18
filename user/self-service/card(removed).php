<?php

use App\Controllers\UserController;

require_once "../../vendor/autoload.php";
$user = new UserController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cards - - Sterlling Unity Online Banking</title>
    <?php include "../layouts/head.php"; ?>
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Gemunu+Libre&family=Poppins:wght@700&display=swap');

    .img-container {
        position: relative;
        text-align: center;
        color: white;
    }

    .img-text {
        position: absolute;
        top: 72%;
        left: 35%;
        transform: translate(-45%, -45%);
        z-index: 999;
        font-family: 'Gemunu Libre', sans-serif;
        font-stretch: ultra-expanded;
        -webkit-touch-callout: none;
        /* iOS Safari */
        -webkit-user-select: none;
        /* Safari */
        -khtml-user-select: none;
        /* Konqueror HTML */
        -moz-user-select: none;
        /* Old versions of Firefox */
        -ms-user-select: none;
        /* Internet Explorer/Edge */
        user-select: none;
        /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
    }

    .img-text-2 {
        position: absolute;
        top: 82%;
        left: 27%;
        transform: translate(-45%, -45%);
        z-index: 999;
        font-family: 'Gemunu Libre', sans-serif;
        font-stretch: ultra-expanded;
        -webkit-touch-callout: none;
        /* iOS Safari */
        -webkit-user-select: none;
        /* Safari */
        -khtml-user-select: none;
        /* Konqueror HTML */
        -moz-user-select: none;
        /* Old versions of Firefox */
        -ms-user-select: none;
        /* Internet Explorer/Edge */
        user-select: none;
        /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
    }

    @media (max-width: 600px) {
        .img-container {
            max-width: 80%;
        }

        .img-text,
        .img-text-2 {
            font-size: 0.9rem !important;
        }
    }

    @media only screen and (min-width: 600px) {
        .img-container {
            max-width: 50%;
        }

        .img-text,
        .img-text-2 {
            font-size: 1rem !important;
        }
    }

    @media only screen and (min-width: 768px) {
        .img-container {
            max-width: 40%;
        }

        .img-text,
        .img-text-2 {
            font-size: 1.1rem !important;
        }
    }
</style>

<body id="page-top" style="min-width: 356px;">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include "../layouts/sidebar.php"; ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <?php include "../layouts/topbar.php"; ?>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Card</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Self Service</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Card</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card py-4 px-2">
                                <div class="alert alert-secondary mx-4"> <i class="fas fa-info-circle"></i> You have no card attatched to your account yet.</div>
                                <div class="alert alert-secondary mx-4"> <i class="fas fa-info-circle"></i> Your request is being procesed.</div>
                                <div class="owl-carousel owl-theme">
                                    <div class="owl-item">
                                        <div class="img-container mx-auto">
                                            <img class="img-fluid" src="../assets/img/credit-card.png" alt="credit-card">
                                        </div>
                                        <div class="my-4 text-center"><button class="btn px-4 text-white" style="background-color: #01448a;">Get A Credit Card</button></div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="img-container mx-auto">
                                            <img class="img-fluid" src="../assets/img/debit-card.png" alt="credit-card">
                                        </div>
                                        <div class="my-4 text-center"><button class="btn px-4 text-white" style="background-color: #e83e8c;">Get A Debit Card</button></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Quick Links-->
                        <div class="col-xl-4 col-lg-5">
                            <?php include "../layouts/quick-link.php"; ?>
                        </div>
                    </div>
                    <!-- Modal Logout -->
                    <?php include "../layouts/logout-modal.php"; ?>

                </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            <?php include "../layouts/footer.php"; ?>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "../layouts/scripts.php"; ?>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                items: 1,
                // loop: true,
                // margin: 10,
                // autoplay: true,
                // autoplayTimeout: 5000,
                // autoplayHoverPause: true
            });
        });
    </script>
</body>

</html>
<?php



    session_start();

    if (!isset($_SESSION['reg_success'])) {

        header("location: " . $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]. "/account/login.php");
    }



    unset($_SESSION['reg_success']);

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <title>Resgistration Successful :: Internet Banking - Sterling Unity Bank</title>

    <?php include "../partials/head.php"; ?>





</head>

<style>
    .text-purple {

        color: #054a85 !important;

    }
</style>



<body class="main-register">



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

                <div class=" bg-light rounded text-center p-5">



                    <i class="fa fa-check-circle iconn" style="color:#054a85;"></i>



                    <div>



                        <h3> Your request has been submitted!</h3>



                        <h5>You will be notified soon.</h5>



                        <div class="pt-4">



                            <p> For more information, contact <span style="color: #054a85;cursor: pointer;" onclick="window.location.assign('mailto:info@financialshore.com')">info@financialshore.com </span></p>



                        </div>

                    </div>



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
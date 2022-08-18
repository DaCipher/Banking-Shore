<?php



use App\Controllers\UserController;



require_once "../../vendor/autoload.php";

$user = new UserController;



?>



<!DOCTYPE html>

<html lang="en">



<head>

    <title>Support Center - SEB Online Banking</title>

    <?php include "../layouts/head.php"; ?>

</head>

<style>
    @media (max-width: 600px) {

        .cs {

            font-size: 1.2rem !important;

        }



        .cs-mail {

            font-size: 0.8rem !important;

            margin: 0 !important;

        }



        .fs {

            padding-right: 2px;

        }



        .icon {

            font-size: 2.4rem;

            ;

        }

    }



    @media (min-width: 601px) and (max-width: 991px) {

        .icon {

            font-size: 4.4rem;

        }

    }



    @media (min-width: 992px) {

        .icon {

            font-size: 2.8rem;

        }

    }



    @media (min-width: 1200px) {

        .icon {

            font-size: 4.2rem;

        }

    }
</style>



<body id="page-top">

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

                        <h1 class="h3 mb-0 text-gray-800">Support Center</h1>

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="./">Self Service</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Support</li>

                        </ol>

                    </div>

                    <div class="row mb-3">

                        <!-- Tab-->

                        <div class="col-xl-8 col-lg-7">

                            <div class="card mb-4 px-2">

                                <div class="card-body">

                                    <div>

                                        <div class="my-2">

                                            <div style="font-size: 1.2rem;" class="mb-3">Your Account Officer</div>

                                        </div>

                                        <hr>

                                        <div class="row">

                                            <div class="col-md-4 d-flex d-md-block justify-content-center justify-content-md-start">

                                                <div class="rounded-circle border p-4 d-flex justify-content-center icon" style="max-width: 180px; max-height: 180px; font-weight:bold;"><?= strtoupper($user->account[0]['firstname'][0]) . strtoupper($user->account[0]['lastname'][0]); ?> </div>

                                            </div>

                                            <div class="col-md-8 p-4 ">

                                                <div class="text-center text-lg-left">

                                                    <div style="font-size: 2rem;"><?= $user->account[0]['firstname'] . " " . $user->account[0]['lastname']; ?></div>

                                                    <div class="1.2rem" onclick="window.location.assign('mailto:<?= $user->account[0]['email'] ?>')" style="cursor: pointer;"><?= $user->account[0]['email'] ?></div>

                                                </div>



                                            </div>

                                        </div>

                                        <hr>

                                        <div class="my-4">

                                            <div class="cs" style="font-size: 1.8rem; font-weight: bold;">Customer Service</div>

                                            <div class="mx-1 cs-mail" style="font-size: 1.2rem;">

                                                <span class="fs" onclick="window.location.assign('mailto:customerservice@financialshore.com')" style="cursor:pointer"><i class="fas fa-envelope"></i> customerservice@financialshore.com</span>

                                            </div>

                                        </div>

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

</body>



</html>
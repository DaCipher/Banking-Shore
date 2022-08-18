<?php



use App\Controllers\UserController;



require_once "../../vendor/autoload.php";

$user = new UserController;



?>

<!DOCTYPE html>

<html lang="en">



<head>

    <title>Transaction Alerts - Financial Shore Online Banking</title>

    <?php include "../layouts/head.php"; ?>

    <link rel="stylesheet" href="../assets/css/sidebar-overlay.css">

</head>

<style>
    .message:hover {

        background-color: #e3eaef;

    }



    @media (max-width: 567px) {

        .trans-info {

            font-size: 0.7rem;



        }

    }
</style>



<body id="page-top">

    <div class="bs-canvas-overlay bs-canvas-anim bg-dark position-fixed w-100 h-100"></div>

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

                        <h1 class="h3 mb-0 text-gray-800">Alert</h1>

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="./">Transaction</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Alert</li>

                        </ol>

                    </div>



                    <div class="row mb-3">





                        <!-- Tab-->

                        <div class="col-xl-8 col-lg-7">

                            <div class="card mb-4 px-2">

                                <div class="card-body">



                                    <?php if (!$user->paginate) : ?>

                                        <div class="py-5">

                                            <div class="py-5 text-center">

                                                <p style="font-size: 1.5rem;">No transaction alert yet!</p>

                                                <p>Alerts from all transactions will show here.</p>

                                            </div>

                                        </div>

                                        <?php else :

                                        foreach ($user->alert as $paginate) : ?>

                                            <div class="message rounded border border-left-<?= ($paginate['transaction_type'] == "credit") ? "success" : "danger"; ?> my-3 py-2 px-3 d-flex align-items-center justify-content-between" data-toggle="canvas" data-target="#bs-canvas-right" aria-expanded="false" aria-controls="bs-canvas-right">

                                                <div>

                                                    <div>Transaction</div>

                                                    <div id="date" style="font-size: 0.6rem;"><?= $paginate['date'] ?></div>

                                                    <div class="trans-info">You have a new <span id="type"><?= ucfirst($paginate['transaction_type']) ?></span> on <?= strtoupper($user->account[0]['account_type']) ?> ACCOUNT with a value of <span id="amount"><?= ($paginate['transaction_type'] == "credit") ? "$ " . number_format($paginate['amount']) : "- $" . number_format($paginate['amount']); ?></span>.</div>

                                                    <span id="details" class="d-none"><?= $paginate['narration'] ?></span>

                                                    <span id="reference" class="d-none"><?= $paginate['reference']; ?></span>

                                                    <span id="currency" class="d-none">USD</span>

                                                </div>





                                            </div>

                                    <?php

                                        endforeach;

                                    endif; ?>



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

    <div id="bs-canvas-right" class="bs-canvas bs-canvas-anim bs-canvas-right position-fixed bg-light h-100">

        <header class="bs-canvas-header p-3 bg-primary overflow-auto">

            <button type="button" class="bs-canvas-close float-left close" aria-label="Close"><span aria-hidden="true" class="text-light">&times;</span></button>

            <h5 class="d-inline-block text-light mb-0 ml-4">Transaction Details</h5>

        </header>

        <div class="bs-canvas-content px-3 py-5">

            <div>

                <div style="font-size: 0.7rem;">Narrative</div>

                <span class="font-weight-bold" id="trans-details"></span>

            </div>

            <hr>

            <div>

                <div style="font-size: 0.7rem;">Transaction Date</div>

                <span style="font-size: 0.9rem;" class="font-weight-bold" id="trans-date"></span>

            </div>

            <hr>

            <div>

                <div style="font-size: 0.7rem;">Transaction Reference</div>

                <span style="font-size: 0.9rem;" class="font-weight-bold" id="trans-reference"></span>

            </div>

            <hr>

            <div>

                <div style="font-size: 0.7rem;">Currency</div>

                <span style="font-size: 0.9rem;" class="font-weight-bold" id="trans-currency"></span>

            </div>

            <hr>

            <div>

                <div style="font-size: 0.7rem;">Amount</div>

                <span style="font-size: 0.9rem;" class="font-weight-bold" id="trans-amount"></span>

            </div>

            <hr>

            <div>

                <div style="font-size: 0.7rem;">Transaction Type</div>

                <span style="font-size: 0.9rem;" class="font-weight-bold" id="trans-type"></span>

            </div>

            <hr>

            <div>

                <div style="font-size: 0.7rem;">Tag</div>

                <span style="font-size: 0.9rem;" class="font-weight-bold"> N/A </span>

            </div>

            <hr>

            <div>

                <div style="font-size: 0.7rem;">Category</div>

                <span style="font-size: 0.9rem;" class="font-weight-bold"> N/A </span>

            </div>



        </div>

    </div>

    <!-- Scroll to top -->

    <a class="scroll-to-top rounded" href="#page-top">

        <i class="fas fa-angle-up"></i>

    </a>



    <?php include "../layouts/scripts.php"; ?>

    <script src="../assets/js/sidebar-overlay.js"></script>

</body>



</html>
<?php

use App\Controllers\UserController;

require_once "../../vendor/autoload.php";
$user = new UserController;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Transaction Limit - Financial Shore Online Banking</title>
    <?php include "../layouts/head.php"; ?>
</head>

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
                        <h1 class="h3 mb-0 text-gray-800">Transaction Limit</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Account</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Limit</li>
                        </ol>
                    </div>

                    <div class="row mb-3">
                        <!-- Tab-->
                        <div class="col-xl-8 col-lg-12">
                            <div class="card mb-4 px-2">
                                <div class="card-body">
                                    <div class="mb-4 px-2">
                                        <div style="font-size: 0.9rem;">Current Daily Limit: <strong>$ <?= ($user->user['daily_limit']) ? number_format($user->user['daily_limit']) : "0"; ?></strong> </div>
                                        <div style="font-size: 0.9rem;">Current Limit Per Transaction: <strong>$ <?= ($user->user['transaction_limit']) ? number_format($user->user['transaction_limit']) : "0"; ?></strong> </div>
                                        <div class="row mt-4 mb-2">
                                            <div class="col-md-6 px-4 mb-4 d-md-flex align-items-stretch">
                                                <div class="p-3 border rounded" style="border-color: #ccc">
                                                    <div class="mx-auto rounded-circle" style="max-width: 2rem; background: #5a5c69;">
                                                        <p class="text-white font-weight-bolder py-2 px-3 d-flex justify-content-center align-self-center" style="font-size: 0.7rem;">
                                                            S
                                                        </p>
                                                    </div>
                                                    <h4 class="text-center" style="font-size:0.8rem;">Standard</h4>
                                                    <hr>
                                                    <div>
                                                        <p>Limit per transaction: $4,000</p>
                                                        <p>Daily Limit : $ 10,000</p>
                                                        <p>Monthly Limit: $300,000</p>
                                                        <form action="" method="post" id="std">
                                                            <input type="hidden" id="daily" name="daily_limit" value="10000">
                                                            <input type="hidden" id="transaction" name="transaction_limit" value="4000">
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-dark btn-block" <?= ($user->user['daily_limit'] >= 10000) ? "disabled" : ""; ?> name="std">Upgrade</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-4 mb-4 d-md-flex align-items-stretch">
                                                <div class="p-3 border rounded" style="border-color: #ccc">
                                                    <div class="mx-auto bg-success rounded-circle" style="max-width: 2rem;">
                                                        <p class="text-white font-weight-bolder py-2 px-3 d-flex justify-content-center align-self-center" style="font-size: 0.7rem;">
                                                            M
                                                        </p>
                                                    </div>
                                                    <h4 class="text-center" style="font-size:0.8rem;">Maximum</h4>
                                                    <hr>
                                                    <div>
                                                        <p>Limit per transaction: $ 5,000,000</p>
                                                        <p>Daily Limit : $ 50,000,000</p>
                                                        <p>Monthly Limit: Unlimted</p>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="daily_limit" value="50000000">
                                                            <input type="hidden" name="transaction_limit" value="5000000">
                                                            <div class="text-center">
                                                                <button type="button" class="btn btn-primary btn-block" name="max">Upgrade</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Quick Links-->
                        <div class="col-xl-4 col-lg">
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
            <!-- Confirm Modal -->
            <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">

                        <div class="modal-body" style="margin-top: 50px!important; margin-bottom: 50px!important;">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <i class="fa fa-check text-white bg-success p-4 rounded-circle" style="font-size: 2.2rem;"></i>
                            </div>

                            <p class="text-center">Limit upgraded to Standard!</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- !Confirm Modal -->
            <!-- Confirm Modal -->
            <div class="modal fade" id="maxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Attention</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div>Please contact <span style="font-weight: bold; cursor:pointer" onclick="location.assign('mailto:customersupport@standardexpressbank.com')">customersupport@standardexpressbank.com</span> with the following documents:</b>
                                <ul>
                                    <li>Valid means of Identification (Driver's License, Passport e.t.c)</li>
                                    <li>Utility Bill (Within last 3 months).</li>
                                    <li>Proof of Residence.</li>
                                    <li>Proof of Source of Income(e.g Payslip).</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- !Confirm Modal -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "../layouts/scripts.php"; ?>
    <script src="../assets/js/upgrade-limit.js"></script>
</body>

</html>
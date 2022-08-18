<?php

use App\Controllers\UserController;

require_once "../../vendor/autoload.php";
$user = new UserController;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account Information - Financial Shore Online Banking</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Account Details</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Account</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Information</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card mb-4 px-2">
                                <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Account Information</h6>
                                </div> -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div>
                                            <div style="font-size:small;">First Name</div>
                                            <div class="font-weight-bold"><?= ucfirst($user->user['firstname']); ?></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div style="font-size:small;">Middle Name</div>
                                            <div class="font-weight-bold"><?= ucfirst($user->user['middlename']); ?></div>
                                            <hr class="d-md-none">
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div style="font-size:small;">Last Name</div>
                                            <div class="font-weight-bold"><?= ucfirst($user->user['lastname']); ?></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <div style="font-size:small;">Social Security Number</div>
                                        <div class="font-weight-bold"><?= strtoupper($user->user['ssn']); ?></div>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div style="font-size:small;">Mobile Number</div>
                                            <div class="font-weight-bold"><?= $user->user['phone']; ?></div>
                                            <hr class="d-md-none">
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div style="font-size:small;">Email</div>
                                            <div class="font-weight-bold"><?= strtolower($user->user['email']); ?></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-3">
                                            <div style="font-size:small;">Nationality</div>
                                            <div class="font-weight-bold"><?= ucwords($user->user['country']); ?></div>
                                            <hr class="d-md-none">
                                        </div>
                                        <div class="col-lg-8 col-md-9">
                                            <div style="font-size:small;">Address</div>
                                            <div class="font-weight-bold">#<?= ucwords($user->user['address']); ?></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <div style="font-size:small;">Routing Number</div>
                                        <div class="font-weight-bold">2372292</div>
                                        <hr>
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
<?php

use App\Controllers\AdminController;

require_once "../../vendor/autoload.php";
$user = new AdminController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password - Financial Shore Admin</title>
    <?php include "../layouts/head.php"; ?>
</head>
<style>
    .message:hover {
        background-color: #e3eaef;
    }

    @media (max-width: 567px) {
        #btn-submit {
            width: 100%;
        }
    }

    @media (min-width: 568px) {
        #btn-submit {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
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
                        <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Password</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-md-6 mx-auto">
                            <div class="row">
                                <div class="col-md-10 mx-auto">
                                    <div class="card mb-4 px-3  py-4">
                                        <div class="card-body">
                                            <div>
                                                <form action="" method="post" class="my-2" id="pass-form">
                                                    <?php if (isset($_POST['change_pass']) && !empty($user->pass_failed)) : ?>
                                                        <div class="alert alert-danger text-center"><?= $user->pass_failed; ?></div>
                                                    <?php endif; ?>
                                                    <?php if (isset($_POST['change_pass']) && !empty($user->pass_success)) : ?>
                                                        <div class="alert alert-success text-center"><?= $user->pass_success; ?></div>
                                                    <?php endif; ?>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="password" name="new_pass" id="new_pass" placeholder="New Password" required>
                                                        <span class="span help-block text-danger" id="new_pass_error"><?= $user->new_pass_error; ?></span>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm Password" required>
                                                        <span class="span help-block text-danger" id="confirm_pass_error"><?= $user->confirm_pass_error; ?></span>
                                                    </div>

                                                    <div class="d-flex  justify-content-end mx-md-2">
                                                        <input type="hidden" name="userid" value="<?= $_SESSION['userid']; ?>">
                                                        <button type="submit" name="change_pass" class="btn btn-outline-primary" id="btn-submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Quick Links-->

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
    <script>
        $(document).ready(function() {
            $('input').attr('required', false);
        });
    </script>
</body>

</html>
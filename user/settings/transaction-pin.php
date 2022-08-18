<?php

use App\Controllers\UserController;

require_once "../../vendor/autoload.php";
$user = new UserController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Transaction PIN - Financial Shore Online Banking</title>
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

    input {
        text-security: disc;
        -webkit-text-security: disc;
        -moz-text-security: disc;
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
                        <h1 class="h3 mb-0 text-gray-800">Change PIN</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">PIN</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-xl-8 col-lg-7">
                            <div class="row">
                                <div class="col-md-6 mx-auto">

                                    <div class="card mb-4 px-2  py-4">
                                        <div class="card-body">
                                            <form action="" method="post" class="my-2" id="pin-form">
                                                <?php if (isset($_POST['change_pin']) && !empty($user->pin_failed)) : ?>
                                                    <div class="alert alert-danger text-center"><?= $user->pin_failed; ?></div>
                                                <?php endif; ?>
                                                <?php if (isset($_POST['change_pin']) && !empty($user->pin_success)) : ?>
                                                    <div class="alert alert-success text-center"><?= $user->pin_success; ?></div>
                                                <?php endif; ?>
                                                <div class="mb-3">
                                                    <input class="form-control" type="number" name="current_pin" id="current_pin" placeholder="Current PIN" required>
                                                    <span class="help-block text-danger" id="current_pin_error"><?= $user->current_pin_error; ?></span>
                                                </div>
                                                <div class="mb-3">
                                                    <input class="form-control" type="number" name="new_pin" maxlength="6" id="new_pin" placeholder="New PIN" required>
                                                    <span class="help-block text-danger" id="new_pin_error"><?= $user->new_pin_error; ?></span>
                                                </div>
                                                <div class="mb-3">
                                                    <input class="form-control" type="number" name="confirm_pin" maxlength="6" id=" confirm_pin" placeholder="Confirm PIN" required>
                                                    <span class="help-block text-danger" id="confirm_pin_error"><?= $user->confirm_pin_error; ?></span>
                                                </div>

                                                <div class="d-flex  justify-content-end mx-md-2">
                                                    <button type="submit" name="change_pin" class="btn btn-outline-primary" id="btn-submit">Submit</button>
                                                </div>
                                            </form>

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
    <script>
        $(document).ready(function() {
            $('input').keypress(function() {
                var value = $(this).val();
                if (value.length == 6) {
                    return false;
                }
            });
        });
    </script>
</body>

</html>
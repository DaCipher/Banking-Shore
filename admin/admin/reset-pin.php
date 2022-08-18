<?php

use App\Controllers\AdminController;

require_once "../../vendor/autoload.php";
$user = new AdminController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset User PIN - Financial Shore ADMIN</title>
    <?php include "../layouts/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/css/bootstrap-select.min.css" />
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
                        <h1 class="h3 mb-0 text-gray-800">Reset PIN</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Reset</a></li>
                            <li class="breadcrumb-item active" aria-current="page">PIN</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <div class="card mb-4 px-3  py-4">
                                        <div class="card-body">
                                            <div>
                                                <form action="" method="post" class="my-2" id="pass-form">
                                                    <?php if (isset($_POST['change_pin']) && !empty($user->pin_failed)) : ?>
                                                        <div class="alert alert-danger text-center"><?= $user->pin_failed; ?></div>
                                                    <?php endif; ?>
                                                    <?php if (isset($_POST['change_pin']) && !empty($user->pin_success)) : ?>
                                                        <div class="alert alert-success text-center"><?= $user->pin_success; ?></div>
                                                    <?php endif; ?>
                                                    <div class="mb-3">
                                                        <div class="mb-3">
                                                            <select class="form-control selectpicker" name="userid" id="" data-show-subtext="true" data-live-search="true" required>
                                                                <option value="" disabled selected> Select Account</option>
                                                                <?php if ($user->admin) :
                                                                    foreach ($user->admin as $users) : ?>
                                                                        <option value="<?= $users['userid']; ?>"><?= $users['firstname'] . " " . $users['lastname']; ?></option>
                                                                <?php endforeach;
                                                                endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="number" name="new_pin" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" id="new_pin" placeholder="New PIN" required>
                                                        <span class="help-block text-danger" id="new_pin_error"><?= $user->new_pin_error; ?></span>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="number" name="confirm_pin" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" id=" confirm_pin" placeholder="Confirm PIN" required>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            $('input').keypress(function() {
                var value = $(this).val();
                if (value.length == 6) {
                    return false;
                }
            });
            $('.selectpicker').selectpicker();

        });
    </script>
</body>

</html>
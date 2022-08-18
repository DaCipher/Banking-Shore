<?php

use App\Controllers\AdminController;

require_once "../../vendor/autoload.php";
$user = new AdminController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Admin - Financial Shore Admin</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Add Admin</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
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
                                                <form action="" method="get" class="my-2" id="add-admin">

                                                    <div class="mb-4">
                                                        <select class="form-control selectpicker" name="userid" id="user" data-show-subtext="true" data-live-search="true" title="Select Account" required>
                                                            <!-- <option value="" disabled selected> Select Account</option> -->
                                                            <?php if ($user->uniqueUser) :
                                                                foreach ($user->uniqueUser as $users) : ?>
                                                                    <option value="<?= $users['userid']; ?>"><?= $users['firstname'] . " " . $users['lastname']; ?></option>
                                                            <?php endforeach;
                                                            endif; ?>
                                                        </select>
                                                        <span class="help-block text-danger pl-2" id="user_error"></span>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="" class="username">Username</label>
                                                        <input type="text" class="form-control" name="username" id="username" aria-describedby="username" placeholder="" required>
                                                        <span class="help-block text-danger pl-2" id="username_error"></span>
                                                    </div>

                                                    <input type="hidden" name="add_admin">
                                                    <div class="d-flex  justify-content-end mx-md-2 mt-1">
                                                        <button type="submit" class="btn btn-primary btn-block" id="add">ADD</button>
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
                    <!-- Confirm Modal -->
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">

                                <div class="modal-body" style="margin-top: 50px!important; margin-bottom: 50px!important;">
                                    <div class="d-flex justify-content-center align-items-center mb-3">
                                        <i class="fa fa-check text-white bg-success p-4 rounded-circle" style="font-size: 2.2rem;" id="status_style"></i>
                                    </div>

                                    <p class="text-center" id="status_text"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- !Confirm Modal -->
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
    <script src="../assets/js/add-admin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.selectpicker').selectpicker();
        });
    </script>
</body>

</html>
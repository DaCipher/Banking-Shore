<?php

use App\Controllers\AdminController;

require_once "../../vendor/autoload.php";
$user = new AdminController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Alerts - Financial Shore Admin</title>
    <?php include "../layouts/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/css/bootstrap-select.min.css" />

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
                        <h1 class="h3 mb-0 text-gray-800">Alerts</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Transaction</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Alerts</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Transaction Alerts</h6>
                                </div>
                                <div class="card-body">

                                    <form action="" id="account-alert" class="mb-4" method="get">
                                        <select class="form-control selectpicker" id="users" name="account" data-show-subtext="true" data-live-search="true">
                                            <option value="" selected disabled> Select User </option>
                                            <?php if ($user->users) : ?>
                                                <?php foreach ($user->users as $users) : ?>
                                                    <option value="<?= $users['account_id']; ?>" <?= ($user->get_account == $users['account_id']) ? "selected" : ""; ?>><?= ucfirst($users['firstname']) . " " . ucfirst($users['lastname']) . " (" . $users['account_number'] . ") - " . ucfirst($users['account_type']); ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </form>
                                    <?php if ($user->history) : $i = 0; ?>
                                        <?php if (isset($_POST['action']) && !empty($user->status_fail)) : ?>
                                            <div class="alert alert-danger text-center"><?= $user->status_fail; ?></div>
                                        <?php endif; ?>
                                        <?php if (isset($_POST['action']) && !empty($user->status_success)) : ?>
                                            <div class="alert alert-success text-center"><?= $user->status_success; ?></div>
                                        <?php endif; ?>
                                        <div class="table-responsive mt-4">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Amount</th>
                                                        <th>Type</th>
                                                        <th>Date</th>
                                                        <th>Reference</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($user->history as $history) : $i++ ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td>$ <?= number_format($history['amount']); ?></td>
                                                            <td><?= ucfirst($history['transaction_type']); ?></td>
                                                            <td><?= $history['date']; ?></td>
                                                            <td><?= $history['reference']; ?></td>
                                                            <td>
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="account" value="<?= $_GET['account']; ?>">
                                                                    <input type="hidden" name="id" value="<?= $history['id']; ?>">
                                                                    <button type="submit" name="action" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else : ?>
                                        <?php if (isset($_GET['account'])) : ?>
                                            <div class="px-4 py-5 d-flex justify-content-center align-items-center" style="height: 290px;">
                                                <div class="text-center">
                                                    <p style="font-size: 1.5rem;"> No alert found!</p>

                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                        <!-- Quick Links-->

                    </div>


                </div>


                <!-- Modal Logout -->
                <?php include "../layouts/logout-modal.php"; ?>


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

            $('#users').change(function() {
                $('form#account-alert').submit();
            });
        });
    </script>

</body>

</html>
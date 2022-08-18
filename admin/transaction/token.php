<?php

use App\Controllers\AdminController;

require_once "../../vendor/autoload.php";
$user = new AdminController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account Token - Financial Shore ADMIN</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Account Token</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Accounts</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Token</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Acccount Tokens</h6>
                                </div>
                                <div class="card-body">
                                    <?php if ($user->users) : ?>
                                        <?php if ((isset($_POST['update'])) && !empty($user->status_fail)) : ?>
                                            <div class="alert alert-danger text-center"><?= $user->status_fail; ?></div>
                                        <?php endif; ?>
                                        <?php if ((isset($_POST['update'])) && !empty($user->status_success)) : ?>
                                            <div class="alert alert-success text-center"><?= $user->status_success; ?></div>
                                        <?php endif; ?>
                                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Account Name</th>
                                                        <th>Account</th>
                                                        <th>IMF</th>
                                                        <th>IMF Code</th>
                                                        <th>COT</th>
                                                        <th>COT Code</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                    <?php $i = 0;
                                                    foreach ($user->users as $users) : $i++;
                                                    ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td>
                                                                <?= $users['firstname'] . "<br>" . $users['lastname']; ?>
                                                            </td>
                                                            <td><?= ucwords($users['account_type']); ?> (<?= $users['account_number']; ?>)</td>
                                                            <form action="" method="post">
                                                                <td>
                                                                    <select name="imf_required" id="" class="form-control">
                                                                        <option value="" disabled> --- Select --- </option>
                                                                        <option value="1" <?= ($users['imf_required'] == "1") ? "selected" : ""; ?>> On</option>
                                                                        <option value="0" <?= ($users['imf_required'] == "0") ? "selected" : ""; ?>> Off</option>
                                                                        <option value="2" <?= ($users['imf_required'] == "2") ? "selected" : ""; ?>> Verfied</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="imf_code" id="" class="form-control" value="<?= $users['imf_code']; ?>" required>
                                                                </td>
                                                                <td>
                                                                    <select name="cot_required" id="" class="form-control">
                                                                        <option value="" disabled> --- Select --- </option>
                                                                        <option value="1" <?= ($users['cot_required'] == "1") ? "selected" : ""; ?>> On</option>
                                                                        <option value="0" <?= ($users['cot_required'] == "0") ? "selected" : ""; ?>> Off</option>
                                                                        <option value="2" <?= ($users['cot_required'] == "2") ? "selected" : ""; ?>> Verfied</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="cot_code" id="" class="form-control" value="<?= $users['cot_code']; ?>" required>
                                                                </td>
                                                                <td>

                                                                    <input type="hidden" name="account" value="<?= $users['account_id']; ?>">
                                                                    <div class="d-flex">
                                                                        <button type="submit" class="btn btn-primary mr-2" name="update">Update</button>
                                                                    </div>
                                                                </td>
                                                            </form>

                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>


                                    <?php else : ?>
                                        <div class="px-4 py-5 d-flex justify-content-center align-items-center" style="height: 290px;">
                                            <div class="text-center">
                                                <p style="font-size: 1.5rem;"> No User account!</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                        <!-- Quick Links-->

                    </div>


                </div>


                <!-- Modal Logout -->
                <?php include "../layouts/logout-modal.php"; ?>

            </div>
            <!---Container Fluid-->

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
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            // $('.selectpicker').selectpicker();


        });
    </script>


</body>

</html>
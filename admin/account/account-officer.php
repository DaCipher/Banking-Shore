<?php

use App\Controllers\AdminController;

require_once "../../vendor/autoload.php";
$user = new AdminController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Account Officer - Financial Shore ADMIN</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Account Officer</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Accounts</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Officer</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">All Accounts</h6>
                                </div>
                                <div class="card-body">
                                    <?php if ($user->users) : ?>
                                        <?php if ((isset($_POST['update'])) && !empty($user->status_fail)) : ?>
                                            <div class="alert alert-danger text-center"><?= $user->status_fail; ?></div>
                                        <?php endif; ?>
                                        <?php if ((isset($_POST['update'])) && !empty($user->status_success)) : ?>
                                            <div class="alert alert-success text-center"><?= $user->status_success; ?></div>
                                        <?php endif; ?>
                                        <div class="d-flex justify-content-end my-2">
                                            <button class="btn btn-primary mr-2" id="addnew">Add New</button>
                                            <button class="btn btn-danger mr-2" id="delete"> Delete</button>
                                        </div>
                                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Account Name</th>
                                                        <th>Account Number</th>
                                                        <th>Account Type</th>
                                                        <th>Balance</th>
                                                        <th>Account Officer</th>
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
                                                            <td><?= $users['account_number']; ?></td>
                                                            <td><?= ucfirst($users['account_type']); ?></td>
                                                            <td>$ <?= number_format($users['account_balance']) ?></td>
                                                            <form action="" method="post">
                                                                <td>
                                                                    <select class="form-control" name="account_officer_id" id="">
                                                                        <option value="" disabled selected> Select Account Officer</option>
                                                                        <?php foreach ($user->account_officer as $officer) : ?>
                                                                            <option value="<?= $officer['id']; ?>" <?= ($users['account_officer_id'] == $officer['id']) ? "selected" : ""; ?>><?= $officer['firstname'] . " " . $officer['lastname']; ?></option>
                                                                        <?php endforeach; ?>
                                                                        <option value="" style="color:red;">Revove Account Officer</option>
                                                                    </select>
                                                                </td>

                                                                <td>
                                                                    <input type="hidden" name="userid" value="<?= $users['userid']; ?>">
                                                                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                                                            </form>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>


                                    <?php else : ?>
                                        <div class="px-4 py-5 d-flex justify-content-center align-items-center" style="height: 290px;">
                                            <div class="text-center">
                                                <p style="font-size: 1.5rem;"> No account found!</p>
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


                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            <?php include "../layouts/footer.php"; ?>
            <!-- Footer -->
            <!-- Add New Modal -->
            <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addOfficerModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Account Officer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post" id="addNewOfficer">
                                <div class="my-2 text-center" id="status"></div>
                                <input type="text" name="firstname" id="firstname" class="form-control my-4" placeholder="First Name" required>
                                <input type="text" name="lastname" id="lastname" class="form-control my-4" placeholder="Last Name" required>
                                <div class="input-group my-4">
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                    <span class="input-group-text rounded-0">@financialshore.com</span>
                                </div>
                                <input type="hidden" name="add">
                                <button type="submit" name="add" class="btn btn-block btn-primary my-4 py-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- !Add New Modal -->
            <!-- Confirm Modal -->
            <div class="modal fade" id="deleteOfficerModal" tabindex="-1" role="dialog" aria-labelledby="deleteOfficerModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Account Officer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="deleteOfficer" method="post">
                                <div class="my-2 text-center" id="del_status"></div>
                                <select class="form-control mb-4" name="officer_id" id="officer_id" required>
                                    <option value="" selected disabled> Select Account Officer</option>
                                    <?php foreach ($user->account_officer as $officers) : ?>
                                        <option value="<?= $officers['id']; ?>"><?= $officers['firstname'] . " " . $officers['lastname'] . " (" . $officers['email'] . ")"; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <input type="hidden" name="del_officer">
                                <button type="submit" class="btn btn-block btn-danger my-2 py-2">Delete</button>
                            </form>
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
    <script src="../assets/js/account_officer.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            $('button#addnew').click(function() {
                $("#addNewModal").modal('show');
            });
            $('button#delete').click(function() {
                $("#deleteOfficerModal").modal('show');
            });
            $('.modal').on("hide.bs.modal", function() {
                location.reload();
            });
        });
    </script>


</body>

</html>
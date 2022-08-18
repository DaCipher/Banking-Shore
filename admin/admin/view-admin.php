<?php

use App\Controllers\AdminController;

require_once "../../vendor/autoload.php";
$user = new AdminController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Administrators - Financial Shore Admin</title>
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
                        <h1 class="h3 mb-0 text-gray-800">All Admin</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Admins</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">All Administrators</h6>
                                </div>
                                <div class="card-body">
                                    <?php if ($user->admin) :; ?>
                                        <?php if (isset($_POST['delete']) && !empty($user->status_failed)) : ?>
                                            <div class="alert alert-danger text-center"><?= $user->status_failed; ?></div>
                                        <?php endif; ?>
                                        <?php if (isset($_POST['delete']) && !empty($user->status_success)) : ?>
                                            <div class="alert alert-success text-center"><?= $user->status_success; ?></div>
                                        <?php endif; ?>
                                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Name</th>
                                                        <th>Username</th>
                                                        <th>Role</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                    <?php $i = 0;
                                                    foreach ($user->admin as $users) : $i++;
                                                    ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td>
                                                                <?= $users['firstname'] . "<br>" . $users['lastname']; ?>
                                                            </td>
                                                            <td><?= $users['username']; ?></td>
                                                            <td><?= ucfirst($users['role']); ?></td>
                                                            <td>
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="account" value="<?= $users['userid']; ?>">
                                                                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
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
                                                <p style="font-size: 1.5rem;"> No Admin account found!</p>
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
        });
    </script>


</body>

</html>
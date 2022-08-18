<?php



use App\Controllers\AdminController;



require_once "../../vendor/autoload.php";

$user = new AdminController;

?>



<!DOCTYPE html>

<html lang="en">



<head>

    <title>View User Accounts - Financial Shore Admin</title>

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

                        <h1 class="h3 mb-0 text-gray-800">All Accounts</h1>

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="./">Accounts</a></li>

                            <li class="breadcrumb-item active" aria-current="page">View</li>

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

                                    <?php if ($user->users) :; ?>



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

                                                        <th>Limit</th>

                                                        <th>Status</th>

                                                    </tr>

                                                </thead>

                                                <tbody id="myTable">

                                                    <?php $i = 0;

                                                    foreach ($user->users as $users) : $i++;

                                                    ?>

                                                        <tr>

                                                            <td><?= $i; ?></td>

                                                            <td>

                                                                <?= $users['firstname'] . " " . $users['lastname'] . "<br>" . $users['email']; ?>

                                                            </td>

                                                            <td><?= $users['account_number']; ?></td>

                                                            <td><?= ucfirst($users['account_type']); ?></td>

                                                            <td>$ <?= number_format($users['account_balance']) ?></td>

                                                            <td>Daily: $ <?= number_format($users['daily_limit']) . "<br> Per Transaction: $ " . number_format($users['transaction_limit']); ?></td>

                                                            <td>Status: <?= ucfirst($users['account_status']); ?><br>

                                                                Restrictions: <?= ucfirst($users['account_restriction']); ?>

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
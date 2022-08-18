<?php

use App\Controllers\AdminController;

require_once realpath("../vendor/autoload.php");
$user = new AdminController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dashboard - Financial Shore Admin</title>
  <?php include "./layouts/head.php"; ?>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "./layouts/sidebar.php"; ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php include "./layouts/topbar.php"; ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ($user->uniqueUser) ? count($user->uniqueUser) : "0"; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2 font-weight-bold">Total Inactive</span>
                        <span><?= ($user->inactive) ? count($user->inactive) : "0"; ?></span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">New Accounts</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ($user->new_accounts) ? count($user->new_accounts) : "0"; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2 font-weight-bold">Approved:</span>
                        <span><?= ($user->uniqueUser) ? count($user->uniqueUser) : "0"; ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Admin Users</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= ($user->admin) ? count($user->admin) : "0"; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2 font-weight-bold">Domain Administrators</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Transaction-->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Restricted</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= ($user->restricted) ? count($user->restricted) : "0"; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2 font-weight-bold">Accounts on Restrictions</span>
                        <span></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Area Chart -->
            <div class="col-lg-10">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">New Accounts</h6>
                  <a href="<?= ADMIN; ?>/account/new-account.php" class="btn text-white bg-primary">View All</a>
                </div>
                <div class="card-body">
                  <?php if ($user->new_accounts) : ?>
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Account Number</th>
                            <th>Account Type</th>
                            <th>Name</th>
                          </tr>
                        </thead>
                        <tbody id="myTable">
                          <?php $i = 0;
                          foreach ($user->new_accounts as $users) : $i++;
                          ?>
                            <tr>
                              <td><?= $i; ?></td>
                              <td><?= $users['userid']; ?></td>
                              <td><?= $users['account_number']; ?></td>
                              <td><?= ucfirst($users['account_type']); ?></td>
                              <td>
                                <?= $users['firstname'] . "<br>" . $users['lastname']; ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>


                  <?php else : ?>
                    <div class="px-4 py-5 d-flex justify-content-center align-items-center" style="height: 290px;">
                      <div class="text-center">
                        <p style="font-size: 1.5rem;"> No new account!</p>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <!-- Quick Links-->

          </div>
          <!-- Modal Logout -->
          <?php include "./layouts/logout-modal.php"; ?>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php include "./layouts/footer.php"; ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php include "./layouts/scripts.php"; ?>
</body>

</html>
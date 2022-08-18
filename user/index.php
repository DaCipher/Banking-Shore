<?php

use App\Controllers\UserController;

require_once realpath("../vendor/autoload.php");
$user = new UserController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>User Dashboard - Financial Shore Online Banking</title>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Balance</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?= ($user->user['account_balance']) ? number_format($user->user['account_balance']) : "0" ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2 font-weight-bold">Book Balance:</span>
                        <span>$ <?= number_format($user->user['account_balance']) ?></span>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Account Type</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ucfirst($user->user['account_type']) ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2 font-weight-bold">Daily Limit:</span>
                        <span>$ <?= ($user->user['daily_limit']) ? number_format($user->user['daily_limit']) : "0" ?></span>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Account Number</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $user->user['account_number'] ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2 font-weight-bold">SSN:</span>
                        <span><?= strtoupper($user->user['ssn']) ?></span>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Transaction</div>
                      <div class=" mb-0 font-weight-bold text-gray-800">
                        <a href="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']; ?>/user/transaction/funds-transfer.php" class=" text-danger">Send Money</a>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-center text-xs">
                        <span class="text-danger mr-2"></span>
                        <span class="font-weight-bold"><a href="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']; ?>/user/transaction/transaction-history.php">Transaction History</a></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Account Summary</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                        <th>Customer ID</th>
                        <th>Account Number</th>
                        <th>Account Type</th>
                        <th>Balance</th>
                      </tr>
                      <tr>
                        <td><?= $user->user['customer_id'] ?></td>
                        <?php foreach ($user->account as $account) :
                        ?>
                      <tr>
                        <td></td>
                        <td><?= $account['account_number'] ?></td>
                        <td><?= ucfirst($account['account_type']) ?></td>
                        <td>$ <?= number_format($account['account_balance']) ?></td>
                      </tr>
                    <?php endforeach;
                    ?>

                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- Quick Links-->
            <div class="col-xl-4 col-lg-5">
              <?php include "./layouts/quick-link.php"; ?>
            </div>
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
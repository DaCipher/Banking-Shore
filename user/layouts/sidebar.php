<?php
define("BASE_URL", $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']);
define("USER", BASE_URL . "/user");
?>

<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/user/">
        <div class="sidebar-brand-icon">
            <img src="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']; ?>/assets/img/logo.png">
        </div>
        <div class="sidebar-brand-text mx-1">Financial Shore</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']; ?>/user">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        NAVIGATION
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="fas fa-fw fa-university"></i>
            <span>Transaction</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= USER; ?>/transaction/funds-transfer.php">Funds Transfer</a>
                <a class="collapse-item" href="<?= USER; ?>/transaction/transaction-history.php">History</a>
                <a class="collapse-item" href="<?= USER; ?>/transaction/wire-transfer.php">Wire Transfer</a>
                <a class="collapse-item" href="<?= USER; ?>/transaction/alert.php">Alert</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true" aria-controls="collapseForm">
            <i class="fas fa-fw fa-portrait"></i>
            <span>Account</span>
        </a>
        <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= USER; ?>/account/account-information.php">Account Information</a>
                <a class="collapse-item" href="<?= USER; ?>/account/transaction-limit.php">Transaction Limit</a>
                <a class="collapse-item" href="<?= USER; ?>/account/inbox.php">Inbox</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true" aria-controls="collapseTable">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Settings</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= USER; ?>/settings/change-password.php">Change Password</a>
                <a class="collapse-item" href="<?= USER; ?>/settings/transaction-pin.php">Transaction PIN</a>
                <a class="collapse-item" href="<?= USER; ?>/settings/security-questions.php">Security Questions</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Self Service
    </div>
    <!-- <li class="nav-item">
        <a class="nav-link" href="?= USER; ?>/self-service/card.php">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Card</span>
        </a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link" href="<?= USER; ?>/self-service/support.php">
            <i class="fas fa-fw fa-comments"></i>
            <span>Support</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Lifestyle (coming Soon)
    </div>

    <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">
            <i class="fas fa-fw fa-money-check-alt"></i>
            <span>Cheque</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">
            <i class="fas fa-fw fa-passport"></i>
            <span>Apply for VISA</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">
            <i class="fas fa-fw fa-plane-departure"></i>
            <span>Book Flight</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Apply for Loan</span>
        </a>
    </li>

</ul>
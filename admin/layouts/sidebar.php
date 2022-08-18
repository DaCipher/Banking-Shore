<?php
define("BASE_URL", $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']);
define("ADMIN", BASE_URL . "/admin");
define("USER", BASE_URL . "/user");
?>

<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']; ?>/admin">
        <div class="sidebar-brand-icon">
            <img src="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']; ?>/assets/img/logo.png">
        </div>
        <div class="sidebar-brand-text mx-1">Financial Shore</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']; ?>/admin">
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
                <a class="collapse-item" href="<?= ADMIN; ?>/transaction/view-transactions.php">View Transaction</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/transaction/view-alerts.php">View Alert</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/transaction/add-history.php">Add</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/transaction/token.php">Token</a>
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
                <a class="collapse-item" href="<?= ADMIN; ?>/account/new-account.php">New Account</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/account/view-accounts.php">View</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/account/account-status.php">Status</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/account/account-officer.php">Account Officer</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/account/account-funding.php">Funding & Limit</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user" aria-expanded="true" aria-controls="user">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>User</span>
        </a>
        <div id="user" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= ADMIN; ?>/user/reset-password.php">Reset Password</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/user/reset-pin.php">Reset PIN</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/user/reset-security-questions.php">Reset Security Questions</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/user/new-message.php">New Message</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/user/view-message.php">View Message</a>
            </div>
        </div>
    </li>
    <?php if ($_SESSION['role'] == "webmaster") : ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admin" aria-expanded="true" aria-controls="admin">
                <i class="fas fa-fw fa-portrait"></i>
                <span>Admin</span>
            </a>
            <div id="admin" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= ADMIN; ?>/admin/add-admin.php">Add</a>
                    <a class="collapse-item" href="<?= ADMIN; ?>/admin/view-admin.php">View</a>
                    <a class="collapse-item" href="<?= ADMIN; ?>/admin/reset-password.php">Reset Password</a>
                    <a class="collapse-item" href="<?= ADMIN; ?>/admin/reset-pin.php">Reset PIN</a>
                    <a class="collapse-item" href="<?= ADMIN; ?>/admin/reset-security-questions.php">Reset Security Questions</a>
                </div>
            </div>
        </li>
    <?php endif; ?>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Self Service
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings" aria-expanded="true" aria-controls="settings">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Settings</span>
        </a>
        <div id="settings" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= ADMIN; ?>/settings/change-password.php">Change Password</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/settings/change-pin.php">Transaction PIN</a>
                <a class="collapse-item" href="<?= ADMIN; ?>/settings/change-security-questions.php">Security Questions</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Account Switch
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= USER; ?>/">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>User View</span>
        </a>
    </li>
</ul>
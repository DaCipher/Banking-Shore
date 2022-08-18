<?php

use App\Model\UserModel;

?>
<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">

            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger badge-counter"><?= ($user->msg) ? "+" : "";  ?></span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in mx-1" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Notification
                </h6> <?php if ($user->msg) :
                            $i = 0;
                            foreach ($user->msg as $msg) : $i++;

                                if ($i == 4) break; ?>

                        <div style="cursor: pointer;" onclick='window.location.assign(" <?= $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/user/account/inbox.php?id=" . $msg['id']; ?>")' class="border <?= ($msg['is_read'] == 0) ?  'border-left-primary' : ""; ?> p-2 d-flex align-items-center justify-content-between <?= ($msg['is_read'] == 0) ?  'font-weight-bold' : ""; ?>">
                            <div>
                                <div style="font-size: 0.9rem!important;"><?= ucwords($msg['subject']) ?></div>
                                <div style="font-size: 0.7rem!important;"> <?= (strlen($msg['message']) > 28) ? substr($msg['message'], 0, 28) . " ..." : substr($msg['message'], 0, 28); ?></div>
                            </div>
                            <div class="text-primary" style="font-size: 0.7rem;"><?= substr($msg['date'], 0, 9); ?></div>

                        </div>
                    <?php endforeach; ?>
                    <a class="dropdown-item text-center small text-gray-500" href="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']; ?>/user/account/inbox.php">Read More Messages</a>
                <?php else : ?>
                    <a class="dropdown-item text-center small text-gray-500">No new notification</a>
                <?php endif; ?>
            </div>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="img-profile bg-white text-secondary font-weight-bold rounded-circle d-flex align-items-center justify-content-center" style="max-width: 60px; font-size: 0.8rem;"> <?= $user->user['firstname'][0] . $user->user['lastname'][0]; ?></div>
                <span class="ml-2 d-none d-lg-inline text-white small"><?= $user->user['firstname'] . " " . $user->user['lastname']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']; ?>/user/account/account-information.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']; ?>/user/settings/change-password.php">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Password
                </a>
                <?php if (UserModel::isadmin($_SESSION['userid'])) : ?>
                    <a class="dropdown-item" href="<?= $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']; ?>/admin/">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Switch Account
                    </a>
                <?php endif; ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
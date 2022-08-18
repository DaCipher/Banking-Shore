<?php

use App\Controllers\UserController;

require_once "../../vendor/autoload.php";
$user = new UserController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Inbox - Financial Shore Online Banking</title>
    <?php include "../layouts/head.php"; ?>
</head>
<style>
    .message:hover {
        background-color: #e3eaef;
    }
</style>

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
                        <h1 class="h3 mb-0 text-gray-800">Inbox</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Account</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Inbox</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card mb-4 px-2">
                                <div class="card-body">
                                    <div>
                                        <?php if ($user->messages) :
                                            if (isset($_GET['id'])) :
                                                if (isset($user->valid_msg)) : ?>
                                                    <div>
                                                        <div class="mt-3 mb-4 d-flex justify-content-between align-items-start">
                                                            <div>

                                                                <div class="row no-gutter">
                                                                    <div class="col-2">
                                                                        <div class="my-1" onclick="window.location.assign('<?= $_SERVER['PHP_SELF']; ?>')"><i class="fas fa-arrow-left"></i></div>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <div class="font-weight-bold"><?= ucwords($user->valid_msg[0]['subject']); ?></div>
                                                                        <div style="font-size: 0.7rem;"><span class="font-weight-bold">Sent:</span> <?= $user->valid_msg[0]['date']; ?></div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div><i class="icon mx-4 fas fa-trash-alt text-danger" style="cursor: pointer"></i></div>
                                                        </div>
                                                        <div>
                                                            <?= ucfirst($user->valid_msg[0]['message']); ?> <br><br>
                                                            Regards, <br>
                                                            <b><?= ucwords($user->valid_msg[0]['sender']); ?> <br>
                                                                Financial Shore Bank
                                                            </b>
                                                        </div>

                                                        <form action="" id="delMessage" method="post">
                                                            <input type="hidden" name="id" value="<?= $user->valid_msg[0]['id']; ?>">
                                                            <input type="hidden" name="user" value="<?= $user->valid_msg[0]['receiver']; ?>">
                                                            <input type="hidden" name="action">
                                                        </form>
                                                    </div>
                                                <?php endif;
                                            else : ?>
                                                <?php foreach ($user->messages as $message) : ?>
                                                    <div onclick="window.location.assign('<?= $_SERVER['PHP_SELF'] . '?id=' . $message['id']; ?>')" class="rounded message border <?= ($message['is_read'] == 0) ?  'border-left-primary' : ""; ?> my-2 p-3 d-flex align-items-center justify-content-between <?= ($message['is_read'] == 0) ?  'font-weight-bold' : ""; ?>">
                                                        <div>
                                                            <div style="font-size: 1.2rem!important;"><?= ucwords($message['subject']) ?></div>
                                                            <div style="font-size: 0.8rem!important;"> <?= (strlen($message['message']) > 28) ? substr($message['message'], 0, 28) . " ..." : substr($message['message'], 0, 28); ?></div>
                                                        </div>
                                                        <div class="text-primary" style="font-size: 0.8rem;"><?= substr($message['date'], 0, 9); ?></div>

                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <!-- Template -->

                                            <!-- !Template -->
                                        <?php else : ?>
                                            <div class="py-5">
                                                <div class="py-5 text-center" style="font-size: 1.5rem;">Inbox Empty.</div>
                                            </div>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Links-->
                        <div class="col-xl-4 col-lg-5">
                            <?php include "../layouts/quick-link.php"; ?>
                        </div>
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
    <script src="../assets/js/inbox.js"></script>
</body>

</html>
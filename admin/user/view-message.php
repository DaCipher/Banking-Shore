<?php

use App\Controllers\AdminController;

require_once "../../vendor/autoload.php";
$user = new AdminController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View User Messages - Financial Shore Admin</title>
    <?php include "../layouts/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/css/bootstrap-select.min.css" />

</head>


<style>
    .message:hover {
        background-color: #e3eaef;
    }

    .message:hover.icon {
        color: black !important;
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
                        <h1 class="h3 mb-0 text-gray-800">Messages</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Message</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-12 col-md-8 mx-auto">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">User Messages</h6>
                                </div>
                                <div class="card-body">

                                    <form action="" id="user-message" class="mb-4" method="get">
                                        <select class="form-control selectpicker" id="users" name="user" data-show-subtext="true" data-live-search="true">
                                            <option value="" selected disabled> Select User </option>
                                            <?php if ($user->users) : ?>
                                                <?php foreach ($user->users as $users) : ?>
                                                    <option value="<?= $users['userid']; ?>" <?= ($user->get_account == $users['userid']) ? "selected" : ""; ?>><?= ucfirst($users['firstname']) . " " . ucfirst($users['lastname']); ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </form>
                                    <?php if ($user->messages) : $i = 0; ?>
                                        <?php if (isset($_POST['action']) && !empty($user->status_fail)) : ?>
                                            <div class="alert alert-danger text-center"><?= $user->status_fail; ?></div>
                                        <?php endif; ?>
                                        <?php if (isset($_POST['action']) && !empty($user->status_success)) : ?>
                                            <div class="alert alert-success text-center"><?= $user->status_success; ?></div>
                                        <?php endif; ?>
                                        <?php foreach ($user->messages as $message) : $i++ ?>

                                            <div class=" row rounded message border <?= ($message['is_read'] == 0) ?  'border-left-primary' : ""; ?> my-2 p-3 <?= ($message['is_read'] == 0) ?  'font-weight-bold' : ""; ?>">
                                                <div class="col-6">
                                                    <div style="font-size: 1.2rem!important;"><?= ucwords($message['subject']) ?></div>
                                                    <div class="d-none d-lg-block" style="font-size: 0.8rem!important;">
                                                        <?= (strlen($message['message']) > 28) ? substr($message['message'], 0, 28) . " ..." : substr($message['message'], 0, 28); ?>
                                                    </div>
                                                    <div class="d-lg-none" style="font-size: 0.8rem!important;">
                                                        <?= (strlen($message['message']) > 20) ? substr($message['message'], 0, 20) . " ..." : substr($message['message'], 0, 20); ?>
                                                    </div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="text-primary" style="font-size: 0.8rem;"><?= substr($message['date'], 0, 9); ?></div>
                                                    <div class="icon" data-id="<?= $message['id']; ?>" style="font-size: 1.3rem!important; cursor: pointer"><i class="fa fa-trash text-danger"></i></div>
                                                </div>
                                                <form action="" id="deleteMessage<?= $message['id']; ?>" method="post">
                                                    <input type="hidden" name="id" value="<?= $message['id']; ?>">
                                                    <input type="hidden" name="user" value="<?= $message['receiver']; ?>">
                                                    <input type="hidden" name="action">
                                                </form>
                                            </div>



                                        <?php endforeach; ?>


                                    <?php else : ?>
                                        <?php if (isset($_GET['user'])) : ?>
                                            <div class="px-4 py-5 d-flex justify-content-center align-items-center" style="height: 290px;">
                                                <div class="text-center">
                                                    <p style="font-size: 1.5rem;"> User Inbox empty!</p>

                                                </div>
                                            </div>

                                        <?php endif; ?>
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

            $('#users').change(function() {
                $('form#user-message').submit();
            });

            $('.icon').click(function() {
                var id = $(this).attr('data-id');
                $('form#deleteMessage' + id).submit();
            });
        });
    </script>

</body>

</html>
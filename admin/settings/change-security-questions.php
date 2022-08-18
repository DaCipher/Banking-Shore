<?php

use App\Controllers\AdminController;

require_once "../../vendor/autoload.php";
$user = new AdminController;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Security Question - Financial Shore Admin</title>
    <?php include "../layouts/head.php"; ?>
</head>
<style>
    @media (max-width: 567px) {
        #btn-submit {
            width: 100%;
        }
    }

    @media (min-width: 568px) {
        #btn-submit {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
    }

    input:focus {
        border-color: #ccc !important;
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
                        <h1 class="h3 mb-0 text-gray-800">Security Questions</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">PIN</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-md-6 mx-auto">
                            <div class="card mb-4 px-2">
                                <div class="card-body">
                                    <div>
                                        <div>
                                            <p>Keep your secret question and answer safe. Don't write them somewhere other people can access. If you forget your security question, you will not be able have access to your account. Use a question you can easily remeber the answer. </p>
                                        </div>
                                        <form action="" method="post" class="my-2" id="pin-form">
                                            <?php if (isset($_POST['change_security']) && !empty($user->sec_failed)) : ?>
                                                <div class="alert alert-danger text-center"><?= $user->sec_failed; ?></div>
                                            <?php unset($_POST['change_security']);
                                            endif; ?>
                                            <?php if (isset($_POST['change_security']) && !empty($user->sec_success)) : ?>
                                                <div class="alert alert-success text-center"><?= $user->sec_success; ?></div>
                                            <?php unset($_POST['change_security']);
                                            endif; ?>
                                            <div class="mb-4">
                                                <div class="form-group">
                                                    <label for="question">Question</label>
                                                    <input type="text" name="question" id="question" class="form-control" placeholder="e.g What city did you meet your spouse?" value="<?= $user->question; ?>" required>
                                                    <span class="help-block text-danger"><?= $user->question_error; ?></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="answer">Answer</label>
                                                    <div class="input-group">
                                                        <input type="password" name="answer" id="answer" class="form-control border-right-0 " placeholder="e.g Los Angeles" requered>
                                                        <div class="input-group-prepend">
                                                            <i class="input-group-text fas fa-eye bg-transparent text-dark border-left-0" id="view" style="border-radius: 0 5px 5px 0;"></i>
                                                        </div>
                                                    </div>

                                                    <span class="help-block text-danger"><?= $user->answer_error; ?></span>
                                                </div>
                                            </div>
                                            <div class="d-flex  justify-content-end mx-md-2">
                                                <input type="hidden" name="userid" value="<?= $_SESSION['userid']; ?>">
                                                <button type="submit" name="change_security" class="btn btn-outline-primary" id="btn-submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Quick Links-->

                    </div>
                    <!-- Modal Logout -->
                    <?php include "../layouts/logout-modal.php"; ?>

                </div>
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
    <script>
        $(document).ready(function() {
            $('#view').click(function() {
                $(this).toggleClass('fas fa-eye-slash').toggleClass('fas fa-eye');
                var type = $('#answer').attr("type");
                if (type == "password") {
                    $('#answer').attr("type", "text");
                } else {
                    $('#answer').attr("type", "password");
                }
            });
        });
    </script>
</body>

</html>
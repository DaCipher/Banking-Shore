<?php

use App\Controllers\LoginController;

require_once realpath("../vendor/autoload.php");
$login = new LoginController;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Set Security Question :: Internet Banking - Sterling Unity Bank</title>
    <?php include "../partials/head.php"; ?>


</head>
<style>
    .text-purple {
        color: #054a85 !important;
    }
</style>

<body class="main-login">

    <!-- ======= Top Bar ======= -->


    <main id="main">
        <!-- ======= Header ======= -->
        <?php include "../partials/inner/header.php"; ?>
        <!-- End Header -->

        <!-- ======= Breadcrumbs ======= -->

        <!-- End Breadcrumbs -->

        <!-- ======= Main Section ======= -->
        <div class="container d-flex align-items-center justify-content-center" style="height: 80vh!important;">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="shadow">
                        <div class="bg-light rounded">
                            <div class="pl-5 mt-2 py-3 mx text-center"> <span style="font-weight: bolder ;" class="text-purple">
                                    <h3>Set Security Question</h3>
                                </span>

                                </a>
                            </div>
                            <form class="px-4 pb-4" action="" method="POST">
                                <div>
                                    <p class="lead hint" style="font-weight: bold;">Keep your security question and answer safe.
                                        <br>
                                        Don't write them somewhere someone can access. Use a question you can easily remeber the answer, to avoid being locked out of your account.
                                    </p>

                                </div>

                                <?php if (isset($_POST['change_security']) && !empty($login->sec_failed)) : ?>

                                    <div class="alert alert-danger text-center"><?= $login->sec_failed; ?></div>

                                <?php unset($_POST['change_security']);

                                endif; ?>

                                <div class="mb-4">

                                    <div class="mb-3">

                                        <label for="question">Question</label>

                                        <input type="text" name="question" id="question" class="form-control" placeholder="e.g What city did you meet your spouse?" value="<?= $login->question; ?>" required autofocus>

                                        <span class="help-block text-danger"><?= $login->question_error; ?></span>

                                    </div>

                                    <div class="mb-3">

                                        <label for="answer">Answer</label>

                                        <div class="input-group">

                                            <input type="password" name="answer" id="answer" class="form-control border-right-0 " placeholder="e.g Los Angeles" requered>

                                            <div class="input-group-prepend border d-flex align-items-center">

                                                <i class="input-group-text border-0 fa fa-eye bg-transparent text-dark border-left-0" id="view" style="border-radius: 0 5px 5px 0;"></i>

                                            </div>

                                        </div>



                                        <span class="help-block text-danger"><?= $login->answer_error; ?></span>

                                    </div>

                                </div>

                                <div class="d-grid mx-md-2">

                                    <button type="submit" name="change_security" class="btn btn-outline-purple" id="btn-submit">Submit</button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Section -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <!-- End Footer -->

    <div id="preloader"></div>
    <?php include "../partials/scripts.php"; ?>
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
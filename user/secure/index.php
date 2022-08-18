<?php



use App\Controllers\LoginController;
use App\Controllers\UserController;

use App\Controllers\PaymentController;



require_once "../../vendor/autoload.php";

$pay = new PaymentController;
$user = new UserController;

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <?php

    include "../../partials/head.php";

    ?>

    <link rel="stylesheet" href="./assets/css/loader.css">

    <title>Secure Payment Gateway</title>

</head>



<body>



    <!-- ======== Preloader ======= -->

    <div id="loader">

        <div id="loader-container">

            <p id="loadingText">

                <marquee behavior="scroll" direction="left">Processing...</marquee>

            </p>

        </div>

    </div>

    <div class="background-primary">

        <?php include "../../partials/inner/header.php" ?>

    </div>

    <main id="main">



        <div class="container">

            <div class="my-2">

                <a href="" class="btn text-color-primary">Return to Funds Transfer</a>

            </div>

            <div class="row d-flex justify-content-center align-items-center" style="height: 80vh;">



                <?php if (isset($_GET['req'])) :

                    if ($_GET['req'] == "imf") : ?>

                        <!-- =========== IMF =========== -->

                        <div class="col-md-6 col-lg-4">

                            <div class="card border rounded">

                                <div class="card-body p-3">

                                    <h5><b><?= $user->user['firstname'] . " " . $user->user['lastname']; ?></b> <br>
                                        <spn class="lead"><?= $user->user['account_number']; ?> </spn>
                                    </h5>

                                    <div class="shadow mt-3 p-3">

                                        <p class="text-success">An International Monetory Fund (IMF) Code is required to procced with your transaction.</p>



                                    </div>

                                    <form action="" method="post" class="imf mt-5">

                                        <div>

                                            <h4>Enter Your IMF Code</h4>

                                            <div class="my-4">

                                                <input type="number" name="imf_code" id="imf_code" class="form-control" required autofocus>

                                                <span class="help-block text-danger"><?= $pay->code_error; ?></span>

                                            </div>

                                            <div class="d-grid gap-2">

                                                <button type="submit" name="imf" id="" class="btn background-primary text-white">SUBMIT</button>

                                            </div>

                                        </div>



                                    </form>

                                </div>

                            </div>

                        </div>

                    <?php elseif ($_GET['req'] == "cot") : ?>

                        <!-- ========== COT ======= -->

                        <div class="col-md-6 col-lg-4">

                            <div class="card border rounded">

                                <div class="card-body p-3">

                                    <h5>FirstName LastName <br> AccountNumber</h5>

                                    <div class="shadow mt-3 p-3">

                                        <p class="text-success">A Cost Of Transfer (COT) Code is required autofocus to procced with your transaction.</p>

                                    </div>

                                    <form action="" method="post" class="imf mt-5">

                                        <div>

                                            <h4>Enter Your COT Code</h4>

                                            <div class="my-4">

                                                <input type="number" name="cot_code" id="imf_code" class="form-control" required autofocus>

                                                <span class="help-block text-danger"><?= $pay->code_error; ?></span>

                                            </div>

                                            <div class="d-grid gap-2">

                                                <button type="submit" name="cot" id="" class="btn background-primary text-white">SUBMIT</button>

                                            </div>

                                        </div>



                                    </form>

                                </div>

                            </div>

                        </div>



                <?php endif;

                endif; ?>



            </div>



        </div>



        </div>

    </main>

    <?php include "../../partials/scripts.php"; ?>



    <script src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/assets/vendor/jquery/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            setTimeout(function() {

                $("#loader").remove();

            }, 5000);



        });
    </script>

</body>



</html>
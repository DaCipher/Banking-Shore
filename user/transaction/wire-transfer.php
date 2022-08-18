<?php



use App\Controllers\UserController;



require_once "../../vendor/autoload.php";

$user = new UserController;



?>

<!DOCTYPE html>

<html lang="en">



<head>

    <title>International Transfer - Financial Shore Online Banking</title>

    <?php include "../layouts/head.php"; ?>

</head>



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

                        <h1 class="h3 mb-0 text-gray-800">Wire Transfer</h1>

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="./">Transaction</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Wire</li>

                        </ol>

                    </div>



                    <div class="row mb-3">





                        <!-- Tab-->

                        <div class="col-xl-8 col-lg-7">

                            <div class="card mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                                    <h6 class="m-0 font-weight-bold text-primary">Wire Transfer</h6>

                                </div>

                                <div class="card-body">

                                    <form action="" class="my-2 p-3" method="POST">

                                        <?php if (isset($_POST['other']) && !empty($user->transfer_error)) : ?>

                                            <div class="alert alert-danger text-center"><?= $user->transfer_error; ?></div>

                                        <?php endif; ?>

                                        <?php if (isset($_POST['other']) && !empty($user->transfer_success)) : ?>

                                            <div class="alert alert-success text-center"><?= $user->transfer_success; ?></div>

                                        <?php endif; ?>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="from-acc">From Account</label>

                                            </div>

                                            <div class="col-md-8">

                                                <select name="from-acc" class="form-control" required>

                                                    <option value="">Select Account</option>

                                                    <?php foreach ($user->account as $account) : ?>

                                                        <option <?= ($user->from_acc == $account['account_id']) ? "selected" : ""; ?> value="<?= $account['account_id']; ?>"><?= ucfirst($account['account_type']) . "(" . $account['account_number'] . ") - " . ucfirst($user->user['firstname']) . "($" . number_format($account['account_balance']) . ")"; ?></option>



                                                    <?php endforeach; ?>

                                                </select>

                                                <span class="help-block info text-danger" id="acc-error"><?= (isset($_POST['other'])) ? $user->from_acc_error : ""; ?></span>

                                            </div>

                                        </div>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="bank">Bank Name</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input class="form-control" name="to-bank" value="<?= (isset($_POST['other'])) ? $user->to_bank : ""; ?>" required />




                                                <span class="help-block info text-danger" id="acc-error"><?= (isset($_POST['other'])) ? $user->to_bank_error : ""; ?></span>

                                            </div>

                                        </div>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="to-acc">Account Number</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input type="text" name="to-acc" pattern="[0-9.]+" class=" form-control" maxlength="17" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?= (isset($_POST['other'])) ? $user->to_acc : ""; ?>" required>

                                                <span class="help-block info text-danger" id="to-acc-error"><?= (isset($_POST['other'])) ? $user->to_acc_error : ""; ?></span>



                                            </div>

                                        </div>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="to-acc-name">Account Holder's Name</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input type="text" name="to-acc-name" class=" form-control" value="<?= (isset($_POST['other'])) ? $user->to_acc_name : ""; ?>" required>

                                                <span class="help-block info text-danger" id="amount-error"><?= (isset($_POST['other'])) ? $user->to_acc_name_error : ""; ?></span>



                                            </div>

                                        </div>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="routing-swift">Rounting Number / Swift Code</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input type="text" name="routing-swift" pattern="[0-9.]+" class=" form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?= (isset($_POST['other'])) ? $user->routing : ""; ?>" maxlength="9" required>

                                                <span class="help-block info text-danger" id="routing-error"><?= (isset($_POST['other'])) ? $user->routing_error : ""; ?></span>



                                            </div>

                                        </div>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="amount">Amount</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input type="text" name="amount" pattern="[0-9.]+" class=" form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?= (isset($_POST['other'])) ? $user->amount : ""; ?>" required>

                                                <span class="help-block info text-danger" id="amount-error"><?= (isset($_POST['other'])) ? $user->amount_error : ""; ?></span>

                                            </div>

                                        </div>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="narration">Narration</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input type="text" name="narration" class=" form-control" value="<?= (isset($_POST['other'])) ? $user->narration : ""; ?>" required>

                                                <span class="help-block info text-danger" id="narration-error"><?= (isset($_POST['other'])) ? $user->narration_error : ""; ?></span>

                                            </div>

                                        </div>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="pin">Transaction PIN</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input type="password" name="pin" class=" form-control" required>

                                                <span class="help-block info text-danger" id="pin-error"><?= (isset($_POST['other'])) ? $user->pin_error : ""; ?></span>

                                            </div>

                                        </div>

                                        <div class="d-flex justify-content-end my-4">

                                            <button type="submit" name="other" class="btn btn-primary rounded px-5">Transfer</button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <!-- Quick Links-->

                        <div class="col-xl-4 col-lg-5">

                            <?php include "../layouts/quick-link.php"; ?>

                        </div>

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



</body>



</html>
<?php



use App\Controllers\UserController;



require_once "../../vendor/autoload.php";

$user = new UserController;

?>



<!DOCTYPE html>

<html lang="en">



<head>

    <title>Send Money - Financial Shore Online Banking</title>

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

                        <h1 class="h3 mb-0 text-gray-800">Transfer Funds</h1>

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="./">Transaction</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Transfer</li>

                        </ol>

                    </div>



                    <div class="row mb-3">





                        <!-- Tab-->

                        <div class="col-xl-8 col-lg-7">

                            <div class="card mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                                    <h6 class="m-0 font-weight-bold text-primary">Send Money</h6>

                                </div>

                                <div class="card-body">

                                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">

                                        <li class="nav-item">

                                            <a class="nav-link <?= (isset($_POST['local'])) ? "active" : ""; ?> " id="home-tab" data-toggle="tab" href="#seb" role="tab" aria-controls="seb" aria-selected="true">SE Bank Account</a>

                                        </li>

                                        <li class="nav-item">

                                            <a class="nav-link  <?= (isset($_POST['other'])) ? "active" : ""; ?> " id="other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="other" aria-selected="false">Other Banks</a>

                                        </li>

                                    </ul>

                                    <div class="tab-content" id="myTabContent">

                                        <!-- SEB Transfer -->

                                        <div class="tab-pane fade <?= (isset($_POST['local'])) ? "show active" : ""; ?> " id="seb" role="tabpanel" aria-labelledby="seb-tab">

                                            <form action="" class="my-2 p-3" id="seb-local" name="seb-local" method="POST">

                                                <?php if (isset($_POST['local']) && !empty($user->transfer_error)) : ?>

                                                    <div class="alert alert-danger text-center"><?= $user->transfer_error; ?></div>

                                                <?php endif; ?>

                                                <?php if (isset($_POST['local']) && !empty($user->transfer_success)) : ?>

                                                    <div class="alert alert-success text-center"><?= $user->transfer_success; ?></div>

                                                <?php endif; ?>

                                                <div class="form-row my-2">

                                                    <div class="col-md-4">

                                                        <label for="from-acc">From Account</label>

                                                    </div>

                                                    <div class="col-md-8">

                                                        <select name="from-acc" id="acc" class="form-control" required>

                                                            <option value="">Select Account</option>

                                                            <?php foreach ($user->account as $account) : ?>

                                                                <option <?= ($user->from_acc == $account['account_id']) ? "selected" : ""; ?> value="<?= $account['account_id']; ?>"><?= ucfirst($account['account_type']) . "(" . $account['account_number'] . ") - " . ucfirst($user->user['firstname']) . "($" . number_format($account['account_balance']) . ")"; ?></option>



                                                            <?php endforeach; ?>

                                                        </select>

                                                        <span class="help-block info text-danger" id="acc-error"><?= (isset($_POST['local'])) ? $user->from_acc_error : ""; ?></span>

                                                    </div>

                                                </div>

                                                <div class="form-row my-2">

                                                    <div class="col-md-4">

                                                        <label for="to-acc">Account Number</label>

                                                    </div>

                                                    <div class="col-md-8">

                                                        <input type="text" name="to-acc" id="recipient-acc" pattern="[0-9.]+" class=" form-control" maxlength="17" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?= (isset($_POST['local'])) ? $user->to_acc : ""; ?>" required>

                                                        <span class="help-block info text-danger" id="to-acc-error"><?= (isset($_POST['local'])) ? $user->to_acc_error : ""; ?></span>

                                                        <span class=" px-2  d-flex justify-content-end" id="to-acc-name"></span>

                                                    </div>

                                                </div>

                                                <div class="form-row my-2">

                                                    <div class="col-md-4">

                                                        <label for="amount">Amount</label>

                                                    </div>

                                                    <div class="col-md-8">

                                                        <input type="text" name="amount" id="amount" pattern="[0-9.]+" class=" form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?= (isset($_POST['local'])) ? $user->amount : ""; ?>" required>

                                                        <span class="help-block info text-danger" id="amount-error"><?= (isset($_POST['local'])) ? $user->amount_error : ""; ?></span>

                                                    </div>

                                                </div>

                                                <div class="form-row my-2">

                                                    <div class="col-md-4">

                                                        <label for="narration">Narration</label>

                                                    </div>

                                                    <div class="col-md-8">

                                                        <input type="text" name="narration" id="narration" class=" form-control" value="<?= (isset($_POST['local'])) ? $user->narration : ""; ?>" required>

                                                        <span class="help-block info text-danger" id="narration-error"><?= (isset($_POST['local'])) ? $user->narration_error : ""; ?></span>

                                                    </div>

                                                </div>

                                                <div class="form-row my-2">

                                                    <div class="col-md-4">

                                                        <label for="pin">Transaction PIN</label>

                                                    </div>

                                                    <div class="col-md-8">

                                                        <input type="password" name="pin" id="pin" class=" form-control" required>

                                                        <span class="help-block info text-danger" id="pin-error"><?= (isset($_POST['local'])) ? $user->pin_error : ""; ?></span>

                                                    </div>

                                                </div>

                                                <div class="d-flex justify-content-end my-4">

                                                    <button type="submit" name="local" id="local" class="btn btn-primary rounded px-5">Send</button>

                                                </div>

                                            </form>

                                        </div>

                                        <!-- !SEB Transfer -->



                                        <!-- Other Bank -->

                                        <div class="tab-pane fade  <?= (isset($_POST['other'])) ? "show active" : ""; ?> " id="other" role="tabpanel" aria-labelledby="other-tab">

                                            <form action="" name="other-bank" id="other-bank" class="my-2 p-3" method="POST">

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

                                                        <input type="text" name="to-acc" pattern="[0-9.]+" class=" form-control" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?= (isset($_POST['other'])) ? $user->to_acc : ""; ?>" required>

                                                        <span class="help-block info text-danger" id="to-acc-error"><?= (isset($_POST['other'])) ? $user->to_acc_error : ""; ?></span>



                                                    </div>

                                                </div>

                                                <div class="form-row my-2">

                                                    <div class="col-md-4">

                                                        <label for="to-acc-name">Account Name</label>

                                                    </div>

                                                    <div class="col-md-8">

                                                        <input type="text" name="to-acc-name" class=" form-control" value="<?= (isset($_POST['other'])) ? $user->to_acc_name : ""; ?>" required>

                                                        <span class="help-block info text-danger" id="amount-error"><?= (isset($_POST['other'])) ? $user->to_acc_name_error : ""; ?></span>



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

                                                    <button type="submit" name="other" class="btn btn-primary rounded px-5">Send</button>

                                                </div>

                                            </form>

                                        </div>

                                        <!-- !Other Bank -->

                                    </div>

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



                    <!-- Auth Modal

                    <div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="authModalCenterTitle" aria-hidden="true">

                        <div class="modal-dialog  modal-sm modal-dialog-centered" role="document">

                            <div class="modal-content">

                                <div class="modal-header p-n1">

                                    <h5 class="modal-title" id="authModalLongTitle">Authetication</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>

                                    </button>

                                </div>

                                <div class="modal-body py-5 px-4">

                                    <div class="form-group pb-3">

                                        <label for="pin">Enter PIN</label>

                                        <input type="password" name="pin" id="pin" class="form-control">

                                    </div>

                                    <div class="div mb-3">

                                        <button type="submit" id="local_transfer" class="btn btn-block rounded btn-primary">Transfer</button>

                                    </div>

                                </div>



                            </div>

                        </div>

                    </div> -->



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

    <script src="../assets/js/funds-transfer.js"></script>



</body>



</html>
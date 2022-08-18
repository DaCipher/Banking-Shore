<?php



use App\Controllers\AdminController;



require_once "../../vendor/autoload.php";

$user = new AdminController;



?>



<!DOCTYPE html>

<html lang="en">



<head>

    <title>Add History - Financial Shore ADMIN</title>

    <?php include "../layouts/head.php"; ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/css/bootstrap-select.min.css" />



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

                        <h1 class="h3 mb-0 text-gray-800">Transactions</h1>

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="./">Transaction</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Add</li>

                        </ol>

                    </div>



                    <div class="row mb-3">





                        <!-- Tab-->

                        <div class="col-12">

                            <div class="card mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                                    <h6 class="m-0 font-weight-bold text-primary">Add Transaction</h6>

                                </div>

                                <div class="card-body">

                                    <!-- Other Bank -->

                                    <form action="" name="other-bank" id="other-bank" class="my-2 p-3" method="post">



                                        <?php if (isset($_POST['add']) && !empty($user->status_failed)) : ?>

                                            <div class="alert alert-danger text-center"><?= $user->status_failed; ?></div>

                                        <?php endif; ?>

                                        <?php if (isset($_POST['add']) && !empty($user->status_success)) : ?>

                                            <div class="alert alert-success text-center"><?= $user->status_success; ?></div>

                                        <?php endif; ?>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="target_account">Target Account</label>

                                            </div>

                                            <div class="col-md-8">

                                                <select id="target_account" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>

                                                    <option id="target_default" value="">Select Target Account</option>

                                                    <?php foreach ($user->users as $account) : ?>

                                                        <option value="<?= $account['account_id'] . " " . $account['firstname'] . " " . $account['lastname']; ?>"><?= ucfirst($account['firstname']) . " " . $account['lastname'] . " - " . ucfirst($account['account_type']) . " (" . $account['account_number'] . ") - " . "($" . number_format($account['account_balance']) . ")"; ?></option>



                                                    <?php endforeach; ?>

                                                </select>

                                                <input type="hidden" name="account_name" id="account_name">

                                                <input type="hidden" name="account_id" id="account_id">

                                                <span class="help-block info text-danger" id="target_account_error"></span>

                                            </div>

                                        </div>

                                        <div class="form-row my-2" id="transfer_type_field">

                                            <div class="col-md-4">

                                                <label for="transaction_type">Transaction Type</label>

                                            </div>

                                            <div class="col-md-8">

                                                <select class="form-control" id="transaction_type" name="transaction_type" required>

                                                    <option selected id="trans_type_default" value="">Select Transaction Type </option>

                                                    <option value="credit">Credit</option>

                                                    <option value="debit">Debit</option>

                                                </select>

                                                <span class="help-block info text-danger" id="transaction_type-error"></span>



                                            </div>

                                        </div>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="transfer_type">Transfer Type</label>

                                            </div>

                                            <div class="col-md-8">

                                                <select class="form-control" id="transfer_type" name="transfer_type" required>

                                                    <option disabled selected value="">Select TransferType </option>

                                                    <option value="local">Local</option>

                                                    <option value="inter-bank">Inter bank</option>

                                                </select>

                                                <span class="help-block info text-danger" id="-error"></span>



                                            </div>

                                        </div>

                                        <div class="form-row my-2 d-none" id="sender_name_field">

                                            <div class="col-md-4">

                                                <label for="sender_name">Sender's Name</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input type="text" name="sender_name" id="sender_name" class="form-control">

                                                <span class="help-block info text-danger" id="sender_name-error"></span>



                                            </div>

                                        </div>

                                        <div class="form-row my-2 d-none" id="reciever_name_field">

                                            <div class="col-md-4">

                                                <label for="reciever_name">Reciever's Name</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input type="text" name="reciever_name" id="reciever_name" class="form-control">

                                                <span class="help-block info text-danger" id="reciever_name-error"></span>



                                            </div>

                                        </div>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="to-acc-name">Date & Time</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input type="datetime-local" id="date" name="date" class="form-control" value="" placeholder="e.g 12-Dec-2021 15-29-47" required>

                                                <span class="help-block info text-danger" id="amount-error"></span>
                                                <span class="help-block" style="font-size:0.8rem; color:rgba(5, 87, 158, 0.9);"><b>Note: Timezone is New York (GMT -5)</b> </span>



                                            </div>

                                        </div>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="amount">Amount</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input type="text" name="amount" pattern="[0-9.]+" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="" required>

                                                <span class="help-block info text-danger" id="amount-error"></span>

                                            </div>

                                        </div>

                                        <div class="form-row my-2">

                                            <div class="col-md-4">

                                                <label for="narration">Narration</label>

                                            </div>

                                            <div class="col-md-8">

                                                <input type="text" name="narration" class="form-control" value="" required>

                                                <span class="help-block info text-danger" id="narration-error"></span>

                                            </div>

                                        </div>
                                        <div class="form-row my-2">

                                            <div class="col-md-4"></div>
                                            <div class="col-md-8">
                                                <div class="my-4">

                                                    <button type="submit" name="add" class="btn btn-block btn-primary rounded px-lg-5">Add Transaction</button>

                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                    <!-- !Other Bank -->

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {

            $("#myInput").on("keyup", function() {

                var value = $(this).val().toLowerCase();

                $("#myTable tr").filter(function() {

                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

                });

            });

            $("#target_account").change(function() {

                if ($(this).val() == "") {

                    $("#target_account_error").text("Select Account!");

                    $('#sender_name_field').addClass("d-none");

                    $('#sender_name').attr("required", false);

                    $('#reciever_name_field').addClass("d-none");

                    $('#reciever_name').attr("required", false);

                    $("#transaction_type").val("");

                } else {

                    $("#target_account_error").text("");

                    var acc_name = $(this).val().slice(7);

                    var acc_id = $(this).val().slice(0, 6);

                    $('#account_name').val(acc_name)

                    $('#account_id').val(acc_id);

                }

            });

            $("#transaction_type").change(function() {

                var trans_type = $("#transaction_type");

                if ($(trans_type).val() == "") {

                    $('#sender_name_field').addClass("d-none");

                    $('#sender_name').attr("required", false);

                    $('#reciever_name_field').addClass("d-none");

                    $("#reciever_name").attr("required", false);

                }

                if ($("#target_account").val() == "") {

                    $("#target_account_error").text("Select Account!");

                    $("#transaction_type").val("");

                } else {

                    $("#target_account_error").text("");

                    if ($(trans_type).val() !== "") {

                        if ($(trans_type).val() == "credit") {

                            $('#sender_name_field').removeClass("d-none");

                            $('#sender_name').attr("required", true);

                            $('#reciever_name_field').addClass("d-none");

                            $("#reciever_name").attr("required", false);

                        } else if ($(trans_type).val() == "debit") {

                            $('#sender_name_field').addClass("d-none");

                            $('#sender_name').attr("required", false);

                            $('#reciever_name_field').removeClass("d-none");

                            $("#reciever_name").attr("required", true);



                        } else {

                            $('#sender_name_field').addClass("d-none");

                            $('#sender_name').attr("required", false);

                            $('#reciever_name_field').addClass("d-none");

                            $("#reciever_name").attr("required", false);

                        }



                    }

                }



            });

            $('.selectpicker').selectpicker();

        });
    </script>





</body>



</html>
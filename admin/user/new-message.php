<?php

use App\Controllers\AdminController;

require_once "../../vendor/autoload.php";
$user = new AdminController;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Send Message - Financial Shore Admin</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Message</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Message</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Compose</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-lg-8 mx-auto">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Compose Message</h6>
                                </div>
                                <div class="card-body">
                                    <form action="" name="" id="" class="my-2 p-3" method="post">

                                        <?php if (isset($_POST['send']) && !empty($user->status_fail)) : ?>
                                            <div class="alert alert-danger text-center"><?= $user->status_fail; ?></div>
                                        <?php endif; ?>
                                        <?php if (isset($_POST['send']) && !empty($user->status_success)) : ?>
                                            <div class="alert alert-success text-center"><?= $user->status_success; ?></div>
                                        <?php endif; ?>
                                        <div class="form-row my-2" id="">
                                            <div class="col-md-4">
                                                <label for="from">From</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="from" id="from" class="form-control" required>
                                                <span class="help-block info text-danger" id="from-error"><?= $user->from_error; ?></span>

                                            </div>
                                        </div>
                                        <div class="form-row my-2">
                                            <div class="col-md-4">
                                                <label for="date">Date & Time</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="datetime-local" id="date" name="date" class="form-control" value="" placeholder="e.g 12-Dec-2021 15-29-47" required>
                                                <span class="help-block info text-danger" id="date-error"><?= $user->date_error; ?></span>

                                            </div>
                                        </div>
                                        <div class="form-row my-2">
                                            <div class="col-md-4">
                                                <label for="to">To</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="to" name="to" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" required>
                                                    <option id="target_default" value="">Select Receipient</option>
                                                    <?php foreach ($user->users as $account) : ?>
                                                        <option value="<?= $account['userid']; ?>"><?= ucfirst($account['firstname']) . " " . $account['lastname']; ?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="help-block info text-danger" id="to_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-row my-2" id="transfer_type_field">
                                            <div class="col-md-4">
                                                <label for="subject">Subject</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="subject" id="subject" class="form-control" required>
                                                <span class="help-block info text-danger" id="subject-error"></span>

                                            </div>
                                        </div>
                                        <div class="form-row my-2">
                                            <div class="col-md-4">
                                                <label for="transfer_type">Message</label>
                                            </div>
                                            <div class="col-md-8">
                                                <textarea name="message" class="form-control" name="message" cols="30" rows="10" required></textarea>
                                                <span class="help-block info text-danger" id="message-error"></span>

                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end my-4">
                                            <button type="submit" name="send" class="btn btn-primary rounded px-5">Send </button>
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
            $('.selectpicker').selectpicker();
        });
    </script>


</body>

</html>
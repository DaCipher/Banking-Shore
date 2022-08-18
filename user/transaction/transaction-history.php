<?php

use App\Controllers\UserController;

require_once "../../vendor/autoload.php";
$user = new UserController;

if ($_SERVER['PHP_SELF'] !== "/user/transaction/transaction-history.php") {
    header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user/transaction/transaction-history.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Transaction History - Financial Shore Online Banking</title>
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
                        <h1 class="h3 mb-0 text-gray-800">History</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Transaction</a></li>
                            <li class="breadcrumb-item active" aria-current="page">History</li>
                        </ol>
                    </div>

                    <div class="row mb-3">


                        <!-- Tab-->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Transaction History</h6>
                                </div>
                                <div class="card-body">
                                    <?php if ($user->paginate) :
                                        foreach ($user->paginate['result'] as $history) : ?>
                                            <div class="rounded border border-left-<?= ($history['transaction_type'] == "debit") ? "danger" : "success" ?> border-top-dark border-right-dark py-2 px-3 mb-2" style="font-size: 0.8rem;">
                                                <div class="d-flex justify-content-between">
                                                    <div><?= $history['date']; ?></div>
                                                    <div class="text-<?= ($history['transaction_type'] == "debit") ? "danger" : "success" ?>">$ <?= number_format($history['amount']) ?></div>
                                                </div>
                                                <hr class="my-2">
                                                <div><?= $history['narration'] ?></div>
                                            </div>
                                        <?php endforeach; ?>

                                        <nav class="page navigation mt-4 d-flex justify-content-center">
                                            <ul class="pagination">

                                                <li class="page-item <?= ($user->page == 1) ? "disabled" : ""; ?>">
                                                    <a href="<?= $_SERVER['PHP_SELF'] . "?page=" . ($user->page - 1); ?>" class="page-link">&laquo;</a>
                                                </li>

                                                <?php for ($i = 1; $i <= $user->pages; $i++) : ?>
                                                    <li class="page-item px-1 <?= ($user->page == $i) ? "active" : ""; ?>">
                                                        <a href="<?= $_SERVER['PHP_SELF'] . "?page=" . $i; ?>" class="page-link"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <li class="page-item <?= ($user->page == $user->pages) ? "disabled" : ""; ?>">
                                                    <a href="<?= $_SERVER['PHP_SELF'] . "?page=" . ($user->page + 1); ?>" class="page-link">&raquo;</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    <?php else : ?>
                                        <div class="px-4  py-5 d-flex justify-content-center align-items-center" style="height: 290px;">
                                            <div class="text-center">
                                                <p style="font-size: 1.5rem;"> No transaction yet!</p>
                                                <p>All transactions perfomed on your account will appear here.</p>
                                            </div>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                        <!-- Quick Links-->
                        <div class="col-xl-4 col-lg-5">
                            <?php include "../layouts/quick-link.php"; ?>
                        </div>
                    </div>


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

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "../layouts/scripts.php"; ?>
</body>

</html>
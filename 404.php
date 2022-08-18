<!DOCTYPE html>
<html lang="en">

<head>
    <title>Page Not Found - Financial Shore Bank</title>
    <?php include "./partials/head.php"; ?>


</head>

<body>

    <!-- ======= Top Bar ======= -->
    <?php include "./partials/top-bar.php"; ?>
    <!-- ======= Header ======= -->
    <?php include "./partials/header.php"; ?>
    <!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="javascript:void(0);">Error</a></li>
                    <li><a href="javascript:void(0);">Page Not Found</a></li>
                </ol>
                <h2>Page Not Found</h2>

            </div>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= Main Section ======= -->
        <section>
            <div class="container d-flex align-items-center justify-content-center">
                <img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/assets/img/404.png" class="img-fluid" style="max-height:650px" data-aos="fade-down">
            </div>
        </section>
        <!-- End Main Section -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include "./partials/footer.php"; ?>
    <!-- End Footer -->

    <div id="preloader"></div>
    <?php include "./partials/scripts.php"; ?>

</body>

</html>
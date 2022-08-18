<!DOCTYPE html>
<html lang="en">

<head>
    <title>Corporate Banking - Financial Shore Bank</title>
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
                    <li><a href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>">Home</a></li>
                    <li><a href="">Banking</a></li>
                </ol>
                <h2>Corporate Banking</h2>

            </div>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= Main Section ======= -->
        <section class="site-section pt-n3">
            <div class="container">
                <div class="">
                    <h3> Consider your bank account a business asset.</h3>
                    <h4 class="lead">With banking solutions designed to increase productivity & growth, togther we will make your bussiness vision a reality. </h4>
                    <div class="mt-3">When you consider the advantages that come with a Financial Shore Account
                        and the many benefits to your business, coupled with the support and guidance you
                        receive from your ever attentive relationship manager, you would be right to consider it
                        a valuable business asset.</div>
                </div>
            </div>
        </section>
        <section class="site-section bg-light">
            <div class="container">
                <div class="row mx-auto">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card shadow rounded h-100">
                            <div class="img-gradient">
                                <img src="./assets/img/electronic-banking.jpg" alt="account" class="card-img-top">
                            </div>
                            <div class="card-img-overlay h-100 align-items-center">
                                <h5 class="card-text text-white">Electronic Banking</h5>
                            </div>

                            <div class="card-body">
                                <h5></h5>
                                <p class="card-text">Business is increasingly mobile as opportunities may arise far
                                    from home base. Our electronic banking platforms can keep you connected to your
                                    funds wherever you may be on the planet.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card shadow rounded h-100">
                            <div class="img-gradient">
                                <img src="./assets/img/business-services.jpg" alt="account" class="card-img-top">
                            </div>
                            <div class="card-img-overlay h-100 align-items-center">
                                <h5 class="card-text text-white">Business Services</h5>
                            </div>

                            <div class="card-body">
                                <h5></h5>
                                <p class="card-text">International trade can be a complicated endeavor with
                                    different laws and practices to contend with in every market one conducts
                                    business. So you need a bank that understands international trade and can offer
                                    the best help.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card shadow rounded h-100">
                            <div class="img-gradient">
                                <img src="./assets/img/investment & Loans.jpg" alt="account" class="card-img-top">
                            </div>
                            <div class="card-img-overlay h-100 align-items-center">
                                <h5 class="card-text text-white">Investment & Loans</h5>
                            </div>

                            <div class="card-body">
                                <h5></h5>
                                <p class="card-text">Ideas capable of reshaping our world often require vast sums of
                                    money to bring to life. Our loans have never met an idea they couldn’t birth. So
                                    bring on the big ideas and let’s change the world together.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card shadow rounded h-100">
                            <div class="img-gradient">
                                <img src="./assets/img/cards-solutions.jpg" alt="account" class="card-img-top">
                            </div>
                            <div class="card-img-overlay h-100 align-items-center">
                                <h5 class="card-text text-white">Card Solutions</h5>
                            </div>

                            <div class="card-body">
                                <h5></h5>
                                <p class="card-text">Paying with plastic is steadily becoming the rule rather then
                                    the exception. But our corporate cards aren’t only about replacing cash, as
                                    there is so much more you can do with them.</p>
                            </div>
                        </div>
                    </div>
                </div>
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
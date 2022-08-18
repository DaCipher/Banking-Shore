<?php



use App\Controllers\ContactController;



require_once "./vendor/autoload.php";

new ContactController;

?>



<!DOCTYPE html>

<html lang="en">



<head>

    <title>Financial Shore Bank - The future of banking</title>

    <?php include "./partials/head.php"; ?>

</head>



<body>



    <!-- ======= Top Bar ======= -->

    <?php include "./partials/top-bar.php"; ?>



    <!-- ======= Header ======= -->

    <?php include "./partials/header.php"; ?>



    <!-- End Header -->



    <!-- ======= Hero Section ======= -->

    <section id="hero" class="d-flex justify-content-center align-items-center">

        <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">



            <!-- Slide 1 -->

            <div class="carousel-item active">

                <div class="carousel-container">

                    <h2 class="animate__animated animate__fadeInDown">We are the bank <span>for everyone</span></h2>

                    <p class="animate__animated animate__fadeInUp">We are here to help you get the best out your money. <br>Welcome to your freedom!</p>

                    <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>

                </div>

            </div>



            <!-- Slide 2 -->

            <div class="carousel-item">

                <div class="carousel-container">

                    <h2 class="animate__animated animate__fadeInDown">Excellent Customer Service</h2>

                    <p class="animate__animated animate__fadeInUp">We are synonymous with innovation, building excellence, superior financial performance and creating role models for society.</p>

                    <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>

                </div>

            </div>



            <!-- Slide 3 -->

            <div class="carousel-item">

                <div class="carousel-container">

                    <h2 class="animate__animated animate__fadeInDown">Bank from almost anywhere</h2>

                    <p class="animate__animated animate__fadeInUp">With internet banking, you can manage your accounts anytime, anywhere. View ewcent transactions, perfom transactions and more.</p>

                    <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>

                </div>

            </div>



            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">

                <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>

            </a>



            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">

                <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>

            </a>



        </div>

    </section><!-- End Hero -->



    <main id="main">



        <!-- ======= Icon Boxes Section ======= -->

        <section id="icon-boxes" class="icon-boxes">

            <div class="container">



                <div class="row">

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up">

                        <div class="icon-box">

                            <div class="icon"><i class="bx bxl-dribbble"></i></div>

                            <h4 class="title"><a href="">Grow Your Wealth</a></h4>

                            <p class="description">Take advantage of our wealth management scheme. We help:</p>

                            <ul>

                                <li class="description">Track your spending.</li>

                                <li class="description">Offer Invest programs.</li>

                                <li class="description">Provide Fincancial Analysis.</li>

                            </ul>

                        </div>

                    </div>



                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">

                        <div class="icon-box">

                            <div class="icon"><i class="bx bx-file"></i></div>

                            <h4 class="title"><a href="">Great Cashback</a></h4>

                            <p class="description">Get up to 5% cash back on your first funding.

                                Enjoy up to 20% annual interest on your savinsg account.</p>

                            <p class="description">T&C Applies.</p>

                        </div>

                    </div>



                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="200">

                        <div class="icon-box">

                            <div class="icon"><i class="bx bx-tachometer"></i></div>

                            <h4 class="title"><a href="">Invest your way</a></h4>

                            <p class="description">We have tools, the people and the insights to help you create a personalized strategy to pursue your goals.</p>

                            <p class="description">All you will need is readily available.</p>

                        </div>

                    </div>



                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="300">

                        <div class="icon-box">

                            <div class="icon"><i class="bx bx-layer"></i></div>

                            <h4 class="title"><a href="">The right features</a></h4>

                            <p class="description">Including a $0 Liability Guarantee that helps cover you from unauthorized transactions.</p>

                            <p class="description">Get started with a Stand Express Bank Checking Account</p>

                        </div>

                    </div>



                </div>



            </div>

        </section><!-- End Icon Boxes Section -->



        <!-- ======= About Us Section ======= -->

        <section id="about" class="about">

            <div class="container" data-aos="fade-up">



                <div class="section-title">

                    <h2>About Us</h2>

                    <p>Financial Shore Bank has worked to make a difference in our customers' lives in ways that matter most to them.</p>

                </div>



                <div class="row content">

                    <div class="col-lg-6">

                        <p>

                            We offer financial tools that can be automated, you set once and our system does the automated analysis and monitoring. Financial problems simplified!

                        </p>

                        <ul>

                            <li><i class="ri-check-double-line"></i> Pay absolutely nothing for sending money</li>

                            <li><i class="ri-check-double-line"></i> See where your money goes without solving equations.</li>

                            <li><i class="ri-check-double-line"></i> Get up to 15% annual interest on Fixed Savings.</li>

                        </ul>

                    </div>

                    <div class="col-lg-6 pt-4 pt-lg-0">

                        <p>

                            We provide you with budget tools to keep track of your spendings and not exceed your set budget. We empower our users with loans of different levels awith super friendly interest rates.

                        </p>

                        <p>Also provided, are tools for tracking your spending habits, saving more and making the right money moves.</p>

                        <a href="./about-us.php" class="btn-learn-more">Learn More</a>

                    </div>

                </div>



            </div>

        </section><!-- End About Us Section -->



        <!-- ======= Clients Section ======= -->

        <section id="clients" class="clients">

            <div class="container" data-aos="zoom-in">



                <marquee behavior="scroll" direction="left" class="text-primary">

                    <h3 style="font-size: 1.9rem; font-weight: bold!important;">Financial Shore Bank supports women and small bussiness owners with up to $100 million credit facility. </h3>

                </marquee>

            </div>



            </div>

        </section><!-- End Clients Section -->



        <!-- ======= Why Us Section ======= -->

        <section id="why-us" class="why-us">

            <div class="container-fluid">



                <div class="row">



                    <div class="col-lg-5 align-items-stretch position-relative video-box" style='background-image: url("assets/img/why-us.jpg");' data-aos="fade-right">

                    </div>



                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch" data-aos="fade-left">



                        <div class="content">

                            <h3>Innovative Banking <strong>Experience</strong></h3>

                            <p>

                                Tailored to your lifestyle, designed for your

                                personal and business needs.

                            </p>

                        </div>



                        <div class="accordion-list">

                            <ul>

                                <li data-aos="fade-up" data-aos-delay="100">

                                    <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>>>> </span> Higher transaction limits for your business needs. <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>

                                    <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">

                                        <p>

                                            Enjoy high transaction limits that is enough to facilate your day-to-day payments and transfers without owrrying about exceeding your limit.

                                        </p>

                                    </div>

                                </li>



                                <li data-aos="fade-up" data-aos-delay="200">

                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>>>> </span> Get a Financial Shore business account without paperwork. <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>

                                    <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">

                                        <p>

                                            Banking halls and queues are old news with Financial Shore Business. Wherever you are, we’ll help you set up your account online quickly.

                                        </p>

                                    </div>

                                </li>



                                <li data-aos="fade-up" data-aos-delay="300">

                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>>>> </span> Send money to any local account at no cost. <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>

                                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">

                                        <p>

                                            Enjoy our standard 10 free transfers to other banks every month even when you’re sending thousands of dollars at once.

                                        </p>

                                    </div>

                                </li>



                            </ul>

                        </div>



                    </div>



                </div>



            </div>

        </section><!-- End Why Us Section -->



        <!-- ======= Services Section ======= -->

        <section id="services" class="services">

            <div class="container" data-aos="fade-up">



                <div class="section-title">

                    <h2>Services</h2>

                </div>



                <div class="row">

                    <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">

                        <div class="icon-box">

                            <i class="bi bi-card-checklist"></i>

                            <h4><a href="#">Insurance Consulting</a></h4>

                            <p>Whether a business or an individual, we have a team of highly experienced professionals that will develop your insurance plans and assess the type of corporate insurance you need.</p>

                        </div>

                    </div>

                    <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">

                        <div class="icon-box">

                            <i class="bi bi-bar-chart"></i>

                            <h4><a href="#">Financial Investment</a></h4>

                            <p>With our connections across the globe, we provide you with stuck and bond deals to maximize your revenue and navigate regulatory requirements.</p>

                        </div>

                    </div>

                    <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="300">

                        <div class="icon-box">

                            <i class="bi bi-binoculars"></i>

                            <h4><a href="#">Income Monitoring</a></h4>

                            <p>Helping you monitor your expenditures against income is our priority as we take the financial welfare of our customers seriously.</p>

                        </div>

                    </div>

                    <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="400">

                        <div class="icon-box">

                            <i class="bi bi-credit-card"></i>

                            <h4><a href="#">Credit card</a></h4>

                            <p>We offer free credit scores, purchase protection, fraud protection, and above all convenience while using your credit cards.</p>

                        </div>

                    </div>

                    <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="500">

                        <div class="icon-box">

                            <i class="bi bi-calendar4-week"></i>

                            <h4><a href="#">Financial Management</a></h4>

                            <p>We help our customers plan, organise and control their financial activities while boosting their financial health.</p>

                        </div>

                    </div>

                    <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="600">

                        <div class="icon-box">

                            <i class="bi bi-briefcase"></i>

                            <h4><a href="#">Business Consulting</a></h4>

                            <p>We help our customers identify, address, and overcome obstacles to meeting their business goals.</p>

                        </div>

                    </div>

                </div>



            </div>

        </section><!-- End Services Section -->



        <!-- ========= How to get started ====== -->

        <section>

            <div class="section-title">

                <h2>Get Started</h2>

            </div>

            <div class="container">

                <div class="row" data-aos="fade-up">

                    <div class="col-md-4 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">

                        <div class="shadow" style="border-radius: 10px;">

                            <div class="card border-0 py-5 px-4" style="border-radius: 10px;">

                                <div class="card-body">

                                    <div class="d-flex justify-content-center mb-3">

                                        <p class="text-center py-2 px-4 rounded-circle text-primary" style=" border: 2px solid #f6b024; font-weight: bold;  font-size: 2rem;">1</p>

                                    </div>

                                    <div class="text-center">

                                        <h4 class="text-primary">Apply Online</h4>

                                        <p>Fill the online application form accurately with your required details and submit. <br> Note that the details you supplied is subject to verification.</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">

                        <div class="shadow" style="border-radius: 10px;">

                            <div class="card border-0 py-5 px-4" style="border-radius: 10px;">

                                <div class="card-body">

                                    <div class="d-flex justify-content-center mb-3">

                                        <p class="text-center py-2 px-4 rounded-circle text-primary" style=" border: 2px solid #f6b024; font-weight: bold;  font-size: 2rem;">2</p>

                                    </div>

                                    <div class="text-center">

                                        <h4 class="text-primary">Verification</h4>

                                        <p>An email with instructions on how to procced will be sent to your mail. <br> Kindly follow the instructions.</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">

                        <div class="shadow" style="border-radius: 10px;">

                            <div class="card border-0 py-5 px-4" style="border-radius: 10px;">

                                <div class="card-body">

                                    <div class="d-flex justify-content-center mb-3">

                                        <p class="text-center py-2 px-4 rounded-circle text-primary" style=" border: 2px solid #f6b024; font-weight: bold;  font-size: 2rem;">3</p>

                                    </div>

                                    <div class="text-center">

                                        <h4 class="text-primary">All Set!</h4>

                                        <p>You account is ready. Desposit funds into your account and start performing transactions.</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- ======= Cta Section ======= -->

        <section id="cta" class="cta">

            <div class="container">



                <div class="row" data-aos="zoom-in">

                    <div class="col-lg-9 text-center text-lg-start">

                        <h3>Get Started</h3>

                        <p> You are one step away from making the bold move on enjoying free banking from anywhere with 24/7 customer support. <br> What are you waiting for?</p>

                    </div>

                    <div class="col-lg-3 cta-btn-container text-center">

                        <a class="cta-btn align-middle" href="./account/register.php">Register Now</a>

                    </div>

                </div>



            </div>

        </section><!-- End Cta Section -->









        <!-- ======= Contact Section ======= -->

        <section id="contact" class="contact">

            <div class="container" data-aos="fade-up">



                <div class="section-title">

                    <h2>Contact Us</h2>

                </div>



                <div class="row mt-1 d-flex justify-content-end" data-aos="fade-right" data-aos-delay="100">



                    <div class="col-lg-5">

                        <div class="info">

                            <div class="address">

                                <i class="bi bi-geo-alt"></i>

                                <h4>Location:</h4>

                                <p>A108 Adam Street, New York, NY 535022</p>

                            </div>



                            <div class="email">

                                <i class="bi bi-envelope"></i>

                                <h4>Email:</h4>

                                <p>info@financialshore.com

                                </p>

                            </div>



                            <div class="phone">

                                <i class="bi bi-phone"></i>

                                <h4>Call:</h4>

                                <p>+1 409 242-6256</p>

                            </div>
                            <div class="phone">

                                <i class="bi bi-whatsapp"></i>

                                <h4>WhatsApp:</h4>

                                <p>+1 409 242-6256</p>

                            </div>


                        </div>



                    </div>



                    <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="100">



                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="php-email-form">

                            <div class="row">

                                <div class="col-md-6 form-group">

                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>

                                </div>

                                <div class="col-md-6 form-group mt-3 mt-md-0">

                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>

                                </div>

                            </div>

                            <div class="form-group mt-3">

                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>

                            </div>

                            <div class="form-group mt-3">

                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>

                            </div>

                            <div class="my-3">

                                <div class="loading">Sending Message...</div>

                                <div class="error-message"></div>

                                <div class="sent-message">Your message has been sent. Thank you!</div>

                            </div>

                            <input type="hidden" name="contact">

                            <div class="text-center"><button type="submit">Send Message</button></div>

                        </form>



                    </div>



                </div>



            </div>

        </section><!-- End Contact Section -->



    </main><!-- End #main -->



    <!-- ======= Footer ======= -->

    <?php include "./partials/footer.php"; ?>

    <!-- End Footer -->



    <div id="preloader"></div>



    <!-- ========== SCRIPTS ========= -->

    <?php include "./partials/scripts.php"; ?>



</body>



</html>
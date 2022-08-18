 <header id="header" class="fixed-top d-flex align-items-center header-inner-pages">
     <div class="container d-flex align-items-center justify-content-between">

         <div class="d-flex align-items-center">
             <!-- Uncomment below if you prefer to use an image logo -->
             <a href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>" class="logo"><img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/assets/img/logo.png" alt="" class="img-fluid"></a>
             <h3 class="logo"><a href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>" style="color: #f6b024;">Financial Shore</a></h3>
         </div>
         <nav id="navbar" class="navbar">
             <ul>
                 <li><a class="nav-link scrollto " href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>#hero">Home</a></li>
                 <li><a class="nav-link scrollto" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>#about">About</a></li>
                 <li><a class="nav-link scrollto" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>#services">Services</a></li>
                 <li class="dropdown"><a href="#"><span>Banking</span> <i class="bi bi-chevron-down"></i></a>
                     <ul>
                         <li><a href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/personal-banking.php">Personal Banking</a></li>
                         <li><a href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/business-banking.php">Bussiness Banking</a></li>
                         <li><a href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/corporate-banking.php">Corporate Banking</a></li>
                         <li><a href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/wealth-management.php">Wealth Management</a></li>
                     </ul>
                 </li>
                 <li class="dropdown"><a href="#"><span>Account</span> <i class="bi bi-chevron-down"></i></a>
                     <ul>
                         <li><a href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/account/register.php">Open account</a></li>
                         <li><a href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/account/login.php">Internet Banking</a></li>
                     </ul>
                 </li>
                 <li><a class="nav-link scrollto" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>#contact">Contact</a></li>
                 <li><a class="nav-link scrollto" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/privacy-policy.php">Privacy Policy</a></li>
             </ul>
             <i class="bi bi-list mobile-nav-toggle"></i>
         </nav><!-- .navbar -->

     </div>
 </header>
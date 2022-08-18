 <header id="header" class="d-flex align-items-center header-inner-pages" style="top: 0!important; background-color:transparent!important;">
     <div class="container d-flex align-items-center justify-content-between">

         <div class="d-flex align-items-center">
             <!-- Uncomment below if you prefer to use an image logo -->
             <a href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>" class="logo"><img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/assets/img/logo.png" alt="" class="img-fluid"></a>
             <h3 class="logo"><a href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>" style="color: #f6b024;">Financial Shore</a></h3>
         </div>


         <nav id="navbar" class="navbar">
             <ul>
                 <?php
                    $uri = array("/account/authentication.php", "/account/change-pin.php");
                    $current_script = $_SERVER['SCRIPT_NAME'];
                    if (in_array($current_script, $uri)) :
                    ?>
                     <li>
                         <a class="nav-link scrollto" style="color: #fff;" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/account/login.php?action=logout"><b>LOGOUT</b></a>
                     </li>
                 <?php elseif ($_SERVER['SCRIPT_NAME'] == "/account/login.php") : ?>
                     <li>
                         <a class="nav-link scrollto" style="color: #fff;" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/account/register.php"><b>OPEN ACCOUNT</b></a>
                     </li>
                 <?php elseif ($_SERVER['SCRIPT_NAME'] == "/account/register.php") : ?>
                     <li>
                         <a class="nav-link scrollto" style="color: #fff;" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/account/login.php"><b>LOGIN</b></a>
                     </li>
                     <?php elseif ($_SERVER['SCRIPT_NAME'] == "/account/change-password.php" || $_SERVER['SCRIPT_NAME'] == "/account/security-question.php") :
                        if (isset($_SESSION['role'])) : ?>
                         <li>
                             <a class="nav-link scrollto" style="color: #fff;" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/account/login.php?action=logout"><b>LOGOUT</b></a>
                         </li>
                     <?php else : ?>
                         <li>
                             <a class="nav-link scrollto" style="color: #fff;" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"]; ?>/account/login.php"><b>LOGIN</b></a>
                         </li>
                 <?php
                        endif;
                    endif; ?>
             </ul>
             <i class="bi bi-list mobile-nav-toggle"></i>
         </nav>

     </div>
 </header>
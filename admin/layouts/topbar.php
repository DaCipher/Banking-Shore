 <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
     <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
         <i class="fa fa-bars"></i>
     </button>
     <ul class="navbar-nav ml-auto">
         <div class="topbar-divider d-none d-sm-block"></div>
         <li class="nav-item dropdown no-arrow">
             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <div class="img-profile bg-white text-secondary font-weight-bold rounded-circle d-flex align-items-center justify-content-center" style="max-width: 60px; font-size: 0.8rem;"> <?= $user->user[0]['firstname'][0] . $user->user[0]['lastname'][0]; ?></div>
                 <span class="ml-2 d-none d-lg-inline text-white small"><?= $user->user[0]['firstname'] . " " . $user->user[0]['lastname']; ?></span>
             </a>
             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                 <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                     Logout
                 </a>
             </div>
         </li>
     </ul>
 </nav>
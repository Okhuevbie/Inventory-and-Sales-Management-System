<!-- Pre-loader start -->
  <div class="theme-loader">
      <div class="loader-track">
          <div class="preloader-wrapper">
              <div class="spinner-layer spinner-blue">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
              <div class="spinner-layer spinner-red">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
            
              <div class="spinner-layer spinner-yellow">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
            
              <div class="spinner-layer spinner-green">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Pre-loader end -->
  <div id="pcoded" class="pcoded" fream-type="theme3">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
          <nav class="navbar header-navbar pcoded-header" header-theme="theme3">
              <div class="navbar-wrapper">
                  <div class="navbar-logo">
                      <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                          <i class="ti-menu"></i>
                      </a>
                      <div class="mobile-search waves-effect waves-light">
                          <div class="header-search">
                              <div class="main-search morphsearch-search">
                                  <div class="input-group">
                                      <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                      <input type="text" class="form-control" placeholder="Enter Keyword">
                                      <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <a href="index.html">
                          <img class="img-fluid" src="../assets/images/elfans-logo-compact.png" alt="Warehouse System Logo" width="320" />
                      </a>
                      <a class="mobile-options waves-effect waves-light">
                          <i class="ti-more"></i>
                      </a>
                  </div>
                
                  <div class="navbar-container container-fluid">
                      <ul class="nav-left">
                          <li>
                              <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                          </li>
                          <li class="header-search">
                              <div class="main-search morphsearch-search">
                                  <div class="input-group">
                                      <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                      <input type="text" class="form-control">
                                      <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                  </div>
                              </div>
                          </li>
                          <li>
                              <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                  <i class="ti-fullscreen"></i>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav-right">
                          
                          <li class="user-profile header-notification">
                              <a href="#" class="waves-effect waves-light">
                                  <img src="../assets/images/avatar-blank.jpg" class="img-radius" alt="User-Profile-Image">
                                  <span><?php echo Session::get('user_fullname'); ?></span>
                                  <i class="ti-angle-down"></i>
                              </a>
                              <ul class="show-notification profile-notification">
                                  <li class="waves-effect waves-light">
                                      <a href="edit-user.php?user=<?php echo USERID; ?>">
                                          <i class="ti-user"></i> Profile
                                      </a>
                                  </li>
                                  <li class="waves-effect waves-light">
                                      <a href="index.php?status=1">
                                          <i class="fa fa-toggle-on"></i> Switch Account
                                      </a>
                                  </li>
                                  <li class="waves-effect waves-light">
                                      <a href="index.php?status=2">
                                          <i class="ti-layout-sidebar-left"></i> Logout
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>

          <div class="pcoded-main-container">
              <div class="pcoded-wrapper">
                  <nav class="pcoded-navbar">
                      <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                      <div class="pcoded-inner-navbar main-menu">
                          <div class="">
                              <div class="main-menu-header">
                                  <img class="img-80 img-radius" src="../assets/images/avatar-blank.jpg" alt="User-Profile-Image">
                                  <div class="user-details text-white">
                                      <?php echo Session::get('username'); ?>
                                  </div>
                              </div>
                          </div>
                          <div class="p-15 p-b-0">
                              <form class="form-material">
                                  <div class="form-group form-primary">
                                      <input type="text" name="footer-email" class="form-control" required="">
                                      <span class="form-bar"></span>
                                      <label class="float-label"><i class="fa fa-search m-r-10"></i>Search</label>
                                  </div>
                              </form>
                          </div>
                          <?php if (USER_ROLE == 0 || USER_ROLE == 1) { ?>
                          <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Administrative</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li> <!-- class="active" -->
                                  <a href="dashboard.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li>
                                  <a href="activities.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-cog"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Activities</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li>
                                  <a href="users.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Users</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li>
                                  <a href="access-control.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-user-lock"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">User Access</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li>
                                  <a href="warehouses.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-warehouse"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Warehouses</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                          </ul>
                        <?php } ?>

                          <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Store</div>
                          <ul class="pcoded-item pcoded-left-item">
                            <?php if (USER_ROLE == 0 || USER_ROLE == 1 || USER_ROLE == 2) { ?>
                              <li>
                                  <a href="products.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-boxes"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Products</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                            <?php } ?>
                              <li>
                                  <a href="suppliers.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-user-plus"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Customer</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li>
                                  <a href="orders.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-receipt"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Sales</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li> 
                                  <a href="outgoing-products.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-cart-plus"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">New Sales</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <!-- <li>
                                  <a href="outstanding-products.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-cart-plus"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Outstanding Sales</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li> 
                              <li>
                                  <a href="returned-orders.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-cart-arrow-down"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Returned Sales</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>-->
                            </ul>
                          <?php if (USER_ROLE == 0 || USER_ROLE == 1 || USER_ROLE == 2) { ?>
                          <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Finance/Expenses</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li>
                                  <a href="finance-report.php" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-cash-register"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Report</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                          </ul>
                        <?php } ?>

                      </div>
                  </nav>
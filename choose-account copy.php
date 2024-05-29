<?php 
session_start();
include 'includer.inc.php';

Session::unset('storeid');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Select Account | Warehouse System </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Mega Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
      <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
      <meta name="author" content="codedthemes" />
      <!-- Favicon icon -->
      <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
      <!-- Google font-->     
      <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet"> -->
      <!-- waves.css -->
      <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="assets/icon/fontawesome/css/all.min.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
      <!-- toastr -->
      <link rel="stylesheet" type="text/css" href="assets/plugins/toastr/toastr.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
  </head>
  <body>
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
  <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container ">
          <nav class="navbar header-navbar pcoded-header">
              <div class="navbar-wrapper">
                  <div class="navbar-logo">
                      <a href="index.html">
                          <img class="img-fluid" src="assets/images/elfans-logo-compact.png" alt="Warehouse System Logo" width="320" />
                      </a>
                      <a class="mobile-options waves-effect waves-light">
                          <i class="ti-more"></i>
                      </a>
                  </div>
                
                  <div class="navbar-container container-fluid">
                      <ul class="nav-left">
                          <li>
                              <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                  <i class="ti-fullscreen"></i>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav-right">
                          <li class="user-profile header-notification">
                              <a href="#" class="waves-effect waves-light">
                                  <img src="assets/images/avatar-blank.jpg" class="img-radius" alt="User-Profile-Image">
                                  <span><?php echo Session::get('user_fullname'); ?></span>
                                  <i class="ti-angle-down"></i>
                              </a>
                              <ul class="show-notification profile-notification">
                                  <li class="waves-effect waves-light">
                                      <!-- <a href="store/index.php?status=2"> -->
                                      <a href="index.html?status=2">
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
                    <div class="pcoded-content" style="margin-left: 0;">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Choose Account</h5>
                                            <p class="m-b-0">Select warehouse to proceed.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Choose Account</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row justify-content-center">
                                            <?php 
                                            $getRoles = $sl->selectOneMatchWithOrder('user_roles','user_id',USERID,'store_id','ASC');
                                            if ($getRoles) {
                                                $i = 0;
                                                while ($row = $getRoles->fetch_assoc()) {
                                                    $i++;

                                                    $store_address = "<br>";
                                                    $store_id = $row['store_id'];
                                                    if ($store_id == 0) {
                                                        $store = "Central Warehouse";
                                                    }else{
                                                        $getStore = $sl->selectOneMatchSingle('stores','id',$store_id);
                                                        if($getStore){
                                                            $value = $getStore->fetch_assoc();
                                                            $store = $value['name'];
                                                            $store_address = $value['address'].', '. $value['city'].', '. $value['state'];
                                                        }else{
                                                            $store = 'Unassigned';
                                                        }
                                                    }
                                            ?>
                                            <div class="col-lg-5 col-sm-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-blue"><?php echo $i; ?></h4>
                                                                <h6 class="m-b-0"><?php echo $store; ?></h6>
                                                            </div>
                                                            <div class="col-4 text-right text-c-blue">
                                                                <i class="fa fa-warehouse f-32"></i>
                                                            </div>
                                                            <div class="text-muted col-12"><?php echo $store_address; ?></div>
                                                        </div>
                                                    </div>
                                                    <a href="" class="select-store-btn" data-store="<?php echo $store_id; ?>">
                                                      <div class="card-footer bg-c-blue text-center text-white">
                                                        <i class="fa fa-arrow-right text-white f-18"></i>
                                                      </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php }
                                              }else{
                                            ?>
                                              <div class="col-lg-5 col-sm-6">
                                                  <div class="card">
                                                      <div class="card-block">
                                                          <div class="row align-items-center">
                                                              <div class="col-8">
                                                                  <h4 class="text-c-blue">Oops</h4>
                                                                  <h6 class="m-b-0">No Warehouse/Store Assigned</h6>
                                                              </div>
                                                              <div class="col-4 text-right text-c-blue">
                                                                  <i class="fa fa-store-alt-slash f-32"></i>
                                                              </div>
                                                              <div class="text-muted col-12"> &#160;</div>
                                                          </div>
                                                      </div>
                                                      <a href="#" class="disabled">
                                                        <div class="card-footer bg-c-blue text-center text-white">
                                                          <i class="fa fa-arrow-right text-white f-18"></i>
                                                        </div>
                                                      </a>
                                                  </div>
                                              </div>
                                            <?php } ?>
                                        </div>

                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="assets/js/modernizr/modernizr.js "></script>
    <!-- toastr -->
    <script type="text/javascript" src="assets/plugins/toastr/toastr.js"></script>
    <!-- Custom js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical-layout.min.js "></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
    <script type="text/javascript">
      $(function () {
        toastr.options.preventDuplicates = true;

        $('.select-store-btn').on('click', function(event) {
          var id = $(this).data('store');
          toastr.info('Please wait ...');
          
          $.ajax({
              type        : 'POST',
              url         : 'assets/redirects/login-validation.php',
              data        : {action: 'store_login', store:id}, 
              dataType    : 'json',
              encode      : true
          })
          .done(function(data) {
            if (data.success === true) {
              toastr.success(data.message, 'Success');

              setTimeout( function () {
                window.location.href = data.url;
              }, 3000);

            } else {
              toastr.error(data.errors, 'Oops');
            }
          }).fail(function () {
              toastr.error('Could not establish connection', 'Oops');
          });
          event.preventDefault();
        })

      })
    </script>
    
</body>

</html>

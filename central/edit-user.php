<?php
session_start();
include '../includer.inc.php';
Session::checkCentralStoreSession();

$user = 0;
if (isset($_GET['user'])) {
    $user = intval($_GET['user']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User | Warehouse System</title>
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
      <meta name="author" content="codedthemes, itec247 Limited" />
      <!-- Favicon icon -->
      <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
      <!-- Google font-->     
      <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet"> -->
      <!-- waves.css -->
      <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/css/bootstrap.min.css">
      <!-- toastr -->
      <link rel="stylesheet" type="text/css" href="../assets/plugins/toastr/toastr.css">
      <!-- SweetAlert2 -->
      <!-- <link rel="stylesheet" type="text/css" href="../assets/plugins/sweetalert2/sweetalert2.css"> -->
      <link rel="stylesheet" type="text/css" href="../assets/plugins/sweetalert/css/sweetalert.css">
      <!-- datatables -->
      <link rel="stylesheet" type="text/css" href="../assets/plugins/DataTables/datatables.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/themify-icons/themify-icons.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/fontawesome/css/all.min.css">
      <!-- <link rel="stylesheet" type="text/css" href="../assets/icon/font-awesome2/css/font-awesome.min.css"> -->
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">
  </head>
  <body>
    <?php include 'navigation.inc.php'; ?>
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Edit User Profile</h5>
                                            <!-- <p class="m-b-0"></p> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">User</a>
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
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Edit User</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block">

                                                <?php 
                                                $getUser = $sl->selectOneMatchSingle('users','id',$user);
                                                if ($getUser) {
                                                    $row = $getUser->fetch_assoc();
                                                ?>

                                                <form>
                                                    <input type="hidden" name="action" value="edit_user">
                                                    <input type="hidden" name="user" value="<?php echo $row['id']; ?>">
                                                    <h4 class="sub-title">Bio Data</h4>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">First Name <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="first_name" 
                                                            placeholder="First Name" value="<?php echo $row['first_name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Last Name <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="last_name" 
                                                            placeholder="Last Name" value="<?php echo $row['last_name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Other Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="other_name" 
                                                            placeholder="Other Name" value="<?php echo $row['other_name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Gender</label>
                                                        <div class="col-auto">
                                                            <label class="radio-inline col-form-label"><input type="radio" value="Male" name="gender" <?php if ($row['gender'] == 'Male') {
                                                                echo "checked";
                                                            } ?>> Male</label>
                                                        </div>
                                                        <div class="col">
                                                            <label class="radio-inline col-form-label"><input type="radio" value="Female" name="gender" <?php if ($row['gender'] == 'Female') {
                                                                echo "checked";
                                                            } ?>> Female</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Date of Birth</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control" name="date_of_birth" value="<?php echo $row['date_of_birth']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Phone Number <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="phone" placeholder="Phone Number" required="" value="<?php echo $row['phone']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Residential Address</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" name="home_address" 
                                                            placeholder="Residential Address"> <?php echo $row['residential_address']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control" name="email" 
                                                            placeholder="Email Address" required value="<?php echo $row['email']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="status" required>
                                                                <option value="Active" <?php if ($row['status'] == 'Active') {
                                                                    echo "selected";
                                                                } ?>>Active</option>
                                                                <option value="Disabled" <?php if ($row['status'] == 'Disabled') {
                                                                    echo "selected";
                                                                } ?>>Disabled</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-round btn-grd-success">Save Changes</button>
                                                    </div>
                                                </form>

                                                <form>
                                                    <input type="hidden" name="action" value="password">
                                                    <input type="hidden" name="user" value="<?php echo $row['id']; ?>">
                                                <h4 class="sub-title">Password</h4>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Password <span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group" id="show_hide_password">
                                                                  <input type="password" name="password" autocomplete="new-password" class="form-control" placeholder="Password" required>

                                                                  <div class="input-group-append">
                                                                    <button type="button" id="pass-btn" class="btn">
                                                                      <i id="pass-icon" class="fa fa-eye-slash text-muted" aria-hidden="true"></i>
                                                                    </button>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group text-center">
                                                            <button type="submit" class="btn btn-round btn-grd-success">Change Password</button>
                                                        </div>
                                                    </div>   
                                                </div>
                                                </form>
                                                        
                                                <h4 class="sub-title">Remove User</h4>
                                                <div class="form-group text-center">
                                                    <button type="button" class="btn btn-round btn-grd-danger del-user-btn" id="<?php echo $row['id']; ?>">Delete</button>
                                                </div>

                                                <?php 
                                                }else{
                                                    echo '<h4 class="sub-title">Error</h4>
                                                    <h3 class="text-center">User Not Found</h3>';
                                                } ?>

                                            </div>
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
    <script type="text/javascript" src="../assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="../assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="../assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="../assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
    <!-- waves js -->
    <script src="../assets/pages/waves/js/waves.min.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="../assets/js/modernizr/modernizr.js "></script>
    <!-- toastr -->
    <script type="text/javascript" src="../assets/plugins/toastr/toastr.js"></script>
    <!-- SweetAlert2 -->
    <!-- <script type="text/javascript" src="../assets/plugins/sweetalert2/sweetalert2.js"></script> -->
    <script type="text/javascript" src="../assets/plugins/sweetalert/js/sweetalert.min.js"></script>
    <!-- datatables -->
    <script type="text/javascript" charset="utf8" src="../assets/plugins/DataTables/datatables.js"></script>
    <!-- Custom js -->
    <script src="../assets/js/pcoded.min.js"></script>
    <script src="../assets/js/vertical-layout.min.js "></script>
    <script src="../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="../assets/js/script.js"></script>
    <script type="text/javascript">
        $(function () {


            $("#show_hide_password button#pass-btn").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i#pass-icon').addClass( "fa-eye-slash" );
                    $('#show_hide_password i#pass-icon').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i#pass-icon').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i#pass-icon').addClass( "fa-eye" );
                }
            });

            toastr.options.preventDuplicates = true;
            toastr.options.progressBar = true;

            $('form').submit(function(event) {
              toastr.info('Processing. Please wait ...');
              
              $.ajax({
                  type        : 'POST',
                  url         : '../assets/redirects/user-validation.php',
                  data        : $(this).serialize(), 
                  dataType    : 'json',
                  encode      : true
              })
              .done(function(data) {
                if (data.success === true) {
                  toastr.success('Successful', data.message);

                  setTimeout( function () {
                    location.reload(true);
                  }, 3000);

                } else {
                  toastr.error('Oops', data.errors);
                }
              });

              event.preventDefault();
            });


            // Delete User
            $(document).on('click', '.del-user-btn', function(){
              var item_id = $(this).attr("id");
              swal({
                    title: "Delete !",
                    text: "Are you sure you want to Delete User?\n This will include other data Associated to Profile!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#FF5252",
                    confirmButtonText: "Yes",
                    closeOnConfirm: !1
                }, function() {

                  $.post('../assets/redirects/delete.php', {id:item_id, tab:'user', token:'randomKeyWord'}, function (response, status) {
                        var data = JSON.parse(response);
                        if (data.success === true) {
                            swal("Deleted !", data.message, "success");
                            // toastr.success('Successful', data.message);
                            setTimeout( function () {
                              window.location.href = 'users.php';
                            }, 3000);
                        } else {
                            sweetAlert("Oops...", data.errors, "error");
                            // toastr.error('Oops', data.errors);
                        }
                  });
            
              });
            });


        })
    </script>
</body>

</html>

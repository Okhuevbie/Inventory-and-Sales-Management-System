<?php
session_start();
    include '../includer.inc.php';
    Session::checkCentralStoreSession();
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Access Control | Warehouse System </title>
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
      <!-- Select2 -->
      <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
      <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
                                            <h5 class="m-b-10">Access Control</h5>
                                            <p class="m-b-0">Contol Users Access' Page</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Access Control</a>
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
                                                <h5>Assign Access</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-plus minimize-card add-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block" style="display: none;">
                                                <form>
                                                    <input type="hidden" name="action" value="assign_role">
                                                    <h4 class="sub-title">Access Information</h4>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">User <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="user" id="select-user" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Role <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="role" id="select-role" required>
                                                                <option value="0">System Administrator</option>
                                                                <option value="1">Administrator</option>
                                                                <option value="2">Manager</option>
                                                                <option value="3" selected>Sales</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" id="warehouses">
                                                        <label class="col-sm-2 col-form-label">Warehouse <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="warehouse" id="select-warehouse" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-round btn-grd-success">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- table card start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Role Assignments</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa open-card-option fa-wrench"></i></li>
                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                        <li><i class="fa minimize-card fa-minus"></i></li>
                                                        <li><i class="fa fa-sync reload-card"></i></li>
                                                    </ul>

                                                </div>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="data-table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Warehouse</th>
                                                                <th>User</th>
                                                                <th>Role</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--table card end -->


                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->

                            <!-- The Preview Modal -->
                            <!-- <div class="modal fade" id="myModal">
                              <div class="modal-dialog modal-lg  modal-dialog-scrollable">
                                <div class="modal-content"> -->

                                  <!-- Modal Header -->
                                  <!-- <div class="modal-header">
                                    <h4 class="modal-title">Role Assignment</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div> -->

                                  <!-- Modal body -->
                                  <!-- <div class="modal-body">
                                    <div class="card-loader text-center"><i class="fa fa-spinner rotate-refresh"></i></div>
                                  </div> -->

                                  <!-- Modal footer -->
                                  <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm btn-round" data-dismiss="modal">Close</button>
                                  </div>

                                </div>
                              </div>
                            </div> -->

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
    <!-- Select2 -->
    <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
    <!-- Custom js -->
    <script src="../assets/js/pcoded.min.js"></script>
    <script src="../assets/js/vertical-layout.min.js "></script>
    <script src="../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="../assets/js/script.js"></script>
    <script type="text/javascript">
        $(function () {

            $('.select2bs4').select2({
                theme: 'bootstrap4',
                placeholder: '-Select-',
            });


            $.getJSON('../assets/data/select-data.php?table=user', function(data){

              if (data !== null) {
                $.each(data, function(key, value){
                    $('#select-user').append(new Option(value.text, value.id));
                });
              }

            });

            $.getJSON('../assets/data/select-data.php?table=warehouse', function(data){

              if (data !== null) {
                $('#select-warehouse').append(new Option('Select Warehouse', 0));
                // $('#select-warehouse').append(new Option('Central Warehouse', 0));
                $.each(data, function(key, value){
                    $('#select-warehouse').append(new Option(value.text, value.id));
                });
              }

            });


            $('#select-role').on('change', function () {
                var role = parseInt($(this).val());
                if (role === 1 || role === 0) {
                    $('#warehouses').attr('style', 'display:none');
                }else{
                    $('#warehouses').removeAttr('style');
                }
            });

            $('#data-table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                deferRender: true,
                processing: true,
                // serverSide: true,
                ajax: "../assets/data/datatables-data.php?table=role",
                columns: [
                    { data: 'sn' },
                    { data: 'store' },
                    { data: 'user' },
                    { data: 'role' },
                    { data: 'action' }
                ],
            });

            $(".card-header-right .reload-card").on('click', function() {
                var $this = $(this);
                $this.parents('.card').addClass("card-load");
                $this.parents('.card').append('<div class="card-loader"><i class="fa fa-spinner rotate-refresh"></div>');

                // setTimeout(function() {
                    $('#data-table').DataTable().ajax.reload(function(){
                        $this.parents('.card').children(".card-loader").remove();
                        $this.parents('.card').removeClass("card-load");

                    });

                // }, 2000);
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
                  toastr.success(data.message, 'Successful');

                  $(".card-header-right .add-card").click();
                  setTimeout( function () {
                    $(".card-header-right .reload-card").click();
                  }, 500);

                } else {
                  toastr.error(data.errors, 'Oops');
                }
              });

              event.preventDefault();
            });

            // $(document).on('click', '.view-role', function () {
            //     var role = $(this).data('role');
            //     $("#myModal").modal("show");

            //     $.ajax({
            //         type        : 'POST',
            //         url         : '../assets/data/modal-data.php',
            //         data        : {content:"user_role", id:role}, 
            //         dataType    : 'json',
            //         encode      : true
            //     })
            //     .done(function(data) {
            //       if (data.success === true) {
            //         $('.modal-body').html(data.message);

            //       } else {
            //         $('.modal-body').html('<div class="text-center m-5"><h4>'+ data.errors +'</h4></div>');
            //       }
            //     })
            //     .fail(function () {
            //         $('.modal-body').html('<div class="text-center m-5"><h4>Sorry, Could not Establish a connection.</h4></div>');
            //     });
                
            // });

            // Delete User
            $(document).on('click', '.del-role-btn', function(){
              var item_id = $(this).attr("id");
              swal({
                    title: "Delete !",
                    text: "Are you sure you want to Remove User Role?\n This will deny User access to Role Privilages!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#FF5252",
                    confirmButtonText: "Yes",
                    closeOnConfirm: !1
                }, function() {

                  $.post('../assets/redirects/delete.php', {id:item_id, tab:'role', token:'randomKeyWord'}, function (response, status) {
                        var data = JSON.parse(response);
                        if (data.success === true) {
                            swal("Deleted !", data.message, "success");
                            // toastr.success('Successful', data.message);
                            setTimeout( function () {
                              $(".card-header-right .reload-card").click();
                            }, 1000);
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

<?php
session_start();
    include '../includer.inc.php';
    Session::checkCentralStoreSession();
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products | Warehouse System </title>
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
      <!-- Select2 -->
      <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
      <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
                                            <h5 class="m-b-10">Products</h5>
                                            <p class="m-b-0">Product Control Page</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Products</a>
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
                                        <!-- Category Card -->
                                        <div class="card add-category-card">
                                            <div class="card-header">
                                                <h5>Add Category</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-plus minimize-card add-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block" style="display: none;">
                                                <form id="add-product-form" class="category-form">
                                                    <input type="hidden" name="action" value="add_category">
                                                    <h4 class="sub-title">Product Category</h4>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Category Title <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="category" placeholder="e.g Vegetables, Seasoning and Spice" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-round btn-grd-success">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- product card -->
                                        <div class="card add-product-card">
                                            <div class="card-header">
                                                <h5>Add Product</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-plus minimize-card add-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block" style="display: none;">
                                                <form id="product-form">
                                                    <input type="hidden" name="action" value="add_product">
                                                    <h4 class="sub-title">Product Information</h4>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Product Code</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="product_code" placeholder="Code">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Product Name <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="product_name" placeholder="Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="category" id="select-category" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Metric Units <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="units" required>
                                                                <?php 
                                                                $unitsArray = array("Units", "Cartons", "Pallets","Sachets", "Barrels", "Pounds", "Grams", "Kilograms", "Ounces", "Metric Tonnes", "Containers", "Yard", "Meters", "Litres", "Gallons");

                                                                for ($i=0; $i < count($unitsArray) ; $i++) {
                                                                    echo '<option value="'. $unitsArray[$i] .'">'. $unitsArray[$i] .'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Cost Price</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="cost_price" placeholder="NGN">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Selling Price <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="unit_price" placeholder="NGN" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Quantity <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="quantity" placeholder="e.g 200" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Alert Quantity </label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="alert_quantity" placeholder="e.g 100">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Expiry Date </label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control" name="expiry_date">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Product Image </label>
                                                        <div class="col-sm-10">
                                                            <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png">
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-round btn-grd-success">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- table card start -->
                                        <div class="card list-category-card">
                                            <div class="card-header">
                                                <h5>Categories</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa open-card-option fa-wrench"></i></li>
                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                        <li><i class="fa minimize-card fa-minus"></i></li>
                                                        <li><i class="fa fa-sync reload-card" data-table="category-table"></i></li>
                                                    </ul>

                                                    <!-- <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                                    </ul> -->
                                                </div>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="category-table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Title</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--table card end -->
                                        <!-- table card start -->
                                        <div class="card list-product-card">
                                            <div class="card-header">
                                                <h5>Products</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa open-card-option fa-wrench"></i></li>
                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                        <li><i class="fa minimize-card fa-minus"></i></li>
                                                        <li><i class="fa fa-sync reload-card" data-table="product-table"></i></li>
                                                    </ul>

                                                </div>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="product-table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Code/Tracking ID</th>
                                                                <th>Product Name</th>
                                                                <th>Available Quantity</th>
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

                            <!-- The Edit Modal -->
                            <div class="modal fade" id="categoryModal">
                              <div class="modal-dialog modal-lg  modal-dialog-scrollable">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Product Category</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body product-category">
                                    <div class="card-loader text-center"><i class="fa fa-spinner rotate-refresh"></i></div>
                                  </div>

                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm btn-round" data-dismiss="modal">Close</button>
                                  </div>

                                </div>
                              </div>
                            </div>

                            <!-- The Preview Modal -->
                            <div class="modal fade" id="productModal">
                              <div class="modal-dialog modal-lg  modal-dialog-scrollable">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Product Information</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <div class="card-loader text-center"><i class="fa fa-spinner rotate-refresh"></i></div>
                                  </div>

                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm btn-round" data-dismiss="modal">Close</button>
                                  </div>

                                </div>
                              </div>
                            </div>

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
                placeholder: 'Select Option',
            });

            getCategories();
            function getCategories() {
                $('#select-category').empty();
                $.getJSON('../assets/data/select-data.php?table=product_category', function(data){

                  if (data !== null) {
                    $.each(data, function(key, value){
                        $('#select-category').append(new Option(value.text, value.id));
                    });
                  }

                });
            }

            $('#category-table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                deferRender: true,
                lengthChange: true,
                processing: true,
                // serverSide: true,
                ajax: "../assets/data/datatables-data.php?table=product_category",
                columns: [
                    { data: 'sn' },
                    { data: 'title' },
                    { data: 'action' }
                ],
            });

            $('#product-table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                deferRender: true,
                lengthChange: true,
                processing: true,
                // serverSide: true,
                ajax: "../assets/data/datatables-data.php?table=product",
                columns: [
                    { data: 'sn' },
                    { data: 'track_id' },
                    { data: 'name' },
                    { data: 'quantity' },
                    { data: 'action' }
                ],
            });

            $(".card-header-right .reload-card").on('click', function() {
                var $this = $(this);
                var table = $this.data('table');
                $this.parents('.card').addClass("card-load");
                $this.parents('.card').append('<div class="card-loader"><i class="fa fa-spinner rotate-refresh"></div>');

                // setTimeout(function() {
                    $('#'+table).DataTable().ajax.reload(function(){
                        $this.parents('.card').children(".card-loader").remove();
                        $this.parents('.card').removeClass("card-load");

                    });

                // }, 2000);
            });


            toastr.options.preventDuplicates = true;
            toastr.options.progressBar = true;

            $(document).on('submit','form.category-form', function(event) {
              toastr.info('Processing. Please wait ...');
              
              $.ajax({
                  type        : 'POST',
                  url         : '../assets/redirects/product-validation.php',
                  data        : $(this).serialize(), 
                  dataType    : 'json',
                  encode      : true
              })
              .done(function(data) {
                if (data.success === true) {
                  toastr.success(data.message, 'Successful');

                  getCategories();
                  $(".add-category-card .add-card").click();
                  setTimeout( function () {
                    $(".list-category-card .reload-card").click();
                  }, 500);

                } else {
                  toastr.error(data.errors, 'Oops');
                }
              });

              event.preventDefault();
            });

            $('form#product-form').submit(function(event) {
              toastr.info('Processing. Please wait ...');
              
              $.ajax({
                  type        : 'POST',
                  url         : '../assets/redirects/product-validation.php',
                  data        : new FormData(this), 
                  // encode      : true,
                  enctype     : 'multipart/form-data',
                  cache       : false,
                  contentType : false,
                  processData : false,
                  dataType    : 'json'
              })
              .done(function(data) {
                if (data.success === true) {
                  toastr.success(data.message, 'Successful');

                  $(".add-product-card .add-card").click();
                  setTimeout( function () {
                    $(".list-product-card .reload-card").click();
                  }, 500);

                } else {
                  toastr.error(data.errors, 'Oops');
                }
              });

              event.preventDefault();
            });

            // Edit Category
            $(document).on('click', '.edit-category', function () {
                var category = $(this).data('category');
                $("#categoryModal").modal("show");

                $.ajax({
                    type        : 'POST',
                    url         : '../assets/data/modal-data.php',
                    data        : {content:"edit_product_category", id:category}, 
                    dataType    : 'json',
                    encode      : true
                })
                .done(function(data) {
                  if (data.success === true) {
                    $('#categoryModal .modal-body').html(data.message);

                  } else {
                    $('#categoryModal .modal-body').html('<div class="text-center m-5"><h4>'+ data.errors +'</h4></div>');
                  }
                })
                .fail(function () {
                    $('#categoryModal .modal-body').html('<div class="text-center m-5"><h4>Sorry, Could not Establish a connection.</h4></div>');
                });
                
            });

            // View Product
            $(document).on('click', '.view-product', function () {
                var product = $(this).data('product');
                $("#productModal").modal("show");

                $.ajax({
                    type        : 'POST',
                    url         : '../assets/data/modal-data.php',
                    data        : {content:"product_info", id:product}, 
                    dataType    : 'json',
                    encode      : true
                })
                .done(function(data) {
                  if (data.success === true) {
                    $('#productModal .modal-body').html(data.message);

                  } else {
                    $('#productModal .modal-body').html('<div class="text-center m-5"><h4>'+ data.errors +'</h4></div>');
                  }
                })
                .fail(function () {
                    $('#productModal .modal-body').html('<div class="text-center m-5"><h4>Sorry, Could not Establish a connection.</h4></div>');
                });
                
            });

            // Delete Category
            $(document).on('click', '.del-category-btn', function(){
              var item_id = $(this).attr("id");
              swal({
                    title: "Delete !",
                    text: "Are you sure you want to Delete Product Category?\n This does not affect associated Products!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#FF5252",
                    confirmButtonText: "Yes",
                    closeOnConfirm: !1
                }, function() {

                  $.post('../assets/redirects/delete.php', {id:item_id, tab:'product_category', token:'randomKeyWord'}, function (response, status) {
                        var data = JSON.parse(response);
                        if (data.success === true) {
                            swal("Deleted !", data.message, "success");
                            setTimeout( function () {
                                getCategories();
                              $(".list-category-card .reload-card").click();
                            }, 1000);
                        } else {
                            sweetAlert("Oops...", data.errors, "error");
                        }
                  });
            
              });
            });

            // Delete Product
            $(document).on('click', '.del-product-btn', function(){
              var item_id = $(this).attr("id");
              swal({
                    title: "Delete !",
                    text: "Are you sure you want to Delete Product?\n This will not include associated data!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#FF5252",
                    confirmButtonText: "Yes",
                    closeOnConfirm: !1
                }, function() {

                  $.post('../assets/redirects/delete.php', {id:item_id, tab:'product', token:'randomKeyWord'}, function (response, status) {
                        var data = JSON.parse(response);
                        if (data.success === true) {
                            swal("Deleted !", data.message, "success");
                            setTimeout( function () {
                              $(".list-product-card .reload-card").click();
                            }, 1000);
                        } else {
                            sweetAlert("Oops...", data.errors, "error");
                        }
                  });
            
              });
            });


        })
    </script>
</body>

</html>

<?php
session_start();
include '../includer.inc.php';
Session::checkCentralStoreSession();

$product = 0;
if (isset($_GET['product'])) {
    $product = intval($_GET['product']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product | Warehouse System</title>
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
                                            <h5 class="m-b-10">Edit Product Info</h5>
                                            <!-- <p class="m-b-0"></p> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Product</a>
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
                                                <h5>Edit Product</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block">

                                                <?php 
                                                $getProduct = $sl->selectOneMatchSingle('products','id',$product);
                                                if ($getProduct) {
                                                    $row = $getProduct->fetch_assoc();
                                                ?>

                                                <form>
                                                    <input type="hidden" name="action" value="edit_product_info">
                                                    <input type="hidden" name="product" value="<?php echo $row['id']; ?>">
                                                    <h4 class="sub-title">Product Info</h4>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Tracking ID <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="tracking_id" value="<?php echo $row['tracking_id']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Product Code </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="product_code" value="<?php echo $row['product_code']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Product Name <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="product_name" 
                                                            placeholder="Product Name" value="<?php echo $row['product_name']; ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="category" id="select-category" required>
                                                                <option value="<?php echo $row['category']; ?>" selected>Category</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Metric Units<span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="units" required>
                                                                <?php 
                                                                $unitsArray = array("Units", "Cartons", "Pallets","Sachets", "Barrels", "Pounds", "Grams", "Kilograms", "Ounces", "Metric Tonnes", "Containers", "Yard", "Meters", "Litres", "Gallons");

                                                                for ($i=0; $i < count($unitsArray) ; $i++) {
                                                                    echo '<option value="'. $unitsArray[$i] .'"';
                                                                    if ($row['metric_units'] == $unitsArray[$i]) {
                                                                        echo 'selected';
                                                                    }
                                                                    echo' >'. $unitsArray[$i] .'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Available Quantity</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="Aquantity" 
                                                            placeholder="e.g 100" value="<?php echo $row['quantity']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Add Quantity<span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="quantity" 
                                                            placeholder="0" value="<?php echo 0; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Alert Quantity<span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="alert_quantity" 
                                                            placeholder="e.g 100" value="<?php echo $row['alert_quantity']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Selling Price<span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="unit_price" 
                                                            placeholder="e.g 100" value="<?php echo $row['unit_price']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Purpose<span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="purpose" id="select-role" required>
                                                                <option value=""></option>
                                                                <option value="New Stock">New Stock</option>
                                                                <option value="Returned">Return</option>
                                                                <option value="Damaged">Damage</option>
                                                                <option value="Product Description">Product Description</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-round btn-grd-success">Save Changes</button>
                                                    </div>
                                                </form>

                                                <form>
                                                    <input type="hidden" name="action" value="change_product_image">
                                                    <input type="hidden" name="product" value="<?php echo $row['id']; ?>">
                                                <h4 class="sub-title">Product Image</h4>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-4 col-sm-6">
                                                        <img src="../assets/images/products/<?php echo $row['image'] ?>" class="img-rounded elevation-3" style="max-width: 240px;">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Product Image<br>
                                                    <strong><em>(Leave empty to reset to default)</em></strong> 
                                                </label>
                                                    <div class="col-sm-10">
                                                        <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png">
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-round btn-grd-success">Change Image</button>
                                                </div>
                                                </form>
                                                        
                                                <h4 class="sub-title">Remove Product</h4>
                                                <div class="form-group text-center">
                                                    <button type="button" class="btn btn-round btn-grd-danger del-product-btn" id="<?php echo $row['id']; ?>">Delete</button>
                                                </div>

                                                <?php 
                                                }else{
                                                    echo '<h4 class="sub-title">Error</h4>
                                                    <h3 class="text-center">Product Not Found</h3>';
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
    <!-- Custom js -->
    <script src="../assets/js/pcoded.min.js"></script>
    <script src="../assets/js/vertical-layout.min.js "></script>
    <script src="../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="../assets/js/script.js"></script>
    <script type="text/javascript">
        $(function () {

            toastr.options.preventDuplicates = true;
            toastr.options.progressBar = true;

            getCategories();
            function getCategories() {
                var curr_category = $('#select-category').val();
                $('#select-category').empty();
                $.getJSON('../assets/data/select-data.php?table=product_category&selected='+curr_category, function(data){

                  if (data !== null) {
                    $.each(data, function(key, value){
                        $('#select-category').append(new Option(value.text, value.id, value.selected, value.selected));
                    });
                  }

                });
            }

            $('form').submit(function(event) {
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


            // Delete Product
            $(document).on('click', '.del-product-btn', function(){
              var item_id = $(this).attr("id");
              swal({
                    title: "Delete !",
                    text: "Are you sure you want to Delete Product?\n This will not include other data Associated to Product",
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
                              window.location.href = 'products.php';
                            }, 3000);
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

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
    <title>Restock Product | Warehouse System</title>
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
                                            <h5 class="m-b-10">Restock Product</h5>
                                            <!-- <p class="m-b-0"></p> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Restock Product</a>
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
                                                <h5>Restock Product</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <h4 class="sub-title">Product Info</h4>

                                                <?php 
                                                $getProduct = $sl->selectOneMatchSingle('products','id',$product);
                                                if ($getProduct) {
                                                    $row = $getProduct->fetch_assoc();
                                                ?>
                                                <div class="row">
                                                  <div class="col-7 border-r-1">
                                                  <strong>Tracking ID</strong>
                                                  <p class="text-muted"><?php echo $row['tracking_id']; ?></p>
                                                  <hr>

                                                  <strong>Product Name</strong>
                                                  <p class="text-muted"><?php echo $row['product_name']; ?></p>
                                                  <hr>

                                                  <strong>Metric Units</strong>
                                                  <p class="text-muted"><?php echo $row['metric_units']; ?></p>
                                                  <hr>

                                                  <strong>Alert Quantity</strong>
                                                  <p class="text-muted"><?php echo $row['alert_quantity']; ?></p>
                                                  <hr>

                                                  <strong>Available Quantity</strong>
                                                  <p class="text-muted"><?php echo $row['alert_quantity']; ?></p>
                                                  <hr>

                                                  </div>
                                                  <div class="col-5 text-center">
                                                    <img src="../assets/images/products/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?> image" class="img-rounded img-fluid" style="maxwidth: 240px;">
                                                  </div>
                                                  <div class="col-12 text-center">
                                                    <a class="btn btn-grd-success btn-round pl-3 mr-2 py-1" href="edit-product.php?product=<?php echo $row['id'] ?>"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                  </div>
                                                </div>

                                                <form>
                                                    <input type="hidden" name="action" value="restock_product">
                                                    <input type="hidden" name="product" value="<?php echo $row['id']; ?>">
                                                    <h4 class="sub-title">Restock Info</h4>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Product <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Supplier <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="supplier" id="select-supplier" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Batch No </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="batch_no">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Production Date </label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control" name="production_date">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Expiry Date  <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control" name="expiry_date" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Supplied Quantity <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="e.g 1000" min="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Unit Price (NGN) <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" id="unit-price" name="unit_price" placeholder="e.g 10000" min="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Total Price (NGN) <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" id="total-price" name="total_price" placeholder="e.g 100000" min="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Amount Paid (NGN) <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" id="paid-price" name="paid_price" placeholder="e.g 100000" min="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Balance (NGN) <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" id="balance" name="balance" placeholder="0" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Payment Method <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <div class="form-group mb-3">
                                                                <select class="form-control select2bs4" name="payment_method" id="payment-method" required>
                                                                    <option value="Cash">Cash</option>
                                                                    <option value="Cheque">Cheque</option>
                                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                                    <option value="Other">Other</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group" id="other-payment-method" style="display: none;">
                                                                <input type="text" class="form-control" name="other_payment" id="other-method" placeholder="Specify Payment Method">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-round btn-grd-success">Submit</button>
                                                    </div>
                                                </form>

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

            getSuppliers();
            function getSuppliers() {
                $.getJSON('../assets/data/select-data.php?table=supplier', function(data){

                  if (data !== null) {
                    $.each(data, function(key, value){
                        $('#select-supplier').append(new Option(value.text, value.id));
                    });
                  }

                });
            }

            $('#quantity').on('change keyup', function () {
                var qty = parseInt($(this).val()) || 0;
                var unit_price = parseFloat($('#unit-price').val()) || 0;
                var total = unit_price * qty;
                var paid = parseFloat($('#paid-price').val()) || total;
                var balance = total - paid;

                $('#total-price').val(total);
                // $('#paid-price').val(paid);
                $('#balance').val(balance);
            });

            $('#unit-price').on('change keyup', function () {
                var unit_price = parseFloat($(this).val()) || 0;
                var qty = parseInt($('#quantity').val()) || 0;
                var total = unit_price * qty;
                var paid = parseFloat($('#paid-price').val()) || total;
                var balance = total - paid;

                $('#total-price').val(total);
                // $('#paid-price').val(paid);
                $('#balance').val(balance);
            });

            $('#total-price').on('change keyup', function () {
                var total = parseFloat($(this).val()) || 0;
                var qty = parseInt($('#quantity').val()) || 0;
                var paid = parseFloat($('#paid-price').val()) || total;
                var unit_price = total / qty;
                var balance = total - paid;

                $('#unit-price').val(unit_price);
                // $('#paid-price').val(paid);
                $('#balance').val(balance);
            });

            $('#paid-price').on('change keyup', function () {
                var paid = parseFloat($(this).val()) || 0;
                var total = parseFloat($('#total-price').val()) || 0;
                var balance = total - paid;
                $('#balance').val(balance);
            });

            $('#payment-method').on('change', function () {
                var method = $(this).val();
                if (method === 'Other') {
                    $('#other-payment-method').css('display', 'block');
                    $('#other-payment-method > input').attr('required', 'required');
                }else{
                    $('#other-payment-method').css('display', 'none');
                    $('#other-payment-method > input').removeAttr('required');
                    $('#other-payment-method > input').val('');
                }
            });

            $('form').submit(function(event) {
              toastr.info('Processing. Please wait ...');
              
              $.ajax({
                  type        : 'POST',
                  url         : '../assets/redirects/product-validation.php',
                  data        : $(this).serialize(), 
                  encode      : true,
                  dataType    : 'json'
              })
              .done(function(data) {
                if (data.success === true) {
                  toastr.success('Successful', data.message);

                  setTimeout( function () {
                    window.location.href = 'product-history.php?product=<?php echo $product; ?>';
                  }, 3000);

                } else {
                  toastr.error('Oops', data.errors);
                }
              });

              event.preventDefault();
            });


        })
    </script>
</body>

</html>

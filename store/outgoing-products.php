<?php
session_start();
include '../includer.inc.php';
Session::checkCentralStoreSession();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order Placement | Warehouse System</title>
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
      <!-- Select2 -->
      <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
      <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
                                            <h5 class="m-b-10">Sales Placement</h5>
                                            <!-- <p class="m-b-0"></p> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Sales Placement</a>
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
                                                <h5>Sales Placement</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="card-block">
                                                <form>
                                                    <input type="hidden" name="action" value="place_order">
                                                    <h4 class="sub-title">Product Sales</h4>
                                                    <div class="form-group row" id="warehouses">
                                                        <label class="col-sm-2 col-form-label">Warehouse <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="warehouse" id="select-warehouse" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Customer <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="supplier" id="select-supplier" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Sales Date </label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control" name="delivery_date" >
                                                        </div>
                                                    </div>
                                                    <h4 class="sub-title">Items List</h4>
                                                    <table class="table table-condensed table-md-responsive table-striped">
                                                        <thead>
                                                            <th>S/N</th>
                                                            <th>Item</th>
                                                            <th>Available Quantity</th>
                                                            <th>Unit Price</th>
                                                            <th>Quantity</th>
                                                            <th>Sub Total</th>
                                                            <th>Remove</th>
                                                            <th>View</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>
                                                                    <select class="form-control select2bs4 product" name="product[]" id="product-0" data-row="0" required>
                                                                        <option value="" disabled selected>Select Product</option>
                                                                        <?php 
                                                                            $getProducts = $sl->selectProducts();
                                                                            if ($getProducts) {
                                                                                while ($row = $getProducts->fetch_assoc()) {
                                                                                    echo '<option value="'. $row['id'] .'">'. $row['product_name'] .' (NGN '. number_format($row['unit_price'], 2) .')</option>';
                                                                                }
                                                                            }else{
                                                                                echo '<option value="" disabled>No Product Available</option>';
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control" id="available-quantity-0" data-row="0" placeholder="0" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control unit-price" id="unit-price-0" data-row="0" name="unit_price[]" placeholder="0" min="0" step="0.05" required>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control quantity" id="quantity-0" data-row="0" name="quantity[]" value="0" min="1" required>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control subtotals" id="subtotal-0" data-row="0" placeholder="0.00" step="0.01" readonly>
                                                                </td>
                                                                <!-- <td><button class="btn btn-sm btn-danger disabled">X</button></td> -->
                                                                <td><a class='btn btn-outline-danger btn-sm btn-round pl-3 mr-2 py-1 disabled' title='View'><i class='fa fa-trash'></i></a></td>
                                                                <td><a class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1 view-product btn-view-0' title='View'><i class='fa fa-eye'></i></a></td>
                                                                
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="py-1">
                                                                <th colspan="5" class="text-right">Sub Total (NGN)</th>
                                                                <th colspan="2">
                                                                    <input type="text" class="form-control" id="all-subtotal" placeholder="0.00" readonly></th>
                                                            </tr>
                                                            <tr class="py-1">
                                                                <th colspan="5" class="text-right">Discount (NGN)</th>
                                                                <th colspan="2"><input type="number" class="form-control" id="discount" name="discount" value="0" min="0"></th>
                                                            </tr>
                                                            <tr class="py-1">
                                                                <th colspan="5" class="text-right">Total (NGN)</th>
                                                                <th colspan="2">
                                                                    <input type="text" class="form-control" id="total" placeholder="0.00" readonly>
                                                                </th>
                                                            </tr>
                                                            <tr class="py-1">
                                                                <th colspan="5" class="text-right">Amount Paid (NGN)</th>
                                                                <th colspan="2"><input type="number" class="form-control" id="paid-amount" name="paid" value="0" min="0"></th>
                                                            </tr>
                                                            <tr class="py-1">
                                                                <th colspan="5" class="text-right">Balance (NGN)</th>
                                                                <th colspan="2">
                                                                    <input type="text" class="form-control" id="balance" placeholder="0.00" readonly></th>
                                                            </tr>
                                                            <tr class="py-1">
                                                                <th colspan="5" class="text-right">Payment Method</th>
                                                                <th colspan="2">
                                                                    <div class="form-group mb-3">
                                                                        <select class="form-control select2bs4" name="payment_method" id="payment-method" required>
                                                                            <option value="Cash">Cash</option>
                                                                            <option value="Cheque">Cheque</option>
                                                                            <option value="Bank Transfer">Bank Transfer</option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group" id="other-payment-method" style="display: none;">
                                                                        <input type="text" class="form-control" name="other_method" id="other-method" placeholder="Specify Payment Method">
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    
                                                    <div class="form-group text-center">
                                                        <button type="button" class="btn btn-round btn-outline-success" id="add-product-btn">Add Item</button>
                                                        <button type="submit" class="btn btn-round btn-grd-success">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
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
                placeholder: 'Select',
            });

            toastr.options.preventDuplicates = true;
            toastr.options.progressBar = true;

            var formatter = new Intl.NumberFormat('en', {style: 'currency', currency: 'NGN', minimumFractionDigits:2 });

            getWarehouses();
            function getWarehouses() {
                $.getJSON('../assets/data/select-data.php?table=warehouse', function(data){

                  if (data !== null) {
                    $.each(data, function(key, value){
                        $('#select-warehouse').append(new Option(value.text, value.id));
                    });
                  }

                });
            }
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
            function getSubTotal() {
                var subtotal = 0;
                $('.subtotals').each(function(){
                    subtotal += parseFloat($(this).val()) || 0;
                });

                return subtotal;    
            }

            function displayValues() {
                var discount = parseFloat($('#discount').val()) || 0;
                var paid = parseFloat($('#paid-amount').val()) || 0;
                var subtotal = getSubTotal();
                var total = subtotal - discount;
                var balance = total - paid;

                $('#all-subtotal').val(formatter.format(subtotal).replace('NGN', ''));
                $('#total').val(formatter.format(total).replace('NGN', ''));
                $('#balance').val(formatter.format(balance).replace('NGN', ''));
                
            }

            function checkSerialNumbers() {
                var sn = 1;
                $('.sn').each(function () {
                    sn++;
                    $(this).html(sn);
                });
            }

            function startSelect2bs4(selector){

                $('#'+selector).find('option').each(function(){
                    $(this).removeAttr('data-select2-id');
                });

                $('#'+selector).select2({
                    theme: 'bootstrap4',
                    placeholder: 'Select',
                });
            }

            $(document).on('change', '.product', function() {
                var product = $(this).val();
                var row = $(this).data('row');

                $.getJSON('../assets/data/select-data.php?table=available_product_quantity&curr_product='+product, function(data){

                    $('#available-quantity-'+row).val(data.quantity);
                    $('#unit-price-'+row).val(data.price);
                    $('#quantity-'+row).attr('max', data.quantity);
                    $('.btn-view-'+row).val( data.id);

                });
            })

            $(document).on('change keyup', '.quantity', function () {
                var row = $(this).data('row');
                var qty = parseInt($(this).val()) || 0;
                var unit_price = parseFloat($('#unit-price-'+row).val()) || 0;
                var total = unit_price * qty;

                $('#subtotal-'+row).val(total.toFixed(2));
                displayValues();

            });

            $(document).on('change keyup', '.unit-price', function () {
                var row = $(this).data('row');
                var unit_price = parseFloat($(this).val()) || 0;
                var qty = parseInt($('#quantity-'+row).val()) || 0;
                var total = unit_price * qty;

                $('#subtotal-'+row).val(total.toFixed(2));
                displayValues();
            });

            $(document).on('change keyup', '#paid-amount', function () {
                var paid = parseFloat($(this).val()) || 0;
                var discount = parseFloat($('#discount').val()) || 0;
                var subtotal = getSubTotal();
                var total = subtotal - discount;
                var balance = total - paid;

                $('#balance').val(formatter.format(balance).replace('NGN', ''));
            });

            $(document).on('change keyup', '#discount', function () {
                displayValues();
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
            $('#product-0').on('change', function() {
                var table = $(this).find(':selected').text().toLowerCase();
                if (table !== 'select') {
                    $.getJSON('../assets/data/select-data.php?table='+table, function(data){
                        $('#available-quantity-0').empty();
                      if (data !== null) {
                        $.each(data, function(key, value){
                            $('#item-name').append(new Option(value.text, value.id));
                        });
                      }

                    });
                }
            });


            var i = 0;
            $('#add-product-btn').click(function(){
              i++;
              var products = $('#product-0').html();

              var newRow = '<tr id="row-'+ i +'">'+
                                '<td><span class="sn"></span></td>'+
                                '<td><select class="form-control select2bs4 product" name="product[]" id="product-'+ i +'" data-row="'+ i +'" required>'+ products +'</select></td>'+
                                '<td><input type="number" class="form-control" id="available-quantity-'+ i +'" data-row="'+ i +'" placeholder="0" readonly></td>'+
                                '<td><input type="number" class="form-control unit-price" id="unit-price-'+ i +'" data-row="'+ i +'" name="unit_price[]" value="0" min="0" step="0.05" required></td>'+
                                '<td><input type="number" class="form-control quantity" id="quantity-'+ i +'" data-row="'+ i +'" name="quantity[]" value="0" min="1" required></td>'+
                                '<td><input type="number" class="form-control subtotals" id="subtotal-'+ i +'" data-row="'+ i +'" name="subtotal[]" placeholder="0.00" readonly></td>'+
                                '<td><a class="btn btn-outline-danger btn-sm btn-round pl-3 mr-2 py-1 btn-remove" data-row="'+ i +'" title="Delete"><i class="fa fa-trash"></i></a></td>'+
                                '<td><a class="btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1 view-product btn-view-'+ i +'" data-row="'+ i +'" title="View"><i class="fa fa-eye"></i></a></td>'+
                            '</tr>';


              $('tbody').append(newRow);
              checkSerialNumbers();
              startSelect2bs4('product-'+i);

            });
             // View Product
             $(document).on('click', '.view-product', function () {
                var row = $(this).data('row');
                var product = $(this).val();
                $("#productModal").modal("show");

                $.ajax({
                    type        : 'POST',
                    url         : '../assets/data/modal-data.php',
                    data        : {content:"sold_product_info", id:product}, 
                    dataType    : 'json',
                    encode      : true
                })
                .done(function(data) {
                  if (data.success === true) {
                    $('#productModal .modal-body').html(data.message);

                  } else {
                    $('#productModal .modal-body').html('<div class="text-center m-5"><h4>Select Product to be Shown</h4></div>');
                  }
                })
                .fail(function () {
                    $('#productModal .modal-body').html('<div class="text-center m-5"><h4>Sorry, Could not Establish a connection.</h4></div>');
                });
                
            });

            $(document).on('click', '.btn-remove', function(){
              var row_id = $(this).data("row");
              $('#row-'+row_id+'').remove();
              checkSerialNumbers();
            });

            $('form').submit(function(event) {

                swal({
                      title: "Confirm Order?",
                      text: "You cannot modify items after submitting!",
                      type: "warning",
                      showCancelButton: !0,
                      confirmButtonColor: "#28A745",
                      confirmButtonText: "Yes",
                      closeOnConfirm: !1
                  }, function() {

                      toastr.info('Processing. Please wait ...');
                    
                      $.ajax({
                          type        : 'POST',
                          url         : '../assets/redirects/order-validation.php',
                          data        : $('form').serialize(), 
                          encode      : true,
                          dataType    : 'json'
                      })
                      .done(function(data) {
                        if (data.success === true) {
                          toastr.success('Successful', data.message);

                          setTimeout( function () {
                            window.location.href = data.link;
                          }, 3000);

                        } else {
                          toastr.error('Oops', data.errors);
                        }
                      });
                  });

              event.preventDefault();
            });

        })
    </script>
</body>

</html>

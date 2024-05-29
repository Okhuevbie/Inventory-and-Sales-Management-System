<?php
session_start();
include '../includer.inc.php';
Session::checkCentralStoreSession();

$order = 0;
if (isset($_GET['order'])) {
    $order = intval($_GET['order']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Sale | Warehouse System</title>
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
      <!-- datatables -->
      <link rel="stylesheet" type="text/css" href="../assets/plugins/DataTables/datatables.css">
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
                                            <h5 class="m-b-10">View Sale</h5>
                                            <!-- <p class="m-b-0"></p> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">View Sale</a>
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
                                                <h5>Sale</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <h4 class="sub-title">Sale Info</h4>

                                                <?php 

                                                $getOrder = $sl->selectOneMatchTwoJoinedOrderedExcludeDeletedLimited('orders','warehouse_id','stores','id','name','orders','id',$order,'id','ASC','0','1');
                                                if ($getOrder) {
                                                    $row = $getOrder->fetch_assoc();
                                                    $customer_name = $row['supplier_id'];
                                                    $name = $sl->getName('suppliers','supplier_name','id',$customer_name);
                                                ?>
                                                  <strong>Invoice No.</strong>
                                                  <p class="text-muted"><?php echo $row['invoice_id']; ?></p>
                                                  <hr>

                                                  <strong>Warehouse</strong>
                                                  <p class="text-muted"><?php echo $row['name']; ?></p>
                                                  <hr>

                                                  <strong>Customer</strong>
                                                  <p class="text-muted"><?php echo $name;?></p>
                                                  <hr>

                                                  <strong>Sales/Delivery Date</strong>
                                                  <p class="text-muted"><?php echo $fm->DateFormat3($row['delivery_date']); ?></p>
                                                  <hr>

                                                  <strong>Sale Type</strong>
                                                  <p class="text-muted"><?php echo $row['order_type']; ?></p>
                                                  <hr>

                                                  <strong>Status</strong>
                                                  <p class="text-muted"><?php echo $row['status']; ?></p>
                                                  <hr>

                                                <h4 class="sub-title">Sale Items</h4>
                                                
                                                <table class="table table-condensed table-md-responsive table-striped" id="items-table">
                                                    <thead>
                                                        <th>S/N</th>
                                                        <th>Item</th>
                                                        <th>Unit Price</th>
                                                        <th>Quantity</th>
                                                        <th>Sub Total</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tfoot>
                                                        <tr class="py-1">
                                                            <th colspan="5" class="text-right">Sub Total</th>
                                                            <th>NGN <?php echo number_format($row['subtotal'], 2); ?>
                                                            </th>
                                                        </tr>
                                                        <tr class="py-1">
                                                            <th colspan="5" class="text-right">Discount</th>
                                                            <th>NGN <?php echo number_format($row['discount'], 2); ?>
                                                            </th>
                                                        </tr>
                                                        <tr class="py-1">
                                                            <th colspan="5" class="text-right">Total</th>
                                                            <th>NGN <?php 
                                                                $total = $row['total'];
                                                                echo number_format($total, 2); 
                                                            ?></th>
                                                        </tr>
                                                        <tr class="py-1">
                                                            <th colspan="5" class="text-right">Amount Paid</th>
                                                            <th>NGN <?php 
                                                                $paid = $ct->sumMatchThreeExcludingDeleted('finances','amount','table_name','orders','item_id',$order,'category','Income');
                                                                echo number_format($paid, 2); 
                                                            ?></th>
                                                        </tr>
                                                        <tr class="py-1">
                                                            <th colspan="5" class="text-right">Balance</th>
                                                            <th>NGN <?php 
                                                                $balance = $total - $paid;
                                                                echo number_format($balance, 2); 
                                                            ?></th>
                                                        </tr>
                                                    </tfoot>
                                                    
                                                </table>
                                                <div class="form-group text-center">
                                                    <a class='btn btn-round btn-grd-warning print-reciept' href='checkoutprint.php?invoice_id=<?php echo $order; ?>' title='Print'><i class='fa fa-print'>Print Reciept</i></a>
                                                </div>
                                                <h4 class="sub-title">Payment History</h4>
                                                <table class="table table-condensed table-md-responsive table-striped" id="payment-table">
                                                    <thead>
                                                        <th>S/N</th>
                                                        <th>Date</th>
                                                        <th>Category</th>
                                                        <th>Amount</th>
                                                        <th>Payment Method</th>
                                                        <th>Action</th>
                                                    </thead>
                                                </table>

                                                <form class="mt-5">
                                                    <input type="hidden" name="action" value="update_order">
                                                    <input type="hidden" name="order" value="<?php echo $row['id']; ?>">
                                                    <h4 class="sub-title">Sales Status</h4>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="status" id="order-status" required>
                                                                <option value="Pending" <?php if ($row['status'] == 'Pending') {
                                                                    echo 'selected';
                                                                } ?>>Pending</option>

                                                                <option value="Processing" <?php if ($row['status'] == 'Processing') {
                                                                    echo 'selected';
                                                                } ?>>Processing</option>

                                                                <option value="Sold/Delivered" <?php if ($row['status'] == 'Delivered') {
                                                                    echo 'selected';
                                                                } ?>>Delivered/Sold</option>

                                                                <option value="Canceled" <?php if ($row['status'] == 'Canceled') {
                                                                    echo 'selected';
                                                                } ?>>Canceled</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-round btn-grd-success">Save Changes</button>
                                                    </div>
                                                </form>
                                                <form class="mt-3">
                                                    <input type="hidden" name="action" value="add_order_payment">
                                                    <input type="hidden" name="order" value="<?php echo $row['id']; ?>">
                                                    <h4 class="sub-title">Add Payment</h4>

                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Amount (NGN) <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="paid_amount" min="1" step="0.05" required>
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
                                                        <button type="submit" class="btn btn-round btn-grd-success">Add Payment</button>
                                                    </div>
                                                </form>


                                                <?php 
                                                }else{
                                                    echo '<h4 class="sub-title">Error</h4>
                                                    <h3 class="text-center">Order Not Found</h3>';
                                                } ?>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->

                            <!-- The Edit Modal -->
                            <div class="modal fade" id="paymentModal">
                              <div class="modal-dialog modal-lg  modal-dialog-scrollable">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Order Payment</h4>
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
    <!-- Custom js -->
    <script src="../assets/js/pcoded.min.js"></script>
    <script src="../assets/js/vertical-layout.min.js "></script>
    <script src="../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="../assets/js/script.js"></script>
    <script type="text/javascript">
        $(function () {

            toastr.options.preventDuplicates = true;
            toastr.options.progressBar = true;

            $('#items-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    
                ],
                deferRender:  true,
                processing:  true,
                searching: false,
                responsive:true,
                paging:  false,
                info:   false,
                sort:  false,
                ajax: "../assets/data/datatables-data.php?table=order_items&order=<?php echo $order; ?>",
                columns: [
                    { data: 'sn' },
                    { data: 'name' },
                    { data: 'price' },
                    { data: 'quantity' },
                    { data: 'subtotal' },
                    { data: 'action' }
                ],
            });

            $('#payment-table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                deferRender: true,
                processing: true,
                ajax: "../assets/data/datatables-data.php?table=order_payment&order=<?php echo $order; ?>",
                columns: [
                    { data: 'sn' },
                    { data: 'date' },
                    { data: 'category' },
                    { data: 'amount' },
                    { data: 'method' },
                    { data: 'action' }
                ],
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

            // View Product
            $(document).on('click', '.view-product', function () {
                var product = $(this).data('product');
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
                    var out = data.message;
                    $('#productModal .modal-body').html(out);

                  } else {
                    $('#productModal .modal-body').html('<div class="text-center m-5"><h4>'+ data.errors +'</h4></div>');
                  }
                })
                .fail(function () {
                    $('#productModal .modal-body').html('<div class="text-center m-5"><h4>Sorry, Could not Establish a connection.</h4></div>');
                });
                
            });
            
            // Edit Payment
            $(document).on('click', '.edit-payment', function () {
                var payment = $(this).data('payment');
                $("#paymentModal").modal("show");

                $.ajax({
                    type        : 'POST',
                    url         : '../assets/data/modal-data.php',
                    data        : {content:"edit_payment", id:payment}, 
                    dataType    : 'json',
                    encode      : true
                })
                .done(function(data) {
                  if (data.success === true) {
                    var doc = $('#paymentModal .modal-body').html(data.message);
                  } else {
                    $('#paymentModal .modal-body').html('<div class="text-center m-5"><h4>'+ data.errors +'</h4></div>');
                  }
                })
                .fail(function () {
                    $('#paymentModal .modal-body').html('<div class="text-center m-5"><h4>Sorry, Could not Establish a connection.</h4></div>');
                });
                
            });

            $(document).on('submit','form', function(event) {
              toastr.info('Processing. Please wait ...');
              
              $.ajax({
                  type        : 'POST',
                  url         : '../assets/redirects/order-validation.php',
                  data        : $(this).serialize(), 
                  dataType    : 'json',
                  encode      : true
              })
              .done(function(data) {
                if (data.success === true) {
                  toastr.success(data.message, 'Successful');

                  setTimeout( function () {
                    location.reload(true);
                  }, 3000);

                } else {
                  toastr.error(data.errors, 'Oops');
                }
              });

              event.preventDefault();
            });

            // Delete Payment
            $(document).on('click', '.del-payment-btn', function(){
              var item_id = $(this).attr("id");
              swal({
                    title: "Delete !",
                    text: "Are you sure you want to Delete Payment?",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#FF5252",
                    confirmButtonText: "Yes",
                    closeOnConfirm: !1
                }, function() {

                  $.post('../assets/redirects/delete.php', {id:item_id, tab:'finance', token:'randomKeyWord'}, function (response, status) {
                        var data = JSON.parse(response);
                        if (data.success === true) {
                            swal("Deleted !", data.message, "success");
                            setTimeout( function () {
                              location.reload(true);
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

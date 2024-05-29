<?php
session_start();
include '../includer.inc.php';
Session::checkCentralStoreSession();

$supply = 0;
if (isset($_GET['supply'])) {
    $supply = intval($_GET['supply']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Supply | Warehouse System</title>
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
                                            <h5 class="m-b-10">View Product Supply</h5>
                                            <!-- <p class="m-b-0"></p> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">View Product Supply</a>
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
                                                <h5>Product Supply</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <h4 class="sub-title">Supply Info</h4>

                                                <?php 

                                                $getSupply = $sl->selectOneMatchThreeJoinedOrderedExcludeDeleted('incoming_products', '*', 'product_id', 'supplier_id', 'products', 'id', 'product_name, `products`.metric_units', 'suppliers', 'id', 'supplier_name', 'incoming_products', 'id', $supply, 'id', 'ASC');
                                                if($getSupply) {
                                                    $row = $getSupply->fetch_assoc();
                                                ?>  
                                                <div class="row">
                                                  <div class="col-md-12">
                                                    <strong>Supply No.</strong>
                                                    <p class="text-muted"><?php echo $row['supply_id']; ?></p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <strong>Product</strong>
                                                    <p class="text-muted"><?php echo $row['product_name']; ?></p>
                                                    <hr> 
                                                  </div>
                                                  <div class="col-md-6">
                                                    <strong>Supplier</strong>
                                                    <p class="text-muted"><?php echo $row['supplier_name']; ?></p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <strong>Date</strong>
                                                    <p class="text-muted"><?php echo $fm->DateFormat3($row['added_date']); ?></p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <strong>Batch No</strong>
                                                    <p class="text-muted"><?php echo $row['batch_no']; ?> &#160;</p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <strong>Production Date</strong>
                                                    <p class="text-muted"><?php 
                                                        if (isset($row['production_date']) && $row['production_date'] != '0000-00-00') {
                                                            $prod_date = $fm->DateFormat7($row['production_date']);
                                                        }else{
                                                            $prod_date = 'Not Set';
                                                        }
                                                        echo $prod_date; ?></p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <strong>Expiry Date</strong>
                                                    <p class="text-muted"><?php 
                                                        if (isset($row['expiry_date']) && $row['expiry_date'] != '0000-00-00') {
                                                            $exp_date = $fm->DateFormat7($row['expiry_date']);
                                                        }else{
                                                            $exp_date = 'Not Set';
                                                        }
                                                        echo $exp_date; ?></p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <strong>Available Quantity</strong>
                                                    <p class="text-muted"><?php echo $row['available_quantity']; ?></p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <strong>Damaged</strong>
                                                    <p class="text-muted"><?php echo $row['damaged']; ?></p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <strong>Supplied Quantity</strong>
                                                    <p class="text-muted"><?php echo $row['supplied_quantity']; ?></p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6">
                                                    <strong>Unit Price</strong>
                                                    <p class="text-muted">NGN <?php echo number_format($row['unit_price'], 2); ?></p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6 col-lg-4">
                                                    <strong>Total</strong>
                                                    <p class="text-muted">NGN <?php echo number_format($row['total_price'], 2); ?></p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6 col-lg-4">
                                                    <strong>Paid</strong>
                                                    <p class="text-muted">NGN <?php
                                                        $paid = $ct->sumMatchThreeExcludingDeleted('finances', 'amount', 'table_name', 'incoming_products', 'item_id', $row['id'], 'category', 'Expense');
                                                        echo number_format($paid, 2); 
                                                    ?></p>
                                                    <hr>
                                                  </div>
                                                  <div class="col-md-6 col-lg-4">
                                                    <strong>Balance</strong>
                                                    <p class="text-muted">NGN <?php echo number_format($row['total_price'] - $paid, 2); ?></p>
                                                    <hr>
                                                  </div>
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
                                                    <input type="hidden" name="action" value="add_supply_payment">
                                                    <input type="hidden" name="supply" value="<?php echo $row['id']; ?>">
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

                                                <form class="mt-3">
                                                    <input type="hidden" name="action" value="add_damaged_items">
                                                    <input type="hidden" name="supply" value="<?php echo $row['id']; ?>">
                                                    <h4 class="sub-title">Add Damaged Supplies</h4>

                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Damaged <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="damaged" min="-<?php echo $row['damaged']; ?>" max="<?php echo $row['available_quantity']; ?>"  required placeholder="e.g 10">
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-round btn-grd-success">Add Damages</button>
                                                    </div>
                                                </form>


                                                <?php 
                                                }else{
                                                    echo '<h4 class="sub-title">Error</h4>
                                                    <h3 class="text-center">Supply Info Not Found</h3>';
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
                                    <h4 class="modal-title">Supply Payment</h4>
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

            $('#payment-table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                deferRender: true,
                processing: true,
                ajax: "../assets/data/datatables-data.php?table=supply_payment&supply=<?php echo $supply; ?>",
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
                    $('#paymentModal .modal-body').html(data.message);

                  } else {
                    $('#paymentModal .modal-body').html('<div class="text-center m-5"><h4>'+ data.errors +'</h4></div>');
                  }
                })
                .fail(function () {
                    $('#paymentModal .modal-body').html('<div class="text-center m-5"><h4>Sorry, Could not Establish a connection.</h4></div>');
                });
                
            });

            $(document).on('submit', 'form', function(event) {
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

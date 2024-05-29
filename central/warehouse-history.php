<?php
session_start();
include '../includer.inc.php';
Session::checkCentralStoreSession();

$warehouse = 0;
if (isset($_GET['warehouse'])) {
    $warehouse = intval($_GET['warehouse']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Warehouse History | Warehouse System</title>
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
                                            <h5 class="m-b-10">Warehouse History</h5>
                                            <!-- <p class="m-b-0"></p> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Warehouse History</a>
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

                                        <?php 
                                        $getWarehouse = $sl->selectOneMatchSingle('stores','id',$warehouse);
                                        if ($getWarehouse) {
                                            $row = $getWarehouse->fetch_assoc();
                                        ?>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Warehouse</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <h4 class="sub-title">Warehouse Info</h4>

                                                <div class="row">
                                                  <div class="col-12">
                                                                      
                                                      <strong><i class="fa fa-warehouse mr-1"></i> Name</strong>
                                                      <p class="text-muted"><?php echo $row['name']; ?></p>
                                                      <hr>
                                                  </div>

                                                  <div class="col-12">
                                                    <strong><i class="fa fa-map-pin mr-1"></i> Address</strong>
                                                      <p class="text-muted"><?php echo $row['address']; ?></p>
                                                      <hr>
                                                  </div>

                                                  <div class="col-md-4">
                                                      <strong><i class="fa fa-map-pin mr-1"></i> Country</strong>
                                                      <p class="text-muted"><?php echo $row['country']; ?></p>
                                                      <hr>
                                                  </div>

                                                  <div class="col-md-4">
                                                      <strong><i class="fa fa-map-pin mr-1"></i> State</strong>
                                                      <p class="text-muted"><?php echo $row['state']; ?></p>
                                                      <hr>
                                                  </div>

                                                  <div class="col-md-4">
                                                      <strong><i class="fa fa-map-pin mr-1"></i> LGA</strong>
                                                      <p class="text-muted"><?php echo $row['city']; ?></p>
                                                      <hr>
                                                  </div>
                                              </div>
                                            <h4 class="sub-title">Warehouse Staff</h4>
                                            <div class="row">
                                              <?php
                                              $getStaff = $sl->selectOneMatchTwoJoinedOrderedExcludeDeleted('users','id','user_roles','user_id','role','user_roles','store_id',$warehouse,'first_name','ASC');
                                              if ($getStaff) {
                                                  while ($staffRow = $getStaff->fetch_assoc()) {
                                                      
                                                ?>
                                                <div class="col-md-4">
                                                  <strong><i class="far fa-user mr-1"></i> Name</strong>
                                                  <p class="text-muted"><?php echo $staffRow['first_name'] .' '.$staffRow['last_name'] .' '. $staffRow['other_name']; ?></p>
                                                  <hr>
                                                </div>

                                                <div class="col-md-4">
                                                  <strong><i class="fas fa-phone mr-1"></i> Phone Number</strong>
                                                  <p class="text-muted"><?php echo $staffRow['phone']; ?></p>
                                                  <hr>
                                                </div>

                                                <div class="col-md-4">
                                                  <strong><i class="fas fa-phone mr-1"></i> Role</strong>
                                                  <p class="text-muted"><?php echo $roleArray[$staffRow['role']]; ?></p>
                                                  <hr>
                                                </div>
                                                <?php
                                                    }
                                                  }else{ ?>
                                                        
                                                    <div class="col-12">
                                                      <strong>No Staff Found or Assigned Role</strong>
                                                      <hr>
                                                    </div>
                                                  <?php } ?>
                                                  </div>
                                                  <div class="col-12 text-center">
                                                    <a class="btn btn-grd-success btn-round pl-3 mr-2 py-1" href="edit-store.php?store=<?php echo $row['id'] ?>"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                  </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Orders and Payments</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <h4 class="sub-title">Orders</h4>
                                                <table class="table table-condensed table-md-responsive table-striped" id="order-table">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Invoice Number</th>
                                                        <th>Date</th>
                                                        <th>Items</th>
                                                        <th>Total (NGN)</th>
                                                        <th>Paid (NGN)</th>
                                                        <th>Balance (NGN)</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="4" class="text-right">TOTAL</th>
                                                            <th class="text-right">00.0</th>
                                                            <th class="text-right">00.0</th>
                                                            <th class="text-right">00.0</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                
                                                <h4 class="sub-title mt-5">Order Payment History</h4>
                                                <table class="table table-condensed table-md-responsive table-striped" id="payment-table">
                                                    <thead>
                                                        <th>S/N</th>
                                                        <th>Date</th>
                                                        <th>Invoice No.</th>
                                                        <th>Amount</th>
                                                        <th>Payment Method</th>
                                                        <th>Action</th>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>


                                        <?php 
                                        }else{
                                            echo '
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Warehouse</h5>
                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                                    <h4 class="sub-title">Error</h4>
                                                    <h3 class="text-center">Warehouse Not Found</h3>
                                                </div>
                                            </div>';
                                        } ?>
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
                                    <h4 class="modal-title">Warehouse Supply</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body warehouse-category">
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
            var formatter = new Intl.NumberFormat('en', {style: 'currency', currency: 'NGN', minimumFractionDigits:2 });
            

            $('#payment-table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                deferRender: true,
                processing: true,
                ajax: "../assets/data/datatables-data.php?table=warehouse_payment&warehouse=<?php echo $warehouse; ?>",
                columns: [
                    { data: 'sn' },
                    { data: 'date' },
                    { data: 'order_no' },
                    { data: 'amount' },
                    { data: 'method' },
                    { data: 'action' }
                ],
            });

            $('#order-table').DataTable({

                footerCallback: function ( row, data, start, end, display ) {
                     var api = this.api(), data;
                     // Remove the formatting to get integer data for summation
                     var intVal = function ( i ) {
                         return typeof i === 'string' ?
                             i.replace(/[\$,]/g, '')*1 :
                             typeof i === 'number' ?
                                 i : 0;
                     };
                
                     // Total over all pages
                     var total = api
                         .column(4)
                         .data()
                         .reduce( function (a, b) {
                             return intVal(a) + intVal(b);
                         }, 0 );

                     var paid = api
                         .column(5)
                         .data()
                         .reduce( function (a, b) {
                             return intVal(a) + intVal(b);
                         }, 0 );

                     var balance = api
                         .column(6)
                         .data()
                         .reduce( function (a, b) {
                             return intVal(a) + intVal(b);
                         }, 0 );
                
                     // Update footer
                     $(api.column(4).footer()).html(formatter.format(total));
                     $(api.column(5).footer()).html(formatter.format(paid));
                     $(api.column(6).footer()).html(formatter.format(balance));
                 },

                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                deferRender: true,
                processing: true,
                ajax: "../assets/data/datatables-data.php?table=warehouse_order&warehouse=<?php echo $warehouse; ?>",
                columns: [
                    { data: 'sn' },
                    { data: 'invoice_no' },
                    { data: 'date' },
                    { data: 'items' },
                    { data: 'total' },
                    { data: 'paid' },
                    { data: 'balance' },
                    { data: 'status' },
                    { data: 'action' }
                ],
                columnDefs : [
                    { className: "text-right", "targets": [ 4, 5, 6 ] }
                  ]

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

            $(document).on('submit','form.payment-form', function(event) {
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

            $('form').submit(function(event) {
              toastr.info('Processing. Please wait ...');
              
              $.ajax({
                  type        : 'POST',
                  url         : '../assets/redirects/order-validation.php',
                  data        : $(this).serialize(), 
                  encode      : true,
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

                  $.post('../assets/redirects/delete.php', {id:item_id, tab:'order_payment', token:'randomKeyWord'}, function (response, status) {
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

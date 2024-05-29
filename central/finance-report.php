<?php
session_start();
    include '../includer.inc.php';
    Session::checkCentralStoreSession();
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Finance | Warehouse System </title>
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
      <!-- Daterangepicker -->
      <link rel="stylesheet" type="text/css" href="../assets/plugins/daterangepicker/daterangepicker.css">
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
                                            <h5 class="m-b-10">Finance</h5>
                                            <p class="m-b-0">Finance Control Page</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Finance</a>
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
                                        <!-- Date and time range -->
                                        <div class="form-group">

                                          <div class="input-group">
                                            <button type="button" class="btn btn-light float-right" id="daterange-btn">
                                              <i class="far fa-calendar-alt"></i> <span>Date Range</span>
                                              <i class="fas fa-caret-down"></i>
                                            </button>
                                          </div>
                                        </div>
                                        <!-- /.form group -->

                                        <!-- Category Card -->
                                        <div class="card add-finance-card">
                                            <div class="card-header">
                                                <h5>Add Financial Report</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-plus minimize-card add-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block" style="display: none;">
                                                <form>
                                                    <input type="hidden" name="action" value="add_finance">
                                                    <h4 class="sub-title">Financial Statement Info</h4>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="category" required>
                                                                <option value="Income">Income</option>
                                                                <option value="Expense">Expense</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Purpose <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="purpose" placeholder="e.g Purchase of goods, Maintenace" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Amount <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="amount" min="1" placeholder="e.g 10000" required>
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
                                                    <h4 class="sub-title">Associated Info (optional)</h4>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Selection </label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="item_table" id="selection-name" required>
                                                                <option value="">Select</option>
                                                                 <?php 
                                                                $unitsArray = array("orders"=> "Order", "incoming_products"=> "Restock", "users"=> "User", "inventories" => "Inventory", "stores" => "Warehouse", "products" => "Product", "suppliers" => "Supplier");

                                                                foreach ($unitsArray as $key => $value) {
                                                                    echo '<option value="'. $key .'">'. $value .'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Item</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="item_id" id="item-name" required>
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
                                        <div class="card list-income-card">
                                            <div class="card-header">
                                                <h5>Income</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa open-card-option fa-wrench"></i></li>
                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                        <li><i class="fa minimize-card fa-minus"></i></li>
                                                        <li><i class="fa fa-sync reload-card" data-table="income-table"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="income-table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Date</th>
                                                                <th>Purpose</th>
                                                                <th>Amount</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--table card end -->
                                        <!-- table card start -->
                                        <div class="card list-expense-card">
                                            <div class="card-header">
                                                <h5>Expenses</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa open-card-option fa-wrench"></i></li>
                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                        <li><i class="fa minimize-card fa-minus"></i></li>
                                                        <li><i class="fa fa-sync reload-card" data-table="expense-table"></i></li>
                                                    </ul>

                                                </div>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="expense-table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Date</th>
                                                                <th>Purpose</th>
                                                                <th>Amount</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--table card end -->
                                        <!-- report card start -->
                                        <div class="card report-card">
                                            <div class="card-header">
                                                <h5>Summary Report</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa open-card-option fa-wrench"></i></li>
                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                        <li><i class="fa minimize-card fa-minus"></i></li>
                                                        <li><i class="fa fa-sync reload-card" data-table="expense-table"></i></li>
                                                    </ul>

                                                </div>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div id="chartdiv" style="height: 400px;"></div>
                                                        <div id="charterror" style="display: none;"></div>
                                                    </div>
                                                    <div class="col-12">
                                                        <table class="table table-striped table-condensed">
                                                            <caption>Summary</caption>
                                                            <tr>
                                                                <th width="25%">Income</th>
                                                                <td><span id="income-report"></span> </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Expense</th>
                                                                <td><span id="expense-report"></span> </td>
                                                            </tr>
                                                                <th>Balance</th>
                                                                <td><span id="balance-report"></span> </td>
                                                            <tr>
                                                                
                                                            </tr>
                                                        </table>
                                                    </div>
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
                            <div class="modal fade" id="financeModal">
                              <div class="modal-dialog modal-lg  modal-dialog-scrollable">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Report Information</h4>
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
    <!-- Select2 -->
    <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
    <!-- Custom js -->
    <script src="../assets/js/pcoded.min.js"></script>
    <script src="../assets/js/vertical-layout.min.js "></script>
    <script src="../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="../assets/js/script.js"></script>
    <!-- amchart js -->
   <script src="../assets/plugins/amchart/v5/index.js"></script>
   <script src="../assets/plugins/amchart/v5/xy.js"></script>
   <script src="../assets/plugins/amchart/v5/themes/Animated.js"></script>
   <script src="../assets/plugins/amchart/v5/themes/Responsive.js"></script>
   <script src="../assets/plugins/amchart/v5/plugins/exporting.js"></script>
   <!-- daterange -->
   <script src="../assets/plugins/daterangepicker/moment.min.js"></script>
   <script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>


       <script>

           //Chart Title
           // "titles": [{
           //   "text": "Finances",
           //   "fontSize": 25,
           //   "tooltipText": "Income and Expenditures"
           // }],


       </script>
    <script type="text/javascript">
        $(function () {

            $('.select2bs4').select2({
                theme: 'bootstrap4',
                placeholder: 'Select Option',
            });

            $('#income-table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                deferRender: true,
                lengthChange: true,
                processing: true,
                // serverSide: true,
                ajax: "", //../assets/data/datatables-data.php?table=finance_income
                columns: [
                    { data: 'sn' },
                    { data: 'date' },
                    { data: 'purpose' },
                    { data: 'amount' },
                    { data: 'action' }
                ],
            });

            $('#expense-table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                deferRender: true,
                lengthChange: true,
                processing: true,
                // serverSide: true,
                ajax: "", //../assets/data/datatables-data.php?table=finance_expense
                columns: [
                    { data: 'sn' },
                    { data: 'date' },
                    { data: 'purpose' },
                    { data: 'amount' },
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

            $('#selection-name').on('change', function() {
                var table = $(this).find(':selected').text().toLowerCase();
                if (table !== 'select') {
                    $.getJSON('../assets/data/select-data.php?table='+table, function(data){
                        $('#item-name').empty();
                      if (data !== null) {
                        $.each(data, function(key, value){
                            $('#item-name').append(new Option(value.text, value.id));
                        });
                      }

                    });
                }
            });


            $(".card-header-right .reload-card").on('click', function() {
                var $this = $(this);
                var table = $this.data('table');
                $this.parents('.card').addClass("card-load");
                $this.parents('.card').append('<div class="card-loader"><i class="fa fa-spinner rotate-refresh"></div>');

                    $('#'+table).DataTable().ajax.url('../assets/data/datatables-data.php?table=finance_'+table.replace('-table', '')).load(function(){
                        $this.parents('.card').children(".card-loader").remove();
                        $this.parents('.card').removeClass("card-load");

                    });

            });


            toastr.options.preventDuplicates = true;
            toastr.options.progressBar = true;

            $('form').submit(function(event) {
              toastr.info('Processing. Please wait ...');
              
              $.ajax({
                  type        : 'POST',
                  url         : '../assets/redirects/finance-validation.php',
                  data        : $(this).serialize(), 
                  dataType    : 'json',
                  encode      : true
              })
              .done(function(data) {
                if (data.success === true) {
                  toastr.success(data.message, 'Successful');

                  $(".add-finance-card .add-card").click();
                  setTimeout( function () {
                    $(".card-header-right .reload-card").click();
                  }, 500);

                } else {
                  toastr.error(data.errors, 'Oops');
                }
              });

              event.preventDefault();
            });

            // View Finance
            $(document).on('click', '.view-finance', function () {
                var finance = $(this).data('finance');
                $("#financeModal").modal("show");

                $.ajax({
                    type        : 'POST',
                    url         : '../assets/data/modal-data.php',
                    data        : {content:"finance_info", id:finance}, 
                    dataType    : 'json',
                    encode      : true
                })
                .done(function(data) {
                  if (data.success === true) {
                    $('#financeModal .modal-body').html(data.message);

                  } else {
                    $('#financeModal .modal-body').html('<div class="text-center m-5"><h4>'+ data.errors +'</h4></div>');
                  }
                })
                .fail(function () {
                    $('#financeModal .modal-body').html('<div class="text-center m-5"><h4>Sorry, Could not Establish a connection.</h4></div>');
                });
                
            });

            // Delete Finance
            $(document).on('click', '.del-finance-btn', function(){
              var item_id = $(this).attr("id");
              swal({
                    title: "Delete !",
                    text: "Are you sure you want to Delete Finance Statement?",
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

    am5.ready(function() {

        // Create root element
        var root = am5.Root.new("chartdiv");

        // Set themes
        root.setThemes([
          am5themes_Animated.new(root),
          am5themes_Responsive.new(root)
        ]);

            updateCards(moment().subtract(29, 'days').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD HH:mm:ss'));
            function updateCards(start, end) {
                getStatementReport(start, end);
                getVisualReport(start, end);
                
            }
            function getStatementReport(from, to) {
                var $this = $('.card-header-right .reload-card');
                $this.parents('.card').addClass("card-load");
                $this.parents('.card').append('<div class="card-loader"><i class="fa fa-spinner rotate-refresh"></div>');

                $('#income-table').DataTable().ajax.url('../assets/data/datatables-data.php?table=finance_statement&category=Income&start='+ from +'&end='+ to).load(function(){
                    $this.parents('.card').children(".card-loader").remove();
                    $this.parents('.card').removeClass("card-load");

                });

                $('#expense-table').DataTable().ajax.url('../assets/data/datatables-data.php?table=finance_statement&category=Expense&start='+ from +'&end='+ to).load(function(){
                    $this.parents('.card').children(".card-loader").remove();
                    $this.parents('.card').removeClass("card-load");

                });
            }

            //Date range as a button
            $('#daterange-btn').daterangepicker(
              {
                ranges   : {
                  'Today'       : [moment(), moment()],
                  'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                  'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                  'Last 2 Months'  : [moment().subtract(2, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                  'Last 3 Months'  : [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment(),
                maxDate : moment()
              },
              function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                updateCards(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD HH:mm:ss'));
              }
            )


            function getVisualReport(from, to) {
                
                    $.ajax({
                        type        : 'GET',
                        url         : '../assets/data/select-data.php',
                        data        : {table:"finance_statement", startDate:from, endDate:to}, 
                        dataType    : 'json',
                        encode      : true
                    })
                    .done(function(response) {
                      if (response.status === true) {
                        $('#chartdiv').css('display', 'block');
                        $('#charterror').css('display', 'none');
                        plotChart(response.values);
                        updateStats(response);

                      } else {
                        $('#chartdiv').css('display', 'none');
                        $('#charterror').css('display', 'block');
                        $('#charterror').html('<div class="text-center p-5"><h2>'+ response.errors +'</h2></div>');
                        updateStats(response);
                      }
                    })
                    .fail(function () {
                        $('#chartdiv').css('display', 'none');
                        $('#charterror').css('display', 'block');
                        $('#charterror').html('<div class="text-center p-5"><h2>Sorry, Could not Establish a connection.</h2></div>');
                        updateStats({totalIncome:0, totalExpense:0, balance:0});
                    });

        } 
            function updateStats(response) {
                var formatter = new Intl.NumberFormat('en', {style: 'currency', currency: 'NGN', minimumFractionDigits:2 });
                var income = parseFloat(response.totalIncome) || 0.00;
                var expense = parseFloat(response.totalExpense) || 0.00;
                var balance = parseFloat(response.balance) || 0.00;

                $('#income-report').html(formatter.format(income));
                $('#expense-report').html(formatter.format(expense));
                $('#balance-report').html(formatter.format(balance));
            }

            
            function plotChart(data){
                // Clear existing Chart
                root.container.children.clear();
                // Create chart
                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                  panX: true,
                  panY: false,
                  wheelX: "panX",
                  wheelY: "zoomX",
                  layout: root.verticalLayout
                }));

                // Add legend
                var legend = chart.children.push(
                  am5.Legend.new(root, {
                    centerX: am5.p50,
                    x: am5.p50
                  })
                );

                // exporting
                var exporting = am5plugins_exporting.Exporting.new(root, {
                  menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                  dataSource: data,
                  csvOptions: {
                    disabled: true
                  },
                  htmlOptions: {
                    disabled: true
                  },
                  jsonOptions: {
                    disabled: true
                  }
                });

                // Create axes
                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                  categoryField: "date",
                  renderer: am5xy.AxisRendererX.new(root, {
                    cellStartLocation: 0.1,
                    cellEndLocation: 0.9
                  }),
                  tooltip: am5.Tooltip.new(root, {})
                }));

                xAxis.data.setAll(data);

                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                  renderer: am5xy.AxisRendererY.new(root, {})
                }));

                // Add series
                function makeSeries(name, fieldName, color) {
                  var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: fieldName,
                    categoryXField: "date"
                  }));

                  series.columns.template.setAll({
                    tooltipText: "{name}, {categoryX}: {valueY}",
                    width: am5.percent(75),
                    tooltipY: 0
                  });
                  series.set("fill", am5.color(color));
                  series.data.setAll(data);

                  // Make stuff animate on load
                  series.appear();

                  series.bullets.push(function () {
                    return am5.Bullet.new(root, {
                      locationY: 0,
                      sprite: am5.Label.new(root, {
                        text: "{valueY}",
                        fill: root.interfaceColors.get("alternativeText"),
                        centerY: 0,
                        centerX: am5.p50,
                        populateText: true
                      })
                    });
                  });

                  legend.data.push(series);
                }

                makeSeries("Income", "income", 0x55cc55);
                makeSeries("Expense", "expense", 0xe93939);


                // Make stuff animate on load
                chart.appear(1000, 100);
            }

                    

        }); // end am5.ready()



        })
    </script>
</body>

</html>

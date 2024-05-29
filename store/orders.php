<?php
session_start();
    include '../includer.inc.php';
    Session::checkCentralStoreSession();
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sales | Warehouse System </title>
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
                                            <h5 class="m-b-10">Sales</h5>
                                            <p class="m-b-0">View Sales Page</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Orders</a>
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
                                        <!-- table card start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Sales</h5>
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
                                                                <th>Invoice Number</th>
                                                                <th>Date</th>
                                                                <th>Customer</th>
                                                                <th>Total (NGN)</th>
                                                                <th>Paid (NGN)</th>
                                                                <th>Balance (NGN)</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="4" class="text-right">Current Page Total <br>(Grand Total)</th>
                                                                <th class="text-right targets">00.0</th>
                                                                <th class="text-right targets">00.0</th>
                                                                <th class="text-right targets">00.0</th>
                                                                <th colspan="2"></th>
                                                            </tr>
                                                        </tfoot>
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
            var formatter = new Intl.NumberFormat('en', {style: 'currency', currency: 'NGN', minimumFractionDigits:2 });

            $('#data-table').DataTable({


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

                    // Total Over Current Pages
                     var pageTotal = api
                         .column( 4, { page: 'current'} )
                         .data()
                         .reduce( function (a, b) {
                             return intVal(a) + intVal(b);
                         }, 0 );

                     var pagePaid = api
                         .column( 5, { page: 'current'} )
                         .data()
                         .reduce( function (a, b) {
                             return intVal(a) + intVal(b);
                         }, 0 );

                     var pageBalance = api
                         .column( 6, { page: 'current'} )
                         .data()
                         .reduce( function (a, b) {
                             return intVal(a) + intVal(b);
                         }, 0 );
                
                     // Update footer
                    $(api.column(4).footer()).html(
                        formatter.format(pageTotal) + ' <br>(' + formatter.format(total) + ')'
                    );
                    $(api.column(5).footer()).html(
                        formatter.format(pagePaid) + ' <br>(' + formatter.format(paid) + ')'
                    );
                    $(api.column(6).footer()).html(
                        formatter.format(pageBalance) + ' <br>(' + formatter.format(balance) + ')'
                    );
                 },
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                deferRender: true,
                processing: true,
                // lengthChange: true,
                ajax: "../assets/data/datatables-data.php?table=order",
                columns: [
                    { data: 'sn' },
                    { data: 'invoice_no' },
                    { data: 'date' },
                    { data: 'customer' },
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

            // Delete User
            $(document).on('click', '.del-order-btn', function(){
              var item_id = $(this).attr("id");
              swal({
                    title: "Delete !",
                    text: "Are you sure you want to Delete Order?\n This will include other data Associated to this Order!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#FF5252",
                    confirmButtonText: "Yes",
                    closeOnConfirm: !1
                }, function() {

                  $.post('../assets/redirects/delete.php', {id:item_id, tab:'order', token:'randomKeyWord'}, function (response, status) {
                        var data = JSON.parse(response);
                        if (data.success === true) {
                            swal("Deleted !", data.message, "success");
                            setTimeout( function () {
                              $(".card-header-right .reload-card").click();
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

<?php
session_start();
include '../includer.inc.php';
Session::checkCentralStoreSession();

$item = 0;
if (isset($_GET['item'])) {
    $item = intval($_GET['item']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Inventory Item History | Warehouse System</title>
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
                                            <h5 class="m-b-10">Inventory Item History</h5>
                                            <!-- <p class="m-b-0"></p> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Inventory Item History</a>
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
                                        $getItem = $sl->selectOneMatchTwoJoinedOrderedExcludeDeletedLimited('inventories','category_id','inventory_categories','id','title','inventories','id',$item,'id','ASC','0','1');
                                        if ($getItem) {
                                            $row = $getItem->fetch_assoc();
                                        ?>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Inventory Item</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <h4 class="sub-title">Item Info</h4>

                                                <strong>Item Name</strong>
                                                <p class="text-muted"><?php echo $row['item_name']; ?></p>
                                                <hr>

                                                <strong>Category</strong>
                                                <p class="text-muted"><?php echo $row['title']; ?></p>
                                                <hr>

                                                <strong>Quantity</strong>
                                                <p class="text-muted"><?php echo $row['quantity']; ?></p>
                                                <hr>

                                                <h4 class="sub-title pt-5">Release Item</h4>
                                                <form>
                                                    <input type="hidden" name="action" value="release_item">
                                                    <input type="hidden" name="item_id" value="<?php echo $item; ?>">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Warehouse <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="warehouse" id="select-warehouse" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Date Taken <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="date" class="form-control" name="date_taken" value="<?php echo date('Y-m-d'); ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Quantity <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="quantity_taken" value="1" min="1" max="<?php echo $row['quantity']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-round btn-grd-success">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Item History</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <h4 class="sub-title">History</h4>
                                                <table class="table table-condensed table-md-responsive table-striped" id="history-table">
                                                    <thead>
                                                        <th>S/N</th>
                                                        <th>Warehouse</th>
                                                        <th>Date Taken</th>
                                                        <th>Quantity Taken</th>
                                                        <th>Date Returned</th>
                                                        <th>Quantity Returned</th>
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
                                                    <h5>Item</h5>
                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                                    <h4 class="sub-title">Error</h4>
                                                    <h3 class="text-center">Item Not Found</h3>
                                                </div>
                                            </div>';
                                        } ?>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->

                            <!-- The Edit Modal -->
                            <div class="modal fade" id="infoModal">
                              <div class="modal-dialog modal-lg  modal-dialog-scrollable">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Item History Info</h4>
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

            $('#history-table').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                deferRender: true,
                processing: true,
                ajax: "../assets/data/datatables-data.php?table=inventory_item&item=<?php echo $item; ?>",
                columns: [
                    { data: 'sn' },
                    { data: 'warehouse' },
                    { data: 'date_taken' },
                    { data: 'quantity_taken' },
                    { data: 'date_returned' },
                    { data: 'quantity_returned' },
                    { data: 'action' }
                ],
            });

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
            
            // Edit History
            $(document).on('click', '.edit-history', function () {
                var history = $(this).data('history');
                $("#infoModal").modal("show");

                $.ajax({
                    type        : 'POST',
                    url         : '../assets/data/modal-data.php',
                    data        : {content:"edit_item_history", id:history}, 
                    dataType    : 'json',
                    encode      : true
                })
                .done(function(data) {
                  if (data.success === true) {
                    $('#infoModal .modal-body').html(data.message);

                    var curr_warehouse = $('#select-edit-warehouse').val();
                    $('#select-edit-warehouse').empty();
                    $.getJSON('../assets/data/select-data.php?table=warehouse&selected='+curr_warehouse, function(data){

                      if (data !== null) {
                        $.each(data, function(key, value){
                            $('#select-edit-warehouse').append(new Option(value.text, value.id, value.selected, value.selected));
                        });
                      }

                    });

                  } else {
                    $('#infoModal .modal-body').html('<div class="text-center m-5"><h4>'+ data.errors +'</h4></div>');
                  }
                })
                .fail(function () {
                    $('#infoModal .modal-body').html('<div class="text-center m-5"><h4>Sorry, Could not Establish a connection.</h4></div>');
                });
                
            });

            $(document).on('submit','form', function(event) {
              toastr.info('Processing. Please wait ...');
              
              $.ajax({
                  type        : 'POST',
                  url         : '../assets/redirects/inventory-validation.php',
                  data        : $(this).serialize(), 
                  dataType    : 'json',
                  encode      : true
              })
              .done(function(data) {
                if (data.success === true) {
                  toastr.success(data.message, 'Successful');

                  $("#infoModal").modal("hide");
                  $('#history-table').DataTable().ajax.reload();
                  // setTimeout( function () {
                  //   location.reload(true);
                  // }, 3000);

                } else {
                  toastr.error(data.errors, 'Oops');
                }
              });

              event.preventDefault();
            });

            // Delete History
            $(document).on('click', '.del-history-btn', function(){
              var item_id = $(this).attr("id");
              swal({
                    title: "Delete !",
                    text: "Are you sure you want to Delete Inventory Item History?",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#FF5252",
                    confirmButtonText: "Yes",
                    closeOnConfirm: !1
                }, function() {

                  $.post('../assets/redirects/delete.php', {id:item_id, tab:'inventory_history', token:'randomKeyWord'}, function (response, status) {
                        var data = JSON.parse(response);
                        if (data.success === true) {
                            swal("Deleted !", data.message, "success");
                            $('#history-table').DataTable().ajax.reload();
                            // setTimeout( function () {
                            //   location.reload(true);
                            // }, 3000);
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

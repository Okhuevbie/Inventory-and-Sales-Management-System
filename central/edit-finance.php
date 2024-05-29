<?php
session_start();
    include '../includer.inc.php';
    Session::checkCentralStoreSession();

    $statement = 0;
    if (isset($_GET['statement'])) {
        $statement = intval($_GET['statement']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Financial Statement | Warehouse System</title>
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
      <!-- Select2 -->
      <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
      <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
                                            <h5 class="m-b-10">Edit Financial Statement</h5>
                                            <!-- <p class="m-b-0"></p> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="dashboard.php"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Edit Financial Statement</a>
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
                                                <h5>Edit Statement</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block">

                                                <?php 
                                                $getStatement = $sl->selectOneMatchSingle('finances','id',$statement);
                                                if ($getStatement) {
                                                    $row = $getStatement->fetch_assoc();
                                                ?>

                                                <form>
                                                    <input type="hidden" name="action" value="edit_payment">
                                                    <input type="hidden" name="fid" value="<?php echo $row['id']; ?>">
                                                    <h4 class="sub-title">Finance Info</h4>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="category" required>
                                                                <option value="Income" <?php if ($row['category'] == 'Income') {
                                                                    echo "selected";
                                                                } ?>>Income</option>
                                                                <option value="Expense" <?php if ($row['category'] == 'Expense') {
                                                                    echo "selected";
                                                                } ?>>Expense</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Purpose <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="purpose" 
                                                            placeholder="Finance Purpose" value="<?php echo $row['purpose']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Amount (NGN) <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control" name="amount" 
                                                            placeholder="e.g 10000" value="<?php echo $row['amount']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Payment Method <span class="text-danger">*</span></label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="payment_method" value="<?php echo $row['payment_method']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <h4 class="sub-title">Associated Info</h4>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Selection </label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="item_table" id="selection-name" required>
                                                                <option value="">Select</option>
                                                                 <?php 
                                                                $unitsArray = array("orders"=> "Order", "incoming_products"=> "Restock", "users"=> "User", "inventories" => "Inventory", "stores" => "Warehouse", "products" => "Product", "suppliers" => "Supplier");

                                                                foreach ($unitsArray as $key => $value) {
                                                                    if ($key == $row['table_name']) {
                                                                        $selected = 'selected';
                                                                    }else{
                                                                        $selected = '';
                                                                    }
                                                                    echo '<option value="'. $key .'" '. $selected .'>'. $value .'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Item</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2bs4" name="item_id" id="item-name" required>
                                                                <option value="<?php echo $row['item_id']; ?>" selected>Select</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-round btn-grd-success">Save Changes</button>
                                                    </div>
                                                </form>
                                                        
                                                <h4 class="sub-title">Remove Statement</h4>
                                                <div class="form-group text-center">
                                                    <button type="button" class="btn btn-round btn-grd-danger del-finance-btn" id="<?php echo $row['id']; ?>">Delete</button>
                                                </div>

                                                <?php 
                                                }else{
                                                    echo '<h4 class="sub-title">Error</h4>
                                                    <h3 class="text-center">Statement Not Found</h3>';
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
    <!-- Select2 -->
    <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
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

            $('.select2bs4').select2({
                theme: 'bootstrap4',
                placeholder: 'Select Option',
            });

            getItems();
            function getItems(){
                var table = $('#selection-name').find(':selected').text().toLowerCase();
                var item_id = $('#item-name').find(':selected').val() || 0;
                if (table !== 'select') {
                    $.getJSON('../assets/data/select-data.php?table='+table+'&selected='+item_id, function(data){
                        $('#item-name').empty();
                      if (data !== null) {
                        $.each(data, function(key, value){
                            $('#item-name').append(new Option(value.text, value.id, value.selected, value.selected));
                        });
                      }

                    });
                }
            }

            $('#selection-name').on('change', function() {
                getItems();
            });

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


            // Delete User
            $(document).on('click', '.del-finance-btn', function(){
              var item_id = $(this).attr("id");
              swal({
                    title: "Delete !",
                    text: "Are you sure you want to Delete Finance?",
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
                              window.location.href = 'finance-report.php';
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

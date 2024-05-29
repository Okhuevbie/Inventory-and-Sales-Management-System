<?php
session_start();
include '../redirects/includer.php';

$content = '';
if (isset($_POST['content'])) {
    $content = $_POST['content'];
}
$data = array();

if(Session::checkAPISession()){ 
if ($content == 'user_profile') {

    if(!empty($_POST['id'])){
        $uid = intval($_POST['id']);
    
        $getUser = $sl->selectOneMatchSingle('users','id',$uid);
        if ($getUser) {
            $row = $getUser->fetch_assoc();
                $data['success'] = true;
                $data['message'] = '
                        <div class="row">
                          <div class="col-7 border-r-1">
                          <strong><i class="far fa-user mr-1"></i> Name</strong>
                          <p class="text-muted">'. $row['first_name'] .' '.$row['last_name'] .' '. $row['other_name'] .'</p>
                          <hr>

                          <strong><i class="fas fa-phone mr-1"></i> Phone Number</strong>
                          <p class="text-muted">'. $row['phone'] .'</p>
                          <hr>

                          <strong><i class="far fa-envelope mr-1"></i> Email</strong>
                          <p class="text-muted">'. $row['email'] .'</p>
                          <hr>

                          <strong><i class="fa fa-sync mr-1"></i> Status</strong>
                          <p class="text-muted">'. $row['status'] .'</p>
                          <hr>

                          </div>
                          <div class="col-5 text-center">
                            <img src="../assets/images/user.png" alt="user-avatar" class="img-circle img-fluid">
                          </div>
                          <div class="col-12 text-center">
                            <a class="btn btn-grd-success btn-round pl-3 mr-2 py-1" href="edit-user.php?user='. $row['id'] .'"><i class="fa fa-pencil-alt"></i> Edit</a>
                          </div>
                        </div>
                ';
        }else{
            $msg = "User Not Found.";
            $data['success'] = false;
            $data['errors'] = $msg;

        }
    }else{
        $msg = "Invalid User Request.";
        $data['success'] = false;
        $data['errors'] = $msg;

    }

} else if ($content == 'store_profile') {

    if(!empty($_POST['id'])){
        $wid = intval($_POST['id']);
    
        $getWarehouse = $sl->selectOneMatchSingle('stores','id',$wid);
        if ($getWarehouse) {
            $row = $getWarehouse->fetch_assoc();
                $data['success'] = true;
                $data['message'] = '
                        <div class="row">
                          <div class="col-12">
                          
                              <strong><i class="fa fa-warehouse mr-1"></i> Name</strong>
                              <p class="text-muted">'. $row['name'] .'</p>
                              <hr>
                          </div>

                          <div class="col-12">
                              <strong><i class="fa fa-map-pin mr-1"></i> Address</strong>
                              <p class="text-muted">'. $row['address'] .'</p>
                              <hr>
                          </div>

                          <div class="col-md-4">
                              <strong><i class="fa fa-map-pin mr-1"></i> Country</strong>
                              <p class="text-muted">'. $row['country'] .'</p>
                              <hr>
                          </div>

                          <div class="col-md-4">
                              <strong><i class="fa fa-map-pin mr-1"></i> State</strong>
                              <p class="text-muted">'. $row['state'] .'</p>
                              <hr>
                          </div>

                          <div class="col-md-4">
                              <strong><i class="fa fa-map-pin mr-1"></i> LGA</strong>
                              <p class="text-muted">'. $row['city'] .'</p>
                              <hr>
                          </div>

                          <div class="col-12">
                          <div class="row">
                          ';

                          $getStaff = $sl->selectOneMatchTwoJoinedOrderedExcludeDeleted('users','id','user_roles','user_id','role','user_roles','store_id',$wid,'first_name','ASC');
                          if ($getStaff) {
                              while ($staffRow = $getStaff->fetch_assoc()) {
                                  
                                  $data['message'] .= '
                                    <div class="col-sm-4">
                                      <strong><i class="far fa-user mr-1"></i> Name</strong>
                                      <p class="text-muted">'. $staffRow['first_name'] .' '.$staffRow['last_name'] .' '. $staffRow['other_name'] .'</p>
                                      <hr>
                                    </div>

                                    <div class="col-sm-4">
                                      <strong><i class="fas fa-phone mr-1"></i> Phone Number</strong>
                                      <p class="text-muted">'. $staffRow['phone'] .'</p>
                                      <hr>
                                    </div>

                                    <div class="col-sm-4">
                                      <strong><i class="fas fa-phone mr-1"></i> Role</strong>
                                      <p class="text-muted">'. $staffRow['role'] .'</p>
                                      <hr>
                                    </div>
                                      ';

                              }
                          }else{
                            $data['message'] .= '

                            <div class="col-12 text-center">
                              <strong>No Staff Found or Assigned Role</strong>
                              <hr>
                            </div>
                            ';

                          }


                    $data['message'] .= '
                            </div>
                        </div>
                          <div class="col-12 text-center">
                            <a class="btn btn-grd-success btn-round pl-3 mr-2 py-1" href="edit-user.php?user='. $row['id'] .'"><i class="fa fa-pencil-alt"></i> Edit</a>
                          </div>
                        </div>
                ';
        }else{
            $msg = "No Match Found.";
            $data['success'] = false;
            $data['errors'] = $msg;

        }
    }else{
        $msg = "Invalid User Request.";
        $data['success'] = false;
        $data['errors'] = $msg;

    }
} else if ($content == 'supplier_profile') {

    if(!empty($_POST['id'])){
        $sid = intval($_POST['id']);
    
        $getSupplier = $sl->selectOneMatchSingle('suppliers','id',$sid);
        if ($getSupplier) {
            $row = $getSupplier->fetch_assoc();
                $data['success'] = true;
                $data['message'] = '
                        <div class="row">
                          <div class="col-12">
                          
                              <strong><i class="fa fa-user-plus mr-1"></i> Name</strong>
                              <p class="text-muted">'. $row['supplier_name'] .'</p>
                              <hr>
                          </div>

                          <div class="col-md-6">
                              <strong><i class="fa fa-phone mr-1"></i> Phone Number</strong>
                              <p class="text-muted">'. $row['phone'] .'</p>
                              <hr>
                          </div>

                          <div class="col-md-6">
                              <strong><i class="fa fa-envelope mr-1"></i> Email</strong>
                              <p class="text-muted">'. $row['email'] .'</p>
                              <hr>
                          </div>

                          <div class="col-12">
                              <strong><i class="fa fa-map-pin mr-1"></i> Address</strong>
                              <p class="text-muted">'. $row['address'] .'</p>
                              <hr>
                          </div>

                        </div>
                          <div class="col-12 text-center">
                            <a class="btn btn-grd-success btn-round pl-3 mr-2 py-1" href="edit-supplier.php?supplier='. $row['id'] .'"><i class="fa fa-pencil-alt"></i> Edit</a>
                          </div>
                        </div>
                ';
        }else{
            $msg = "Supplier Not Found.";
            $data['success'] = false;
            $data['errors'] = $msg;

        }
    }else{
        $msg = "Invalid Supplier Request.";
        $data['success'] = false;
        $data['errors'] = $msg;

    }

} else if ($content == 'finance_info') {

    if(!empty($_POST['id'])){
        $fid = intval($_POST['id']);
    
        $getStatement = $sl->selectOneMatchSingle('finances','id',$fid);
        if ($getStatement) {
            $row = $getStatement->fetch_assoc();
                $data['success'] = true;
                $data['message'] = '
                        <div class="row">

                          <div class="col-md-6 col-lg-4">
                              <strong>Date</strong>
                              <p class="text-muted">'. $fm->DateFormat5($row['added_date']) .'</p>
                              <hr>
                          </div>
                          
                          <div class="col-md-6 col-lg-4">
                              <strong> Category</strong>
                              <p class="text-muted">'. $row['category'] .'</p>
                              <hr>
                          </div>';

                          // if (!empty($row['table_name']) && !empty($row['item_id'])) {
                          //     $getInfo = $sl->selectOneMatchSingle($row['table_name'], 'id', $row['item_id']);
                          //     if ($getInfo) {
                          //         $value = $getInfo->fetch_assoc();
                          //         $data['message'] .= '
                          //               <div class="col-md-12">
                          //                   <strong> Associated Information</strong>
                          //                   <p class="text-muted">'. $value['product_name'] .'</p>
                          //                   <hr>
                          //               </div>
                          //         ';

                          //     }
                          // }


                $data['message'] .= '
                          <div class="col-md-12 col-lg-4">
                              <strong>Amount</strong>
                              <p class="text-muted">NGN '. $row['amount'] .'</p>
                              <hr>
                          </div>

                          <div class="col-md-12">
                              <strong>Purpose</strong>
                              <p class="text-muted">'. $row['purpose'] .'</p>
                              <hr>
                          </div>

                        </div>
                          <div class="col-12 text-center">
                            <a class="btn btn-grd-success btn-round pl-3 mr-2 py-1" href="edit-finance.php?statement='. $row['id'] .'"><i class="fa fa-pencil-alt"></i> Edit</a>
                          </div>
                        </div>
                ';
        }else{
            $msg = "Finanacial Statement Not Found.";
            $data['success'] = false;
            $data['errors'] = $msg;

        }
    }else{
        $msg = "Invalid Finanacial Statement Request.";
        $data['success'] = false;
        $data['errors'] = $msg;

    }

} else if ($content == 'edit_product_category') {

    if(!empty($_POST['id'])){
        $cid = intval($_POST['id']);
    
        $getCategory = $sl->selectOneMatchSingle('product_categories','id',$cid);
        if ($getCategory) {
            $row = $getCategory->fetch_assoc();
                $data['success'] = true;
                $data['message'] = '
                        <div class="row">
                          <div class="col-12">
                          
                              <form id="edit-category-form" class="category-form">
                                  <input type="hidden" name="action" value="edit_category">
                                  <input type="hidden" name="cid" value="'. $row['id'] .'">
                                  <h4 class="sub-title">Product Category</h4>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Category Title <span class="text-danger">*</span></label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="category" placeholder="e.g Vegetables, Seasoning and Spice" value="'. $row['title'] .'" required>
                                      </div>
                                  </div>
                                  <div class="form-group text-center">
                                      <button type="submit" class="btn btn-round btn-grd-success">Submit</button>
                                  </div>
                              </form>
                          </div>
                        </div>
                ';
        }else{
            $msg = "Category Not Found.";
            $data['success'] = false;
            $data['errors'] = $msg;

        }
    }else{
        $msg = "Invalid Category Request.";
        $data['success'] = false;
        $data['errors'] = $msg;

    }

} else if ($content == 'edit_inventory_category') {

    if(!empty($_POST['id'])){
        $cid = intval($_POST['id']);
    
        $getCategory = $sl->selectOneMatchSingle('inventory_categories','id',$cid);
        if ($getCategory) {
            $row = $getCategory->fetch_assoc();
                $data['success'] = true;
                $data['message'] = '
                        <div class="row">
                          <div class="col-12">
                          
                              <form id="edit-category-form" class="category-form" data-table="category">
                                  <input type="hidden" name="action" value="edit_category">
                                  <input type="hidden" name="cid" value="'. $row['id'] .'">
                                  <h4 class="sub-title">Inventory Category</h4>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Category Title <span class="text-danger">*</span></label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="category" placeholder="e.g Automobile, Stationary, Structures" value="'. $row['title'] .'" required>
                                      </div>
                                  </div>
                                  <div class="form-group text-center">
                                      <button type="submit" class="btn btn-round btn-grd-success">Submit</button>
                                  </div>
                              </form>
                          </div>
                        </div>
                ';
        }else{
            $msg = "Category Not Found.";
            $data['success'] = false;
            $data['errors'] = $msg;

        }
    }else{
        $msg = "Invalid Category Request.";
        $data['success'] = false;
        $data['errors'] = $msg;

    }

}elseif ($content == 'product_info') {

    if(!empty($_POST['id'])){
        $pid = intval($_POST['id']);
        if($_GET){

        }
        $getProduct = $sl->selectOneMatchSingle('products','id',$pid);
        if ($getProduct) {
            $row = $getProduct->fetch_assoc();
                $data['success'] = true;
                $val= '
                        <div class="row">
                          <div class="col-7 border-r-1">
                          <strong>Tracking ID</strong>
                          <p class="text-muted">'. $row['tracking_id'] .'</p>
                          <hr>

                          <strong>Product Name</strong>
                          <p class="text-muted">'. $row['product_name'] .'</p>
                          <hr>

                          <strong>Metric Units</strong>
                          <p class="text-muted">'. $row['metric_units'] .'</p>
                          <hr>

                          <strong>Alert Quantity</strong>
                          <p class="text-muted">'. $row['alert_quantity'] .'</p>
                          <hr>

                          <strong>Available Quantity</strong>
                          <p class="text-muted">'. $row['quantity'] .'</p>
                          <hr>

                          </div>
                          <div class="col-5 text-center">
                            <img src="../assets/images/products/'. $row['image'] .'" alt="'. $row['product_name'] .' image" class="img-round img-fluid" style="maxwidth: 240px;">
                          </div>
                          
                          <div class="col-12 text-center">
                            <a class="btn btn-grd-success btn-round pl-3 mr-2 py-1" href="edit-product.php?product='. $row['id'] .'"><i class="fa fa-pencil-alt"></i> Edit</a>
                          </div>
                        </div>
                ';
                $data['message'] =$val;
        }else{
            $msg = "Product Not Found.";
            $data['success'] = false;
            $data['errors'] = $msg;

        }
    }else{
        $msg = "Invalid Product Request.";
        $data['success'] = false;
        $data['errors'] = $msg;

    }

}elseif ($content == 'sold_product_info') {

    if(!empty($_POST['id'])){
        $pid = intval($_POST['id']);
        if($_GET){

        }
        $getProduct = $sl->selectOneMatchSingle('products','id',$pid);
        if ($getProduct) {
            $row = $getProduct->fetch_assoc();
                $data['success'] = true;

                $val= '
                        <div class="row">
                          <div class="col-7 border-r-1">
                          <strong>Tracking ID</strong>
                          <p class="text-muted">'. $row['tracking_id'] .'</p>
                          <hr>

                          <strong>Product Name</strong>
                          <p class="text-muted">'. $row['product_name'] .'</p>
                          <hr>

                          <strong>Metric Units</strong>
                          <p class="text-muted">'. $row['metric_units'] .'</p>
                          <hr>

                          </div>
                          <div class="col-5 text-center">
                            <img src="../assets/images/products/'. $row['image'] .'" alt="'. $row['product_name'] .' image" class="img-round img-fluid" style="maxwidth: 240px;">
                          </div>
                        </div>
                ';
                $data['message'] =$val;
        }else{
            $msg = "Product Not Found.";
            $data['success'] = false;
            $data['errors'] = $msg;

        }
    }else{
        $msg = "Invalid Product Request.";
        $data['success'] = false;
        $data['errors'] = $msg;

    }

} elseif ($content == 'inventory_info') {

    if(!empty($_POST['id'])){
        $in_id = intval($_POST['id']);
    
        $getItem = $sl->selectOneMatchTwoJoinedOrderedExcludeDeletedLimited('inventories','category_id','inventory_categories','id','title','inventories','id',$in_id,'id','ASC','0','1');
        if ($getItem) {
            $row = $getItem->fetch_assoc();
                $data['success'] = true;
                $data['message'] = '
                <form data-table="inventory">
                    <div class="row">
                        <div class="col-lg-4">
                            <h4 class="sub-title">Item Info</h4>
                            <strong>Item Name</strong>
                            <p class="text-muted">'. $row['item_name'] .'</p>
                            <hr>

                            <strong>Category</strong>
                            <p class="text-muted">'. $row['title'] .'</p>
                            <hr>

                            <strong>Quantity</strong>
                            <p class="text-muted">'. $row['quantity'] .'</p>
                            <hr>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <h4 class="sub-title">Edit Item</h4>
                            <input type="hidden" name="action" value="edit_inventory_info">
                            <input type="hidden" name="item_id" value="'. $row['id'] .'">
                            <div class="form-group row p-md-2">
                                <label class="col-md-3 col-form-label">Item Name <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="item_name" placeholder="Item Name" value="'. $row['item_name'] .'" required>
                                </div>
                            </div>
                            <div class="form-group row p-md-2">
                                <label class="col-md-3 col-form-label">Category <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2bs4" name="category" id="select-edit-category" required>
                                        <option value="'. $row['category_id'] .'" selected> '. $row['title'] .'</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row p-md-2">
                                <label class="col-md-3 col-form-label">Quantity <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="quantity" placeholder="e.g 10" value="'. $row['quantity'] .'" required min="1">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-round btn-grd-success">Save Changes</button>
                            </div>
                        </div>
                    </div>

                      
                ';
        }else{
            $msg = "Item Not Found.";
            $data['success'] = false;
            $data['errors'] = $msg;

        }
    }else{
        $msg = "Invalid Item Request.";
        $data['success'] = false;
        $data['errors'] = $msg;

    }

} else if ($content == 'edit_payment') {

    if(!empty($_POST['id'])){
        $pid = intval($_POST['id']);
    
        $getPayment = $sl->selectOneMatchSingle('finances','id',$pid);
        if ($getPayment) {
            $row = $getPayment->fetch_assoc();
                $data['success'] = true;
                $data['message'] = '
                        <div class="row">
                          <div class="col-12">
                          
                              <form id="edit-payment-form" class="payment-form">
                                  <input type="hidden" name="action" value="edit_payment">
                                  <input type="hidden" name="pid" value="'. $row['id'] .'">
                                  <h4 class="sub-title">Edit Payment</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Amount (NGN) <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="paid_amount" min="1" step="0.05" value="'. $row['amount'] .'" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Payment Method <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="other_payment" id="other-method" placeholder="Specify Payment Method" value="'. $row['payment_method'] .'">
                                            </div>
                                        </div>
                                    </div>
                                  <div class="form-group text-center">
                                      <button type="submit" class="btn btn-round btn-grd-success">Submit</button>
                                  </div>
                              </form>
                          </div>
                        </div>
                ';
        }else{
            $msg = "Payment Not Found.";
            $data['success'] = false;
            $data['errors'] = $msg;

        }
    }else{
        $msg = "Invalid Payment Request.";
        $data['success'] = false;
        $data['errors'] = $msg;

    }

} else if ($content == 'edit_item_history') {

    if(!empty($_POST['id'])){
        $hid = intval($_POST['id']);
    
        $getHistory = $sl->selectOneMatchTwoJoinedOrderedExcludeDeletedLimited('inventory_history','item_id','inventories','id','quantity','inventory_history','id',$hid,'id','ASC','0','1');
        // $sl->selectOneMatchThreeJoinedOrderedExcludeDeletedLimited('inventory_history', '*', 'item_id', 'warehouse_id', 'inventories', 'id', 'quantity', 'stores', 'id', 'name', 'inventory_history', 'id', $hid, 'id', 'ASC', '0', '1');
        if ($getHistory) {
            $row = $getHistory->fetch_assoc();
                $data['success'] = true;
                $data['message'] = '
                        <div class="row">
                          <div class="col-12">
                          
                              <form id="edit-history-form" class="history-form">
                                  <input type="hidden" name="action" value="retrieve_item">
                                  <input type="hidden" name="hid" value="'. $row['id'] .'">
                                  <h4 class="sub-title">Update Item History</h4>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Warehouse <span class="text-danger">*</span></label>
                                      <div class="col-sm-10">
                                          <select class="form-control select2bs4" name="warehouse" id="select-edit-warehouse" required>
                                            <option value="'. $row['warehouse_id'] .'" selected> Warehouse</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Date Taken <span class="text-danger">*</span></label>
                                      <div class="col-sm-10">
                                          <input type="date" class="form-control" name="date_taken" value="'. $row['date_taken'] .'" required>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Quantity Taken<span class="text-danger">*</span></label>
                                      <div class="col-sm-10">
                                          <input type="number" class="form-control" name="quantity_taken" value="'. $row['quantity_taken'] .'" min="1" max="'. $row['quantity'] .'" required>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Date Returned</label>
                                      <div class="col-sm-10">
                                          <input type="date" class="form-control" name="date_returned" value="'. $row['date_returned'] .'">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Quantity Returned</label>
                                      <div class="col-sm-10">
                                          <input type="number" class="form-control" name="quantity_returned" value="'. $row['quantity_returned'] .'" min="0" max="'. $row['quantity'] .'">
                                      </div>
                                  </div>
                                  <div class="form-group text-center">
                                      <button type="submit" class="btn btn-round btn-grd-success">Submit</button>
                                  </div>
                              </form>
                          </div>
                        </div>
                ';
        }else{
            $msg = "Category Not Found.";
            $data['success'] = false;
            $data['errors'] = $msg;

        }
    }else{
        $msg = "Invalid Category Request.";
        $data['success'] = false;
        $data['errors'] = $msg;

    }

}
}
if (empty($data)) {
    $data['success'] = false;
    $data['errors'] = 'Invalid Request';
}

echo json_encode($data);
?>
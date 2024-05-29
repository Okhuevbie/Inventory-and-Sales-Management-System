<?php
session_start();
include '../redirects/includer.php';
 
$data = array();

$table = '';
if (isset($_GET['table'])) {
    $table = $_GET['table'];
}

if(Session::checkAPISession()){

if ($table == 'user') {
    $getUsers = $sl->selectAllWithOrder('users','first_name','ASC');
    if ($getUsers) {
        $i = 0;
        while ($row = $getUsers->fetch_assoc()) {

            $active_status = array('Active' => 'success', 'Disabled' => 'danger');
            $data[$i] = array(
                    "sn"   => $i+1,
                    "name"   => $row['first_name']." ". $row['last_name'] ." ". $row['other_name'],
                    "phone"  => $row['phone'],
                    "status" => "<label class='label label-lg label-". $active_status[$row['status']] ."'>". $row['status'] ."</label>",
                    "action" => "<button class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1 view-user' data-user='". $row['id'] ."' title='View'><i class='fa fa-eye'></i></button>
                                <a class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1' href='edit-user.php?user=". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></a>
                                <button class='btn btn-outline-danger btn-sm btn-round del-user-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }

}elseif ($table == 'warehouse'){
    $getWarehouses = $sl->selectAllWithOrder('stores','name','ASC');
    if ($getWarehouses) {
        $i = 0;
        while ($row = $getWarehouses->fetch_assoc()) {

            $data[$i] = array();

            $getManager = $sl->selectTwoMatchTwoJoinedOrderedExcludeDeletedLimited('users','id','user_roles','user_id','user_id','user_roles','store_id',$row['id'],'user_roles','role','2','added_date','ASC','0','1');
            if($getManager){
                $mgrRow = $getManager->fetch_assoc();
                $data[$i]["manager"] = $mgrRow['first_name']." ". $mgrRow['last_name'] ." ". $mgrRow['other_name'];
                $data[$i]["phone"]   = $mgrRow['phone'];
        
            }else{
                $data[$i]["manager"] = "Not Set";
                $data[$i]["phone"]   = "Not Found";
                
            }

            $data[$i]["sn"]      = $i+1;
            $data[$i]["name"]    = $row['name'];
            $data[$i]["address"] = $row['address'];
            $data[$i]["state"]   = $row['state'];
            $data[$i]["action"]  = "
                    <button class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1 view-store' data-store='". $row['id'] ."' title='View'><i class='fa fa-eye'></i></button>
                    <a class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1' href='edit-store.php?store=". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></a>

                    <a class='btn btn-outline-secondary btn-sm btn-round pl-3 mr-2 py-1' href='warehouse-history.php?warehouse=". $row['id'] ."' title='Warehouse History'><i class='fa fa-history'></i></a>
                    <button class='btn btn-outline-danger btn-sm btn-round del-store-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>";
                    // <a class='btn btn-outline-info btn-sm btn-round pl-3 mr-2 py-1' href='../choose-account.php?store=". $row['id'] ."' title='Switch to'><i class='fa fa-toggle-on'></i></a>
            $i++;
        }
    }
}elseif ($table == 'role'){
    $getRoles = $sl->selectTwoJoinedOrderedExcludeDeleted('user_roles','user_id','users','id','first_name`,`users`.`last_name`,`users`.`other_name','store_id','ASC');
    if ($getRoles) {
        $i = 0;
        while ($row = $getRoles->fetch_assoc()) {
            $store_id = $row['store_id'];

            if ($store_id == 0) {
                $store = "Central Warehouse";
            }else{
                $getStore = $sl->selectOneMatchSingle('stores','id',$store_id);
                if($getStore){
                    $value = $getStore->fetch_assoc();

                    $store = $value['name'];
            
                }else{
                    $store = 'Unassigned';
                    
                }
            }

                $data[$i] = array();
                $data[$i]["sn"]      = $i+1;
                $data[$i]["store"]   = $store;
                $data[$i]["user"]    = $row['first_name']." ". $row['last_name'] ." ". $row['other_name'];
                $data[$i]["role"]    = $roleArray[$row['role']];
                $data[$i]["action"]  = "
                        <button class='btn btn-outline-danger btn-sm btn-round del-role-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>";
                        // <button class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1 view-role' data-store='". $row['id'] ."' title='View'><i class='fa fa-eye'></i></button>
            $i++;
        }
    }
}elseif ($table == 'supplier'){
    $getSuppliers = $sl->selectAllWithOrder('suppliers','supplier_name','ASC');
    if ($getSuppliers) {
        $i = 0;
        while ($row = $getSuppliers->fetch_assoc()) {

            $data[$i] = array(
                    "sn"   => $i+1,
                    "name"   => $row['supplier_name'],
                    "phone"  => $row['phone'],
                    "action" => "<button class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1 view-supplier' data-supplier='". $row['id'] ."' title='View'><i class='fa fa-eye'></i></button>
                                <a class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1' href='edit-supplier.php?supplier=". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></a>
                                <button class='btn btn-outline-danger btn-sm btn-round del-supplier-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'product_category'){
    $getCategories = $sl->selectAllWithOrder('product_categories','id','DESC');
    if ($getCategories) {
        $i = 0;
        while ($row = $getCategories->fetch_assoc()) {

            $data[$i] = array(
                    "sn"   => $i+1,
                    "title"   => $row['title'],
                    "action" => "<button class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1 edit-category' data-category='". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></button>
                                <button class='btn btn-outline-danger btn-sm btn-round del-category-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'inventory_category'){
    $getCategories = $sl->selectAllWithOrder('inventory_categories','title','ASC');
    if ($getCategories) {
        $i = 0;
        while ($row = $getCategories->fetch_assoc()) {

            $data[$i] = array(
                    "sn"   => $i+1,
                    "title"   => $row['title'],
                    "action" => "<button class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1 edit-category' data-category='". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></button>
                                <button class='btn btn-outline-danger btn-sm btn-round del-category-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'product'){
    $getProducts = $sl->selectAllWithOrder('products','id','DESC');
    if ($getProducts) {
        $i = 0;
        while ($row = $getProducts->fetch_assoc()) {

            $available = intval($ct->sumAvailableProducts($row['id']));
            if ($available <= $row['alert_quantity']) {
                $available = '<a class="mytooltip text-danger" href="javascript:void(0)"> '. $available .' <i class="fa fa-exclamation-triangle"></i><span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2">Below '. $row['alert_quantity'] .' alert quantity</span></span></span></a>';
            }

            $data[$i] = array(
                    "sn"        => $i+1,
                    "track_id"  => $row['product_code'],
                    "name"      => $row['product_name'],
                    "quantity"  => $available,
                    "action"    => "<button class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1 view-product' data-product='". $row['id'] ."' title='View'><i class='fa fa-eye'></i></button>
                                <a class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1' href='edit-product.php?product=". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></a>
                                <a class='btn btn-outline-secondary btn-sm btn-round pl-3 mr-2 py-1' href='product-history.php?product=". $row['id'] ."' title='Product History'><i class='fa fa-history'></i></a>
                                <button class='btn btn-outline-danger btn-sm btn-round del-product-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
    
    // <a class='btn btn-outline-warning btn-sm btn-round pl-3 mr-2 py-1' href='incoming-product.php?product=". $row['id'] ."' title='Restock'><i class='fa fa-plus-square'></i></a>
}elseif ($table == 'activity'){
    $getActivity = $sl->selectActivities();
    if ($getActivity) {
        $i = 0;
        while ($row = $getActivity->fetch_assoc()) {

            $data[$i] = array(
                    "sn"        => $i+1,
                    "user"      => $row['user'],
                    "activity"  => $row['activity'],
                    "date"      => $fm->DateFormat5($row['time'])
                );
            $i++;
        }
    }
}elseif ($table == 'inventory'){
    $getInventory = $sl->selectTwoJoinedOrderedExcludeDeleted('inventories','category_id','inventory_categories','id','title','title','ASC');
    if ($getInventory) {
        $i = 0;
        while ($row = $getInventory->fetch_assoc()) {

            $data[$i] = array(
                    "sn"        => $i+1,
                    "category"  => $row['title'],
                    "name"      => $row['item_name'],
                    "quantity"  => number_format($row['quantity']),
                    "action"    => "
                                <button class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1 view-inventory' data-inventory='". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></button>
                                <a class='btn btn-outline-secondary btn-sm btn-round pl-3 mr-2 py-1' href='inventory-history.php?item=". $row['id'] ."' title='Item History'><i class='fa fa-history'></i></a>
                                <button class='btn btn-outline-danger btn-sm btn-round del-inventory-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'finance_income'){
    $getIncome = $sl->selectOneMatchWithOrder('finances','category','Income','added_date','DESC');
    if ($getIncome) {
        $i = 0;
        while ($row = $getIncome->fetch_assoc()) {

            $data[$i] = array(
                    "sn"        => $i+1,
                    "date"      => $fm->DateFormat7($row['added_date']),
                    "purpose"   => $row['purpose'],
                    "amount"    => '<div class="text-right">'. number_format($row['amount'], 2) .'</div>',
                    "action"    => "<button class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1 view-finance' data-finance='". $row['id'] ."' title='View'><i class='fa fa-eye'></i></button>
                                <a class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1' href='edit-finance.php?statement=". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></a>
                                <button class='btn btn-outline-danger btn-sm btn-round del-finance-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'finance_expense'){
    $getExpenses = $sl->selectOneMatchWithOrder('finances','category','Expense','added_date','DESC');
    if ($getExpenses) {
        $i = 0;
        while ($row = $getExpenses->fetch_assoc()) {

            $data[$i] = array(
                    "sn"        => $i+1,
                    "date"      => $fm->DateFormat7($row['added_date']),
                    "purpose"   => $row['purpose'],
                    "amount"    => '<div class="text-right">'. number_format($row['amount'], 2) .'</div>',
                    "action"    => "<button class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1 view-finance' data-finance='". $row['id'] ."' title='View'><i class='fa fa-eye'></i></button>
                                <a class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1' href='edit-finance.php?statement=". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></a>
                                <button class='btn btn-outline-danger btn-sm btn-round del-finance-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'finance_statement'){
    $category = $_GET['category'];
    $from = $_GET['start'];
    $to = $_GET['end'];

    $getStatement = $sl->selectMatchOneAndBetweenWithOrder('finances','added_date',$from,$to,'category',$category,'added_date','DESC');
    if ($getStatement) {
        $i = 0;
        while ($row = $getStatement->fetch_assoc()) {

            $data[$i] = array(
                    "sn"        => $i+1,
                    "date"      => $fm->DateFormat7($row['added_date']),
                    "purpose"   => $row['purpose'],
                    "amount"    => '<div class="text-right">'. number_format($row['amount'], 2) .'</div>',
                    "action"    => "<button class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1 view-finance' data-finance='". $row['id'] ."' title='View'><i class='fa fa-eye'></i></button>
                                <a class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1' href='edit-finance.php?statement=". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></a>
                                <button class='btn btn-outline-danger btn-sm btn-round del-finance-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'order'){

    // $getOrders = $sl->selectTwoJoinedOrderedExcludeDeleted('orders','id','suppliers','order_id','product_price_id','id','DESC');
    $getOrders = $sl->selectAllWithOrder('orders','id','DESC');
    if ($getOrders) {
        $i = 0;
        while ($row = $getOrders->fetch_assoc()) {
            $order_id = $row['id'];
            // $value = $row['product_price_id'];
            $customer = $row['supplier_id'];
            // $items = $ct->countWhereExcludingDeleted('order_items','order_id',$order_id);
            // $product_name = $sl->getName('products','product_name','id',$value);
            $customer_name = $sl->getName('suppliers','supplier_name','id',$customer);
            $total = $row['total'];
            $paid = $ct->sumTwoMatchExcludingDeleted('finances','amount','table_name','orders','item_id',$order_id);
            // $paid = $sl->selectOneFieldWithTwoMach('finances','amount','item_id',$order_id,'table_name','orders');
            // // sumWhereExcludingDeleted('order_payments','amount','order_id',$order_id);
            // $paid = $paid->fetch_assoc();
            // $paid = $paid['sum'];
            
                $balance = $total - $paid;
            
           

            $data[$i] = array(
                    "sn"         => $i+1,
                    "invoice_no" => $row['invoice_id'],
                    "date"       => $fm->DateFormat7($row['added_date']),
                    "customer"   => $customer_name,
                    "total"      => '<div class="text-right">'. number_format($total, 2) .'</div>',
                    "paid"       => '<div class="text-right">'. number_format($paid, 2) .'</div>',
                    "balance"    => '<div class="text-right">'. number_format($balance, 2) .'</div>',
                    "status" => $row['status'],
                    "action"     => "<a class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1' href='view-order.php?order=". $order_id ."' title='View'><i class='fa fa-eye'></i></a>"
                );

            $i++;
        }
    }
}elseif ($table == 'order_items'){
    $order = $_GET['order'];

    $getItems = $sl->selectOneMatchTwoJoinedOrderedExcludeDeleted('order_items', 'product_price_id', 'products', 'id', 'product_name', 'order_items', 'order_id', $order, 'id', 'ASC');
    if ($getItems) {
        $i = 0;
        while ($row = $getItems->fetch_assoc()) {

            $data[$i] = array(
                    "sn"       => $i+1,
                    "name"     => $row['product_name'],
                    "price"    => number_format($row['unit_price'], 2),
                    "quantity" => $row['quantity'],
                    "subtotal" => number_format($row['subtotal'], 2),
                    "action"    => "<button class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1 view-product' data-product='". $row['id'] ."' title='View'><i class='fa fa-eye'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'order_payment'){
    $order = $_GET['order'];

    $getPayments = $sl->selectTwoMatchWithOrder('finances','table_name','orders','item_id',$order,'id','DESC');
    if ($getPayments) {
        $i = 0;
        while ($row = $getPayments->fetch_assoc()) {

            $data[$i] = array(
                    "sn"        => $i+1,
                    "date"      => $fm->DateFormat7($row['added_date']),
                    "category"  => $row['category'],
                    "amount"    => number_format($row['amount'], 2),
                    "method"    => $row['payment_method'],
                    "action"    => "
                                <button class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1 edit-payment' data-payment='". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></button>
                                <button class='btn btn-outline-danger btn-sm btn-round del-payment-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'supply_payment'){
    $supply = $_GET['supply'];

    $getPayments = $sl->selectTwoMatchWithOrder('finances', 'table_name', 'incoming_products', 'item_id', $supply, 'id', 'DESC');;
    if ($getPayments) {
        $i = 0;
        while ($row = $getPayments->fetch_assoc()) {

            $data[$i] = array(
                    "sn"        => $i+1,
                    "date"      => $fm->DateFormat7($row['added_date']),
                    "category"  => $row['category'],
                    "amount"    => number_format($row['amount'], 2),
                    "method"    => $row['payment_method'],
                    "action"    => "
                                <button class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1 edit-payment' data-payment='". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></button>
                                <button class='btn btn-outline-danger btn-sm btn-round del-payment-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'product_supply'){
    $product = $_GET['product'];

    $getSupply = $sl->selectOneMatchTwoJoinedOrderedExcludeDeleted('incoming_products','supplier_id','suppliers','id','supplier_name','incoming_products','product_id',$product,'id','DESC');
    if ($getSupply) {
        $i = 0;
        while ($row = $getSupply->fetch_assoc()) {
            $paid = floatval($ct->sumMatchThreeExcludingDeleted('finances', 'amount', 'table_name', 'incoming_products', 'item_id', $row['id'], 'category', 'Expense'));

            if (isset($row['expiry_date']) && $row['expiry_date'] != '0000-00-00') {
                $date = $fm->DateFormat7($row['expiry_date']);
            }else{
                $date = '';
            }

            $data[$i] = array(
                    "sn"        => $i+1,
                    "supplier"  => $row['supplier_name'],
                    "date"      => $date,
                    "available" => $row['available_quantity'],
                    "supplied"  => $row['supplied_quantity'],
                    "total"     => number_format($row['total_price'], 2),
                    "paid"      => number_format($paid, 2),
                    "balance"   => number_format($row['total_price'] - $paid, 2),
                    "action"    => "<a class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1 view-payment' href='view-supply.php?supply=". $row['id'] ."' title='View'><i class='fa fa-eye'></i></a>"
                );
            $i++;
        }
    }
}elseif ($table == 'product_order'){
    $product = $_GET['product'];

    // $getProductOrders = $sl->selectOneMatchThreeJoinedOrderedExcludeDeleted('order_items', '*', 'order_id', 'product_price_id', 'orders', 'id', 'invoice_id, `orders`.warehouse_id', 'incoming_products', 'id', 'unit_price AS `supplied_unit_price`', 'incoming_products', 'product_id', $product, 'id', 'DESC');
    $getProductOrders = $sl->selectOneMatchTwoJoinedOrderedExcludeDeleted('order_items','order_id', 'orders', 'id', 'invoice_id','order_items','product_price_id', $product, 'id', 'DESC');
    if ($getProductOrders) {
        $i = 0;
        while ($row = $getProductOrders->fetch_assoc()) {

            $suplier_id = $sl->getName('orders','supplier_id','id',$row['order_id']);
            $suplier_name = $sl->getName('suppliers','supplier_name','id',$suplier_id);
            
            $data[$i] = array(
                    "sn"        => $i+1,
                    "date"      => $fm->DateFormat7($row['added_date']),
                    "customer" => $suplier_name,
                    "order"     => $row['invoice_id'],
                    "sold_unit_price"      => number_format($row['unit_price'], 2),
                    "quantity"  => $row['quantity'],
                    "total"     => number_format($row['subtotal'], 2)
                );
            $i++;
        }
    }
}elseif ($table == 'product_update'){
    $product = $_GET['product'];

    // $getProductOrders = $sl->selectOneMatchThreeJoinedOrderedExcludeDeleted('order_items', '*', 'order_id', 'product_price_id', 'orders', 'id', 'invoice_id, `orders`.warehouse_id', 'incoming_products', 'id', 'unit_price AS `supplied_unit_price`', 'incoming_products', 'product_id', $product, 'id', 'DESC');
    $getProductUpdate = $sl->selectOneMatchWithOrder('product_update','product_id',$product,'id','DESC');
    if ($getProductUpdate) {
        $i = 0;
        while ($row = $getProductUpdate->fetch_assoc()) {

            // $suplier_id = $sl->getName('orders','supplier_id','id',$row['order_id']);
            // $suplier_name = $sl->getName('suppliers','supplier_name','id',$suplier_id);
            
            $data[$i] = array(
                    "sn"        => $i+1,
                    "user"      => $row['user_id'],
                    "purpose"   => $row['purpose'],
                    "quantity"  => $row['quantity'],
                    "date"      => $fm->DateFormat7($row['updated_date'])
                );
            $i++;
        }
    }
}elseif ($table == 'warehouse_order'){
    $warehouse = $_GET['warehouse'];

    $getOrders = $sl->selectOneMatchWithOrder('orders','warehouse_id',$warehouse,'id','DESC');
    if ($getOrders) {
        $i = 0;
        while ($row = $getOrders->fetch_assoc()) {
            $order_id = $row['id'];
            $items = $ct->countWhereExcludingDeleted('order_items','order_id',$order_id);
            $total = $row['total'];
            $paid = $ct->sumTwoMatchExcludingDeleted('finances','amount','table_name','orders','item_id',$order_id);
            // sumWhereExcludingDeleted('order_payments','amount','order_id',$order_id);
            $balance = $total - $paid;

            $data[$i] = array(
                    "sn"         => $i+1,
                    "invoice_no" => $row['invoice_id'],
                    "date"       => $fm->DateFormat7($row['added_date']),
                    "items"      => $items,
                    "total"      => number_format($total, 2),
                    "paid"       => number_format($paid, 2),
                    "balance"    => number_format($balance, 2),
                    "status" => $row['status'],
                    "action"     => "<a class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1' href='view-order.php?order=". $order_id ."' title='View'><i class='fa fa-eye'></i></a>"
                );

            $i++;
        }
    }
}elseif ($table == 'warehouse_payment'){
    $warehouse = $_GET['warehouse'];

    $getPayment = $sl->selectTwoMatchTwoJoinedOrderedExcludeDeleted('finances','item_id','orders','id','invoice_id','finances','table_name','orders','orders','warehouse_id',$warehouse,'id','DESC');
    if ($getPayment) {
        $i = 0;
        while ($row = $getPayment->fetch_assoc()) {
            
            $data[$i] = array(
                    "sn"        => $i+1,
                    "date"      => $fm->DateFormat7($row['added_date']),
                    "order_no"  => $row['invoice_id'],
                    "amount"    => number_format($row['amount'], 2),
                    "method"    => $row['payment_method'],
                    "action"    => "
                                <button class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1 edit-payment' data-payment='". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></button>
                                <button class='btn btn-outline-danger btn-sm btn-round del-payment-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'inventory_item'){
    $item = $_GET['item'];

    $getItemHistory = $sl->selectOneMatchTwoJoinedOrderedExcludeDeleted('inventory_history','warehouse_id','stores','id','name','inventory_history','item_id',$item,'id','DESC');
    if ($getItemHistory) {
        $i = 0;
        while ($row = $getItemHistory->fetch_assoc()) {
            if (isset($row['date_returned']) && $row['date_returned'] != '0000-00-00') {
                $date_returned = $fm->DateFormat7($row['date_returned']);
            }else{
                $date_returned = '-';
            }

            $data[$i] = array(
                    "sn"                => $i+1,
                    "warehouse"         => $row['name'],
                    "date_taken"        => $fm->DateFormat7($row['date_taken']),
                    "quantity_taken"    => number_format($row['quantity_taken']),
                    "date_returned"     => $date_returned,
                    "quantity_returned" => number_format($row['quantity_returned']),
                    "action"            => "
                                <button class='btn btn-outline-primary btn-sm btn-round pl-3 mr-2 py-1 edit-history' data-history='". $row['id'] ."' title='Edit'><i class='fa fa-pencil-alt'></i></button>
                                <button class='btn btn-outline-danger btn-sm btn-round del-history-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'request'){

    $getRequests = $sl->selectTwoJoinedOrderedExcludeDeleted('requests','warehouse_id','stores','id','name','id','DESC');
    if ($getRequests) {
        $i = 0;
        while ($row = $getRequests->fetch_assoc()) {

            $data[$i] = array(
                    "sn"            => $i+1,
                    "date"          => $fm->DateFormat7($row['added_date']),
                    "warehouse"     => $row['name'],
                    "category"      => $row['category'],
                    "description"   => $fm->limit_words($row['description'], 10) .'...',
                    "status"        => $row['status'],
                    "action"        => "
                                <a class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1' href='view-request.php?request=". $row['id'] ."' title='View'><i class='fa fa-eye'></i></a>
                                <button class='btn btn-outline-danger btn-sm btn-round del-request-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}elseif ($table == 'returned_order'){

    $getRequests = $sl->selectAllWithOrder('returned_orders','id','DESC');
    if ($getRequests) {
        $i = 0;
        while ($row = $getRequests->fetch_assoc()) {

            $item_id = $sl->getName('order_items','product_price_id','id',$row['item_id']);
            $item_id = $sl->getName('incoming_products','product_id','id',$item_id);
            $item_name = $sl->getName('products','product_name','id',$item_id);

            $data[$i] = array(
                    "sn"       => $i+1,
                    "date"     => $fm->DateFormat7($row['added_date']),
                    "item"     => $item_name,
                    "quantity" => number_format($row['quantity']),
                    "total"    => number_format($row['total']),
                    "status"   => $row['status'],
                    "action"   => "
                                <a class='btn btn-outline-success btn-sm btn-round pl-3 mr-2 py-1' href='view-returned-order.php?order=". $row['id'] ."' title='View'><i class='fa fa-eye'></i></a>
                                <button class='btn btn-outline-danger btn-sm btn-round del-returned-btn pl-3 mr-2 py-1' id='". $row['id'] ."' title='Delete'><i class='fa fa-trash'></i></button>"
                );
            $i++;
        }
    }
}
}
$results = ["sEcho" => 1,
  "iTotalRecords" => count($data),
  "iTotalDisplayRecords" => count($data),
  "aaData" => $data ];

echo json_encode($results);
?>
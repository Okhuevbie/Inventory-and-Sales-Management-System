<?php
session_start();
include '../redirects/includer.php';

$table = '';
if (isset($_GET['table'])) {
    $table = $_GET['table'];
}

$current_id = '';
if (isset($_GET['selected'])) {
    $current_id = $_GET['selected'];
}

$data = array();

if(Session::checkAPISession()){
if ($table == 'user') {
    $getUsers = $sl->selectAllExcludeDeleted('users');
    if ($getUsers) {
        while ($row = $getUsers->fetch_assoc()) {
            if ($current_id == $row['id']) {
                $selected = true;
            }else{
                $selected = false;
            }
            $data[] = array(
                    "id"   => $row['id'],
                    "text" => $row['first_name']." ". $row['last_name'] ." ". $row['other_name'],
                    "selected" => $selected
                );
        }
    }

}else if ($table == 'warehouse') {
    $getStores = $sl->selectAllExcludeDeleted('stores');
    if ($getStores) {
        while ($row = $getStores->fetch_assoc()) {
            if ($current_id == $row['id']) {
                $selected = true;
            }else{
                $selected = false;
            }
            $data[] = array(
                    "id"   => $row['id'],
                    "text" => $row['name'],
                    "selected" => $selected
                );
        }
    }

// }else if ($table == 'customer') {
//     $getStores = $sl->selectAllExcludeDeleted('suppliers');
//     if ($getStores) {
//         while ($row = $getStores->fetch_assoc()) {
//             if ($current_id == $row['id']) {
//                 $selected = true;
//             }else{
//                 $selected = false;
//             }
//             $data[] = array(
//                     "id"   => $row['id'],
//                     "text" => $row['supplier_name'],
//                     "selected" => $selected
//                 ); 
//         }
//     }

}else if ($table == 'supplier') {
    $getsupplier = $sl->selectAllExcludeDeleted('suppliers');
    if ($getsupplier) {
        while ($rows = $getsupplier->fetch_assoc()) {
            if ($current_id == $rows['id']) {
                $selected = true;
            }else{
                $selected = false;
            } 
            $data[] = array(
                    "id"   => $rows['id'],
                    "text" => $rows['supplier_name'],
                    "selected" => $selected
                );
        }
    }

}else if ($table == 'product_category') {
    $getCategories = $sl->selectAllExcludeDeleted('product_categories');
    if ($getCategories) {
        while ($row = $getCategories->fetch_assoc()) {
            if ($current_id == $row['id']) {
                $selected = true;
            }else{
                $selected = false;
            }
            $data[] = array(
                    "id"   => $row['id'],
                    "text" => $row['title'],
                    "selected" => $selected
                );
        }
    }

}else if ($table == 'inventory_category') {
    $getCategories = $sl->selectAllExcludeDeleted('inventory_categories');
    if ($getCategories) {
        while ($row = $getCategories->fetch_assoc()) {
            if ($current_id == $row['id']) {
                $selected = true;
            }else{
                $selected = false;
            }
            $data[] = array(
                    "id"   => $row['id'],
                    "text" => $row['title'],
                    "selected" => $selected
                );
        }
    }

}else if ($table == 'product') {
    $getProducts = $sl->selectAllExcludeDeleted('products');
    if ($getProducts) {
        while ($row = $getProducts->fetch_assoc()) {
            if ($current_id == $row['id']) {
                $selected = true;
            }else{
                $selected = false;
            }
            $data[] = array(
                    "id"   => $row['id'],
                    "text" => $row['product_name'],
                    "quantity" => $row['quantity'],
                    "price" => $row['unit_price'],
                    "image" => $row['image'],
                    "selected" => $selected
                );
        }
    }

}else if ($table == 'inventory') {
    $getProducts = $sl->selectAllExcludeDeleted('inventories');
    if ($getProducts) {
        while ($row = $getProducts->fetch_assoc()) {
            if ($current_id == $row['id']) {
                $selected = true;
            }else{
                $selected = false;
            }
            $data[] = array(
                    "id"   => $row['id'],
                    "text" => $row['item_name'],
                    "selected" => $selected
                );
        }
    }

}else if ($table == 'order') {
    $getOrders = $sl->selectAllExcludeDeleted('orders');
    if ($getOrders) {
        while ($row = $getOrders->fetch_assoc()) {
            if ($current_id == $row['id']) {
                $selected = true;
            }else{
                $selected = false;
            }
            $data[] = array(
                    "id"   => $row['id'],
                    "text" => $row['invoice_id'],
                    "selected" => $selected
                );
        }
    }

}else if ($table == 'restock') {
    $getSupply = $sl->selectAllExcludeDeleted('incoming_products');
    if ($getSupply) {
        while ($row = $getSupply->fetch_assoc()) {
            if ($current_id == $row['id']) {
                $selected = true;
            }else{
                $selected = false;
            }
            $data[] = array(
                    "id"   => $row['id'],
                    "text" => $row['supply_id'],
                    "selected" => $selected
                );
        }
    }

}else if ($table == 'inventory') {
    $getInventory = $sl->selectAllExcludeDeleted('inventories');
    if ($getInventory) {
        while ($row = $getInventory->fetch_assoc()) {
            if ($current_id == $row['id']) {
                $selected = true;
            }else{
                $selected = false;
            }
            $data[] = array(
                    "id"   => $row['id'],
                    "text" => $row['item_name'],
                    "selected" => $selected
                );
        }
    }

}else if ($table == 'finance_statement') {
    $start_date = $_GET['startDate'];
    $end_date = $_GET['endDate'];

    $getDates = $sl->selectDistinctBetweenWithOrder('finances','added_date','added_date',$start_date,$end_date,'added_date','ASC');
    $data['totalIncome'] = $data['totalExpense'] = $data['balance'] = 0.00;
    if ($getDates) {
        $dateArray = array();
        while ($row = $getDates->fetch_assoc()) {
            $row_date = $fm->DateFormat1($row['added_date']);
            $dateArray[$row_date] = array('income' => 0.00, "expense" => 0.00);
        }

        $getStatements = $sl->selectAllBetweenWithOrder('finances','added_date',$start_date,$end_date,'added_date','ASC');
        if ($getStatements) {
            $data['status'] = true;
            $data['values'] = array();
            while ($stmt_row = $getStatements->fetch_assoc()) {
                $stmt_date = $fm->DateFormat1($stmt_row['added_date']);
                if ($stmt_row['category'] == 'Income') {
                    $dateArray[$stmt_date]['income'] += floatval($stmt_row['amount']);
                }else if ($stmt_row['category'] == 'Expense') {
                    $dateArray[$stmt_date]['expense'] += floatval($stmt_row['amount']);
                }
                
            }

            foreach ($dateArray as $key => $value) {
                $data['values'][] = array(
                    "date" => $key,
                    "income" => $value['income'],
                    "expense" => $value['expense']
                );
                $data['totalIncome'] += floatval($value['income']);
                $data['totalExpense'] += floatval($value['expense']);
            }
            $data['balance'] = floatval($data['totalIncome'] - $data['totalExpense']);
        }

    }else{
        $data['status'] = false;
        $data['errors'] = "No Record Found";
    }

}else if ($table == 'all_finance_statement') {
    $getDates = $sl->selectDistinctWithOrder('finances','added_date','added_date','ASC');
    $data['totalIncome'] = $data['totalExpense'] = $data['balance'] = 0.00;
    if ($getDates) {
        $dateArray = array();
        while ($row = $getDates->fetch_assoc()) {
            $row_date = $fm->DateFormat10($row['added_date']);
            $dateArray[$row_date] = array('income' => 0.00, "expense" => 0.00);
        }

        $getStatements = $sl->selectAllExcludeDeleted('finances');
        if ($getStatements) {
            $data['status'] = true;
            $data['values'] = array();
            while ($stmt_row = $getStatements->fetch_assoc()) {
                $stmt_date = $fm->DateFormat10($stmt_row['added_date']);
                if ($stmt_row['category'] == 'Income') {
                    $dateArray[$stmt_date]['income'] += floatval($stmt_row['amount']);
                }else if ($stmt_row['category'] == 'Expense') {
                    $dateArray[$stmt_date]['expense'] += floatval($stmt_row['amount']);
                }
                
            }

            foreach ($dateArray as $key => $value) {
                $data['values'][] = array(
                    "date" => $key,
                    "income" => $value['income'],
                    "expense" => $value['expense']
                );
                $data['totalIncome'] += floatval($value['income']);
                $data['totalExpense'] += floatval($value['expense']);
            }
            // $data['balance'] = floatval($data['totalIncome'] - $data['totalExpense']);
        }

    }else{
        $data['status'] = false;
        $data['errors'] = "No Record Found";
    }

}else if ($table == 'available_product_quantity') {
    $product = intval($_GET['curr_product']);
    $getProducts = $sl->selectOneMatchSingle('products','id',$product);
    if ($getProducts) {
        $row = $getProducts->fetch_assoc();
        $data['quantity'] = $row['quantity'];
        $data['price'] = $row['unit_price'];
        $data['id'] = $row['id'];
        
    }

}

}

echo json_encode($data);
?>
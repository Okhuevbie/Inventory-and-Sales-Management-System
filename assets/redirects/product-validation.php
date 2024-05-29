<?php
  session_start();
  include 'includer.php';  
  
  $data    = array();

    if(($_SERVER['REQUEST_METHOD']=='POST')){
       

        if ($_POST['action'] == 'add_category') {
    
            $msg = $up->insertProductCategory($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Category added Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }

        }elseif ($_POST['action'] == 'edit_category') {
            $msg = $ud->updateProductCategory($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Category updated Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'add_product') {
            $msg = $up->insertProduct($_POST, $_FILES);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Product added Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'edit_product_info') {
            $msg = $ud->updateProductInfo($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Product updated Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'change_product_image') {
            $msg = $ud->updateProductImage($_POST, $_FILES);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Product updated Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'restock_product') {
            $msg = $up->restockProduct($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Product restocked Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'add_supply_payment') {
            $msg = $up->insertSupplyPayment($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Payment added Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'edit_payment') {
            $msg = $ud->updateSupplyPayment($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Payment updated Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'add_damaged_items') {
            $msg = $ud->updateDamagedQuantity($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Product updated Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }else{
            $msg = "An Error Occured";

            $data['success'] = false;
            $data['errors']  = $msg;
        }
    
    }else{
        $msg = "An Error Occured";

        $data['success'] = false;
        $data['errors']  = $msg;

    }
    
    echo json_encode($data);
?>

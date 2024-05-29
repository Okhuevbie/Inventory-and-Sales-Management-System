<?php
  session_start();
  include 'includer.php';  
  
  $data    = array();

    if(($_SERVER['REQUEST_METHOD']=='POST')){
      

        if ($_POST['action'] == 'add_category') {
       
            $msg = $up->insertInventoryCategory($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Category added Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }

        }elseif ($_POST['action'] == 'edit_category') {
            $msg = $ud->updateInventoryCategory($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Category updated Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'add_inventory') {
            $msg = $up->insertInventoryItem($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Inventory Item added Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'edit_inventory_info') {
            $msg = $ud->updateInventoryInfo($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Inventory Item updated Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'release_item') {
            $msg = $up->insertItemHistory($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Item released Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'retrieve_item') {
            $msg = $ud->updateItemHistory($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Item updated Successfully.';
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

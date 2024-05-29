<?php
  session_start();
  include 'includer.php';  
  
  $data    = array();
 
    if(($_SERVER['REQUEST_METHOD']=='POST')){
      

        if ($_POST['action'] == 'place_order') {
            $msg = $up->placeOrder($_POST);
            if (is_int($msg)) {
                $data['success'] = true;
                $data['message'] = 'Ordered Successfully.';
                $data['link'] = 'view-order.php?order='. $msg;
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'add_order_payment') {
            $msg = $up->insertOrderPayment($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Payment added Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'edit_payment') {
            $msg = $ud->updateOrderPayment($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Payment updated Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'update_order') {
            $msg = $ud->updateOrderStatus($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Order updated Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'outstanding_order') {
            $msg = $up->outstandingOrder($_POST);
            if (is_int($msg)) {
                $data['success'] = true;
                $data['message'] = 'Ordered Successfully.';
                $data['link'] = 'view-order.php?order='. $msg;
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

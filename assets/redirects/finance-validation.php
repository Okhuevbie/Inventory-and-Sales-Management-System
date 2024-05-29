<?php
  session_start();
  include 'includer.php';  
  
  $data    = array();

    if(($_SERVER['REQUEST_METHOD']=='POST')){
      
        if ($_POST['action'] == 'add_finance') {
            $msg = $up->insertFinance($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Financial Statement added Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }elseif ($_POST['action'] == 'edit_payment') {
            $msg = $ud->updateFinance($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Payment updated Successfully.';
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

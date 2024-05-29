<?php
  session_start();
  include 'includer.php';  
  
  $data    = array();

    if(($_SERVER['REQUEST_METHOD']=='POST')){
      

        if ($_POST['action'] == 'add') {
       
            $msg = $up->insertStore($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Warehouse added Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }

        }elseif ($_POST['action'] == 'edit') {
            $msg = $ud->updateStore($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Warehouse updated Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }
    
    }else{
        $msg = "An Error Occured";

        $data['success'] = false;
        $data['errors']  = $msg;

    }
    
    echo json_encode($data);
?>

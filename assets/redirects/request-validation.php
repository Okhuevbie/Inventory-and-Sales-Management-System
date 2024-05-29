<?php
  session_start();
  include 'includer.php';  
  
  $data    = array();

    if(($_SERVER['REQUEST_METHOD']=='POST')){
      

        if ($_POST['action'] == 'add_request') {
       
            $msg = $up->insertRequest($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Request sent Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }

        }elseif ($_POST['action'] == 'update_request') {
            $msg = $ud->updateRequestStatus($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Request updated Successfully.';
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

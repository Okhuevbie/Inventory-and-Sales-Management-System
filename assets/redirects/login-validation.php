<?php
  session_start();
  include 'includer.php';  
  
  $data    = array();

    if(($_SERVER['REQUEST_METHOD']=='POST')){
      

        if ($_POST['action'] == 'login') {
       
            $msg = $lg->confirmUser($_POST);
            if ($msg == 'Success') {

                $data['success'] = true;
                $data['message'] = 'Confirmed Successfully, Please wait...';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }

        }elseif ($_POST['action'] == 'store_login') {
            $_POST['user'] = USERID;
            $msg = $lg->confirmStore($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Verification Complete...';
                if ($_POST['role'] == 3) {
                    $data['url'] = 'store/dashboard.php';
                }else{
                    $data['url'] = 'central/dashboard.php';
                }
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

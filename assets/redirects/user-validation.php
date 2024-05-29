<?php
  session_start();
  include 'includer.php';  
  
  $data    = array();

    if(($_SERVER['REQUEST_METHOD']=='POST')){
      

        if ($_POST['action'] == 'add_user') {
       
            $msg = $up->insertUser($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'User added Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }

        }elseif ($_POST['action'] == 'edit_user') {

            $msg = $ud->updateUser($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Profile updated Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }

        }elseif ($_POST['action'] == 'assign_role') {

            $msg = $up->assignUserRole($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Role Assigned Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
            
        }elseif ($_POST['action'] == 'password') {

            $msg = $ud->changeUserPassword($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Password changed Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
        }else if ($_POST['action'] == 'add_supplier') {
       
            $msg = $up->insertSupplier($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Supplier added Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }

        }elseif ($_POST['action'] == 'edit_supplier') {
            $msg = $ud->updateSupplier($_POST);
            if ($msg == 'Success') {
                $data['success'] = true;
                $data['message'] = 'Supplier updated Successfully.';
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

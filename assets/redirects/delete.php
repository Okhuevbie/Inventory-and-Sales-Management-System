<?php 
  session_start();
  $title = "Delete";
  include 'includer.php'; ?>

  <?php 

  $errors  = array();
  $data    = array();

  if (isset($_POST['token'])) {
  
	  $id = $_POST['id'];
	  $tab = $_POST['tab'];

	  switch ($tab) {
	  	case 'user':
	  		$table = 'users';
	  		$msg = $dl->deleteTemporaryWithChild($table,$id,'id','user_roles','user_id');
	  		if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'User deleted Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
	  		break;

        case 'warehouse':
            $table = 'stores';
            $msg = $dl->deleteTemporaryWithChild($table,$id,'id','user_roles','store_id');
            if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'Warehouse deleted Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
            break;

        case 'role':
            $table = 'user_roles';
            $msg = $dl->deleteTemporary($table,'id',$id);
            if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'User Role removed Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
            break;

	  	case 'supplier':
	  		$table = 'suppliers';
	  		$msg = $dl->deleteTemporary($table,'id',$id);
	  		if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'Supplier deleted Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
	  		break;

        case 'product':
            $table = 'products';
            $msg = $dl->deleteTemporary($table,'id',$id);
            if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'Product deleted Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
            break;

        case 'inventory':
            $table = 'inventories';
            $msg = $dl->deleteTemporary($table,'id',$id);
            if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'Inventory Item deleted Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
            break;

        case 'product_category':
            $table = 'product_categories';
            $msg = $dl->deleteTemporary($table,'id',$id);
            if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'Category deleted Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
            break;

        case 'inventory_category':
            $table = 'inventory_categories';
            $msg = $dl->deleteTemporary($table,'id',$id);
            if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'Category deleted Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
            break;

        // case 'order':
        //     $table = 'orders';
        //     $msg = $dl->deleteTemporaryWithTwoChildNode($table,$id,'id','order_items','order_id','order_payments','order_id');

        //     if ($msg == 'Deleted') {
        //         $data['success'] = true;
        //         $data['message'] = 'Order deleted Successfully.';
        //     }else{
        //         $data['success'] = false;
        //         $data['errors']  = $msg;
        //     }
        //     break;

        case 'finance':
            $table = 'finances';
            $msg = $dl->deleteTemporary($table,'id',$id);
            if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'Payment deleted Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
            break;

        case 'inventory_history':
            $table = 'inventory_history';
            $msg = $dl->deleteTemporary($table,'id',$id);
            if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'History deleted Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
            break;

        case 'request':
            $table = 'requests';
            $msg = $dl->deleteTemporary($table,'id',$id);
            if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'Request deleted Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
            break;

        case 'returned':
            $table = 'returned_orders';
            $msg = $dl->deleteTemporary($table,'id',$id);
            if ($msg == 'Deleted') {
                $data['success'] = true;
                $data['message'] = 'Returned Order deleted Successfully.';
            }else{
                $data['success'] = false;
                $data['errors']  = $msg;
            }
            break;
	  	
	  	default:
	  		$data['success'] = false;
	  		$data['errors']  = 'An Error Occured';
	  		break;
	  }
	}
	echo json_encode($data);
 ?>
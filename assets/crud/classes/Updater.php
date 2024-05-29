<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath."/../lib/Database.php");
  include_once ($filepath."/../helpers/format.php");
  include_once ($filepath."/../lib/Session.php");
?>
<?php
   class Updater
  {
	  	private $db;
	  	private $fm;
	  	
	  	function __construct()
	  	{
	  		$this->db = new Database();
	  		$this->fm = new Format();
	  	}

    public function updateUser($post){

              $uid = $this->fm->validation($post['user']);
              $first_name = $this->fm->validation($post['first_name']);
              $last_name = $this->fm->validation($post['last_name']);
              $other_name = $this->fm->validation($post['other_name']);
              $date_of_birth = $this->fm->validation($post['date_of_birth']);
              $phone = $this->fm->validation($post['phone']);
              $residential_address = $this->fm->validation($post['home_address']);
              $email = $this->fm->validation($post['email']);
              $gender = '';
              if (isset($post['gender'])) {
                $gender = $this->fm->validation($post['gender']);
              }
              $status = $this->fm->validation($post['status']);

              $uid  = mysqli_real_escape_string($this->db->link, $uid);
              $first_name  = mysqli_real_escape_string($this->db->link, $first_name);
              $last_name  = mysqli_real_escape_string($this->db->link, $last_name);
              $other_name  = mysqli_real_escape_string($this->db->link, $other_name);
              $date_of_birth  = mysqli_real_escape_string($this->db->link, $date_of_birth);
              $phone  = mysqli_real_escape_string($this->db->link, $phone);
              $residential_address  = mysqli_real_escape_string($this->db->link, $residential_address);
              $email  = mysqli_real_escape_string($this->db->link, $email);
              $gender  = mysqli_real_escape_string($this->db->link, $gender);
              $status  = mysqli_real_escape_string($this->db->link, $status);


              if(empty($first_name) || empty($last_name) || empty($phone) || empty($email) || empty($status)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
            //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
          //     $msg = "You are not authorized to perform this action!!!"; 
          //     return $msg;
          // }
            elseif (!preg_match("/^[a-zA-Z\' ]*$/",$first_name) || !preg_match("/^[a-zA-Z\' ]*$/",$last_name) || !preg_match("/^[a-zA-Z\' ]*$/",$other_name)) {
              $msg = "Only letters and white space allowed in Name"; 
              return $msg;
            }
            elseif (!preg_match("/^[0-9 ]*$/",$phone)) {
                $msg = "Only numbers, allowed in phone";
                return $msg; 
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msg = "Invalid email format";
                return $msg; 
            }
            else{
            $chquery = "SELECT * FROM users WHERE email=? AND id !=? AND status != 'deleted' OR phone=? AND id !=? AND status != 'deleted'";
            $chresult = $this->db->select($chquery,array('sisi'),array(&$email,&$uid,&$phone,&$uid),array());
            if($chresult){
               $msg = "Email or Phone has been Registered";
               return $msg;
            }else{
                $query = "UPDATE `users` SET `first_name`=?, `last_name`=?, `other_name`=?, `gender`=?, `date_of_birth`=?, `phone`=?, `residential_address`=?, `email`=?, `status`=? WHERE id=?";
                $type = array('sssssisssi');
                $result = $this->db->insert($query,$type,array(&$first_name,&$last_name,&$other_name,&$gender,&$date_of_birth,&$phone,&$residential_address,&$email,&$status,&$uid));             

                  if ($result) {
                    $action = 'Updated a User: '.$first_name.' '.$last_name .' '.$other_name;
                    self::logActivity($action);

                    $msg = "Success";
                    return $msg;
                  }else{
                    $msg = "An Error Occurred";
                    return $msg;
                  }
                
              }
              
            }
      }

    public function changeUserPassword($post){

              $uid = $this->fm->validation($post['user']);
              $password = $this->fm->validation($post['password']);

              $uid  = mysqli_real_escape_string($this->db->link, $uid);
              $password  = mysqli_real_escape_string($this->db->link, $password);
              $password_hash =  password_hash($password, PASSWORD_DEFAULT,['cost'=>12]);
              

                if(empty($password)){
              $msg = "Password is empty Empty...";
                return $msg;
            }
            //    elseif ($admin != ('Developer' || 'System Admnistrator')) {
          //     $msg = "You are not authorized to perform this action!!!"; 
          //     return $msg;
          // }
            
          else{

                $query = "UPDATE `users` SET `password`=? WHERE `id`=? AND `status` != 'deleted'";
                $type = array('si');
                $result = $this->db->update($query,$type,array(&$password_hash,&$uid));             

                  if ($result) {

                    $action = 'Updated User: Password';
                    self::logActivity($action);

                    $msg = "Success";
                    return $msg;
                  }else{
                    $msg = "An Error Occurred";
                    return $msg;
                  }            
                
          }
            
      }


      public function updateStore($post){

                $wid = $this->fm->validation($post['store']);
                $name = $this->fm->validation($post['name']);
                $store_type = $this->fm->validation($post['type']);
                $address = $this->fm->validation($post['address']);
                $country = $this->fm->validation($post['country']);
                $state = $this->fm->validation($post['state']);
                $city = $this->fm->validation($post['city']);

                $wid  = mysqli_real_escape_string($this->db->link, $wid);
                $name  = mysqli_real_escape_string($this->db->link, $name);
                $store_type  = mysqli_real_escape_string($this->db->link, $store_type);
                $address  = mysqli_real_escape_string($this->db->link, $address);
                $country  = mysqli_real_escape_string($this->db->link, $country);
                $state  = mysqli_real_escape_string($this->db->link, $state);
                $city  = mysqli_real_escape_string($this->db->link, $city);


                if(empty($name) || empty($address) || empty($state)){
                  $msg = "Some required Fields are Empty...";
                  return $msg;
                }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              elseif (!preg_match("/^[a-zA-Z\' ]*$/",$name)) {
                $msg = "Only letters and white space allowed in Name"; 
                return $msg;
              }
              else{
                $chquery = "SELECT * FROM stores WHERE name=? AND type=? AND address=? AND state=? AND city=? AND id != ? AND status != 'deleted'";
                $chresult = $this->db->select($chquery,array('sssssi'),array(&$name,&$store_type,&$address,&$state,&$city,&$wid),array());
                if($chresult){
                   $msg = "Warehouse Exist Already";
                   return $msg;
              }else{
                  $query = "UPDATE `stores` SET `name`=?, `type`=?, `address`=?, `country`=?, `state`=?, `city`=? WHERE id=?";
                  $type = array('ssssssi');
                  $result = $this->db->insert($query,$type,array(&$name,&$store_type,&$address,&$country,&$state,&$city,&$wid));             

                    if ($result) {
                      $action = 'Updated a Warehouse: '.$name.' ('.$address .' - '.$state.')';
                      self::logActivity($action);

                      $msg = "Success";
                      return $msg;
                    }else{
                      $msg = "An Error Occurred";
                      return $msg;
                    }
                  
                }
                
              }
        }

    public function updateSupplier($post){

              $sid = $this->fm->validation($post['supplier']);
              $name = $this->fm->validation($post['name']);
              $phone = $this->fm->validation($post['phone']);
              $email = $this->fm->validation($post['email']);
              $address = $this->fm->validation($post['address']);
              
              $sid  = mysqli_real_escape_string($this->db->link, $sid);
              $name  = mysqli_real_escape_string($this->db->link, $name);
              $phone  = mysqli_real_escape_string($this->db->link, $phone);
              $email  = mysqli_real_escape_string($this->db->link, $email);
              $address  = mysqli_real_escape_string($this->db->link, $address);
              
              if(empty($name) ||  empty($phone) || empty($email)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
            //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
          //     $msg = "You are not authorized to perform this action!!!"; 
          //     return $msg;
          // }
            elseif (!preg_match("/^[0-9 ]*$/",$phone)) {
                $msg = "Only numbers, allowed in phone";
                return $msg; 
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msg = "Invalid email format";
                return $msg; 
            }
            else{
            $chquery = "SELECT * FROM suppliers WHERE email=? AND id !=? AND status != 'deleted' OR phone=? AND id !=? AND status != 'deleted'";
            $chresult = $this->db->select($chquery,array('sisi'),array(&$email,&$sid,&$phone,&$sid),array());
            if($chresult){
               $msg = "Email or Phone has been Registered";
               return $msg;
            }else{
                $query = "UPDATE `suppliers` SET `supplier_name`=?, `phone`=?, `email`=?, `address`=? WHERE id=?";
                $type = array('sissi');
                $result = $this->db->insert($query,$type,array(&$name,&$phone,&$email,&$address,&$sid));             

                  if ($result) {
                    $action = 'Updated a Supplier: '.$name;
                    self::logActivity($action);

                    $msg = "Success";
                    return $msg;
                  }else{
                    $msg = "An Error Occurred";
                    return $msg;
                  }
                
              }
              
            }
      }

    public function updateProductCategory($post){

              $cid = $this->fm->validation($post['cid']);
              $category = $this->fm->validation($post['category']);

              $cid  = mysqli_real_escape_string($this->db->link, $cid);
              $category  = mysqli_real_escape_string($this->db->link, $category);
              
              if(empty($cid) || empty($category)){
                $msg = "An error occured with data...";
                return $msg;
              }
            //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
          //     $msg = "You are not authorized to perform this action!!!"; 
          //     return $msg;
          // }
              else{
              $chquery = "SELECT * FROM product_categories WHERE title=? AND id != ? AND status != 'deleted'";
              $chresult = $this->db->select($chquery,array('si'),array(&$category,&$cid),array());
              if($chresult){
                 $msg = "Product Category exist already";
                 return $msg;
              }else{
                $query = "UPDATE `product_categories` SET `title`=? WHERE `id`=?";
                $type = array('si');
                $result = $this->db->insert($query,$type,array(&$category,&$cid));             

                  if ($result) {

                    $action = 'Updated a Product Category: '. $category;
                    self::logActivity($action);

                    $msg = "Success";
                    return $msg;
                  }else{
                    $msg = "An Error Occurred";
                    return $msg;
                  }
                
              }
              
            }
      }
      public function updateProductQuantitySales($post){

        $pid = $this->fm->validation($post['pid']);
        $quantity = $this->fm->validation($post['quantity']);
        $name = $this->fm->validation($post['product_name']);

        $pid  = mysqli_real_escape_string($this->db->link, $pid);
        $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
        $name  = mysqli_real_escape_string($this->db->link, $name);
        
        if(empty($pid) || empty($quantity) || empty($name)){
          $msg = "An error occured with data...";
          return $msg;
        }
      //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
    //     $msg = "You are not authorized to perform this action!!!"; 
    //     return $msg;
    // }
        else{
        $chquery = "SELECT quantity FROM products WHERE id=? AND status != 'deleted'";
        $chresult = $this->db->select($chquery,array('i'),array(&$pid),array());
        $row = $chresult->fetch_assoc();
        if(!$row){
           $msg = "Product Quantity Not Uploaded";
           return $msg;
        }else{
          $newquantity = $row['quantity']-$quantity;
          $query = "UPDATE `products` SET `quantity`=? WHERE `id`=?";
          $type = array('ii');
          $result = $this->db->insert($query,$type,array(&$newquantity,&$cid));             

            if ($result) {

              $action = 'Updated a Product Quantity: '. $name;
              self::logActivity($action);

              $msg = "Success";
              return $msg;
            }else{
              $msg = "An Error Occurred";
              return $msg;
            }
          
        }
        
      }
}

    public function updateInventoryCategory($post){

              $cid = $this->fm->validation($post['cid']);
              $category = $this->fm->validation($post['category']);

              $cid  = mysqli_real_escape_string($this->db->link, $cid);
              $category  = mysqli_real_escape_string($this->db->link, $category);
              
              if(empty($cid) || empty($category)){
                $msg = "An error occured with data...";
                return $msg;
              }
            //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
          //     $msg = "You are not authorized to perform this action!!!"; 
          //     return $msg;
          // }
              else{
              $chquery = "SELECT * FROM inventory_categories WHERE title=? AND id != ? AND status != 'deleted'";
              $chresult = $this->db->select($chquery,array('si'),array(&$category,&$cid),array());
              if($chresult){
                 $msg = "Inventory Category exist already";
                 return $msg;
              }else{
                $query = "UPDATE `inventory_categories` SET `title`=? WHERE `id`=?";
                $type = array('si');
                $result = $this->db->insert($query,$type,array(&$category,&$cid));             

                  if ($result) {

                    $action = 'Updated an Inventory Category: '. $category;
                    self::logActivity($action);

                    $msg = "Success";
                    return $msg;
                  }else{
                    $msg = "An Error Occurred";
                    return $msg;
                  }
                
              }
              
            }
      }

    public function updateProductInfo($post){

              $pid = $this->fm->validation($post['product']);
              $code = $this->fm->validation($post['product_code']);
              $name = $this->fm->validation($post['product_name']);
              $category = $this->fm->validation($post['category']);
              $units = $this->fm->validation($post['units']);
              $quantity = $this->fm->validation($post['quantity']);
              $alert_quantity = $this->fm->validation($post['alert_quantity']);
              $unit_price = $this->fm->validation($post['unit_price']);
              $purpose = $this->fm->validation($post['purpose']);

              $pid  = mysqli_real_escape_string($this->db->link, $pid);
              $code  = mysqli_real_escape_string($this->db->link, $code);
              $name  = mysqli_real_escape_string($this->db->link, $name);
              $category  = mysqli_real_escape_string($this->db->link, $category);
              $units  = mysqli_real_escape_string($this->db->link, $units);
              $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
              $alert_quantity  = mysqli_real_escape_string($this->db->link, $alert_quantity);
              $unit_price  = mysqli_real_escape_string($this->db->link, $unit_price);
              $purpose  = mysqli_real_escape_string($this->db->link, $purpose);
              
              if(empty($pid) || empty($name) || empty($category) || empty($units) || empty($alert_quantity) || empty($unit_price)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              else{
                $chquery = "SELECT * FROM products WHERE product_name=? AND category=? AND id != ? AND status != 'deleted'";
                $chresult = $this->db->select($chquery,array('sii'),array(&$name,&$category,&$pid),array());
                if($chresult){
                   $msg = "Product exist already";
                   return $msg;
                }else{

                  $query = "UPDATE `products` SET `product_code`=?, `product_name`=?, `category`=?, `metric_units`=?, `quantity`=`quantity`+?, `alert_quantity`=?, `unit_price`=? WHERE `id`=? AND `status` != 'deleted'";
                  $type = array('ssisiiii');
                  $result = $this->db->insert($query,$type,array(&$code,&$name,&$category,&$units,&$quantity,&$alert_quantity,&$unit_price,&$pid));             
                    
                    if ($result) { 
                      $product_update= "INSERT INTO `product_update`( `user_id`, `product_id`, `purpose`, `quantity`) VALUES (?,?,?,?)";
                      $puser_id = Session::get('userid');
                      $puser = Session::get('user_fullname');
                      $ptype = array('sisi');
                      $presult = $this->db->insert($product_update,$ptype,array(&$puser,&$pid,&$purpose,&$quantity));

                      $action = 'Updated ' . $name. ' Product ( PURPOSE: '.$purpose.' || PRODUCT QUANTITY ADDED: '.$quantity.')' ;
                      self::logActivity($action);

                      $msg = "Success";
                      return $msg;
                    }else{
                      $msg = "An Error Occurred";
                      return $msg;
                    }
                  
                }
              
             }
      }
    public function updateInventoryInfo($post){

              $in_id = $this->fm->validation($post['item_id']);
              $name = $this->fm->validation($post['item_name']);
              $category = $this->fm->validation($post['category']);
              $quantity = $this->fm->validation($post['quantity']);

              $in_id  = mysqli_real_escape_string($this->db->link, $in_id);
              $name  = mysqli_real_escape_string($this->db->link, $name);
              $category  = mysqli_real_escape_string($this->db->link, $category);
              $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
              
              if(empty($in_id) || empty($name) || empty($category) || empty($quantity)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              else{
                $chquery = "SELECT * FROM inventories WHERE item_name=? AND category_id=? AND id != ? AND status != 'deleted'";
                $chresult = $this->db->select($chquery,array('sii'),array(&$name,&$category,&$in_id),array());
                if($chresult){
                   $msg = "Product exist already";
                   return $msg;
                }else{

                  $query = "UPDATE `inventories` SET `item_name`=?, `category_id`=?, `quantity`=? WHERE `id`=? AND `status` != 'deleted'";
                  $type = array('siii');
                  $result = $this->db->insert($query,$type,array(&$name,&$category,&$quantity,&$in_id));             

                    if ($result) { 

                      $action = 'Updated an Inventory Item: '. $name;
                      self::logActivity($action);

                      $msg = "Success";
                      return $msg;
                    }else{
                      $msg = "An Error Occurred";
                      return $msg;
                    }
                  
                }
              
             }
      }
      public function updateProductImage($post, $file){

              $filepath = realpath(dirname(__FILE__));
              $pid = $this->fm->validation($post['product']);
              $pid  = mysqli_real_escape_string($this->db->link, $pid);
              
              if(empty($pid)){
                $msg = "A product error occured...";
                return $msg;
              }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              else{

                  $tz = new DateTime('now', new DateTimeZone('Africa/Lagos'));
                  if (!empty($file['image']['name'])) {

                    $time = $tz->format('Ymd_His');
                    $image_file = basename($file['image']['name']);
                    $year_folder = $tz->format('Y');
                    $directory = $filepath.'/../../images/products/'.$year_folder.'/';

                    if (!file_exists($directory)) {
                      mkdir($directory, 0777, true);
                    }

                    $target_file = $directory . $image_file;
                    $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_temp = $file['image']['tmp_name'];
                    $image_newname = 'EF_IMG_'. $time .'.'.$image_type;
                    $image_rename = $directory.$image_newname;

                    if ($image_type != "jpg" && $image_type != "jpeg" && $image_type != "png"){
                      $msg = "File type ".$image_type." not Supported. \nSelect an Image with jpg, jpeg or png formats!";
                      return $msg;
                    }
                    elseif (!move_uploaded_file($image_temp, $image_rename)) {
                      $msg = "Error uploading File";
                      return $msg;
                     }
                     elseif ($file['image']['size'] > 2048000) {
                      $msg = "File too large. File should not be more than 2MB";
                      return $msg;
                     }
                     else{
                      $product_image = $year_folder.'/'.$image_newname;

                     }

                  }else{
                    $product_image = 'default-image.jpg';
                  }

                  $query = "UPDATE `products` SET `image`=? WHERE `id` = ? AND `status` != 'deleted'";
                  $type = array('si');
                  $result = $this->db->insert($query,$type,array(&$product_image,&$pid));             

                    if ($result) { 

                      $action = 'Updated a Product Image: '. self::getName('products','product_name','id',$pid);
                      self::logActivity($action);

                      $msg = "Success";
                      return $msg;
                    }else{
                      $msg = "An Error Occurred";
                      return $msg;
                    }
                  
              
             }
      }

      public function updateOrderPayment($post){

              $payment = $this->fm->validation($post['pid']);
              $amount = $this->fm->validation(floatval($post['paid_amount']));
              $payment_method = $this->fm->validation($post['other_payment']);

              $payment  = mysqli_real_escape_string($this->db->link, $payment);
              $amount  = mysqli_real_escape_string($this->db->link, $amount);
              $payment_method  = mysqli_real_escape_string($this->db->link, $payment_method);
              
              if(empty($payment) || empty($amount) || empty($payment_method)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              else{

                // $query1 = "UPDATE `order_payments` SET `amount`=?, `payment_method`=? WHERE `id` = ? AND `status` != 'deleted'";
                // $type1 = array('dsi');
                // $result1 = $this->db->insert($query1,$type1,array(&$amount,&$payment_method,&$payment));

                $order_id = self::getName('finances','item_id','id',$payment);
                $order_no = self::getName('orders','invoice_id','id',$order_id);

                  $finance_status = '';
                  $query = "SELECT * FROM finances WHERE id=? AND status != 'deleted' LIMIT 1";
                  $result = $this->db->select($query,array('i'),array(&$payment),array());
                  if($result){
                    $row = $result->fetch_assoc();
                    $income = array(
                        "fid" => $row['id'],
                        "item_table" => "orders",
                        "item_id" => $order_id,
                        "category" => $row['category'],
                        "purpose" => $row['purpose'],
                        "amount" => $amount,
                        "payment_method" => $payment_method
                      );

                    $finance_status = self::updateFinance($income);
                  }
                  

                if ($finance_status == 'Success') {
                  $action = 'Updated an order payment at Order No.'. $order_no ;
                  self::logActivity($action);

                  $msg = "Success";
                  return $msg;
                }else{
                  $msg = "An Error Occurred";
                  return $msg;
                }
               
             }
      }

      public function updateSupplyPayment($post){

              $payment = $this->fm->validation($post['pid']);
              $amount = $this->fm->validation(floatval($post['paid_amount']));
              $payment_method = $this->fm->validation($post['other_payment']);

              $payment  = mysqli_real_escape_string($this->db->link, $payment);
              $amount  = mysqli_real_escape_string($this->db->link, $amount);
              $payment_method  = mysqli_real_escape_string($this->db->link, $payment_method);
              
              if(empty($payment) || empty($amount) || empty($payment_method)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              else{

                // $query1 = "UPDATE `order_payments` SET `amount`=?, `payment_method`=? WHERE `id` = ? AND `status` != 'deleted'";
                // $type1 = array('dsi');
                // $result1 = $this->db->insert($query1,$type1,array(&$amount,&$payment_method,&$payment));

                $supply_id = self::getName('finances','item_id','id',$payment);
                $supply_no = self::getName('incoming_products','supply_id','id',$supply_id);

                  $finance_status = '';
                  $query = "SELECT * FROM finances WHERE id=? AND status != 'deleted' LIMIT 1";
                  $result = $this->db->select($query,array('i'),array(&$payment),array());
                  if($result){
                    $row = $result->fetch_assoc();
                    $expense = array(
                        "fid" => $row['id'],
                        "item_table" => "incoming_products",
                        "item_id" => $supply_id,
                        "category" => $row['category'],
                        "purpose" => $row['purpose'],
                        "amount" => $amount,
                        "payment_method" => $payment_method
                      );

                    $finance_status = self::updateFinance($expense);
                  }
                  

                if ($finance_status == 'Success') {
                  $action = 'Updated a supply payment at Supply No.'. $supply_no ;
                  self::logActivity($action);

                  $msg = "Success";
                  return $msg;
                }else{
                  $msg = "An Error Occurred";
                  return $msg;
                }
               
             }
      }
      public function updateFinance($post){

              $fid = $this->fm->validation($post['fid']);
              $item_table = $this->fm->validation($post['item_table']);
              $item_id = $this->fm->validation($post['item_id']);
              $category = $this->fm->validation($post['category']);
              $purpose = $this->fm->validation($post['purpose']);
              $amount = $this->fm->validation($post['amount']);
              $payment_method = $this->fm->validation($post['payment_method']);

              $fid  = mysqli_real_escape_string($this->db->link, $fid);
              $item_table  = mysqli_real_escape_string($this->db->link, $item_table);
              $item_id  = mysqli_real_escape_string($this->db->link, $item_id);
              $category  = mysqli_real_escape_string($this->db->link, $category);
              $purpose  = mysqli_real_escape_string($this->db->link, $purpose);
              $amount  = mysqli_real_escape_string($this->db->link, $amount);
              $payment_method  = mysqli_real_escape_string($this->db->link, $payment_method);
              
              if(empty($fid) || empty($category) || empty($purpose) || empty($amount) || empty($payment_method)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              else{

                $query = "UPDATE `finances` SET `table_name`=?, `item_id`=?, `category`=?, `purpose`=?, `amount`=?, `payment_method`=? WHERE `id`=? AND `status` != 'deleted'";
                $type = array('sissdsi');
                $result = $this->db->insert($query,$type,array(&$item_table,&$item_id,&$category,&$purpose,&$amount,&$payment_method,&$fid));             

                  if ($result) { 

                    $action = 'Update an '. $category .' in Finance: '. $this->fm->limit_words($purpose, 10) .'...';
                    self::logActivity($action);

                    $msg = "Success";
                    return $msg;
                  }else{
                    $msg = "An Error Occurred";
                    return $msg;
                  }
               
              
             }
      }


      public function updateItemHistory($post){

                $hid = $this->fm->validation($post['hid']);
                $warehouse = $this->fm->validation($post['warehouse']);
                $date_taken = $this->fm->validation($post['date_taken']);
                $quantity_taken = $this->fm->validation($post['quantity_taken']);
                $date_returned = $this->fm->validation($post['date_returned']);
                $quantity_returned = $this->fm->validation($post['quantity_returned']);

                $hid  = mysqli_real_escape_string($this->db->link, $hid);
                $warehouse  = mysqli_real_escape_string($this->db->link, $warehouse);
                $date_taken  = mysqli_real_escape_string($this->db->link, $date_taken);
                $quantity_taken  = mysqli_real_escape_string($this->db->link, $quantity_taken);
                $date_returned  = mysqli_real_escape_string($this->db->link, $date_returned);
                $quantity_returned  = mysqli_real_escape_string($this->db->link, $quantity_returned);
                
                if(empty($hid) || empty($warehouse) || empty($date_taken) || empty($quantity_taken)){
                  $msg = "Some required Fields are Empty...";
                  return $msg;
                }
                //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
              //     $msg = "You are not authorized to perform this action!!!"; 
              //     return $msg;
              // }
                else{

                    $query = "UPDATE `inventory_history` SET `warehouse_id`=?, `date_taken`=?, `quantity_taken`=?, `date_returned`=?, `quantity_returned`=? WHERE `id`=?";
                    $type = array('isisii');
                    $result = $this->db->insert($query,$type,array(&$warehouse,&$date_taken,&$quantity_taken,&$date_returned,&$quantity_returned,&$hid));
                    if ($result) {

                      $warehouse_name = self::getName('stores', 'name', 'id', $warehouse);
                      $action = 'Updated Inventory Items for '. $warehouse_name;
                      self::logActivity($action);

                      $msg = "Success";
                      return $msg;
                    }else{
                      $msg = "An Error Occurred";
                      return $msg;
                    }
                
               }
        }


      public function updateRequestStatus($post){

                $rid = $this->fm->validation($post['request']);
                $status = $this->fm->validation($post['status']);

                $rid  = mysqli_real_escape_string($this->db->link, $rid);
                $status  = mysqli_real_escape_string($this->db->link, $status);
                
                if(empty($rid) || empty($status)){
                  $msg = "Some required Fields are Empty...";
                  return $msg;
                }
                //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
              //     $msg = "You are not authorized to perform this action!!!"; 
              //     return $msg;
              // }
                else{

                    $query = "UPDATE `request` SET `status`=? WHERE `id`=?";
                    $type = array('si');
                    $result = $this->db->insert($query,$type,array(&$status,&$rid));
                    if ($result) {

                      $warehouse = self::getName('requests', 'warehouse_id', 'id', $rid);
                      $category = self::getName('requests', 'category', 'id', $rid);
                      $warehouse_name = self::getName('stores', 'name', 'id', $warehouse);
                      $action = 'Updated Request '. $category .', made by '. $warehouse_name;
                      self::logActivity($action);

                      $msg = "Success";
                      return $msg;
                    }else{
                      $msg = "An Error Occurred";
                      return $msg;
                    }
                
               }
        }

      public function updateOrderStatus($post){

                $oid = $this->fm->validation($post['order']);
                $status = $this->fm->validation($post['status']);

                $oid  = mysqli_real_escape_string($this->db->link, $oid);
                $status  = mysqli_real_escape_string($this->db->link, $status);
                
                if(empty($oid) || empty($status)){
                  $msg = "Some required Fields are Empty...";
                  return $msg;
                }
                //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
              //     $msg = "You are not authorized to perform this action!!!"; 
              //     return $msg;
              // }
                else{

                    $query = "UPDATE `orders` SET `status`=? WHERE `id`=?";
                    $type = array('si');
                    $result = $this->db->insert($query,$type,array(&$status,&$oid));
                    if ($result) {

                      $order_no = self::getName('orders', 'invoice_id', 'id', $oid);
                      $action = 'Updated Order No '. $order_no .' Status to'. $status;
                      self::logActivity($action);

                      $msg = "Success";
                      return $msg;
                    }else{
                      $msg = "An Error Occurred";
                      return $msg;
                    }
                
               }
        }

      public function updateDamagedQuantity($post){

                $pid = $this->fm->validation($post['supply']);
                $quantity = $this->fm->validation($post['damaged']);

                $pid  = mysqli_real_escape_string($this->db->link, $pid);
                $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
                
                if(empty($pid) || empty($quantity)){
                  $msg = "Enter Quanitity...";
                  return $msg;
                }
                //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
              //     $msg = "You are not authorized to perform this action!!!"; 
              //     return $msg;
              // }
                else{

                    $query = "UPDATE `incoming_products` SET `available_quantity`= `available_quantity` - $quantity, `damaged` = `damaged` + $quantity WHERE `id`=?";
                    $type = array('i');
                    $result = $this->db->insert($query,$type,array(&$pid));
                    if ($result) {

                      $product_id = self::getName('incoming_products', 'product_id', 'id', $pid);
                      $product = self::getName('products', 'product_name', 'id', $product_id);

                      $action = 'Updated '. $product .' Damaged Quantity by'. $quantity;
                      self::logActivity($action);

                      $msg = "Success";
                      return $msg;
                    }else{
                      $msg = "An Error Occurred";
                      return $msg;
                    }
                
               }
        }

    public function getName($table,$name_field,$col,$value){

      $name = '';
      $query = "SELECT `$name_field` FROM `$table` WHERE `$col`=? AND `status` != 'deleted' LIMIT 1";
      $result = $this->db->select($query,array('s'),array(&$value),array());
      if($result){
        $row = $result->fetch_assoc();
        $name = $row[$name_field];
      }
      return $name;
    }

    public function logActivity($activity) {
          $user = Session::get('user_fullname');
          $user_id = Session::get('userid');
          
          $logquery = "INSERT INTO activities (user_id,user,activity) VALUES(?,?,?)";
          $logtype = array('iss');
          $logresult = $this->db->insert($logquery,$logtype,array(&$user_id,&$user,&$activity));
      }
  
  }
?>
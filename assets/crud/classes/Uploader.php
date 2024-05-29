<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath."/../lib/Database.php");
  include_once ($filepath."/../helpers/format.php");
  include_once ($filepath."/../lib/Session.php");

?>
<?php
   class Uploader
  {
	  	private $db;
	  	private $fm;
	  	
	  	function __construct()
	  	{
	  		$this->db = new Database();
	  		$this->fm = new Format();
	  	}

  public function insertUser($post){

            $first_name = $this->fm->validation($post['first_name']);
            $last_name = $this->fm->validation($post['last_name']);
            $other_name = $this->fm->validation($post['other_name']);
            $date_of_birth = $this->fm->validation($post['date_of_birth']);
            $phone = $this->fm->validation($post['phone']);
            $residential_address = $this->fm->validation($post['home_address']);
            $email = $this->fm->validation($post['email']);
            $password = $this->fm->validation($post['password']);
            $gender = '';
            if (isset($post['gender'])) {
              $gender = $this->fm->validation($post['gender']);
            }

            $first_name  = mysqli_real_escape_string($this->db->link, $first_name);
            $last_name  = mysqli_real_escape_string($this->db->link, $last_name);
            $other_name  = mysqli_real_escape_string($this->db->link, $other_name);
            $date_of_birth  = mysqli_real_escape_string($this->db->link, $date_of_birth);
            $residential_address  = mysqli_real_escape_string($this->db->link, $residential_address);
            $phone  = mysqli_real_escape_string($this->db->link, $phone);
            $email  = mysqli_real_escape_string($this->db->link, $email);
            $password  = mysqli_real_escape_string($this->db->link, $password);
            $gender  = mysqli_real_escape_string($this->db->link, $gender);

            $password_hash =  password_hash($password, PASSWORD_DEFAULT,['cost'=>12]);

            if(empty($first_name) || empty($last_name) || empty($password) || empty($phone) || empty($email)){
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
          $chquery = "SELECT * FROM users WHERE email=? AND status != 'deleted' OR phone=? AND status != 'deleted'";
          $chresult = $this->db->select($chquery,array('ss'),array(&$email,&$phone),array());
          if($chresult){
             $msg = "Email or Phone has been Registered";
             return $msg;
          }else{
              $query = "INSERT INTO `users`(`first_name`, `last_name`, `other_name`, `gender`, `date_of_birth`, `phone`, `residential_address`, `email`, `password`) VALUES (?,?,?,?,?,?,?,?,?)";
              $type = array('sssssisss');
              $result = $this->db->insert($query,$type,array(&$first_name,&$last_name,&$other_name,&$gender,&$date_of_birth,&$phone,&$residential_address,&$email,&$password_hash));             

                if ($result) {
                  $action = 'Added a User: '.$first_name.' '.$last_name .' '.$other_name;
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

    public function insertStore($post){

            $name = $this->fm->validation($post['name']);
            $store_type = $this->fm->validation($post['type']);
            $address = $this->fm->validation($post['address']);
            $country = $this->fm->validation($post['country']);
            $state = $this->fm->validation($post['state']);
            $city = $this->fm->validation($post['city']);

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
          $chquery = "SELECT * FROM stores WHERE name=? AND type=? AND address=? AND state=? AND city=? AND status != 'deleted'";
          $chresult = $this->db->select($chquery,array('sssss'),array(&$name,&$type,&$address,&$state,&$lga),array());
          if($chresult){
             $msg = "Warehouse Exist Already";
             return $msg;
          }else{
              $query = "INSERT INTO `stores`(`name`, `type`, `address`, `country`, `state`, `city`) VALUES (?,?,?,?,?,?)";
              $type = array('ssssss');
              $result = $this->db->insert($query,$type,array(&$name,&$store_type,&$address,&$country,&$state,&$city));             

                if ($result) {
                  $action = 'Added a Warehouse: '.$name.' ('.$address .', '.$state .' State)';
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

    public function insertSupplier($post){

              $name = $this->fm->validation($post['name']);
              $phone = $this->fm->validation($post['phone']);
              $email = $this->fm->validation($post['email']);
              $address = $this->fm->validation($post['address']);
              
              $name  = mysqli_real_escape_string($this->db->link, $name);
              $phone  = mysqli_real_escape_string($this->db->link, $phone);
              $email  = mysqli_real_escape_string($this->db->link, $email);
              $address  = mysqli_real_escape_string($this->db->link, $address);
              
              if(empty($name) || empty($phone)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
            //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
          //     $msg = "You are not authorized to perform this action!!!"; 
          //     return $msg;
          // }
            // elseif (!preg_match("/^[0-9 ]*$/",$phone)) {
            //     $msg = "Only numbers, allowed in phone";
            //     return $msg; 
            // }
            // elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //     $msg = "Invalid email format";
            //     return $msg; 
            // }
            else{
            $chquery = "SELECT * FROM suppliers WHERE supplier_name=? AND status != 'deleted'";
            $chresult = $this->db->select($chquery,array('s'),array(&$name),array());
            if($chresult){
               $msg = "Customer has been Registered, Please add a second or third name";
               return $msg;
            }
            else{
                $query = "INSERT INTO `suppliers`(`supplier_name`, `phone`, `email`, `address`) VALUES (?,?,?,?)";
                $type = array('ssss');
                $result = $this->db->insert($query,$type,array(&$name,&$phone,&$email,&$address));             

                  if ($result) {
                    $action = 'Added a Supplier: '.$name;
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

    public function assignUserRole($post){

              $user = $this->fm->validation($post['user']);
              $role = $this->fm->validation($post['role']);
              if (isset($post['warehouse'])) {
                $store = $this->fm->validation($post['warehouse']);
              }else{
                $store = 0;
              }
              
              $user  = mysqli_real_escape_string($this->db->link, $user);
              $role  = mysqli_real_escape_string($this->db->link, $role);
              $store  = mysqli_real_escape_string($this->db->link, $store);
              
              if(empty($user) ||  $role == null || $store == null){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
            //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
          //     $msg = "You are not authorized to perform this action!!!"; 
          //     return $msg;
          // }
              else{
              $chquery = "SELECT * FROM user_roles WHERE user_id=? AND store_id=? AND status != 'deleted'";
              $chresult = $this->db->select($chquery,array('ii'),array(&$user,&$store),array());
              if($chresult){
                 $msg = "User has been assigned a Role in Warehouse!";
                 return $msg;
              }else{
                $query = "INSERT INTO `user_roles`(`user_id`, `store_id`, `role`) VALUES (?,?,?)";
                $type = array('iii');
                $result = $this->db->insert($query,$type,array(&$user,&$store,&$role));             

                  if ($result) {

                    $action = 'Assigned a User Role: '. self::getRole($role) .' to '. self::getName('users','first_name','id',$user);
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
    public function insertProductCategory($post){

              $category = $this->fm->validation($post['category']);
              $category  = mysqli_real_escape_string($this->db->link, $category);
              
              if(empty($category)){
                $msg = "Enter a Category...";
                return $msg;
              }
            //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
          //     $msg = "You are not authorized to perform this action!!!"; 
          //     return $msg;
          // }
              else{
              $chquery = "SELECT * FROM product_categories WHERE title=? AND status != 'deleted'";
              $chresult = $this->db->select($chquery,array('s'),array(&$category),array());
              if($chresult){
                 $msg = "Product Category exist already";
                 return $msg;
              }else{
                $query = "INSERT INTO `product_categories`(`title`) VALUES (?)";
                $type = array('s');
                $result = $this->db->insert($query,$type,array(&$category));             

                  if ($result) {

                    $action = 'Added a Product Category: '. $category;
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
    public function insertInventoryCategory($post){

              $category = $this->fm->validation($post['category']);
              $category  = mysqli_real_escape_string($this->db->link, $category);
              
              if(empty($category)){
                $msg = "Enter a Category...";
                return $msg;
              }
            //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
          //     $msg = "You are not authorized to perform this action!!!"; 
          //     return $msg;
          // }
              else{
              $chquery = "SELECT * FROM inventory_categories WHERE title=? AND status != 'deleted'";
              $chresult = $this->db->select($chquery,array('s'),array(&$category),array());
              if($chresult){
                 $msg = "Inventory Category exist already";
                 return $msg;
              }else{
                $query = "INSERT INTO `inventory_categories`(`title`) VALUES (?)";
                $type = array('s');
                $result = $this->db->insert($query,$type,array(&$category));             

                  if ($result) {

                    $action = 'Added an Inventory Category: '. $category;
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
    public function insertProduct($post, $file){
     
              $filepath = realpath(dirname(__FILE__));
              $code = $this->fm->validation($post['product_code']);
              $name = $this->fm->validation($post['product_name']);
              $category = $this->fm->validation($post['category']);
              $units = $this->fm->validation($post['units']);
              $cost_price = $this->fm->validation($post['cost_price']);
              $unit_price = $this->fm->validation($post['unit_price']);
              $quantity = $this->fm->validation($post['quantity']);
              $alert_quantity = $this->fm->validation($post['alert_quantity']);
              $expiry_date = $this->fm->validation($post['expiry_date']);


              $code  = mysqli_real_escape_string($this->db->link, $code);
              $name  = mysqli_real_escape_string($this->db->link, $name);
              $category  = mysqli_real_escape_string($this->db->link, $category);
              $units  = mysqli_real_escape_string($this->db->link, $units);
              $cost_price  = mysqli_real_escape_string($this->db->link, $cost_price);
              $unit_price  = mysqli_real_escape_string($this->db->link, $unit_price);
              $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
              $alert_quantity  = mysqli_real_escape_string($this->db->link, $alert_quantity);
              $expiry_date  = mysqli_real_escape_string($this->db->link, $expiry_date);
              
              if(empty($name) || empty($category) || empty($units) || empty($unit_price) || empty($quantity) || empty($alert_quantity)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              else{
                $chquery = "SELECT * FROM products WHERE product_code=? AND product_name=? AND category=? AND status != 'deleted'";
                $chresult = $this->db->select($chquery,array('ssi'),array(&$code,&$name,&$category),array());
                if($chresult){
                   $msg = "Product exist already";
                   return $msg;
                }else{

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
                    $image_newname = 'IMG_'. $time .'.'.$image_type;
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

                  $query = "INSERT INTO `products`(`product_code`, `product_name`, `category`, `metric_units`, `cost_price`, `unit_price`, `quantity`, `alert_quantity`, `expiry_date`, `image`) VALUES (?,?,?,?,?,?,?,?,?,?)";
                  $type = array('ssisiiiiss');
                  $result = $this->db->insert($query,$type,array(&$code,&$name,&$category,&$units,&$cost_price,&$unit_price,&$quantity,&$alert_quantity,&$expiry_date,&$product_image));             

                    if ($result) {
                      $product_id = $result->insert_id;
                      $tracking_id = 'PID'. $tz->format('ymd-His') . sprintf("%04d", $product_id);

                      $upquery = "UPDATE `products` SET `tracking_id`=? WHERE `id`=?";
                      $upresult = $this->db->update($upquery,array('si'),array(&$tracking_id,&$product_id)); 

                      $action = 'Added a Product: '. $name;
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

    public function restockProduct($post){

              $product_id = $this->fm->validation($post['product']);
              $supplier = $this->fm->validation($post['supplier']);
              $batch_no = $this->fm->validation($post['batch_no']);
              $production_date = $this->fm->validation($post['production_date']);
              $expiry_date = $this->fm->validation($post['expiry_date']);
              $unit_price = $this->fm->validation($post['unit_price']);
              $quantity = $this->fm->validation($post['quantity']);
              $paid_amount = $this->fm->validation($post['paid_price']);
              if (isset($post['other_payment']) && !empty($post['other_payment'])) {
                $payment_method = $this->fm->validation($post['other_payment']);
              }else{
                $payment_method = $this->fm->validation($post['payment_method']);
              }

              $product_id  = mysqli_real_escape_string($this->db->link, $product_id);
              $supplier  = mysqli_real_escape_string($this->db->link, $supplier);
              $batch_no  = mysqli_real_escape_string($this->db->link, $batch_no);
              $production_date  = mysqli_real_escape_string($this->db->link, $production_date);
              $expiry_date  = mysqli_real_escape_string($this->db->link, $expiry_date);
              $unit_price  = mysqli_real_escape_string($this->db->link, $unit_price);
              $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
              $paid_amount  = mysqli_real_escape_string($this->db->link, $paid_amount);
              $payment_method  = mysqli_real_escape_string($this->db->link, $payment_method);
              $total = floatval($unit_price * $quantity);
              
              if(empty($product_id) || empty($supplier) || empty($unit_price) || empty($quantity)){
                $msg = "Some required Fields are Empty..."; 
                return $msg;
              }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              else{

                $query1 = "INSERT INTO `incoming_products`(`product_id`, `supplier_id`, `batch_no`, `production_date`, `expiry_date`, `available_quantity`, `supplied_quantity`, `unit_price`, `total_price`) VALUES (?,?,?,?,?,?,?,?,?)";
                $type1 = array('iisssiidd');
                $result1 = $this->db->insert($query1,$type1,array(&$product_id,&$supplier,&$batch_no,&$production_date,&$expiry_date,&$quantity,&$quantity,&$unit_price,&$total));             

                  if ($result1) { 
                    $supply_id = $result1->insert_id;
                    $supply_no = 'ES' . sprintf("%06d", $supply_id);
                    $metric_units = self::getName('products','metric_units','id',$product_id);
                    $product_name = self::getName('products','product_name','id',$product_id);
                    $supplier_name = self::getName('suppliers','supplier_name','id',$supplier);

                    $expense = array(
                      "item_table" => "incoming_products",
                      "item_id" => $supply_id,
                      "category" => "Expense",
                      "purpose" => "Purchase of ". $quantity ." ". $metric_units ." of ". $product_name ." from ". $supplier_name,
                      "amount" => $paid_amount,
                      "payment_method" => $payment_method
                    );

                    $finance_status = self::insertFinance($expense);

                    $query2 = "UPDATE `incoming_products` SET `supply_id`=? WHERE `id`=?";
                    $result2 = $this->db->update($query2,array('si'),array(&$supply_no,&$supply_id)); 
                    $action = 'Restocked a Product: '. $product_name;
                    self::logActivity($action);

                    $msg = "Success";
                    return $msg;
                  }else{
                    $msg = "An Error Occurred";
                    return $msg;
                  }
               
              
             }
      }

      public function placeOrder($post){
        
                $warehouse = $this->fm->validation($post['warehouse']);
                $delivery_date = $this->fm->validation($post['delivery_date']);
                $discount = $this->fm->validation(floatval($post['discount']));
                $paid_amount = $this->fm->validation(floatval($post['paid']));
                $customer = $this->fm->validation(floatval($post['supplier']));

                if (isset($post['other_payment']) && !empty($post['other_payment'])) {
                  $payment_method = $this->fm->validation($post['other_payment']);
                }else{
                  $payment_method = $this->fm->validation($post['payment_method']);
                }

                $warehouse  = mysqli_real_escape_string($this->db->link, $warehouse);
                $delivery_date  = mysqli_real_escape_string($this->db->link, $delivery_date);
                $discount  = mysqli_real_escape_string($this->db->link, $discount);
                $paid_amount  = mysqli_real_escape_string($this->db->link, $paid_amount);
                $payment_method  = mysqli_real_escape_string($this->db->link, $payment_method);
                $customer  = mysqli_real_escape_string($this->db->link, $customer);
                if ($delivery_date==''){
                  $delivery_date = date("Y-m-d");
                }else{
                  $delivery_date = $delivery_date;
                }
                if(empty($warehouse)){
                  $msg = "Select a Warehouse...";
                  return $msg;
                }
                //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
              //     $msg = "You are not authorized to perform this action!!!"; 
              //     return $msg;
              // }
                else{

                  $query1 = "INSERT INTO `orders`(`warehouse_id`, `supplier_id`, `delivery_date`, `order_type`) VALUES(?,?,?,'New Sales')";
                  $type1 = array('iis');
                  $result1 = $this->db->insert($query1,$type1,array(&$warehouse,&$customer,&$delivery_date)); 

                  if ($result1) {
                    $order_id = $result1->insert_id;
                    $invoice_id = 'EO' . sprintf("%06d", $order_id);
                    $total = 0.00;

                    for ($i=0; $i < count($post['product']); $i++) {
                      $product = $this->fm->validation($post['product'][$i]);
                      $unit_price = $this->fm->validation(floatval($post['unit_price'][$i]));
                      $quantity = $this->fm->validation($post['quantity'][$i]);

                      $product  = mysqli_real_escape_string($this->db->link, $product);
                      $unit_price = mysqli_real_escape_string($this->db->link, $unit_price);
                      $quantity  = mysqli_real_escape_string($this->db->link, $quantity);

                      $subtotal = floatval($unit_price * $quantity);
                      $total += $subtotal;

                      $query2 = "INSERT INTO `order_items`(`order_id`, `product_price_id`, `unit_price`, `quantity`, `subtotal`) VALUES (?,?,?,?,?)";
                      $type2 = array('iidid');
                      $result2 = $this->db->insert($query2,$type2,array(&$order_id,&$product,&$unit_price,&$quantity,&$subtotal));

                      if ($result2) {
 
                        $query3 = "UPDATE `products` SET `quantity`= `quantity`- $quantity WHERE `id`=? AND `status` != 'deleted'";
                        $result3 = $this->db->update($query3,array('i'),array(&$product));
                      }

                    }

                    $grand_total = floatval($total - $discount);


                    $query4 = "UPDATE `orders` SET `invoice_id`=?, `subtotal`=?, `discount`=?, `total`=? WHERE `id`=?";
                    $result4 = $this->db->update($query4,array('sdddi'),array(&$invoice_id,&$total,&$discount,&$grand_total,&$order_id));             

                      if ($result4) {

                        $customer_name = self::getName('suppliers','supplier_name','id',$customer);
                        if ($paid_amount > 0.00) {

                          $post_data = array(
                            "order" => $order_id,
                            "paid_amount" => $paid_amount,
                            "payment_method" => $payment_method
                          );

                          // $payment_id = self::insertOrderPayment($post_data, 'initial');

                          $income = array(
                            "item_table" => "orders",
                            "item_id" => $order_id,
                            "category" => "Income",
                            "purpose" => "Payment for ". count($post['product']) ." Items by ". $customer_name .". Invoice No. ". $invoice_id,
                            "amount" => $paid_amount,
                            "payment_method" => $payment_method
                          );

                          $finance_status = self::insertFinance($income); 
                          
                        }

                        $action = 'Sales made to: '. $customer_name;
                        self::logActivity($action);

                        $msg = $order_id;
                        return $msg;
                      }else{
                        $msg = "An Error Occurred";
                        return $msg;
                      }

                    }
      
                
               }
        }

      public function outstandingOrder($post){

                $warehouse = $this->fm->validation($post['warehouse']);
                $delivery_date = $this->fm->validation($post['delivery_date']);
                $discount = $this->fm->validation(floatval($post['discount']));
                $paid_amount = $this->fm->validation(floatval($post['paid']));

                if (isset($post['other_payment']) && !empty($post['other_payment'])) {
                  $payment_method = $this->fm->validation($post['other_payment']);
                }else{
                  $payment_method = $this->fm->validation($post['payment_method']);
                }

                $warehouse  = mysqli_real_escape_string($this->db->link, $warehouse);
                $delivery_date  = mysqli_real_escape_string($this->db->link, $delivery_date);
                $discount  = mysqli_real_escape_string($this->db->link, $discount);
                $paid_amount  = mysqli_real_escape_string($this->db->link, $paid_amount);
                $payment_method  = mysqli_real_escape_string($this->db->link, $payment_method);

                if(empty($warehouse)){
                  $msg = "Select a Warehouse...";
                  return $msg;
                }
                //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
              //     $msg = "You are not authorized to perform this action!!!"; 
              //     return $msg;
              // }
                else{

                  $query1 = "INSERT INTO `orders`(`warehouse_id`, `delivery_date`, `order_type`, `status`) VALUES(?,?,'Outstanding Order', 'Delivered')";
                  $type1 = array('is');
                  $result1 = $this->db->insert($query1,$type1,array(&$warehouse,&$delivery_date)); 

                  if ($result1) {
                    $order_id = $result1->insert_id;
                    $invoice_id = 'EO' . sprintf("%06d", $order_id);
                    $total = 0.00;

                    for ($i=0; $i < count($post['product']); $i++) {
                      $product = $this->fm->validation($post['product'][$i]);
                      $unit_price = $this->fm->validation(floatval($post['unit_price'][$i]));
                      $quantity = $this->fm->validation($post['quantity'][$i]);

                      $product  = mysqli_real_escape_string($this->db->link, $product);
                      $unit_price = mysqli_real_escape_string($this->db->link, $unit_price);
                      $quantity  = mysqli_real_escape_string($this->db->link, $quantity);

                      $subtotal = floatval($unit_price * $quantity);
                      $total += $subtotal;

                      $query2 = "INSERT INTO `order_items`(`order_id`, `product_price_id`, `unit_price`, `quantity`, `subtotal`) VALUES (?,?,?,?,?)";
                      $type2 = array('iidid');
                      $result2 = $this->db->insert($query2,$type2,array(&$order_id,&$product,&$unit_price,&$quantity,&$subtotal));

                      // if ($result2) {

                      //   $query3 = "UPDATE `incoming_products` SET `available_quantity`= `available_quantity`- $quantity WHERE `id`=? AND `status` != 'deleted'";
                      //   $result3 = $this->db->update($query3,array('i'),array(&$product));
                      // }

                    }

                    $grand_total = floatval($total - $discount);


                    $query4 = "UPDATE `orders` SET `invoice_id`=?, `subtotal`=?, `discount`=?, `total`=? WHERE `id`=?";
                    $result4 = $this->db->update($query4,array('sdddi'),array(&$invoice_id,&$total,&$discount,&$grand_total,&$order_id));             

                      if ($result4) {

                        $warehouse_name = self::getName('stores','name','id',$warehouse);
                        if ($paid_amount > 0.00) {

                          $post_data = array(
                            "order" => $order_id,
                            "paid_amount" => $paid_amount,
                            "payment_method" => $payment_method
                          );

                          // $payment_id = self::insertOrderPayment($post_data, 'initial');

                          $income = array(
                            "item_table" => "orders",
                            "item_id" => $order_id,
                            "category" => "Income",
                            "purpose" => "Payment for ". count($post['product']) ." Items by ". $warehouse_name .". Order No. ". $invoice_id,
                            "amount" => $paid_amount,
                            "payment_method" => $payment_method
                          );

                          $finance_status = self::insertFinance($income); 
                          
                        }

                        $action = 'Placed an Outstanding Order for: '. $warehouse_name;
                        self::logActivity($action);

                        $msg = $order_id;
                        return $msg;
                      }else{
                        $msg = "An Error Occurred";
                        return $msg;
                      }

                    }
      
                
               }
        }

    public function insertOrderPayment($post){

              $order = $this->fm->validation($post['order']);
              $amount = $this->fm->validation(floatval($post['paid_amount']));
              if (isset($post['other_payment']) && !empty($post['other_payment'])) {
                $payment_method = $this->fm->validation($post['other_payment']);
              }else{
                $payment_method = $this->fm->validation($post['payment_method']);
              }

              $order  = mysqli_real_escape_string($this->db->link, $order);
              $amount  = mysqli_real_escape_string($this->db->link, $amount);
              $payment_method  = mysqli_real_escape_string($this->db->link, $payment_method);
              
              if(empty($order) || empty($amount) || empty($payment_method)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              else{

                // $query = "INSERT INTO `order_payments`(`order_id`, `amount`, `payment_method`) VALUES  (?,?,?)";
                // $type = array('ids');
                // $result = $this->db->insert($query,$type,array(&$order,&$amount,&$payment_method));

                $order_no = self::getName('orders','invoice_id','id',$order);
                $cid = self::getName('orders','supplier_id','id',$order);
                $customer_name = self::getName('suppliers','supplier_name','id',$cid);

                // if ($result) {
                  // $payment_id = $result->insert_id;

                  // if ($step == 'add') {
                    $income = array(
                      "item_table" => "orders",
                      "item_id" => $order,
                      "category" => "Income",
                      "purpose" => "Payment Made for Order No. ". $order_no .". By ". $customer_name,
                      "amount" => $amount,
                      "payment_method" => $payment_method
                    );
                    
                    $finance_status = self::insertFinance($income);             
                  // }else{
                  //   return $payment_id;
                  // }

                if ($finance_status == 'Success') {
                  $action = 'Added an Payment to Order No.'. $order_no ;
                  self::logActivity($action);

                  $msg = "Success";
                  return $msg;
                }else{
                  $msg = "An Error Occurred";
                  return $msg;
                }
               
              
             }
      }
    public function insertSupplyPayment($post){

              $supply = $this->fm->validation($post['supply']);
              $amount = $this->fm->validation(floatval($post['paid_amount']));
              if (isset($post['other_payment']) && !empty($post['other_payment'])) {
                $payment_method = $this->fm->validation($post['other_payment']);
              }else{
                $payment_method = $this->fm->validation($post['payment_method']);
              }

              $supply  = mysqli_real_escape_string($this->db->link, $supply);
              $amount  = mysqli_real_escape_string($this->db->link, $amount);
              $payment_method  = mysqli_real_escape_string($this->db->link, $payment_method);
              
              if(empty($supply) || empty($amount) || empty($payment_method)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              else{

                $supply_no = self::getName('incoming_products','supply_id','id',$supply);
                $sid = self::getName('incoming_products','supplier_id','id',$supply);
                $supplier_name = self::getName('suppliers','supplier_name','id',$sid);


                  $income = array(
                    "item_table" => "incoming_products",
                    "item_id" => $supply,
                    "category" => "Expense",
                    "purpose" => "Added Payment to Supply No. ". $supply_no ." to ". $supplier_name,
                    "amount" => $amount,
                    "payment_method" => $payment_method
                  );
                  
                  $finance_status = self::insertFinance($income);

                if ($finance_status == 'Success') {
                  $action = 'Added a supply payment to Supply No.'. $supply_no ;
                  self::logActivity($action);

                  $msg = "Success";
                  return $msg;
                }else{
                  $msg = "An Error Occurred";
                  return $msg;
                }
               
              
             }
      }
    public function insertFinance($post){

              $item_table = $this->fm->validation($post['item_table']);
              $item_id = $this->fm->validation($post['item_id']);
              $category = $this->fm->validation($post['category']);
              $purpose = $this->fm->validation($post['purpose']);
              $amount = $this->fm->validation($post['amount']);
              if (isset($post['other_payment']) && !empty($post['other_payment'])) {
                $payment_method = $this->fm->validation($post['other_payment']);
              }else{
                $payment_method = $this->fm->validation($post['payment_method']);
              }


              $item_table  = mysqli_real_escape_string($this->db->link, $item_table);
              $item_id  = mysqli_real_escape_string($this->db->link, $item_id);
              $category  = mysqli_real_escape_string($this->db->link, $category);
              $purpose  = mysqli_real_escape_string($this->db->link, $purpose);
              $amount  = mysqli_real_escape_string($this->db->link, $amount);
              $payment_method  = mysqli_real_escape_string($this->db->link, $payment_method);
              
              if(empty($category) || empty($purpose) || empty($amount) || empty($payment_method)){
                $msg = "Some required Fields are Empty...";
                return $msg;
              }
              //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
            //     $msg = "You are not authorized to perform this action!!!"; 
            //     return $msg;
            // }
              else{

                $query = "INSERT INTO `finances`(`table_name`, `item_id`, `category`, `purpose`, `amount`, `payment_method`) VALUES (?,?,?,?,?,?)";
                $type = array('sissds');
                $result = $this->db->insert($query,$type,array(&$item_table,&$item_id,&$category,&$purpose,&$amount,&$payment_method));             

                  if ($result) { 

                    $action = 'Added an '. $category .' to Finance: '. $this->fm->limit_words($purpose, 10) .'...';
                    self::logActivity($action);

                    $msg = "Success";
                    return $msg;
                  }else{
                    $msg = "An Error Occurred";
                    return $msg;
                  }
               
              
             }
      }


      public function insertInventoryItem($post){

                $name = $this->fm->validation($post['item_name']);
                $category = $this->fm->validation($post['category']);
                $quantity = $this->fm->validation($post['quantity']);

                $name  = mysqli_real_escape_string($this->db->link, $name);
                $category  = mysqli_real_escape_string($this->db->link, $category);
                $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
                
                if(empty($name) || empty($category) || empty($quantity)){
                  $msg = "Some required Fields are Empty...";
                  return $msg;
                }
                //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
              //     $msg = "You are not authorized to perform this action!!!"; 
              //     return $msg;
              // }
                else{
                  $chquery = "SELECT * FROM inventories WHERE item_name=? AND category_id=? AND status != 'deleted'";
                  $chresult = $this->db->select($chquery,array('si'),array(&$name,&$category),array());
                  if($chresult){
                     $msg = "Inventory Item exist already";
                     return $msg;
                  }else{

                    $query = "INSERT INTO `inventories`(`item_name`, `category_id`, `quantity`) VALUES (?,?,?)";
                    $type = array('sii');
                    $result = $this->db->insert($query,$type,array(&$name,&$category,&$quantity));             

                      if ($result) {

                        $action = 'Added an Inventory Item: '. $name;
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

      public function insertItemHistory($post){

                $item = $this->fm->validation($post['item_id']);
                $warehouse = $this->fm->validation($post['warehouse']);
                $date_taken = $this->fm->validation($post['date_taken']);
                $quantity_taken = $this->fm->validation($post['quantity_taken']);

                $item  = mysqli_real_escape_string($this->db->link, $item);
                $warehouse  = mysqli_real_escape_string($this->db->link, $warehouse);
                $date_taken  = mysqli_real_escape_string($this->db->link, $date_taken);
                $quantity_taken  = mysqli_real_escape_string($this->db->link, $quantity_taken);
                
                if(empty($item) || empty($warehouse) || empty($date_taken) || empty($quantity_taken)){
                  $msg = "Some required Fields are Empty...";
                  return $msg;
                }
                //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
              //     $msg = "You are not authorized to perform this action!!!"; 
              //     return $msg;
              // }
                else{

                    $query = "INSERT INTO `inventory_history`(`item_id`, `warehouse_id`, `date_taken`, `quantity_taken`) VALUES (?,?,?,?)";
                    $type = array('iisi');
                    $result = $this->db->insert($query,$type,array(&$item,&$warehouse,&$date_taken,&$quantity_taken));             
                    if ($result) {

                      $item_name = self::getName('inventories', 'item_name', 'id', $item);
                      $warehouse_name = self::getName('stores', 'name', 'id', $warehouse);
                      $action = 'Released '. $quantity_taken .' '. $item_name .' from Inventory Items to: '. $warehouse_name;
                      self::logActivity($action);

                      $msg = "Success";
                      return $msg;
                    }else{
                      $msg = "An Error Occurred";
                      return $msg;
                    }
                
               }
        }

      public function insertRequest($post){

                $warehouse = $this->fm->validation($post['warehouse']);
                $category = $this->fm->validation($post['category']);
                $description = $this->fm->validation($post['description']);

                $warehouse  = mysqli_real_escape_string($this->db->link, $warehouse);
                $category  = mysqli_real_escape_string($this->db->link, $category);
                $description  = mysqli_real_escape_string($this->db->link, $description);
                
                if(empty($warehouse) || empty($category) || empty($description)){
                  $msg = "Some required Fields are Empty...";
                  return $msg;
                }
                //    elseif ($admin != ('Software Developer' || 'System Admnistrator')) {
              //     $msg = "You are not authorized to perform this action!!!"; 
              //     return $msg;
              // }
                else{

                    $query = "INSERT INTO `requests`(`warehouse_id`, `category`, `description`) VALUES (?,?,?)";
                    $type = array('iss');
                    $result = $this->db->insert($query,$type,array(&$warehouse,&$category,&$description));             
                    if ($result) {

                      $warehouse_name = self::getName('stores', 'name', 'id', $warehouse);
                      $action = $warehouse_name .'Sent a Request: '. $category .': '. $this->fm->limit_words($description, 10) .'...';
                      self::logActivity($action);

                      $msg = "Success";
                      return $msg;
                    }else{
                      $msg = "An Error Occurred";
                      return $msg;
                    }
                
               }
        }

    public function getRole($role){
      $roleArray = array('System Administrator', 'Administrator', 'Manager', 'Sales');
      return $roleArray[$role];
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
    
    public function reArrayFiles(&$file_post) {

      $file_ary = array();
      $file_count = count($file_post['name']);
      $file_keys = array_keys($file_post);

      for ($i=0; $i < $file_count; $i++) {
          foreach ($file_keys as $key) {
              $file_ary[$i][$key] = $file_post[$key][$i];
          }
      }

      return $file_ary;
    }
    public function cropImage($cropped_name,$image_type,$image_rename) {
        $file_ext = $new_img_ext = "";

        if ($image_type == 'png') {
          $img_ext = imagecreatefrompng($image_rename);
        }
        elseif ($image_type == 'gif') {
          $img_ext = imagecreatefromgif($image_rename);
        }
        else{
          $img_ext = imagecreatefromjpeg($image_rename);
        }

        
        $im = $img_ext;
        $size = min(imagesx($im),imagesy($im));

        $im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => 700, 'height' => 500]);
        if ($im2 !== FALSE) {
          //header("Content-type: image/jpeg");

          if ($image_type == 'png') {
            $new_img_ext = imagepng($im2, $cropped_name);
          }
          elseif ($image_type == 'gif') {
            $new_img_ext = imagegif($im2, $cropped_name);
          }
          else{
            $new_img_ext = imagejpeg($im2, $cropped_name);
          }

          //$new_img_ext;
          imagedestroy($im2);
        }
        imagedestroy($im);
      }

    public function randomID($size){
          $digits = date('y', time()).'-';
          $length = $size - strlen($digits);
          $numbers = range(0,9);

          shuffle($numbers);
          for($i = 0; $i < $length; $i++){
              $digits .= $numbers[$i];
          }
          return $digits;
      }
      public function randomID2($size){
          $digits = date('y', time());
          $length = $size - strlen($digits);
          $numbers = range(0,9);

          shuffle($numbers);
          for($i = 0; $i < $length; $i++){
              $digits .= $numbers[$i];
          }
          return $digits;
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
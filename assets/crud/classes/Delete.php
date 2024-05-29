<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath."/../lib/Database.php");
  include_once ($filepath."/../helpers/format.php");
  include_once ($filepath."/../lib/Session.php");
?>
<?php
   class Delete 
  {
	  	private $db;
	  	private $fm;
	  	
	  	function __construct()
	  	{
	  		$this->db = new Database();
	  		$this->fm = new Format();
	  	}

    public function deleteTemporary($table,$field,$id){

        $id = $this->fm->validation($id);
        $id = mysqli_real_escape_string($this->db->link, $id);
        
        $updated_date = date('Y-m-d H:i:s', time());

        $query = "UPDATE $table SET status = 'deleted', updated_date=? WHERE $field = ?";
        $type = array('si');
        $result = $this->db->update($query,$type,array(&$updated_date,&$id));

        if($result){
             self::logDelete($table, 'id', $id);
          $msg = "Deleted";
          return $msg;
        }else{
         $msg = "Error";
         return $msg;
        }
    }

    public function deleteTemporaryTwoMatches($table,$col1,$col1_value,$col2,$col2_value){

        $col1_value = $this->fm->validation($col1_value);
        $col2_value = $this->fm->validation($col2_value);

        $col1_value = mysqli_real_escape_string($this->db->link, $col1_value);
        $col2_value = mysqli_real_escape_string($this->db->link, $col2_value);
        
        $updated_date = date('Y-m-d H:i:s', time());

        $query = "UPDATE $table SET status = 'deleted', updated_date=? WHERE $col1 = ? AND $col2 = ?";
        $type = array('sii');
        $result = $this->db->update($query,$type,array(&$updated_date,&$col1_value,&$col2_value));

        if($result){
          self::logDelete($table, $col1, $col1_value);
          // self::logDelete($table, $col2, $col2_value);
          $msg = "Deleted";
          return $msg;
        }else{
         $msg = "Error";
         return $msg;
        }
    }

    public function deleteTemporaryWithChild($parent_table,$parent_id,$parent_field,$child_table,$child_field){
        
        $parent_id = $this->fm->validation($parent_id);
        $parent_id = mysqli_real_escape_string($this->db->link, $parent_id);

        $result1 = self::deleteTemporary($parent_table,'id',$parent_id);
        if ($result1 == "Deleted") {
            $query = "SELECT $parent_field FROM $parent_table WHERE id=?";
            $result2 = $this->db->select($query,array('i'),array(&$parent_id),array());
            
            if ($result2) {
              $value = $result2->fetch_assoc();
              $child_id = $value[$parent_field];
              
              self::deleteTemporary($child_table,$child_field,$child_id);

            }
              $msg = "Deleted";
              return $msg;
        }else{
          $msg = "Error";
          return $msg;
        }
    }

    public function deleteTemporaryWithTwoChildNode($parent_table,$parent_id,$parent_field,$child_table1,$child_field1,$child_table2,$child_field2){

        $parent_id = $this->fm->validation($parent_id);
        $parent_id = mysqli_real_escape_string($this->db->link, $parent_id);
        
        $result1 = self::deleteTemporary($parent_table,'id',$parent_id);
        if ($result1 == "Deleted") {
            $query = "SELECT $parent_field FROM $parent_table WHERE id=?";
            $result2 = $this->db->select($query,array('i'),array(&$parent_id),array());
            
            if ($result2) {
              $value = $result2->fetch_assoc();
              $child_id = $value[$parent_field];
              
              self::deleteTemporary($child_table1,$child_field1,$child_id);
              self::deleteTemporary($child_table2,$child_field2,$child_id);

            }
              $msg = "Deleted";
              return $msg;
        }else{
          $msg = "Error";
          return $msg;
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

    public function logDelete($table,$field,$id){

      $action = $name = '';
      $query = "SELECT * FROM $table WHERE $field=? LIMIT 1";
      $result = $this->db->select($query,array('i'),array(&$id),array());
      
      if ($result) {
        $value = $result->fetch_assoc();
      
          switch ($table) {
            case 'users':
              $name .= $value['first_name'].' '.$value['last_name'].' '.$value['other_name'];
              $action .= "Deleted a User: ".$name;
              break;

            case 'stores':
              $name .= $value['name'];
              $action .= "Deleted a Warehouse: ".$name;
              break;

            case 'user_roles':
              $roleArray = array('System Administrator', 'Administrator', 'Manager', 'Sales');
              $name .= $roleArray[$value['role']];
              $action .= "Removed a Role: ".$name;
              break;

            case 'suppliers':
              $name .= $value['supplier_name'];
              $action .= "Deleted a Supplier: ".$name;
              break;

            case 'products':
              $name .= $value['product_name'];
              $action .= "Deleted a Product: ".$name;
              break;

            case 'inventories':
              $name .= $value['item_name'];
              $action .= "Deleted an Inventory Item: ".$name;
              break;

            case 'product_categories':
              $name .= $value['title'];
              $action .= "Deleted a Product Category: ".$name;
              break;

            case 'inventory_categories':
              $name .= $value['title'];
              $action .= "Deleted an Inventory Category: ".$name;
              break;
            
            case 'orders':
              $name .= $value['id'];
              $order_no = self::getName('orders','invoice_id','id',$order);
              $cid = self::getName('orders','supplier_id','id',$order);
              $name = self::getName('suppliers','supplier_name','id',$cid);

              $action .= "Deleted an Order for Order No: ". $order .", Order by: ".$name;
              break;

            case 'order_payments':
              $order = $value['id'];
              $deleteFinance = self::deleteTemporaryTwoMatches('finances','table_name',$table,'item_id',$order);

              $order_no = self::getName('orders','invoice_id','id',$order);
              $wid = self::getName('orders','warehouse_id','id',$order);
              $name = self::getName('stores','name','id',$wid);

              $action .= "Deleted an Order Payment for Order No ". $order_no .", Payment by". $name;
              break;

            case 'finances':
              $name .= $value['category'];
              $action .= "Deleted an ". $name ." Financial Statement: ". $value['purpose'];
              break;

            case 'inventory_history':
              // $name .= $value['quantity'];
              $item_name = self::getName('inventories', 'item_name', 'id', $value['item_id']);
              $warehouse_name = self::getName('stores', 'name', 'id', $value['warehouse_id']);

              $action .= "Deleted ". $item_name ." history from ". $warehouse_name;
              break;

            case 'requests':
              $name .= $value['category'];
              $warehouse_name = self::getName('stores', 'name', 'id', $value['warehouse_id']);
              $action .= "Deleted a Request ". $name ." by: ". $warehouse_name;
              break;

            case 'returned_orders':
              $name .= self::getName('stores', 'name', 'id', $value['warehouse_id']);
              $action .= "Deleted a Returned Order from ". $name;
              break;
            
            default:
              $name = ucwords(str_replace('_', ' ', $table));
              $action .= "Deleted From ".$name ." at ID ".$id;
              break;
          }

       }

      $user = Session::get('user_fullname');
      $user_id = Session::get('userid');

        $query2 = "INSERT INTO activities (user_id,user,activity) VALUES(?,?,?)";
        $type2 = array('iss');
        $result2 = $this->db->insert($query2,$type2,array(&$user_id,&$user,&$action));
        
        if ($result2) {
          return true;
        }

    }
  }
?>
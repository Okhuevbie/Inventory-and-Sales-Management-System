<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath."../../lib/Database.php");
  include_once ($filepath."../../helpers/format.php");
  include_once ($filepath."/../lib/Session.php");

   class Counter 
  {
      private $db;
      private $fm;
      
      function __construct()
      {
        $this->db = new Database();
        $this->fm = new Format();
      }
      public function countAll($table){

          $query = "SELECT COUNT(*) As total_num FROM $table";
          $result = $this->db->select($query,array(),array(),array());
          if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function countExcludingDeleted($table){

          $query = "SELECT COUNT(*) As total_num FROM $table WHERE status != 'deleted'";
          $result = $this->db->select($query,array(),array(),array());
          if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function countExcluding($table,$where,$value){

          $query = "SELECT COUNT(*) As total_num FROM $table WHERE $where != ?";
          $result = $this->db->select($query,array('s'),array(&$value),array());
          if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function countWhereExcludingDeleted($table,$where,$value){

          $query = "SELECT COUNT(*) As total_num FROM $table WHERE $where = ? AND status != 'deleted'";
          $result = $this->db->select($query,array('s'),array(&$value),array());
          if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function sumExcludingDeleted($table,$sum_field){

          $query = "SELECT SUM($sum_field) As total_sum FROM $table WHERE status != 'deleted'";
          $result = $this->db->select($query,array(),array(),array());
          if($result){
            $getTotalSum = mysqli_fetch_assoc($result);
            $getTotalSum = $getTotalSum['total_sum'];
            return $getTotalSum;
          }
          else{
            return false;
          }
      }
      public function sumWhereExcludingDeleted($table,$sum_field,$where,$value){

          $query = "SELECT SUM($sum_field) As total_sum FROM $table WHERE $where = ? AND status != 'deleted'";
          $result = $this->db->select($query,array('s'),array(&$value),array());
          if($result){
            $getTotalSum = mysqli_fetch_assoc($result);
            $getTotalSum = $getTotalSum['total_sum'];
            return $getTotalSum;
          }
          else{
            return false;
          }
      }
      public function sumTwoMatchExcludingDeleted($table,$sum_field,$col1,$value1,$col2,$value2){
          $query = "SELECT SUM($sum_field) As total_sum FROM $table WHERE $col1=? AND $col2 = ? AND status != 'deleted'";
          $result = $this->db->select($query,array('ss'),array(&$value1,&$value2),array());

          if($result){
            $getTotalSum = $result->fetch_assoc();
            // $getTotalSum = mysqli_fetch_assoc($result);
            $getTotalSum = $getTotalSum['total_sum'];
            return $getTotalSum;
          }
          else{
            return false;
          }
      }
      public function sumMatchThreeExcludingDeleted($table,$sum_field,$col1,$col1_value,$col2,$col2_value,$col3,$col3_value){

          $query = "SELECT SUM($sum_field) As total_sum FROM $table WHERE $col1 = ? AND $col2 = ? AND $col3 = ? AND status != 'deleted'";
          $result = $this->db->select($query,array('sss'),array(&$col1_value,&$col2_value,&$col3_value),array());
          if($result){
            $getTotalSum = mysqli_fetch_assoc($result);
            $getTotalSum = $getTotalSum['total_sum'];
            return $getTotalSum;
          }
          else{
            return false;
          }
      }
      public function sumAvailableProducts($product){

          $query = "SELECT quantity FROM products WHERE id = ? AND status = 'Active' AND expiry_date = '0000-00-00' OR id = ? AND status = 'Active' AND expiry_date > CURRENT_DATE";
          $result = $this->db->select($query,array('ss'),array(&$product,&$product),array());
          if($result){
            $getQuantity = mysqli_fetch_assoc($result);
            $getQuantity = $getQuantity['quantity'];
            return $getQuantity;
          }
          else{
            return false;
          }
      }
      public function sumExpiredProducts(){

        $query = "SELECT COUNT('expiry_date') AS total_expired FROM products WHERE  status = 'Active' AND expiry_date < CURRENT_DATE  AND expiry_date != '0000-00-00'";
        $result = $this->db->select($query,array(),array(),array());
        if($result){
          $getExpiredQuantity = mysqli_fetch_assoc($result);
          $getExpiredQuantity = $getExpiredQuantity['total_expired'];
          return $getExpiredQuantity;
        }
        else{
          return false;
        }
    }
      // public function countWhereAndExcluding($table,$where,$where_value,$exclude,$exclude_value){

      //     $query = "SELECT COUNT(*) As total_num FROM $table WHERE $where = ? AND $exclude != ?";
      //     $result = $this->db->select($query,array('ss'),array(&$where_value,&$exclude_value),array());
      //     if($result){
      //       $getTotal = mysqli_fetch_assoc($result);
      //       $getTotal = $getTotal['total_num'];
      //       return $getTotal;
      //     }
      //     else{
      //       return false;
      //     }
      // }
      public function countHereAndThere($table,$here,$here_value,$there,$there_value){

          $query = "SELECT COUNT(*) As total_num FROM $table WHERE $here = ? AND $there = ? ";
          $result = $this->db->select($query,array('ss'),array(&$here_value,&$there_value),array());
          if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function countNotHere($table,$where,$value){

          $query = "SELECT COUNT(*) As total_num FROM $table WHERE $where != ? AND status != 'deleted' ";
          $result = $this->db->select($query,array('s'),array(&$value),array());
          if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function countHereAndThereExcludingDeleted($table,$here,$here_value,$there,$there_value){

          $query = "SELECT COUNT(*) As total_num FROM $table WHERE $here = ? AND $there = ? AND status != 'deleted'";
          $result = $this->db->select($query,array('ss'),array(&$here_value,&$there_value),array());
          if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function countTwoMatchAndInExcludingDeleted($table,$col1,$col1_value,$col2,$col2_value,$in_col,$in_value){

          $query = "SELECT COUNT(*) As total_num FROM $table WHERE $col1 = ? AND $col2 = ? AND $in_col IN  (?) AND status != 'deleted'";
          $result = $this->db->select($query,array('sss'),array(&$col1_value,&$col2_value,&$in_value),array());
          if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function countThreeMatchesExcludingDeleted($table,$col1,$col1_value,$col2,$col2_value,$col3,$col3_value){


          $query = "SELECT COUNT(*) As total_num FROM $table WHERE $col1 = ? AND $col2 = ? AND $col3 = ? AND status != 'deleted'";
          $result = $this->db->select($query,array('sss'),array(&$col1_value,&$col2_value,&$col3_value),array());
          if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function countIDwithJoinedAndDoubleOrderExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$where_table,$where_column,$where_value){

        $query = "SELECT COUNT(*)  AS total_num FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$where_table`.`$where_column` = ? AND `$table1`.`status` != 'deleted'";
        $result = $this->db->select($query,array('s'),array(&$where_value),array());
        if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function countIDwithJoinedAndInExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$where_table,$where_column,$where_value,$in_table,$in_col,$in_value){

        $query = "SELECT COUNT(*)  AS total_num FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$in_table`.`$in_col` IN ($in_value) AND `$where_table`.`$where_column` = ? AND `$table1`.`status` != 'deleted'";
        $result = $this->db->select($query,array('s'),array(&$where_value),array());
        if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function countDistinctTwoMatchExcludeDeleted($table,$field,$col1,$col1_value,$col2,$col2_value){
          
          $query = "SELECT COUNT(DISTINCT $field) AS total_num FROM $table WHERE $col1 = ? AND $col2 = ? AND status != 'deleted'";
          $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
          if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      public function countDistinctTwoAndInMatchExcludeDeleted($table,$field,$col1,$col1_value,$col2,$col2_value,$in_col,$in_value){
          
          $query = "SELECT COUNT(DISTINCT $field) AS total_num FROM $table WHERE $col1 = ? AND $col2 = ? AND $in_col IN ($in_value) AND status != 'deleted' ORDER BY $field ASC";
          $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
          if($result){
            $getTotal = mysqli_fetch_assoc($result);
            $getTotal = $getTotal['total_num'];
            return $getTotal;
          }
          else{
            return false;
          }
      }
      // public function countOnly($table,$where,$value){

      //     $query = "SELECT COUNT(*) As total_num FROM $table WHERE $where = ?";
      //     $result = $this->db->select($query,array('s'),array(&$value),array());
      //     if($result){
      //       $getTotal = mysqli_fetch_assoc($result);
      //       $getTotal = $getTotal['total_num'];
      //       return $getTotal;
      //     }
      //     else{
      //       return false;
      //     }
      // }
      // public function countRangeAndEcluding($table,$where,$value){

      //     $query = "SELECT COUNT(*) As total_num FROM $table WHERE $where BETWEEN ? AND ?";
      //     $result = $this->db->select($query,array('s'),array(&$value),array());
      //     if($result){
      //       $getTotal = mysqli_fetch_assoc($result);
      //       $getTotal = $getTotal['total_num'];
      //       return $getTotal;
      //     }
      //     else{
      //       return false;
      //     }
      // }
      // public function countDistinctName($table,$where){

      //     $query = "SELECT COUNT(DISTINCT $where) As total_num FROM $table";
      //     $result = $this->db->select($query,array(),array(),array());
      //     if($result){
      //       $getTotal = mysqli_fetch_assoc($result);
      //       $getTotal = $getTotal['total_num'];
      //       return $getTotal;
      //     }
      //     else{
      //       return false;
      //     }
      // }
      // public function countAllWhere($table,$where,$what){

      //     $query = "SELECT COUNT(*) As total_num FROM $table WHERE $where='$what'";
      //     $result = $this->db->select($query,array(),array(),array());
      //     if($result){
      //       $getTotal = mysqli_fetch_assoc($result);
      //       $getTotal = $getTotal['total_num'];
      //       return $getTotal;
      //     }
      //     else{
      //       return false;
      //     }
      // }
      // public function countEither($table,$where,$what,$and){

      //     $query = "SELECT COUNT(*) As total_num FROM $table WHERE $where='$what' OR $where='$and'";
      //     $result = $this->db->select($query,array(),array(),array());
      //     if($result){
      //       $getTotal = mysqli_fetch_assoc($result);
      //       $getTotal = $getTotal['total_num'];
      //       return $getTotal;
      //     }
      //     else{
      //       return false;
      //     }
      // }
      // public function countResult($result){

      //       $getTotal = mysqli_fetch_assoc($result);
      //       $getTotal = $getTotal['total_num'];

      //       return $getTotal;
      // }
      // public function countSearch($search){

      //     $query = "SELECT COUNT(*) As total_num FROM products LEFT JOIN product_category ON `product_category`.`product_track_id` = `products`.`track_id` WHERE `products`.`name` LIKE '%$search%' OR `product_category`.`sub_category` LIKE '%$search%'";
      //     $result = $this->db->select($query,array(),array(),array());
      //     if($result){
      //       $getTotal = mysqli_fetch_assoc($result);
      //       $getTotal = $getTotal['total_num'];
      //       return $getTotal;
      //     }
      //     else{
      //       return false;
      //     }
      // }
      // public function countSearchTwoFields($table,$fieldI,$fieldII,$word){

      //       $search = $this->fm->validation($word);
      //       $search = mysqli_real_escape_string($this->db->link, $search);
      //       $search = "%".$word."%";

      //     $query = "SELECT COUNT(*) As total_num FROM $table WHERE $fieldI LIKE ? OR $fieldII LIKE ?";
      //     $result = $this->db->select($query,array('ss'),array(&$search,&$search),array());
      //     if($result){
      //       $getTotal = mysqli_fetch_assoc($result);
      //       $getTotal = $getTotal['total_num'];
      //       return $getTotal;
      //     }
      //     else{
      //       return false;
      //     }
      // }

  }
?>
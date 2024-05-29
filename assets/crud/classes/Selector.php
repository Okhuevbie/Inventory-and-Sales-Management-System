<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath."../../lib/Database.php");
  include_once ($filepath."../../helpers/format.php");
  include_once ($filepath."/../lib/Session.php");

   class Selector
  {
      private $db;
      private $fm;
      
      function __construct()
      {
        $this->db = new Database();
        $this->fm = new Format();
      }
    
      public function selectAll($table){

          $query = "SELECT * FROM $table";
          $result = $this->db->select($query,array(),array(),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectActivities(){

          $query = "SELECT * FROM `activities` ORDER BY `id` DESC";
          $result = $this->db->select($query,array(),array(),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectAllExcludeDeleted($table){

          $query = "SELECT * FROM $table WHERE status != 'deleted'";
          $result = $this->db->select($query,array(),array(),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectAllWithOrder($table,$by,$order){

          $query = "SELECT * FROM $table WHERE status != 'deleted' ORDER BY $by $order";
          $result = $this->db->select($query,array(),array(),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectOneMatchSingle($table,$col,$col_value){

          $query = "SELECT * FROM $table WHERE $col=? AND status != 'deleted' LIMIT 1";
          $result = $this->db->select($query,array('s'),array(&$col_value),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectOneMatchWithOrder($table,$where,$value,$by,$order){

          $query = "SELECT * FROM $table WHERE $where=? AND status != 'deleted' ORDER BY $by $order";
          $result = $this->db->select($query,array('s'),array(&$value),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectTwoMatchWithOrder($table,$where1,$value1,$where2,$value2,$by,$order){

          $query = "SELECT * FROM $table WHERE $where1=? AND $where2=? AND status != 'deleted' ORDER BY $by $order";
          $result = $this->db->select($query,array('ss'),array(&$value1,&$value2),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectOneField($table,$field,$id,$value){

        $query = "SELECT $field FROM $table WHERE $id=? AND status != 'deleted'";
        $result = $this->db->select($query,array('i'),array(&$value),array());
        if($result)
          return $result;
        else
          return false;
    }
    public function selectOneFieldWithTwoMach($table,$field,$id1,$value1,$id2,$value2){

      $query = "SELECT $field FROM $table WHERE $id1=? AND $id2=? AND status != 'deleted'";
      $result = $this->db->select($query,array('is'),array(&$value1,&$value2),array());
      if($result)
        return $result;
      else
        return false;
  }
      public function selectDistinctWithOrder($table,$field,$by,$order){

          $query = "SELECT DISTINCT $field FROM $table WHERE status != 'deleted' ORDER BY $by $order";
          $result = $this->db->select($query,array(),array(),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectDistinctBetweenWithOrder($table,$field,$col,$col_value1,$col_value2,$by,$order){

          $query = "SELECT DISTINCT $field FROM $table WHERE $col BETWEEN ? AND ? AND status != 'deleted' ORDER BY $by $order";
          $result = $this->db->select($query,array('ss'),array(&$col_value1,&$col_value2),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectAllBetweenWithOrder($table,$col,$col_value1,$col_value2,$by,$order){

          $query = "SELECT * FROM $table WHERE $col BETWEEN ? AND ? AND status != 'deleted' ORDER BY $by $order";
          $result = $this->db->select($query,array('ss'),array(&$col_value1,&$col_value2),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectMatchOneAndBetweenWithOrder($table,$col1,$col1_value1,$col1_value2,$col2,$col2_value,$by,$order){

          $query = "SELECT * FROM $table WHERE $col1 BETWEEN ? AND ? AND $col2 = ? AND status != 'deleted' ORDER BY $by $order";
          $result = $this->db->select($query,array('sss'),array(&$col1_value1,&$col1_value2,&$col2_value),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectTwoJoinedOrderedExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$by,$order){

          $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$table1`.`status` != 'deleted' ORDER BY `$by` $order";
          $result = $this->db->select($query,array(),array(),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectOneMatchTwoJoinedOrderedExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$col_table,$col,$col_value,$by,$order){

          $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$col_table`.`$col` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by` $order";
          $result = $this->db->select($query,array('s'),array(&$col_value),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectOneMatchTwoJoinedOrderedExcludeDeletedLimited($table1,$table1_ID,$table2,$table2_ID,$name_field,$col1_table,$col1,$col1_value,$by,$order,$from,$to){

        $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$col1_table`.`$col1` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by` $order LIMIT $from, $to";
        $result = $this->db->select($query,array('s'),array(&$col1_value),array());
        if($result)
          return $result;
        else
          return false;
      }
      public function selectTwoMatchTwoJoinedOrderedExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$col1_table,$col1,$col1_value,$col2_table,$col2,$col2_value,$by,$order){

          $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$col1_table`.`$col1` = ? AND `$col2_table`.`$col2` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by` $order";
          $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectTwoMatchTwoJoinedOrderedExcludeDeletedLimited($table1,$table1_ID,$table2,$table2_ID,$name_field,$col1_table,$col1,$col1_value,$col2_table,$col2,$col2_value,$by,$order,$from,$to){

        $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$col1_table`.`$col1` = ? AND `$col2_table`.`$col2` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by` $order LIMIT $from, $to";
        $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
        if($result)
          return $result;
        else
          return false;
      }
      public function selectOneMatchThreeJoinedOrderedExcludeDeleted($table1, $table1_field, $table1_ID1, $table1_ID2, $table2, $table2_ID, $table2_field, $table3, $table3_ID, $table3_field, $col_table, $col_column, $col_value, $by, $order){

          $query = "SELECT `$table1`.$table1_field, `$table2`.$table2_field, `$table3`.$table3_field FROM `$table1` JOIN `$table2` ON `$table1`.`$table1_ID1` = `$table2`.`$table2_ID` JOIN `$table3` ON `$table1`.`$table1_ID2` = `$table3`.`$table3_ID` WHERE `$col_table`.`$col_column` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by` $order";

          $result = $this->db->select($query,array('s'),array(&$col_value),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectOneMatchThreeJoinedOrderedExcludeDeletedLimited($table1, $table1_field, $table1_ID1, $table1_ID2, $table2, $table2_ID, $table2_field, $table3, $table3_ID, $table3_field, $col_table, $col_column, $col_value, $by, $order, $from, $to){

          $query = "SELECT `$table1`.$table1_field, `$table2`.$table2_field, `$table3`.$table3_field FROM `$table1` JOIN `$table2` ON `$table1`.`$table1_ID1` = `$table2`.`$table2_ID` JOIN `$table3` ON `$table1`.`$table1_ID2` = `$table3`.`$table3_ID` WHERE `$col_table`.`$col_column` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by` $order LIMIT $from, $to";

          $result = $this->db->select($query,array('s'),array(&$col_value),array());
          if($result)
            return $result;
          else
            return false;
      }
      public function selectProducts(){

        $query = "SELECT * FROM `products` WHERE `products`.`quantity` > 0 AND  (`products`.`expiry_date` > CURRENT_DATE OR  `products`.`expiry_date` = '0000-00-00') AND `products`.`status` = 'Active' AND `products`.`status` != 'deleted' ORDER BY `product_name` ASC, `quantity` ASC";
        $result = $this->db->select($query,array(),array(),array());
        if($result)
          return $result;
        else
          return false;
      }
      public function selectProductsForOrder(){

          $query = "SELECT `incoming_products`.`id`, `incoming_products`.`available_quantity`, `incoming_products`.`unit_price`, `products`.`product_name` FROM `incoming_products` JOIN `products` ON `products`.`id` = `incoming_products`.`product_id` WHERE `incoming_products`.`available_quantity` > 0 AND  (`incoming_products`.`expiry_date` > CURRENT_DATE OR  `incoming_products`.`expiry_date` = '0000-00-00') AND `incoming_products`.`status` = 'Active' AND `products`.`status` != 'deleted' ORDER BY `product_name` ASC, `available_quantity` ASC";
          $result = $this->db->select($query,array(),array(),array());
          if($result)
            return $result;
          else
            return false;
        }
      public function selectProductsForOrder2(){

          $query = "SELECT `incoming_products`.`id`, `incoming_products`.`available_quantity`, `incoming_products`.`unit_price`, `products`.`product_name` FROM `incoming_products` JOIN `products` ON `products`.`id` = `incoming_products`.`product_id` WHERE `incoming_products`.`status` = 'Active' AND `products`.`status` != 'deleted' ORDER BY `product_name` ASC, `available_quantity` ASC";
          $result = $this->db->select($query,array(),array(),array());
          if($result)
            return $result;
          else
            return false;
        }
        public function getName($table,$name_field,$col,$value){

          $query = "SELECT `$name_field` FROM `$table` WHERE `$col`=? AND `status` != 'deleted' LIMIT 1";
          $result = $this->db->select($query,array('s'),array(&$value),array());
          if($result){
            $row = $result->fetch_assoc();
            $name = $row[$name_field];
          }else{
            $name = 'Error Retrieving Value';
          }
          return $name;
        }
        public function getRow($table,$col,$value){

          $query = "SELECT * FROM `$table` WHERE `$col`=? AND `status` != 'deleted' LIMIT 1";
          $result = $this->db->select($query,array('s'),array(&$value),array());
          if($result){
            $row = $result->fetch_assoc();
            return $row;
          }else{
            return false;
          }
        }
      // public function selectAllInExcludeDeleted($table,$field,$values){

      //     $query = "SELECT * FROM $table WHERE $field IN ($values) AND status != 'deleted'";
      //     $result = $this->db->select($query,array(),array(),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectAllWithOrderExcludeDeleted($table,$by,$order){

      //     $query = "SELECT * FROM $table WHERE status != 'deleted' ORDER BY $by $order";
      //     $result = $this->db->select($query,array(),array(),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectTwoIndependentTablesExcludeDeleted($table1,$name_field1,$table1_col,$table1_value,$table2,$name_field2,$table2_col,$table2_value,$school){

      //     $query = "SELECT `$name_field1`, `$name_field2` FROM `$table1`, `$table2` WHERE `$table1`.`school_id` = ? AND `$table1`.`$table1_col` = ? AND `$table1`.`status` != 'deleted' AND `$table2`.`school_id` = ? AND `$table2`.`$table2_col` = ? AND `$table2`.`status` != 'deleted'";
      //     $result = $this->db->select($query,array('isis'),array(&$school,&$table1_value,&$school,&$table2_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectThreeIndependentTablesExcludeDeleted($table1,$name_field1,$table1_col,$table1_value,$table2,$name_field2,$table2_col,$table2_value,$table3,$name_field3,$table3_col,$table3_value,$school){

      //     $query = "SELECT `$name_field1`, `$name_field2`, `$name_field3` FROM `$table1`, `$table2`, `$table3` WHERE `$table1`.`school_id` = ? AND `$table1`.`$table1_col` = ? AND `$table1`.`status` != 'deleted' AND `$table2`.`school_id` = ? AND `$table2`.`$table2_col` = ? AND `$table2`.`status` != 'deleted' AND `$table3`.`school_id` = ? AND `$table3`.`$table3_col` = ? AND `$table3`.`status` != 'deleted'";
      //     $result = $this->db->select($query,array('isisis'),array(&$school,&$table1_value,&$school,&$table2_value,&$school,&$table3_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectAllDoubleOrderExcludeDeleted($table,$by1,$order1,$by2,$order2){

      //     $query = "SELECT * FROM $table WHERE status != 'deleted' ORDER BY $by1 $order1, $by2 $order2";
      //     $result = $this->db->select($query,array(),array(),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectSingleHereAndthereExcludeDeleted($table,$here,$here_value,$there,$there_value){

      //     $query = "SELECT * FROM $table WHERE $here = ? AND $there = ? AND status != 'deleted' LIMIT 1";
      //     $result = $this->db->select($query,array('ss'),array(&$here_value,&$there_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectInAndThereExcludeDeleted($table,$field,$values,$there,$there_value){

      //     $query = "SELECT * FROM $table WHERE $field IN ($values) AND $there=? AND status != 'deleted'";
      //     $result = $this->db->select($query,array('s'),array(&$there_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectHereAndthereExcludeDeleted($table,$here,$here_value,$there,$there_value){

      //     $query = "SELECT * FROM $table WHERE $here = ? AND $there = ? AND status != 'deleted'";
      //     $result = $this->db->select($query,array('ss'),array(&$here_value,&$there_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectHereAndthereWithOrderExcludeDeleted($table,$here,$here_value,$there,$there_value,$by,$order){

      //     $query = "SELECT * FROM $table WHERE $here = ? AND $there = ? AND status != 'deleted' ORDER BY $by $order";
      //     $result = $this->db->select($query,array('ss'),array(&$here_value,&$there_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectHereAndthereOrWhereExcludeDeleted($table,$here,$here_value,$there,$there_value,$where,$where_value){

      //     $query = "SELECT * FROM $table WHERE $here = ? AND status != 'deleted' AND $there=? OR $where = ?";
      //     $result = $this->db->select($query,array('sss'),array(&$here_value,&$there_value,&$where_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectMatchThreeColumnsExcludeDeleted($table,$col1,$col1_value,$col2,$col2_value,$col3,$col3_value){

      //     $query = "SELECT * FROM $table WHERE $col1 = ? AND $col2 = ? AND $col3 = ? AND status != 'deleted'";
      //     $result = $this->db->select($query,array('sss'),array(&$col1_value,&$col2_value,&$col3_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectMatchFourColumnsExcludeDeleted($table,$col1,$col1_value,$col2,$col2_value,$col3,$col3_value,$col4,$col4_value){

      //     $query = "SELECT * FROM $table WHERE $col1 = ? AND $col2 = ? AND $col3 = ? AND $col4 = ? AND status != 'deleted'";
      //     $result = $this->db->select($query,array('ssss'),array(&$col1_value,&$col2_value,&$col3_value,&$col4_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectMatchFiveColumnsExcludeDeleted($table,$col1,$col1_value,$col2,$col2_value,$col3,$col3_value,$col4,$col4_value,$col5,$col5_value){

      //     $query = "SELECT * FROM $table WHERE $col1 = ? AND $col2 = ? AND $col3 = ? AND $col4 = ? AND $col5 = ? AND status != 'deleted'";
      //     $result = $this->db->select($query,array('sssss'),array(&$col1_value,&$col2_value,&$col3_value,&$col4_value,&$col5_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      
      // // public function selectAllLimited($table,$from,$to){

      // //     $query = "SELECT * FROM $table LIMIT $from, $to";
      // //     $result = $this->db->select($query,array(),array(),array());
      // //     if($result)
      // //       return $result;
      // //     else
      // //       return false;
      // // }
      // // public function selectAllLimitedDesc($table,$from,$to){

      // //     $query = "SELECT * FROM $table ORDER BY id DESC LIMIT $from, $to";
      // //     $result = $this->db->select($query,array(),array(),array());
      // //     if($result)
      // //       return $result;
      // //     else
      // //       return false;
      // // }
      // public function selectSingleById($table,$where,$value){

      //     $query = "SELECT * FROM $table WHERE $where=? AND status != 'deleted' LIMIT 1";
      //     $result = $this->db->select($query,array('s'),array(&$value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      
      // public function selectwithJoinedAndDoubleOrderExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$by1,$order1,$by2,$order2){

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$table1`.`status` != 'deleted' ORDER BY $by1 $order1, $by2 $order2";
      //     $result = $this->db->select($query,array(),array(),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function selectIDwithJoinedAndDoubleOrderExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$where_table,$where_column,$where_value,$by1,$order1,$by2,$order2){

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$where_table`.`$where_column` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by1` $order1, `$by2` $order2";
      //     $result = $this->db->select($query,array('s'),array(&$where_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function selectIDwithJoinedAndDoubleOrderExcludeDeletedWithLimit($table1,$table1_ID,$table2,$table2_ID,$name_field,$where_table,$where_column,$where_value,$by1,$order1,$by2,$order2,$from,$to){

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$where_table`.`$where_column` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by1` $order1, `$by2` $order2 LIMIT $from, $to";
      //     $result = $this->db->select($query,array('s'),array(&$where_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function selectMatchTwoJoinedAndDoubleOrderExcludeDeletedWithLimit($table1,$table1_ID,$table2,$table2_ID,$name_field,$col1_table,$col1,$col1_value,$col2_table,$col2,$col2_value,$by1,$order1,$by2,$order2,$from,$to){

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$col1_table`.`$col1` = ? AND `$col2_table`.`$col2` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by1` $order1, `$by2` $order2 LIMIT $from,$to";
      //     $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function selectMatchTwoJoinedAndDoubleOrderExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$col1_table,$col1,$col1_value,$col2_table,$col2,$col2_value,$by1,$order1,$by2,$order2){

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$col1_table`.`$col1` = ? AND `$col2_table`.`$col2` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by1` $order1, `$by2` $order2";
      //     $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function selectMatchTwoJoinedWithInAndDoubleOrderExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$col1_table,$col1,$col1_value,$col2_table,$col2,$col2_value,$in_table,$in_col,$in_value,$by1,$order1,$by2,$order2){

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$in_table`.`$in_col` IN ($in_value) AND `$col1_table`.`$col1` = ? AND `$col2_table`.`$col2` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by1` $order1, `$by2` $order2";
      //     $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function selectMatchTwoJoinedWithInAndDoubleOrderExcludeDeletedLimited($table1,$table1_ID,$table2,$table2_ID,$name_field,$col1_table,$col1,$col1_value,$col2_table,$col2,$col2_value,$in_table,$in_col,$in_value,$by1,$order1,$by2,$order2,$from,$to){

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$in_table`.`$in_col` IN ($in_value) AND `$col1_table`.`$col1` = ? AND `$col2_table`.`$col2` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by1` $order1, `$by2` $order2 LIMIT $from, $to";
      //     $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function  selectMatchThreeJoinedAndDoubleOrderExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$col1_table,$col1,$col1_value,$col2_table,$col2,$col2_value,$col3_table,$col3,$col3_value,$by1,$order1,$by2,$order2){

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$col1_table`.`$col1` = ? AND `$col2_table`.`$col2` = ? AND `$col3_table`.`$col3` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by1` $order1, `$by2` $order2";
      //     $result = $this->db->select($query,array('sss'),array(&$col1_value,&$col2_value,&$col3_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function selectMatchFourJoinedAndDoubleOrderExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$col1_table,$col1,$col1_value,$col2_table,$col2,$col2_value,$col3_table,$col3,$col3_value,$col4_table,$col4,$col4_value,$by1,$order1,$by2,$order2){

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$col1_table`.`$col1` = ? AND `$col2_table`.`$col2` = ? AND `$col3_table`.`$col3` = ? AND `$col4_table`.`$col4` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by1` $order1, `$by2` $order2";
      //     $result = $this->db->select($query,array('ssss'),array(&$col1_value,&$col2_value,&$col3_value,&$col4_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function selectDebtors($school, $session, $term){

      //     $query = "SELECT `students`.`first_name`, `students`.`last_name`, `students`.`other_name`, `students`.`student_id`, `students`.`present_class` FROM `students` WHERE NOT EXISTS (SELECT * FROM `fees_payment` WHERE `students`.`school_id` = ? AND `fees_payment`.`student_id` = `students`.`student_id` AND `fees_payment`.`session_id` = ? AND `fees_payment`.`term_id` = ?) AND `students`.`school_id` = ? AND `students`.`status` = 'Active'";

      //     // $query = "SELECT `students`.`first_name`, `students`.`last_name`, `students`.`other_name` LEFT OUTER JOIN `fees_payment`.`student_id` = `students`.`student_id` AND `students`.`status` = 'Active' FROM `students` WHERE `fees_payment`.`student_id` IS NULL";

      //     $result = $this->db->select($query,array('ssss'),array(&$school,&$session,&$term,&$school),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function selectDebtorsbyClass($school, $session, $term, $class){

      //     $query = "SELECT `students`.`first_name`, `students`.`last_name`, `students`.`other_name`, `students`.`student_id`, `students`.`present_class` FROM `students` WHERE NOT EXISTS (SELECT * FROM `fees_payment` WHERE `students`.`school_id` = ? AND `fees_payment`.`student_id` = `students`.`student_id` AND `fees_payment`.`session_id` = ? AND `fees_payment`.`term_id` = ?) AND `students`.`school_id` = ? AND `students`.`status` = 'Active' AND `students`.`present_class` = ?";

      //     // $query = "SELECT `students`.`first_name`, `students`.`last_name`, `students`.`other_name` LEFT OUTER JOIN `fees_payment`.`student_id` = `students`.`student_id` AND `students`.`status` = 'Active' FROM `students` WHERE `fees_payment`.`student_id` IS NULL";

      //     $result = $this->db->select($query,array('sssss'),array(&$school,&$session,&$term,&$school,&$class),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function  selectMatchFiveJoinedAndDoubleOrderExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$col1_table,$col1,$col1_value,$col2_table,$col2,$col2_value,$col3_table,$col3,$col3_value,$col4_table,$col4,$col4_value,$col5_table,$col5,$col5_value,$by1,$order1,$by2,$order2){

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$col1_table`.`$col1` = ? AND `$col2_table`.`$col2` = ? AND `$col3_table`.`$col3` = ? AND `$col4_table`.`$col4` = ? AND `$col5_table`.`$col5` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by1` $order1, `$by2` $order2";
      //     $result = $this->db->select($query,array('sssss'),array(&$col1_value,&$col2_value,&$col3_value,&$col4_value,&$col5_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function  selectWherewithJoinedAndDoubleOrderExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$where,$value,$by1,$order1,$by2,$order2){

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$table1`.`$where` = ? AND `$table1`.`status` != 'deleted' ORDER BY $by1 $order1, $by2 $order2";

      //     $result = $this->db->select($query,array('s'),array(&$value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }

      //   //SELECT `sessions`.*, `schools`.`school_name` FROM `sessions` JOIN `schools` ON `schools`.`school_id` = `sessions`.`school_id`
      //   public function  selectThreeJoinedAndTripleOrderExcludeDeleted($table1, $table1_ID1, $table1_ID2, $table2, $table2_ID, $table2_field, $table3, $table3_ID, $table3_field, $by1, $order1, $by2, $order2, $by3, $order3){

      //       $query = "SELECT `$table1`.*, `$table2`.`$table2_field`, `$table3`.`$table3_field` FROM ((`$table1` INNER JOIN `$table2` ON `$table1`.`$table1_ID1` = `$table2`.`$table2_ID`) INNER JOIN `$table3` ON `$table1`.`$table1_ID2` = `$table3`.`$table3_ID`) WHERE `$table1`.`status` != 'deleted' ORDER BY `$by1` $order1, `$by2` $order2, `$by3` $order3";

      //       $result = $this->db->select($query,array(),array(),array());
      //       if($result)
      //         return $result;
      //       else
      //         return false;
      //     }
      

      //   public function selectThreeJoinedAndTwoMatchWithOrderExcludeDeleted($table1, $table1_ID1, $table1_ID2, $table2, $table2_ID, $table2_field, $table3, $table3_ID, $table3_field, $col1_table,$col1,$col1_value,$col2_table,$col2,$col2_value,$by, $order){

      //       $query = "SELECT `$table1`.*, `$table2`.`$table2_field`, `$table3`.`$table3_field` FROM ((`$table1` INNER JOIN `$table2` ON `$table1`.`$table1_ID1` = `$table2`.`$table2_ID`) INNER JOIN `$table3` ON `$table1`.`$table1_ID2` = `$table3`.`$table3_ID`) WHERE `$col1_table`.`$col1` = ? AND `$col2_table`.`$col2` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by` $order";

      //       $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
      //       if($result)
      //         return $result;
      //       else
      //         return false;
      //     }
      //   public function selectThreeJoinedAndThreeMatchWithOrderExcludeDeleted($table1, $table1_ID1, $table1_ID2, $table2, $table2_ID, $table2_field, $table3, $table3_ID, $table3_field, $col1_table,$col1,$col1_value,$col2_table,$col2,$col2_value,$col3_table,$col3,$col3_value, $by, $order){

      //       $query = "SELECT `$table1`.*, `$table2`.`$table2_field`, `$table3`.`$table3_field` FROM ((`$table1` INNER JOIN `$table2` ON `$table1`.`$table1_ID1` = `$table2`.`$table2_ID`) INNER JOIN `$table3` ON `$table1`.`$table1_ID2` = `$table3`.`$table3_ID`) WHERE `$col1_table`.`$col1` = ? AND `$col2_table`.`$col2` = ? AND `$col3_table`.`$col3` = ? AND `$table1`.`status` != 'deleted' ORDER BY `$by` $order";

      //       $result = $this->db->select($query,array('sss'),array(&$col1_value,&$col2_value,&$col3_value),array());
      //       if($result)
      //         return $result;
      //       else
      //         return false;
      //     }

      //   public function selectStudentsForBroadsheet($school,$result_id){

      //       $query = "SELECT 
      //                     `result_positions`.*, 
      //                     `students`.`student_id`,
      //                     `students`.`admission_id`,
      //                     `students`.`first_name`,
      //                     `students`.`last_name`,
      //                     `students`.`other_name`
      //                     -- `result_positions`.`total_score`,
      //                     -- `result_positions`.`average`,
      //                     -- `result_positions`.`position`
      //                 FROM 
      //                     `result_positions` 
      //                         INNER JOIN `students` ON `result_positions`.`student_id` = `students`.`student_id`
      //                 WHERE 
      //                         -- `result_scores`.`school_id` = ? 
      //                     `result_positions`.`school_id` = ?
      //                     -- AND `result_scores`.`result_id` = ?
      //                     AND `result_positions`.`result_id` = ?
      //                     AND `result_positions`.`status` != 'deleted' 
      //                 ORDER BY 
      //                     `last_name` ASC,
      //                     `first_name` ASC";
      //       // $query = "SELECT 
      //       //               `result_scores`.*, 
      //       //               `students`.`student_id`,
      //       //               `students`.`admission_id`,
      //       //               `students`.`first_name`,
      //       //               `students`.`last_name`,
      //       //               `students`.`other_name`,
      //       //               `result_positions`.`total_score`,
      //       //               `result_positions`.`average`,
      //       //               `result_positions`.`position`
      //       //           FROM 
      //       //               (
      //       //                 (
      //       //                   `result_positions` 
      //       //                   INNER JOIN `students` ON `result_scores`.`student_id` = `students`.`student_id`
      //       //                 ) 
      //       //                 INNER JOIN `result_positions` ON `result_scores`.`student_id` = `result_positions`.`student_id`
      //       //               ) 
      //       //           WHERE 
      //       //                   `result_scores`.`school_id` = ? 
      //       //               AND `result_positions`.`school_id` = ?
      //       //               AND `result_scores`.`result_id` = ?
      //       //               AND `result_positions`.`result_id` = ?
      //       //               AND `result_scores`.`status` != 'deleted' 
      //       //           ORDER BY 
      //       //               `last_name` ASC,
      //       //               `first_name` ASC";

      //       $result = $this->db->select($query,array('ii'),array(&$school,&$result_id),array());
      //       if($result)
      //         return $result;
      //       else
      //         return false;
      //     }
      //   public function selectResultFourJoined($school_id){
      //         $query = "SELECT
      //                       `results`.*,
      //                       `schools`.`school_name`,
      //                       `classrooms`.`short_name`,
      //                       `classrooms`.`category`,
      //                       `sessions`.`session_name`,
      //                       `terms`.`term_name`
      //                   FROM  
      //                       (
      //                           (
      //                               (
      //                                   (
      //                                       `results`
      //                                   INNER JOIN `schools` ON `results`.`school_id` = `schools`.`school_id` 
      //                                   )
      //                               INNER JOIN `classrooms` ON `results`.`class_id` = `classrooms`.`id` 
      //                               )
      //                           INNER JOIN `sessions` ON `results`.`session_id` = `sessions`.`session_id`
      //                           )
      //                         INNER JOIN `terms` ON `results`.`term_id` = `terms`.`id` 
      //                       )
      //                   WHERE
      //                       `results`.`school_id` = ?
      //                       AND
      //                       `results`.`status` != 'deleted'
      //                       AND 
      //                       `schools`.`status` != 'deleted'
      //                       AND 
      //                       `classrooms`.`status` != 'deleted'
      //                       AND 
      //                       `sessions`.`status` != 'deleted'
      //                       AND 
      //                       `terms`.`status` != 'deleted'
      //                   ORDER BY
      //                       `school_name` ASC,
      //                       `session_name` DESC,
      //                       `term_name` ASC";

      //           $result = $this->db->select($query,array('i'),array(&$school_id),array());
      //           if($result)
      //             return $result;
      //           else
      //             return false;
              
      //   }
      //   public function selectFourJoinedExlcudingDeleted($table1,$table1_ID1,$table1_ID2,$table1_ID3,$table2,$table2_ID,$table2_col,$table3,$table3_ID,$table3_col,$table4,$table4_ID,$table4_col,$by1,$order1,$by2,$order2,$by3,$order3){
      //         $query = "SELECT
      //                       `$table1`.*,
      //                       `$table2`.`$table2_col`,
      //                       `$table3`.`$table3_col`,
      //                       `$table4`.`$table4_col`
      //                   from  
      //                       (
      //                           (
      //                               (
      //                                   `$table1`
      //                               INNER JOIN `$table2` ON `$table1`.`$table1_ID1` = `$table2`.`$table2_ID`
      //                               )
      //                           INNER JOIN `$table3` ON `$table1`.`$table1_ID2` = `$table3`.`$table3_ID`
      //                           )
      //                       INNER JOIN `$table4` ON `$table1`.`$table1_ID3` = `$table4`.`$table4_ID`
      //                       )
      //                   WHERE
      //                       `$table1`.`status` != 'deleted'
      //                   ORDER BY
      //                       `$by1` $order1,
      //                       `$by2` $order2,
      //                       `$by3` $order3";
      //           $result = $this->db->select($query,array(),array(),array());
      //           if($result)
      //             return $result;
      //           else
      //             return false;
              
      //   }
      //   public function selectOneMatchFourJoinedExlcudingDeleted($table1,$table1_ID1,$table1_ID2,$table1_ID3,$table2,$table2_ID,$table2_col,$table3,$table3_ID,$table3_col,$table4,$table4_ID,$table4_col,$where_table,$where_column,$where_value,$by1,$order1,$by2,$order2,$by3,$order3){
      //         $query = "SELECT
      //                       `$table1`.*,
      //                       `$table2`.`$table2_col`,
      //                       `$table3`.`$table3_col`,
      //                       `$table4`.`$table4_col`
      //                   from  
      //                       (
      //                           (
      //                               (
      //                                   `$table1`
      //                               INNER JOIN `$table2` ON `$table1`.`$table1_ID1` = `$table2`.`$table2_ID`
      //                               )
      //                           INNER JOIN `$table3` ON `$table1`.`$table1_ID2` = `$table3`.`$table3_ID`
      //                           )
      //                       INNER JOIN `$table4` ON `$table1`.`$table1_ID3` = `$table4`.`$table4_ID`
      //                       )
      //                   WHERE
      //                       `$where_table`.`$where_column` = ? AND
      //                       `$table1`.`status` != 'deleted'
      //                   ORDER BY
      //                       `$by1` $order1,
      //                       `$by2` $order2,
      //                       `$by3` $order3";
      //           $result = $this->db->select($query,array('s'),array(&$where_value),array());
      //           if($result)
      //             return $result;
      //           else
      //             return false;
              
      //   }
      //   public function selectTwoMatchFourJoinedExlcudingDeleted($table1,$table1_ID1,$table1_ID2,$table1_ID3,$table2,$table2_ID,$table2_col,$table3,$table3_ID,$table3_col,$table4,$table4_ID,$table4_col,$where_table1,$where_column1,$where_value1,$where_table2,$where_column2,$where_value2,$by1,$order1,$by2,$order2,$by3,$order3){
      //         $query = "SELECT
      //                       `$table1`.*,
      //                       `$table2`.`$table2_col`,
      //                       `$table3`.`$table3_col`,
      //                       `$table4`.`$table4_col`
      //                   from  
      //                       (
      //                           (
      //                               (
      //                                   `$table1`
      //                               INNER JOIN `$table2` ON `$table1`.`$table1_ID1` = `$table2`.`$table2_ID`
      //                               )
      //                           INNER JOIN `$table3` ON `$table1`.`$table1_ID2` = `$table3`.`$table3_ID`
      //                           )
      //                       INNER JOIN `$table4` ON `$table1`.`$table1_ID3` = `$table4`.`$table4_ID`
      //                       )
      //                   WHERE
      //                       `$where_table1`.`$where_column1` = ? AND
      //                       `$where_table2`.`$where_column2` = ? AND
      //                       `$table1`.`status` != 'deleted'
      //                   ORDER BY
      //                       `$by1` $order1,
      //                       `$by2` $order2,
      //                       `$by3` $order3";
      //           $result = $this->db->select($query,array('ss'),array(&$where_value1,&$where_value2),array());
      //           if($result)
      //             return $result;
      //           else
      //             return false;
              
      //   }
      //   public function selectTwoMatchFiveJoinedExlcudingDeleted($table1,$table1_ID1,$table1_ID2,$table1_ID3,$table1_ID4,$table2,$table2_ID,$table2_col,$table3,$table3_ID,$table3_col,$table4,$table4_ID,$table4_col,$table5,$table5_ID,$table5_col,$where_table1,$where_column1,$where_value1,$where_table2,$where_column2,$where_value2,$by1,$order1,$by2,$order2,$by3,$order3){
      //         $query = "SELECT
      //                       `$table1`.*,
      //                       `$table2`.`$table2_col`,
      //                       `$table3`.`$table3_col`,
      //                       `$table4`.`$table4_col`,
      //                       `$table5`.`$table5_col`
      //                   FROM
      //                     (  
      //                       (
      //                           (
      //                               (
      //                                   `$table1`
      //                               INNER JOIN `$table2` ON `$table1`.`$table1_ID1` = `$table2`.`$table2_ID`
      //                               )
      //                           INNER JOIN `$table3` ON `$table1`.`$table1_ID2` = `$table3`.`$table3_ID`
      //                           )
      //                       INNER JOIN `$table4` ON `$table1`.`$table1_ID3` = `$table4`.`$table4_ID`
      //                       )
      //                     INNER JOIN `$table5` ON `$table1`.`$table1_ID4` = `$table5`.`$table5_ID`
      //                     )
      //                   WHERE
      //                       `$where_table1`.`$where_column1` = ? AND
      //                       `$where_table2`.`$where_column2` = ? AND
      //                       `$table1`.`status` != 'deleted'
      //                   ORDER BY
      //                       `$by1` $order1,
      //                       `$by2` $order2,
      //                       `$by3` $order3";
      //           $result = $this->db->select($query,array('ss'),array(&$where_value1,&$where_value2),array());
      //           if($result)
      //             return $result;
      //           else
      //             return false;
              
      //   }
      //   public function selectFourMatchFiveJoinedExlcudingDeleted($table1,$table1_ID1,$table1_ID2,$table1_ID3,$table1_ID4,$table2,$table2_ID,$table2_col,$table3,$table3_ID,$table3_col,$table4,$table4_ID,$table4_col,$table5,$table5_ID,$table5_col,$where_table1,$where_column1,$where_value1,$where_table2,$where_column2,$where_value2,$where_table3,$where_column3,$where_value3,$where_table4,$where_column4,$where_value4,$by1,$order1,$by2,$order2){
      //         $query = "SELECT
      //                       `$table1`.*,
      //                       `$table2`.`$table2_col`,
      //                       `$table3`.`$table3_col`,
      //                       `$table4`.`$table4_col`,
      //                       `$table5`.`$table5_col`
      //                   FROM
      //                     (  
      //                       (
      //                           (
      //                               (
      //                                   `$table1`
      //                               INNER JOIN `$table2` ON `$table1`.`$table1_ID1` = `$table2`.`$table2_ID`
      //                               )
      //                           INNER JOIN `$table3` ON `$table1`.`$table1_ID2` = `$table3`.`$table3_ID`
      //                           )
      //                       INNER JOIN `$table4` ON `$table1`.`$table1_ID3` = `$table4`.`$table4_ID`
      //                       )
      //                     INNER JOIN `$table5` ON `$table1`.`$table1_ID4` = `$table5`.`$table5_ID`
      //                     )
      //                   WHERE
      //                       `$where_table1`.`$where_column1` = ? AND
      //                       `$where_table2`.`$where_column2` = ? AND
      //                       `$where_table3`.`$where_column3` = ? AND
      //                       `$where_table4`.`$where_column4` = ? AND
      //                       `$table1`.`status` != 'deleted'
      //                   ORDER BY
      //                       `$by1` $order1,
      //                       `$by2` $order2";
      //           $result = $this->db->select($query,array('ssss'),array(&$where_value1,&$where_value2,&$where_value3,&$where_value4),array());

      //           if($result)
      //             return $result;
      //           else
      //             return false;
              
      //   }
      //   public function selectTwoMatchSixJoinedExlcudingDeleted($table1,$table1_ID1,$table1_ID2,$table1_ID3,$table1_ID4,$table1_ID5,$table2,$table2_ID,$table2_col,$table3,$table3_ID,$table3_col,$table4,$table4_ID,$table4_col,$table5,$table5_ID,$table5_col,$table6,$table6_ID,$table6_col,$where_table1,$where_column1,$where_value1,$where_table2,$where_column2,$where_value2,$by1,$order1,$by2,$order2,$by3,$order3){
      //         $query = "SELECT
      //                       `$table1`.*,
      //                       `$table2`.`$table2_col`,
      //                       `$table3`.`$table3_col`,
      //                       `$table4`.`$table4_col`,
      //                       `$table5`.`$table5_col`,
      //                       `$table6`.`$table6_col`
      //                   FROM
      //                     (  
      //                       (
      //                         (
      //                           (
      //                               (
      //                                   `$table1`
      //                               INNER JOIN `$table2` ON `$table1`.`$table1_ID1` = `$table2`.`$table2_ID`
      //                               )
      //                           INNER JOIN `$table3` ON `$table1`.`$table1_ID2` = `$table3`.`$table3_ID`
      //                           )
      //                       INNER JOIN `$table4` ON `$table1`.`$table1_ID3` = `$table4`.`$table4_ID`
      //                       )
      //                     INNER JOIN `$table5` ON `$table1`.`$table1_ID4` = `$table5`.`$table5_ID`
      //                     )
      //                     INNER JOIN `$table6` ON `$table1`.`$table1_ID5` = `$table6`.`$table6_ID`
      //                     )
      //                   WHERE
      //                       `$where_table1`.`$where_column1` = ? AND
      //                       `$where_table2`.`$where_column2` = ? AND
      //                       `$table1`.`status` != 'deleted'
      //                   ORDER BY
      //                       `$by1` $order1,
      //                       `$by2` $order2,
      //                       `$by3` $order3";
      //           $result = $this->db->select($query,array('ss'),array(&$where_value1,&$where_value2),array());
      //           if($result)
      //             return $result;
      //           else
      //             return false;
              
      //   }
      //   public function selectAllStudentsExcludeDeleted() {

      //       $query = "SELECT `students`.*, `schools`.`school_name`, `classrooms`.`class_name` FROM ((`students` INNER JOIN `schools` ON `students`.`school_id` = `schools`.`school_id`) INNER JOIN `classrooms` ON `students`.`present_class` = `classrooms`.`id`) WHERE `students`.`status` != 'deleted' ORDER BY `school_name` ASC, `class_name` ASC, `first_name` ASC";

      //       if($result)
      //         return $result;
      //       else
      //         return false;
      //   }
      //   public function  searchIDwithLikeJoinedAndDoubleOrderExcludeDeleted($table1,$table1_ID,$table2,$table2_ID,$name_field,$where_table,$where_column,$where_value,$field_table,$field_column,$word,$by,$order){

      //     $word = $this->fm->validation($word);
      //     $word = mysqli_real_escape_string($this->db->link, $word);
      //     $search = "%".$word."%";

      //     $query = "SELECT `$table1`.*, `$table2`.`$name_field` FROM `$table1` LEFT JOIN `$table2` ON `$table2`.`$table2_ID` = `$table1`.`$table1_ID` WHERE `$where_table`.`$where_column` =? AND `$field_table`.`$field_column` LIKE ? AND `$table1`.`status` != 'deleted' ORDER BY `$by` $order";
      //     $result = $this->db->select($query,array('ss'),array(&$where_value,&$search),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      //   }
      //   public function searchByFieldWithID($table,$where,$where_value,$field,$word){

      //       $word = $this->fm->validation($word);
      //       $word = mysqli_real_escape_string($this->db->link, $word);
      //       $search = "%".$word."%";

      //     $query = "SELECT * FROM $table WHERE $where =? AND $field LIKE ? AND status != 'deleted'";
      //     $result = $this->db->select($query,array('ss'),array(&$where_value,&$search),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }

      //   //"SELECT `students`.*, `schools`.`school_name`, `classrooms`.`class_name` FROM ((`students` INNER JOIN `schools` ON `students`.`school_id` = `schools`.`school_id`) INNER JOIN `classrooms` ON `students`.`present_class` = `classrooms`.`id`) WHERE `students`.`status` != 'deleted' ORDER BY `school_name` ASC, `class_name` ASC, `first_name` ASC"

      // public function selectDistinctTwoMatchExcludeDeleted($table,$field,$col1,$col1_value,$col2,$col2_value){
          
      //     $query = "SELECT DISTINCT ($field) FROM $table WHERE $col1 = ? AND $col2 = ? AND status != 'deleted' ORDER BY $field ASC";
      //     $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectDistinctTwoAndInMatchExcludeDeleted($table,$field,$col1,$col1_value,$col2,$col2_value,$in_col,$in_value){
          
      //     $query = "SELECT DISTINCT ($field) FROM $table WHERE $col1 = ? AND $col2 = ? AND $in_col IN ($in_value) AND status != 'deleted' ORDER BY $field ASC";
      //     $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectDistinctTwoMatchLimitedExcludeDeleted($table,$field,$col1,$col1_value,$col2,$col2_value,$from,$to){
          
      //     $query = "SELECT DISTINCT ($field) FROM $table WHERE $col1 = ? AND $col2 = ? AND status != 'deleted' ORDER BY $field ASC LIMIT $from, $to";
      //     $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectDistinctTwoAndInMatchLimitedExcludeDeleted($table,$field,$col1,$col1_value,$col2,$col2_value,$in_col,$in_value,$from,$to){
          
      //     $query = "SELECT DISTINCT ($field) FROM $table WHERE $col1 = ? AND $col2 = ? AND $in_col IN ($in_value) AND status != 'deleted' ORDER BY $field ASC LIMIT $from, $to";
      //     $result = $this->db->select($query,array('ss'),array(&$col1_value,&$col2_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectByField($table,$where,$something){

      //     $something = $this->fm->validation($something);
      //     $something = mysqli_real_escape_string($this->db->link, $something);

      //     $query = "SELECT * FROM $table WHERE $where=? LIMIT 1";
      //     $result = $this->db->select($query,array('s'),array(&$something),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectByFieldswithLimit($table,$where,$what,$from,$to){

      //     $what = $this->fm->validation($what);
      //     $what  = mysqli_real_escape_string($this->db->link, $what);

      //     $query = "SELECT * FROM $table WHERE $where=? LIMIT $from,$to";
      //     $result = $this->db->select($query,array('s'),array(&$what),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // public function selectNotThereWithOrder($table,$where,$what,$by,$order){

      //     $query = "SELECT * FROM $table WHERE $where != '$what' ORDER BY $by $order";
      //     $result = $this->db->select($query,array(),array(),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // }
      // public function selectByFieldNoLimit($table,$where,$what){

      //     $what = $this->fm->validation($what);
      //     $what  = mysqli_real_escape_string($this->db->link, $what);

      //     $query = "SELECT * FROM $table WHERE $where=?";
      //     $result = $this->db->select($query,array('s'),array(&$what),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectAllByFields($table,$where,$what){

      //     $what = $this->fm->validation($what);
      //     $what  = mysqli_real_escape_string($this->db->link, $what);

      //     $query = "SELECT * FROM $table WHERE $where=?";
      //     $result = $this->db->select($query,array('s'),array(&$what),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectNotThereLimitedDesc($table,$where,$what,$from,$to){

      //     $query = "SELECT * FROM $table WHERE $where != ? ORDER BY id DESC LIMIT $from,$to";
      //     $result = $this->db->select($query,array('s'),array(&$what),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectNotThereLimitedandOrder($table,$where,$what,$by,$order,$from,$to){

      //     $query = "SELECT * FROM $table WHERE $where != ? ORDER BY $by $order LIMIT $from,$to";
      //     $result = $this->db->select($query,array('s'),array(&$what),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      
      // public function selectHereAndNotthereWithOrder($table,$here,$here_value,$there,$there_value,$by,$order){

      //     $query = "SELECT * FROM $table WHERE $here = ? AND $there != ? ORDER BY $by $order";
      //     $result = $this->db->select($query,array('ss'),array(&$here_value,&$there_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectHereAndNotthere($table,$here,$here_value,$there,$there_value){

      //     $query = "SELECT * FROM $table WHERE $here = ? AND $there != ?";
      //     $result = $this->db->select($query,array('ss'),array(&$here_value,&$there_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectHereAndNottherewithOrderLimit($table,$here,$here_value,$there,$there_value,$by,$order,$from,$to){

      //     $query = "SELECT * FROM $table WHERE $here = ? AND $there != ? ORDER BY $by $order LIMIT $from,$to";
      //     $result = $this->db->select($query,array('ss'),array(&$here_value,&$there_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectWhereHereAndNottherewithOrderLimit($table,$where,$where_value,$here,$here_value,$there,$there_value,$by,$order,$from,$to){

      //     $query = "SELECT * FROM $table WHERE $where = ? AND $here = ? AND $there != ? ORDER BY $by $order LIMIT $from,$to";
      //     $result = $this->db->select($query,array('sss'),array(&$where_value,&$here_value,&$there_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function selectHereOrtherewithLimitandOrder($table,$here,$here_value,$there,$there_value,$order,$from,$to){

      //     $query = "SELECT * FROM $table WHERE $here = ? OR $there = ? ORDER BY $order DESC LIMIT $from,$to";
      //     $result = $this->db->select($query,array('ss'),array(&$here_value,&$there_value),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
      // public function getSearchwithLimit($search,$from,$to){

      //       $search = $this->fm->validation($search);
      //       $search = mysqli_real_escape_string($this->db->link, $search);
      //       $search = "%".$search."%";

      //     $query = "SELECT `products`.*, `product_category`.* FROM `products` LEFT JOIN `product_category` ON `product_category`.`product_track_id` = `products`.`track_id` WHERE `products`.`name` LIKE ? OR `product_category`.`sub_category` LIKE ? LIMIT $from, $to";
      //     $result = $this->db->select($query,array('ss'),array(&$search,&$search),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }

      // public function searchTwoFields($table,$fieldI,$fieldII,$word){

      //       $word = $this->fm->validation($word);
      //       $word = mysqli_real_escape_string($this->db->link, $word);
      //       $search = "%".$word."%";

      //     $query = "SELECT * FROM $table WHERE $fieldI LIKE ? OR $fieldII LIKE ? AND status != 'deleted'";
      //     $result = $this->db->select($query,array('ss'),array(&$search,&$search),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }

      // public function searchByField($table,$field,$word){

      //       $word = $this->fm->validation($word);
      //       $word = mysqli_real_escape_string($this->db->link, $word);
      //       $search = "%".$word."%";

      //     $query = "SELECT * FROM $table WHERE $field LIKE ? AND status != 'deleted'";
      //     $result = $this->db->select($query,array('s'),array(&$search),array());
      //     if($result)
      //       return $result;
      //     else
      //       return false;
      // }
            
      public function exportTable($result,$table) {
        $timestamp = time();
        $filename = 'Simpat_' . $table . '_export' . $timestamp . '.xls';
        
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        $isPrintHeader = false;
        foreach ($result as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
        exit();
    }
  }
?>
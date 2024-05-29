<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath."/../lib/Database.php");
  include_once ($filepath."/../helpers/format.php");
  include_once ($filepath."/../lib/Session.php");
?>
<?php

   class Login 
  {
	  	private $db;
	  	private $fm;
	  	
	  	function __construct()
	  	{
	  		$this->db = new Database();
	  		$this->fm = new Format();
	  	}
      public function confirmUser($post){

        	$user = $this->fm->validation($post['email']);
        	$password = $this->fm->validation($post['password']);

        	$user = mysqli_real_escape_string($this->db->link,$user);
        	$password = mysqli_real_escape_string($this->db->link,$password);

        	if(empty($user) || empty($password)){
	  			  $msg = "Fields Must Not Be Empty...";
	  		    return $msg;
	  		  }
          elseif (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
            $msg = "Invalid email format";
            return $msg; 
          }
          else{
	  		    $chquery = "SELECT * FROM users WHERE email=? AND status != 'deleted' LIMIT 1";
			      $chresult = $this->db->select($chquery,array('s'),array(&$user),array());
				    
            if($chresult){
				 	    $value = $chresult->fetch_assoc();

              $database_pass = $value['password'];
              $passresult = password_verify($password,$database_pass);

              if($passresult){
                if ($value['status'] == 'Disabled') {
                  $msg = "Account Disabled, Contact Administrator...";
                  return $msg;
                }else{

                  $data = array();
    					 	  $data['login']      = true;
    		  				$data['userid']     = $value['id'];
    		  				$data['username']   = $value['first_name'];
                  $data['user_fullname']   = $value['first_name'] .' '.$value['last_name'] .' '.$value['other_name'];
    		  				$data['site']       = 'Warehouse System';
                  $data['reset_time'] = time() + strtotime('10 minutes');

    		  				$name = $data['user_fullname'];
    		  				$query = "INSERT INTO activities (user,activity) VALUES(?,'Online')";
    		  				$type = array('s');
    		  				$result = $this->db->insert($query,$type,array(&$name));

                  $_SESSION = $data;
    		  				$msg = 'Success';
    		  				return $msg;
                }
  			      }else{
  			   	    $msg = "Incorrect Password";
			          return $msg;
  			      }
				    }else{
	  				  $msg = "User Not Found";
	  			    return $msg;
	  			  }
	  		  }
    }

    public function confirmStore($post){
            $user = $this->fm->validation($post['user']);
            $store = $this->fm->validation($post['store']);

            $user = mysqli_real_escape_string($this->db->link,$user);
            $store = mysqli_real_escape_string($this->db->link,$store);

            if(empty($user) || $store == ''){
              $msg = "Data error...";
              return $msg;
            }
            else{
              $chquery = "SELECT * FROM user_roles WHERE user_id=? AND store_id=? AND status != 'deleted' LIMIT 1";
              $chresult = $this->db->select($chquery,array('ii'),array(&$user,&$store),array());

              if($chresult){
                $value = $chresult->fetch_assoc();

                $_SESSION['storeid'] = $value['store_id'];
                $_SESSION['role'] = $value['role'];

                $store_name = '';
                if ($store == 0) {
                  $store_name = 'Central Warehouse';
                }else{
                  $query = "SELECT `name` FROM `stores` WHERE `id`=? AND `status` != 'deleted' LIMIT 1";
                  $result = $this->db->select($query,array('i'),array(&$store),array());
                  if($result){
                    $row = $result->fetch_assoc();
                    $store_name = $row['name'];
                  }
                }
                $name = $_SESSION['user_fullname'];
                $user = $_SESSION['userid'];
                $action = "Logged into ". $store_name;

                $query = "INSERT INTO activities (user_id,user,activity) VALUES(?,?,?)";
                $type = array('iss');
                $result = $this->db->insert($query,$type,array(&$user,&$name,&$action));

                $msg = 'Success';
                return $msg;
                
              }else{
                $msg = "Error occured retrieving Store";
                return $msg;
              }
            }
      
    }
        
      
      public function logOffline(){
            $name = Session::get('user_fullname');
            $query = "INSERT INTO activities (user,activity) VALUES(?,'Offline')";
            $type = array('s');
            $result = $this->db->insert($query,$type,array(&$name));

            if($result){
            return $result;
          }else{
            return false;
          }
        }

      public function logLock($name){
            $name = Session::get('name');
            $query = "INSERT INTO activities (user,activity) VALUES(?,'Locked Account')";
            $type = array('s');
            $result = $this->db->insert($query,$type,array(&$name));

            if($result){
            return $result;
          }else{
            return false;
          }
        }


}
?>
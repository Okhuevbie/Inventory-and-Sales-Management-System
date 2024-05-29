
<?php
  /**Session Class**/

  class Session{
    
    public static function init(){
        // session_start();
     }

     public static function set($key, $val){
          $_SESSION[$key] = $val;
     }

     public static function unset($key){
          unset($_SESSION[$key]);
     }

     public static function get($key){
          if (isset($_SESSION[$key])) {
           return $_SESSION[$key];
          } else {
           return false;
          }
     }

     public static function checkUserSession(){
          self::init();
          if (self::get("login") != true) {
           self::destroy();
           echo "<script>window.location = 'index.html'</script>";
          }else{
            $now = time();
            if (self::get('reset_time') > $now) {
              session_regenerate_id();
            }
          }
     }

     public static function checkAPISession(){
          self::init();
          if (self::get("login") != true) {
           self::destroy();
           return  false;
          }else{
            return true;
          }
     }

     public static function checkStoreSession(){
          self::init();
          $id = self::get("storeid");
          // if ($id == null) {
          //  echo "<script>window.location = '../choose-account.php'</script>";
          // }
     }

     public static function checkCentralStoreSession(){
          self::init();
          $id = self::get("storeid");
          if ($id == 3) {
           echo "<script>window.location = '../choose-account.php'</script>";
          }
     }

    public static function checkLockScreen(){
          self::init();
          if (self::get("status") == 2) {
           echo "<script>window.location = 'locked.php'</script>";
          }
     }
     
     public static function checkLogin(){
          self::init();
          if (self::get("login") == true) {
            $now = time();
            if (self::get('reset_time') > $now) {
              session_regenerate_id();
            }
           echo "<script>window.open('dashboard.php','_self')</script>";
          }else{
           echo "<script>window.location = 'index.php'</script>";
          }
     }
    
     public static function destroy(){
          session_destroy();
          echo "<script>window.location = '../index.html'</script>";

     }
     public static function destroy2(){
          session_destroy();
     }


  }
?>

          
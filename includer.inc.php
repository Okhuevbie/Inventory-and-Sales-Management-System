<?php
	include 'assets/crud/lib/Database.php';
	include 'assets/crud/lib/Session.php';
	include 'assets/crud/classes/Login.php';

	if (!isset($locked) || $locked != true) {
		Session::checkLockScreen();
	}
	Session::checkUserSession();

	include 'assets/crud/classes/Selector.php';
	include 'assets/crud/classes/Counter.php';
	// include 'plugins/crud/classes/Delete.php';
	
	// $db = new Database();
	$fm = new Format();
	$lg = new Login();
	$sl = new Selector();
	$ct = new Counter();
	// $dl = new Delete();
	
	define('USERID', Session::get('userid'));
	define('USER_ROLE', Session::get('role'));
    
    $roleArray = array('System Administrator', 'Administrator', 'Manager');
	

 ?>
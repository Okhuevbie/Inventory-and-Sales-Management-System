<?php 
	include '../crud/lib/Database.php';
	include '../crud/lib/Session.php';
	include '../crud/classes/Login.php';

	// Session::checkSession();

	include '../crud/classes/Uploader.php';
	include '../crud/classes/Updater.php';
	include '../crud/classes/Selector.php';
	include '../crud/classes/Counter.php';
	include '../crud/classes/Delete.php';
	
	$db = new Database();
	$fm = new Format();
	$up = new Uploader();
	$ud = new Updater();
	$lg = new Login();
	$sl = new Selector();
	$ct = new Counter();
	$dl = new Delete();

	define('USERID', Session::get('userid'));
	$roleArray = array('System Administrator', 'Administrator', 'Manager', 'Sales');
	
 ?>
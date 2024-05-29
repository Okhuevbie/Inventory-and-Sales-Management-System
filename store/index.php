<?php
session_start();
    include '../includer.inc.php';
    Session::checkCentralStoreSession();
    $status = $_GET['status'];

    if ($status == 1) {
        echo "<script>window.location = '../choose-account.php'</script>";
    }else{
        $lg->logOffline();
        Session::destroy();
    }
?> 
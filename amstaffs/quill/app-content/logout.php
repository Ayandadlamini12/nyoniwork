<?php
include "../amstaff.conn.php";
ob_start();
session_start();
if(isset($_SESSION['my_id'])) {

    $iddata = $_SESSION['my_id']; 
     
    session_destroy();
    unset($_SESSION['my_id']);
    unset($_SESSION['my_name']);
    header("Location: ./");
} else {
    header("Location: ./");
}
?>
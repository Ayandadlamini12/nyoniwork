<?php

    error_reporting(E_ERROR | E_PARSE); 
    session_start();
     require('../amstaff.conn.php');
    // Final Control Sheet Info
    $id = $_POST['id'];
    $har_fullname = $_POST['har_fullname'];
    $har_phone = $_POST['har_phone']; 
    $har_date_of_birth = $_POST['har_date_of_birth']; 
    $har_address = $_POST['har_address']; 

    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $output = substr(str_shuffle($permitted_chars), 0, 8);

       if (isset($_POST['upload'])) {
 
            $filename = $_FILES["profile"]["name"];
            $newname = $output.'_'.$filename;
            $tempname = $_FILES["profile"]["tmp_name"];
            $folder = "uploads/profiles/" . $newname;

 
            if (move_uploaded_file($tempname, $folder)) {
                $update="UPDATE users set har_fullname ='$har_fullname', har_phone='$har_phone', har_date_of_birth='$har_date_of_birth', har_address='$har_address', har_profile='$newname' WHERE id='$id'";
                mysqli_query($conn, $update) or die(mysqli_error($conn));
                $_SESSION['metadata'] = "Your Profile Information Has Been Successfully Updated!!";
                header("Location: account-settings"); 
                exit(); 
            } else {
                $update="UPDATE users set har_fullname ='$har_fullname', har_phone='$har_phone', har_date_of_birth='$har_date_of_birth', har_address='$har_address' WHERE id='$id'";
                mysqli_query($conn, $update) or die(mysqli_error($conn));
                $_SESSION['metadata'] = "Your Profile Information Has Been Successfully Updated!!";
                header("Location: account-settings"); 
                exit();
            }
        } 
     
 ?> 
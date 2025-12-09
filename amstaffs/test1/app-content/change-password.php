<?php
       error_reporting (E_ALL ^ E_NOTICE); 
       session_start();
       require('../amstaff.conn.php');
       // Final Control Sheet Info
       $id = $_POST['id'];
       $password = $_POST['password'];
       $rpassword = $_POST['rpassword'];
       $opassword = $_POST['opassword'];


        if ($password != $rpassword) {

            $_SESSION['wrong_metadata'] = "New Password and Confirmation Password Does Not Match, Try Again!!";
            header("Location: account-settings"); 
            exit(); 

       }else{

            $query  = "SELECT * FROM users WHERE id = '$id'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) == 1){
                while ($row = mysqli_fetch_assoc($result)) {
                    if (password_verify($opassword, $row['har_password'])) {
                        
                        $encode = password_hash($password, PASSWORD_DEFAULT);
                        $update="UPDATE users set har_password ='$encode' WHERE id='$id'";
                        mysqli_query($conn, $update) or die(mysqli_error($conn));

                        $_SESSION['metadata'] = "Your Password Has Been Successfully Changed!!";
                        header("Location: account-settings"); 
                        exit();  

                    }else{

                        $_SESSION['wrong_metadata'] = "Wrong Current Password Entered, Try Again!!";
                        header("Location: account-settings"); 
                        exit();   

                    }
                }
            }

       } 
 ?> 
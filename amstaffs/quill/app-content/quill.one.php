<?php

    session_start(); 
    include "../amstaff.conn.php";

    // Check if the required parameters are present in the URL
    if (!isset($_GET['id']) || !isset($_GET['image_name'])) {
        $_SESSION['metadata'] = "Select Dog Image You Wanna Delete!!";
        header("Location: quill-photos"); 
        exit;
    }

    // Get the parameters from the URL
    // NOTE: In a production environment, use $_POST for deletion to prevent CSRF attacks.
    $image_id = $_GET['id'];
    $image_name = $_GET['image_name'];
    
    // 💡 FIX 1: Correct the folder location path (missing '/')
    $folder_location = '../assets/uploads/dogs/';
    $file_path = $folder_location . $image_name; // Full path to the file

    // Check if the user confirmed the delete action
    if (isset($_GET['delete']) && $_GET['delete'] === 'true') {
        
        // --- 1. FILE DELETION ---
        if (file_exists($file_path)) {
            if (unlink($file_path)) {
                $file_deleted = true;
            } else {
                $file_deleted = false;
                // Log this error
                error_log("Failed to delete file: " . $file_path);
            }
        } else {
            // Treat it as deleted if the file isn't found (maybe it was manually deleted)
            $file_deleted = true; 
        }

        // --- 2. DATABASE DELETION ---
        if ($file_deleted) {
            // 💡 FIX 2: Use the correct table (assuming 'quill_dog_gallery')
            // 💡 FIX 3: Use prepared statements for security (prevents SQL injection)
            $sql_delete = "DELETE FROM quill_dog_gallery WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql_delete);

            if ($stmt) {
                // Bind the image ID parameter
                mysqli_stmt_bind_param($stmt, "i", $image_id);
                
                // Execute the deletion
                if (mysqli_stmt_execute($stmt)) {
                    // Success message and redirect
                    $_SESSION['metadata'] = "Dog Image Deleted Successfully!!";
                    header("Location: quill-photos");
                    exit;
                } else {
                    $error_message = "Database Error: Failed to delete record.";
                }
                mysqli_stmt_close($stmt);
            } else {
                $error_message = "Database Error: Could not prepare statement.";
            }
        } else {
            $error_message = "File Deletion Failed. Database record was NOT deleted.";
        }
        
        $_SESSION['metadata'] = $error_message;
        header("Location: quill-photos");
        exit();
    
    } else {
         
        echo "<script>
        if (confirm('Are you sure you want to delete the gallery image? Click OK to delete or Cancel to go back.')) {
  
            window.location.href='quill-one?id=$image_id&image_name=$image_name&delete=true'; 
        } else {
            window.location.href='quill-photos';
        }
        </script>";
    }
 
?>
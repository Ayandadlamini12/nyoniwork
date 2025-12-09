<?php

    session_start();
    // Assuming 'amstaff.conn.php' includes $conn, your mysqli connection variable
    include "../amstaff.conn.php";

    // --- 0. Initial Validation ---
    // We now rely on the dog_id, not the image_id.
    if (!isset($_GET['id'])) {
        $_SESSION['metadata'] = "Error: Missing dog identifier.";
        header("Location: kb-dogs"); 
        exit;
    }

    $dog_id = $_GET['id'];
    $folder_location = '../assets/uploads/dogs/';
    
    // Check if the user confirmed the delete action
    if (isset($_GET['delete']) && $_GET['delete'] === 'true') {
        
        $error_message = '';
        $success = false;

        // =========================================================================
        // STEP 1: GET ALL IMAGE PATHS FOR THE DOG_ID AND DELETE FILES
        // =========================================================================
        
        // Retrieve all image paths associated with the dog_id
        $sql_get_paths = "SELECT dog_image_path FROM quill_dog_gallery WHERE dog_id = ?";
        $stmt_paths = mysqli_prepare($conn, $sql_get_paths);

        if ($stmt_paths) {
            mysqli_stmt_bind_param($stmt_paths, "i", $dog_id);
            mysqli_stmt_execute($stmt_paths);
            $result_paths = mysqli_stmt_get_result($stmt_paths);
            
            $files_deleted_count = 0;
            $files_to_delete = mysqli_num_rows($result_paths);
            
            // Loop through all results and delete files one by one
            while ($path_row = mysqli_fetch_assoc($result_paths)) {
                $current_path = $folder_location . $path_row['dog_image_path'];
                
                // Attempt to delete the file
                if (file_exists($current_path)) {
                    if (unlink($current_path)) {
                        $files_deleted_count++;
                    } else {
                        // Log failure, but continue to the next file
                        error_log("Failed to delete file: " . $current_path);
                    }
                } else {
                    // File not found, treat as deleted successfully
                    $files_deleted_count++;
                }
            }
            mysqli_stmt_close($stmt_paths);
            
            // =========================================================================
            // STEP 2: DATABASE DELETION (Delete ALL records for the dog_id)
            // =========================================================================
            
            // Proceed only if we have successfully handled all files
            if ($files_deleted_count === $files_to_delete) {
                
                $sql_delete_all = "DELETE FROM quill_dog_gallery WHERE dog_id = ?";
                $stmt_delete = mysqli_prepare($conn, $sql_delete_all);
                
                if ($stmt_delete) {
                    mysqli_stmt_bind_param($stmt_delete, "i", $dog_id);
                    
                    if (mysqli_stmt_execute($stmt_delete)) {
                        $success = true;
                        $_SESSION['metadata'] = "Dog Gallery, Successfully Deleted";
                    } else {
                        $error_message = "Database Error: Failed to delete records for Dog ID " . $dog_id . ".";
                    }
                    mysqli_stmt_close($stmt_delete);
                } else {
                    $error_message = "Database Error: Could not prepare mass deletion statement.";
                }
            } else {
                // This handles the case where not all files were accounted for.
                $error_message = "File Deletion Error: Could not delete all associated files. Database records were NOT touched.";
            }
            
        } else {
            $error_message = "Database Error: Could not prepare image path retrieval statement.";
        }
        
        // --- 3. Final Redirect ---
        if (!$success) {
            // Ensure an error message is set if deletion failed
            if (empty($error_message)) {
                 $error_message = "An unknown error occurred during the deletion process.";
            }
            $_SESSION['metadata'] = $error_message;
        }

        header("Location: kb-dogs");
        exit();
        
    } else {
        // --- 4. Confirmation Prompt ---
        // The confirmation now uses the dog_id parameter in the link.
        echo "<script>
        if (confirm('WARNING: Are you sure you want to delete **ALL** gallery images associated with this Dog? This will delete all files and records. This action is irreversible. Click OK to delete or Cancel to go back.')) { 
            window.location.href='quill-all?id=$dog_id&delete=true'; 
        } else {
            window.location.href='kb-dogs';
        }
        </script>";
    }
?>
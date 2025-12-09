<?php

    session_start();
    // Assuming 'amstaff.conn.php' includes $conn, your mysqli connection variable
    include "../amstaff.conn.php";

    // --- 0. Initial Validation ---
    if (!isset($_GET['id'])) { // Changed from 'id' to 'dog_id' based on context
        $_SESSION['metadata'] = "Error: Missing dog identifier.";
        header("Location: quill-photos"); 
        exit;
    }

    $dog_id = $_GET['id']; // Using dog_id
    $folder_location = '../assets/uploads/dogs/';
    
    // Check if the user confirmed the delete action
    if (isset($_GET['delete']) && $_GET['delete'] === 'true') {
        
        $error_message = '';
        $success = false;
        $gallery_deleted = false;

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
                
                if (file_exists($current_path)) {
                    if (unlink($current_path)) {
                        $files_deleted_count++;
                    } else {
                        error_log("Failed to delete file: " . $current_path);
                    }
                } else {
                    $files_deleted_count++; // Treat missing file as successful deletion
                }
            }
            mysqli_stmt_close($stmt_paths);
            
            // =========================================================================
            // STEP 2: DATABASE DELETION (Delete ALL GALLERY records for the dog_id)
            // =========================================================================
            
            // Proceed only if we have successfully handled all files
            if ($files_deleted_count === $files_to_delete) {
                
                $sql_delete_gallery = "DELETE FROM quill_dog_gallery WHERE dog_id = ?";
                $stmt_delete_gallery = mysqli_prepare($conn, $sql_delete_gallery);
                
                if ($stmt_delete_gallery) {
                    mysqli_stmt_bind_param($stmt_delete_gallery, "i", $dog_id);
                    
                    if (mysqli_stmt_execute($stmt_delete_gallery)) {
                        $gallery_deleted = true;
                    } else {
                        $error_message = "Database Error: Failed to delete gallery records for Dog ID " . $dog_id . ".";
                    }
                    mysqli_stmt_close($stmt_delete_gallery);
                } else {
                    $error_message = "Database Error: Could not prepare gallery deletion statement.";
                }
            } else {
                $error_message = "File Deletion Error: Could not delete all associated files. Database records were NOT touched.";
            }

            // =========================================================================
            // STEP 3: DELETE THE MAIN DOG RECORD (NEW STEP)
            // =========================================================================

            if ($gallery_deleted) {
                $sql_delete_dog = "DELETE FROM quill_dogs WHERE id = ?";
                $stmt_delete_dog = mysqli_prepare($conn, $sql_delete_dog);
                
                if ($stmt_delete_dog) {
                    mysqli_stmt_bind_param($stmt_delete_dog, "i", $dog_id);
                    
                    if (mysqli_stmt_execute($stmt_delete_dog)) {
                        $success = true;
                        $_SESSION['metadata'] = "The entire dog profile permanently deleted.";
                    } else {
                        // Crucial failure: Dog gallery deleted but main dog record failed
                        $error_message = "CRITICAL ERROR: Gallery deleted, but failed to delete main dog record in 'quill_dogs'.";
                    }
                    mysqli_stmt_close($stmt_delete_dog);
                } else {
                    $error_message = "Database Error: Could not prepare main dog deletion statement.";
                }
            }
            
        } else {
            $error_message = "Database Error: Could not prepare image path retrieval statement.";
        }
        
        // --- 4. Final Redirect ---
        if (!$success) {
            if (empty($error_message)) {
                 $error_message = "An unknown error occurred during the deletion process.";
            }
            $_SESSION['metadata'] = $error_message;
        }

        header("Location: quill-photos");
        exit();
        
    } else {
        // --- 5. Confirmation Prompt ---
        // Ensure the prompt uses the correct variable and destination file
        echo "<script>
        if (confirm('WARNING: Are you sure you want to delete **THIS ENTIRE DOG PROFILE** ? This action is irreversible. Click OK to delete or Cancel to go back.')) {  
            window.location.href='quill-entire?id=$dog_id&delete=true'; 
        } else {
            window.location.href='quill-photos';
        }
        </script>";
    }
?>
<?php
 


   // =========================================================================
// ADD NEW DOG AND GALLERY LOGIC
// =========================================================================
if (isset($_POST['addNewDog']) && $_POST['addNewDog'] == 1) {
    
    // Define the helper function. Keep this structure for safety.
    if (!function_exists('reArrayFiles')) {
        function reArrayFiles(&$file_post) {
            $file_ary = array();
            // Check for the first file name; if it's missing, it means no files were selected.
            if (empty($file_post['name'][0])) return $file_ary; 
            
            $file_count = count($file_post['name']);
            $file_keys = array_keys($file_post);
            
            for ($i=0; $i<$file_count; $i++) {
                foreach ($file_keys as $key) {
                    $file_ary[$i][$key] = $file_post[$key][$i];
                }
            }
            return $file_ary;
        }
    }
    
    // IMPORTANT: Check and ensure this path is correct and writable!
    $target_dir = "../assets/uploads/dogs/"; 
    $upload_success = true; // Overall status tracker
    $error_message = null; // Error message tracker
    
    // 1. Sanitize and validate input data
    $dog_name = $_POST['dog_name'] ?? '';
    $dog_info = $_POST['dog_information'] ?? '';
    $dog_status = $_POST['dog_status'] ?? 'inactive'; 
    $dog_id = null; 
    
    // --- 2. DATABASE INSERT: Insert Dog into quill_dogs ---
    if (!empty($dog_name)) {
        
        $insert_dog_sql = "INSERT INTO quill_dogs (dog_name, dog_information, status) VALUES (?, ?, ?)";
        $stmt_dog = mysqli_prepare($conn, $insert_dog_sql);
        
        if ($stmt_dog === false) {
            $upload_success = false;
            $error_message = "Error preparing dog insert statement: " . mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt_dog, "sss", $dog_name, $dog_info, $dog_status);
            
            if (mysqli_stmt_execute($stmt_dog)) {
                $dog_id = mysqli_insert_id($conn);
            } else {
                $upload_success = false;
                $error_message = "Error executing dog insert: " . mysqli_stmt_error($stmt_dog);
            }
            mysqli_stmt_close($stmt_dog);
        }
    } else {
        $upload_success = false;
        $error_message = "Dog Name is required.";
    }
    
    // --- 3. HANDLE MULTIPLE IMAGE UPLOADS (Only if dog insertion was successful) ---
    if ($upload_success && $dog_id !== null) {
        
        // --- FIX: Resolve 'cannot be passed by reference' Fatal Error ---
        // 1. Assign the $_FILES data to a variable first. 
        // This ensures a variable is passed by reference, not a temporary value from the ?? operator.
        $dog_files = $_FILES['dog_gallery_images'] ?? [];
        
        // 2. Pass the variable to the function. (This is line 1689 in your environment)
        $file_ary = reArrayFiles($dog_files); 
        // -------------------------------------------------------------------
        
        // Track how many images were successfully uploaded
        $image_count = 0;
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        // Prepare the gallery insert statement outside the loop for efficiency
        $insert_gallery_sql = "INSERT INTO quill_dog_gallery (dog_id, dog_image_path) VALUES (?, ?)";
        $stmt_gallery = mysqli_prepare($conn, $insert_gallery_sql);
        
        if ($stmt_gallery === false) {
            $upload_success = false;
            $error_message .= " | Error preparing gallery statement: " . mysqli_error($conn);
        } else {
            
            foreach ($file_ary as $file) {
                // Check if the file name is actually provided (ignore empty inputs)
                if (empty($file["name"])) continue;
                
                $output = substr(str_shuffle($permitted_chars), 0, 8);
                $original_filename = basename($file["name"]);
                
                // Use a unique name for the file
                $newname = 'dog_gal_'.$output . '_' . $original_filename; 
                $folder = $target_dir . $newname;
                $image_path_for_db = $target_dir . $newname; // Path stored in DB
                
                // Basic file upload check
                if (is_uploaded_file($file["tmp_name"]) && move_uploaded_file($file["tmp_name"], $folder)) {
                    
                    // Bind parameters: 'is' = 1 integer (dog_id), 1 string (dog_image_path)
                    mysqli_stmt_bind_param($stmt_gallery, "is", $dog_id, $image_path_for_db);
                    
                    if (mysqli_stmt_execute($stmt_gallery)) {
                        $image_count++;
                    } else {
                        $upload_success = false;
                        $error_message .= " | Failed to log image path for: " . htmlspecialchars($original_filename);
                    }
                } else {
                    $upload_success = false;
                    $error_message .= " | Failed to move uploaded file or file type check failed: " . htmlspecialchars($original_filename);
                }
            } // End foreach file
            
            mysqli_stmt_close($stmt_gallery);
            
            if ($image_count == 0) {
                // Keep track of the scenario where no images were uploaded/valid
                $error_message .= " | Note: Dog was saved, but no valid images were attached.";
            }
        }
    }
    
    // --- 4. REDIRECTION AND FEEDBACK ---
    if ($upload_success) {
        $_SESSION['metadata'] = "Dog and Gallery Saved Successfully! ({$image_count} Images added).";
    } else {
        // Use the accumulated error message
        $_SESSION['metadata'] = "Error saving dog: " . $error_message;
    }
    
    header("Location: quill-photos"); 
    exit();
}
?>
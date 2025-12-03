<?php 
    include 'includes-request.php';
    
    //UPDATE GALLERY IMAGE INFO - GALLER PAGE
    if (isset($_POST['ThisUpdate']) && $_POST['ThisUpdate'] == 1) {

        $content_id = $_POST['content_id'];
        $content_title = $_POST['content_title'];
        $content_description = $_POST['content_description'];

        $sql = "UPDATE quill_gallery SET gallery_title = ?, gallery_description = ? WHERE id = ?";
    
        $stmt = mysqli_prepare($conn, $sql);
            if ($stmt === false) {
            error_log("Failed to prepare statement: " . mysqli_error($conn));
            $_SESSION['metadata'] = "Error preparing update. Please try again.";
            header("Location: quill-photos");
            exit();
        }
     
        mysqli_stmt_bind_param($stmt, "ssi", $content_title, $content_description, $content_id);
    
        // 5. Execute the statement
        $result = mysqli_stmt_execute($stmt);
    
        // 6. Check for execution success
        if ($result) {
            $_SESSION['metadata'] = "Image Info Updated Successfully!";
            header("Location: quill-photos");
            exit();
        } else {
            // Log the error and give a generic message to the user
            error_log("Failed to execute statement: " . mysqli_stmt_error($stmt));
            $_SESSION['metadata'] = "Error updating image info. Please try again.";
            header("Location: quill-photos");
            exit();
        }
     
        mysqli_stmt_close($stmt);
     
        header("Location: quill-photos");
        exit();
    }

    //DELETE GALLERY IMAGE INFO - GALLER PAGE
    if (isset($_POST['deleteImage']) && $_POST['deleteImage'] == 1) {
     
        // Assume $conn is your valid mysqli connection object
        $content_id = $_POST['content_id'];
        $content_value = $_POST['content_value']; // IMAGE NAME


        $safe_file_name = basename($content_value);
        $full_file_path = '../assets/uploads/gallery/' . $safe_file_name;
    
        if ($content_value && file_exists($full_file_path)) {
            // Attempt to delete the file
            if (unlink($full_file_path)) {
                
                // --- STEP 3: DELETE THE DATABASE RECORD ---
                $delete_sql = "DELETE FROM quill_gallery WHERE id = ?";
                $stmt_delete = mysqli_prepare($conn, $delete_sql);
            
                if ($stmt_delete === false) {
                    error_log("Failed to prepare delete statement: " . mysqli_error($conn));
                    $_SESSION['metadata'] = "A critical server error occurred (Database delete preparation).";
                    header("Location: quill-photos");
                    exit();
                }
            
                // Bind the ID parameter (i for integer)
                mysqli_stmt_bind_param($stmt_delete, "i", $content_id);
            
                if (mysqli_stmt_execute($stmt_delete)) {
                    // Database deletion successful
                    $_SESSION['metadata'] = "Image Record Deleted Successfully!";
                    header("Location: quill-photos");
                    exit();
                } else {
                    // Database deletion failed
                    error_log("Failed to execute delete statement: " . mysqli_stmt_error($stmt_delete));
                    $_SESSION['metadata'] = "Error deleting database record. Please check logs.";
                    header("Location: quill-photos");
                    exit();
                }
            
                mysqli_stmt_close($stmt_delete);  

            } else {
                // File deletion failed (permissions issue, etc.)
                $_SESSION['metadata'] = "Warning: Failed to delete physical file on server. ";
                header("Location: quill-photos");
                exit(); 
            }
        } else { 
            
            $_SESSION['metadata'] = "Warning: Image Cannot Be Found on physical server. ";
            header("Location: quill-photos");
            exit();
        }
    
    }

    //ADD GALLERY IMAGE INFO - GALLERY PAGE
    if (isset($_POST['addNewImage']) && $_POST['addNewImage'] == 1) {

        $content_title = $_POST['gallery_title'] ?? '';
        $content_description = $_POST['gallery_description'] ?? '';
    
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $output = substr(str_shuffle($permitted_chars), 0, 8);

        // Name of the uploaded file element is 'content_value'
        $original_filename = basename($_FILES["gallery_image"]["name"] ?? '');
        $tempname = $_FILES["gallery_image"]["tmp_name"] ?? '';
    
        // Check if a file was actually uploaded and is valid
        if (empty($original_filename) || !is_uploaded_file($tempname)) {
            $_SESSION['metadata'] = "No file uploaded or upload failed.";
            header("Location: quill-photos");
            exit();
        }
        
        $newname = 'gl_'.$output . '_' . $original_filename;
        
        // Ensure this folder path is correct relative to the execution script
        // $folder will contain the full server path where the file will be saved
        $folder = "../assets/uploads/gallery/" . $newname;
        
        // $image_path_for_db will contain the relative URL/path stored in the database
        $image_path_for_db = $newname;
    
        // --- 2. FILE UPLOAD ---
    
        if (move_uploaded_file($tempname, $folder)) {
            
            // --- 3. DATABASE INSERT (Using prepared statement) ---
            // Target the new 'quill_gallery' table and match the columns:
            // gallery_image, gallery_title, gallery_description
            $insert_sql = "INSERT INTO quill_gallery (gallery_image, gallery_title, gallery_description) VALUES (?, ?, ?)";
    
            $stmt = mysqli_prepare($conn, $insert_sql);
    
            if ($stmt === false) {
                error_log("Failed to prepare statement: " . mysqli_error($conn));
                $_SESSION['metadata'] = "Error preparing database update.";
            } else {
                // Bind parameters: 's' = string (for the three fields)
                // Binding: (1) image path, (2) title, (3) description
                mysqli_stmt_bind_param($stmt, "sss", $image_path_for_db, $content_title, $content_description);
    
                if (mysqli_stmt_execute($stmt)) {
                    // Database insert successful
                    $_SESSION['metadata'] = "Image Info Saved Successfully!";
                } else {
                    // Database insert failed
                    error_log("Failed to execute statement: " . mysqli_stmt_error($stmt));
                    $_SESSION['metadata'] = "Error saving image info to database.";
                }
                mysqli_stmt_close($stmt);
            }
            
        } else {
            // File upload failed
            $_SESSION['metadata'] = "Image Not Saved, Check permissions of the 'gallery' folder.";
        }
    
        // --- 4. REDIRECT ---
        header("Location: quill-photos");
        exit();
    }

    //HOME PAGE - ADD CAROUSEL IMAGE INFO
    if (isset($_POST['addNewCarousel']) && $_POST['addNewCarousel'] == 1) {

        $carousel_title = $_POST['carousel_title'] ?? '';
        $carousel_subtitle = $_POST['carousel_subtitle'] ?? '';
        $carousel_description = $_POST['carousel_description'] ?? '';
        $carousel_position = $_POST['carousel_position'] ?? '';
    
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $output = substr(str_shuffle($permitted_chars), 0, 8);

        $original_filename = basename($_FILES["carousel_image"]["name"] ?? '');
        $tempname = $_FILES["carousel_image"]["tmp_name"] ?? '';
    
        // Check if a file was actually uploaded and is valid
        if (empty($original_filename) || !is_uploaded_file($tempname)) {
            $_SESSION['metadata'] = "No file uploaded or upload failed.";
            header("Location: quill-photos");
            exit();
        }
        
        $newname = 'car_'.$output . '_' . $original_filename;
        
         
        $folder = "../assets/uploads/carousel/" . $newname;
    
        // --- 2. FILE UPLOAD ---
    
        if (move_uploaded_file($tempname, $folder)) {
            
            $insert_sql = "INSERT INTO quill_carousel (carousel_image, carousel_title, carousel_subtitle, carousel_description, carousel_position, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
    
            $stmt = mysqli_prepare($conn, $insert_sql);
    
            if ($stmt === false) {
                error_log("Failed to prepare statement: " . mysqli_error($conn));
                $_SESSION['metadata'] = "Error preparing database update.";
            } else {
                // Bind parameters: 's' = string (for the three fields: newname, title, description)
                mysqli_stmt_bind_param($stmt, "sssss", $newname, $carousel_title, $carousel_subtitle, $carousel_description, $carousel_position);
    
                if (mysqli_stmt_execute($stmt)) {
                    // Database insert successful
                    $_SESSION['metadata'] = "Carousel Info Saved Successfully!";
                } else {
                    // Database insert failed
                    error_log("Failed to execute statement: " . mysqli_stmt_error($stmt));
                    $_SESSION['metadata'] = "Error saving carousel info to database.";
                }
                mysqli_stmt_close($stmt);
            }
            
        } else {
            // File upload failed
            $_SESSION['metadata'] = "Image Not Saved, Check permissions of the 'gallery' folder.";
        }
    
        // --- 4. REDIRECT ---
        header("Location: quill-photos");
        exit();
    }

    //HOME PAGE - UPDATE CAROUSEL IMAGE INFO
    if (isset($_POST['UpdateCarousel']) && $_POST['UpdateCarousel'] == 1) {

        $upload_dir = "../assets/uploads/carousel/";

        // --- 1. SANITIZE AND GET POST VARIABLES ---
        // Note: We are using prepared statements below, but basic sanitization is still good practice.
        $carousel_title = $_POST['carousel_title'] ?? '';
        $carousel_subtitle = $_POST['carousel_subtitle'] ?? '';
        $carousel_description = $_POST['carousel_description'] ?? '';
        $carousel_id = $_POST['carousel_id'] ?? '';
        
        // This value identifies the row to update. It is NOT updated itself.
        $carousel_position = (int)($_POST['carousel_position'] ?? 0); 
        
        // The current image filename stored in the database
        $carousel_old_image = $_POST['carousel_old_image'] ?? ''; 
    
        // Variable for success/failure handling
        $update_successful = false;
    
        // --- 2. CHECK FOR NEW IMAGE UPLOAD ---
        // Check if the file field exists AND if the upload was successful (UPLOAD_ERR_OK is 0)
        if (isset($_FILES['carousel_image']) && $_FILES['carousel_image']['error'] === UPLOAD_ERR_OK) {
    
            // ==========================================================
            //         CASE A: NEW IMAGE UPLOADED (Image & Text Update)
            // ==========================================================
            
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $output = substr(str_shuffle($permitted_chars), 0, 8);
            $original_filename = basename($_FILES["carousel_image"]["name"]);
            $tempname = $_FILES["carousel_image"]["tmp_name"];
            $new_image_filename = 'car_' . $output . '_' . $original_filename;
            $folder = $upload_dir . $new_image_filename;
    
            // Try to move the uploaded file to the destination folder
            if (move_uploaded_file($tempname, $folder)) {
                
                // 1. New file uploaded successfully, now delete the old file
                if (!empty($carousel_old_image) && $carousel_old_image != $new_image_filename) {
                    $old_file_path = $upload_dir . $carousel_old_image;
                    
                    // Ensure the file exists and is actually a file before trying to delete
                    if (file_exists($old_file_path) && is_file($old_file_path)) {
                        unlink($old_file_path);
                    }
                }
    
                // 2. Update database with new image and content
                $update_sql = "UPDATE quill_carousel 
                               SET carousel_image = ?, carousel_title = ?, carousel_subtitle = ?, carousel_description = ?, updated_at = NOW() 
                               WHERE id = ?";
    
                $stmt = mysqli_prepare($conn, $update_sql);
                
                if ($stmt) {
                    // Bind parameters: ssss (image, title, subtitle, description), i (position)
                    mysqli_stmt_bind_param($stmt, "ssssi", 
                        $new_image_filename, 
                        $carousel_title, 
                        $carousel_subtitle, 
                        $carousel_description, 
                        $carousel_id
                    );
    
                    if (mysqli_stmt_execute($stmt)) {
                        $_SESSION['metadata'] = "Carousel content and image updated successfully!";
                        $update_successful = true;
                    } else {
                        error_log("Failed to execute statement (with image): " . mysqli_stmt_error($stmt));
                        $_SESSION['metadata'] = "Error updating carousel info (DB error).";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    error_log("Failed to prepare statement (with image): " . mysqli_error($conn));
                    $_SESSION['metadata'] = "Error preparing database update.";
                }
    
            } else {
                // File upload failed (permissions/folder error)
                $_SESSION['metadata'] = "New image upload failed. Check folder permissions: {$upload_dir}";
            }
    
        } else {
            
            // ==========================================================
            //         CASE B: NO NEW IMAGE UPLOADED (Text-Only Update)
            // ==========================================================
    
            // Update database with content only (keeping existing image file name)
            $update_sql = "UPDATE quill_carousel 
                           SET carousel_title = ?, carousel_subtitle = ?, carousel_description = ?, updated_at = NOW() 
                           WHERE id = ?";
    
            $stmt = mysqli_prepare($conn, $update_sql);
    
            if ($stmt) {
                // Bind parameters: sss (title, subtitle, description), i (position)
                mysqli_stmt_bind_param($stmt, "sssi", 
                    $carousel_title, 
                    $carousel_subtitle, 
                    $carousel_description, 
                    $carousel_id
                );
    
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['metadata'] = "Carousel content updated successfully (image retained).";
                    $update_successful = true;
                } else {
                    error_log("Failed to execute statement (text-only): " . mysqli_stmt_error($stmt));
                    $_SESSION['metadata'] = "Error updating carousel info (DB error).";
                }
                mysqli_stmt_close($stmt);
            } else {
                error_log("Failed to prepare statement (text-only): " . mysqli_error($conn));
                $_SESSION['metadata'] = "Error preparing database update.";
            }
        }
    
        // --- 3. REDIRECT ---
        header("Location: quill-photos");
        exit();
    }

    // HOME PAGE - DELETE CAROUSEL IMAGE INFO
    if (isset($_POST['DeleteCarousel']) && $_POST['DeleteCarousel'] == 1) {
    
        $upload_dir = "../assets/uploads/carousel/";// --- 1. GET IDENTIFIERS ---
        // The position identifies the row to delete.
        $carousel_id = (int)($_POST['carousel_id'] ?? 0); 
        // The current image filename stored in the database
        $carousel_old_image = $_POST['carousel_old_image'] ?? ''; 
    
        // --- 2. FILE DELETION ---
        if (!empty($carousel_old_image)) {
            $old_file_path = $upload_dir . $carousel_old_image;
            
            // Ensure the file exists and is actually a file before trying to delete
            if (file_exists($old_file_path) && is_file($old_file_path)) {
                // Attempt to delete the file, logging success/failure for debugging
                if (unlink($old_file_path)) {
                     error_log("Successfully deleted file: " . $old_file_path);
                } else {
                     error_log("Failed to delete file: " . $old_file_path);
                }
            }
        }
    
        // --- 3. DATABASE DELETION ---
        // Delete the record based on the position
        $delete_sql = "DELETE FROM quill_carousel WHERE id = ?";
    
        $stmt = mysqli_prepare($conn, $delete_sql);
    
        if ($stmt) {
            // Bind parameter: i (position)
            mysqli_stmt_bind_param($stmt, "i", $carousel_id);
    
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['metadata'] = "Carousel slide deleted successfully!";
            } else {
                error_log("Failed to execute delete statement: " . mysqli_stmt_error($stmt));
                $_SESSION['metadata'] = "Error deleting carousel slide from database.";
            }
            mysqli_stmt_close($stmt);
        } else {
            error_log("Failed to prepare delete statement: " . mysqli_error($conn));
            $_SESSION['metadata'] = "Error preparing database delete.";
        }
    
        // --- 4. REDIRECT ---
        header("Location: quill-photos");
        exit();
    }

    // ABOUT SECTION - UPDATE CONTENT 
    if (isset($_POST['UpdateAbout']) && $_POST['UpdateAbout'] == 1) {

        // Define the upload directory for the about page content
        $upload_dir = "../assets/uploads/about/"; 
    
        // --- 1. SANITIZE AND GET POST VARIABLES ---
        $about_title = $_POST['about_title'] ?? '';
        $about_subtitle = $_POST['about_subtitle'] ?? '';
        $about_description = $_POST['about_description'] ?? '';
        
        // Feature sections 
        $about_head1 = $_POST['about_head1'] ?? '';
        $about_statement1 = $_POST['about_statement1'] ?? '';
        $about_head2 = $_POST['about_head2'] ?? '';
        $about_statement2 = $_POST['about_statement2'] ?? '';
        $about_head3 = $_POST['about_head3'] ?? '';
        $about_statement3 = $_POST['about_statement3'] ?? '';
    
        // ID is always 1 for the single About page record
        $about_id = (int)($_POST['about_id'] ?? 1); 
        
        // The current image filename stored in the database
        $about_old_image = $_POST['about_old_image'] ?? ''; 
        
        // Variable for success/failure handling
        $update_successful = false;
    
        // --- 2. CHECK FOR NEW IMAGE UPLOAD ---
        // Check if the file field exists AND if the upload was successful (UPLOAD_ERR_OK is 0)
        if (isset($_FILES['about_image']) && $_FILES['about_image']['error'] === UPLOAD_ERR_OK) {
    
            // ==========================================================
            //         CASE A: NEW IMAGE UPLOADED (Image & Text Update)
            // ==========================================================
            
            // Generate a unique filename
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $output = substr(str_shuffle($permitted_chars), 0, 8);
            $original_filename = basename($_FILES["about_image"]["name"]);
            $tempname = $_FILES["about_image"]["tmp_name"];
            $new_image_filename = 'abt_' . $output . '_' . $original_filename;
            $folder = $upload_dir . $new_image_filename;
    
            // Try to move the uploaded file to the destination folder
            if (move_uploaded_file($tempname, $folder)) {
                
                // 1. New file uploaded successfully, now delete the old file
                if (!empty($about_old_image) && $about_old_image != $new_image_filename) {
                    $old_file_path = $upload_dir . $about_old_image;
                    
                    // Ensure the file exists and is actually a file before trying to delete
                    if (file_exists($old_file_path) && is_file($old_file_path)) {
                        unlink($old_file_path);
                    }
                }
    
                // 2. Update database with new image and content
                $update_sql = "UPDATE quill_about 
                               SET about_image = ?, about_title = ?, about_subtitle = ?, about_description = ?,
                                   about_head1 = ?, about_statement1 = ?, about_head2 = ?, about_statement2 = ?,
                                   about_head3 = ?, about_statement3 = ?, updated_at = NOW() 
                               WHERE id = ?";
                
                $stmt = mysqli_prepare($conn, $update_sql);
                
                if ($stmt) {
                    // Bind parameters: 10 strings (image + 9 text fields), 1 integer (id)
                    mysqli_stmt_bind_param($stmt, "ssssssssssi", 
                        $new_image_filename,
                        $about_title, 
                        $about_subtitle, 
                        $about_description, 
                        $about_head1,
                        $about_statement1,
                        $about_head2,
                        $about_statement2,
                        $about_head3,
                        $about_statement3,
                        $about_id
                    );
    
                    if (mysqli_stmt_execute($stmt)) {
                        $_SESSION['metadata'] = "About content and image updated successfully!";
                        $update_successful = true;
                    } else {
                        error_log("Failed to execute statement (with image): " . mysqli_stmt_error($stmt));
                        $_SESSION['metadata'] = "Error updating About info (DB error).";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    error_log("Failed to prepare statement (with image): " . mysqli_error($conn));
                    $_SESSION['metadata'] = "Error preparing database update.";
                }
    
            } else {
                // File upload failed (permissions/folder error)
                $_SESSION['metadata'] = "New image upload failed. Check folder permissions: {$upload_dir}";
            }
    
        } else {
            
            // ==========================================================
            //         CASE B: NO NEW IMAGE UPLOADED (Text-Only Update)
            // ==========================================================
    
            // Update database with content only (keeping existing image file name)
            $update_sql = "UPDATE quill_about 
                           SET about_title = ?, about_subtitle = ?, about_description = ?,
                               about_head1 = ?, about_statement1 = ?, about_head2 = ?, about_statement2 = ?,
                               about_head3 = ?, about_statement3 = ?, updated_at = NOW() 
                           WHERE id = ?";
    
            $stmt = mysqli_prepare($conn, $update_sql);
    
            if ($stmt) {
                // Bind parameters: 9 strings (text fields), 1 integer (id)
                mysqli_stmt_bind_param($stmt, "sssssssssi", 
                    $about_title, 
                    $about_subtitle, 
                    $about_description, 
                    $about_head1,
                    $about_statement1,
                    $about_head2,
                    $about_statement2,
                    $about_head3,
                    $about_statement3,
                    $about_id
                );
    
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['metadata'] = "About content updated successfully (image retained).";
                    $update_successful = true;
                } else {
                    error_log("Failed to execute statement (text-only): " . mysqli_stmt_error($stmt));
                    $_SESSION['metadata'] = "Error updating About info (DB error).";
                }
                mysqli_stmt_close($stmt);
            } else {
                error_log("Failed to prepare statement (text-only): " . mysqli_error($conn));
                $_SESSION['metadata'] = "Error preparing database update.";
            }
        } 
        
        header("Location: quill-photos"); // Adjust the redirect URL as needed
        exit();
    }

    // UPDATE SECTION HEADER 
    if (isset($_POST['UpdateSectionHeader']) && $_POST['UpdateSectionHeader'] == 1) {
        
        // 1. Sanitize and retrieve POST data
        $section_id = $_POST['section_id'] ?? null;
        $title = $_POST['section_title'] ?? '';
        $subtitle = $_POST['section_subtitle'] ?? '';
        $description = $_POST['section_description'] ?? '';
        
        // Simple validation (check if ID is set and title is not empty)
        if ($section_id && !empty($title)) {
            
            // 2. Prepare the SQL statement
            // Update the 'title', 'subtitle', and 'description' columns based on the 'id'
            $sql = "UPDATE quill_section_headers SET title = ?, subtitle = ?, description = ? WHERE id = ?";
            
            if ($stmt = mysqli_prepare($conn, $sql)) {
                
                // 3. Bind parameters (s = string, i = integer)
                mysqli_stmt_bind_param($stmt, "sssi", $title, $subtitle, $description, $section_id);
                
                // 4. Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    // Success: Update successful
                    // Use $_SESSION['metadata'] for messaging and perform Post/Redirect/Get (PRG)
                    $_SESSION['metadata'] = "Section header updated successfully!";
                    header("Location: quill-photos");
                    exit();
                } else {
                    // Error: Execution failed
                    error_log("Error executing statement: " . mysqli_stmt_error($stmt));
                    // Use $_SESSION['metadata'] for error message
                    $_SESSION['metadata'] = "Error updating record: " . mysqli_stmt_error($stmt);
                    header("Location: quill-photos");
                    exit();
                }
                
                // 5. Close the statement
                mysqli_stmt_close($stmt);
                
            } else {
                // Error: Preparation failed
                error_log("Error preparing statement: " . mysqli_error($conn));
                // Use $_SESSION['metadata'] for error message
                $_SESSION['metadata'] = "Database error: Could not prepare statement.";
                header("Location: quill-photos");
                exit();
            }
            
        } else {
            // Validation failed
            // Use $_SESSION['metadata'] for warning message
            $_SESSION['metadata'] = "Error: Required fields are missing.";
            header("Location: quill-photos");
            exit();
        }
    }

    // UPDATE CONTACT INFOR  
    if (isset($_POST['UpdateContact']) && $_POST['UpdateContact'] == 1) {
    
        // 1. Sanitize and retrieve POST data
        // Use the null coalescing operator (??) for safety
        $contact_id = $_POST['contact_id'] ?? null;
        
        // Retrieve all fields from the form
        $follow_header = $_POST['follow_header'] ?? '';
        $location_header = $_POST['location_header'] ?? '';
        $mail_header = $_POST['mail_header'] ?? '';
        $call_header = $_POST['call_header'] ?? '';
        $location = $_POST['location'] ?? '';
        $mail = $_POST['mail'] ?? '';
        $call = $_POST['call'] ?? '';
        $gps_map_url = $_POST['gps_map_url'] ?? '';
        $sm_1 = $_POST['sm_1'] ?? '';
        $sm_link1 = $_POST['sm_link1'] ?? '';
        $sm_2 = $_POST['sm_2'] ?? '';
        $sm_link2 = $_POST['sm_link2'] ?? '';
        $sm_3 = $_POST['sm_3'] ?? '';
        $sm_link3 = $_POST['sm_link3'] ?? '';
        $sm_4 = $_POST['sm_4'] ?? '';
        $sm_link4 = $_POST['sm_link4'] ?? '';
        $follow = $_POST['follow'] ?? '';
        
        // Simple validation (check if ID is set)
        if ($contact_id !== null) {
            
            // 2. Prepare the SQL statement with placeholders (?)
            $sql = "UPDATE quill_contact SET
                follow_header = ?,
                location_header = ?,
                mail_header = ?,
                call_header = ?,
                location = ?,
                mail = ?,
                `call` = ?,
                gps_map_url = ?,
                sm_1 = ?,
                sm_link1 = ?,
                sm_2 = ?,
                sm_link2 = ?,
                sm_3 = ?,
                sm_link3 = ?,
                sm_4 = ?,
                sm_link4 = ?,
                follow = ?
            WHERE id = ? LIMIT 1";
            
            if ($stmt = mysqli_prepare($conn, $sql)) {
                
                // 3. Bind parameters (s = string, i = integer)
                // 16 strings, 1 integer (ID)
                mysqli_stmt_bind_param($stmt, "sssssssssssssssssi", 
                    $follow_header, $location_header, $mail_header, $call_header, 
                    $location, $mail, $call, $gps_map_url, 
                    $sm_1, $sm_link1, $sm_2, $sm_link2, $sm_3, $sm_link3, $sm_4, $sm_link4, $follow, 
                    $contact_id
                );
                
                // 4. Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['metadata'] = "Contact information updated successfully!";
                    header("Location: quill-photos");
                    exit(); 
                } else {
                    // Error: Execution failed
                    error_log("Error executing statement: " . mysqli_stmt_error($stmt));
                    $status = "error";
                    $_SESSION['metadata'] = "Error updating record: " . mysqli_stmt_error($stmt);
                }
                
                // 5. Close the statement
                mysqli_stmt_close($stmt);
                
            } else {
                // Error: Preparation failed
                error_log("Error preparing statement: " . mysqli_error($conn));
                $status = "error";
                $_SESSION['metadata'] = "Database error: Could not prepare statement.";
            }
            
        } else {
            // Validation failed (ID missing)
            $status = "warning";
           $_SESSION['metadata'] = "Error: Contact ID is missing.";
        }
    
        header("Location: quill-photos");
        exit(); 
    
    }

    //ADD TESTIMONIAL INFO - TESTIMONIAL PAGE
    if (isset($_POST['addNewTestimonial']) && $_POST['addNewTestimonial'] == 1) {
         
 
        $full_name = $_POST['testimonial_full_name'] ?? '';
        $content = $_POST['testimonial_content'] ?? '';
        $profession = $_POST['testimonial_profession'] ?? '';
        $rating = (int)($_POST['testimonial_rating'] ?? 5);  // Cast rating to integer

        // 2. Prepare file upload variables
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $output = substr(str_shuffle($permitted_chars), 0, 8);

        // File input name is 'testimonial_image'
        $original_filename = basename($_FILES["testimonial_image"]["name"] ?? '');
        $tempname = $_FILES["testimonial_image"]["tmp_name"] ?? '';
        
        $image_path_for_db = 'default.png'; // Default to null if no image is uploaded (VARCHAR allows null)
        $upload_success = true; // Tracks file upload status

        // Check if a file was provided and handle upload
        if (!empty($original_filename) && is_uploaded_file($tempname)) {
            $newname = 'ts_'.$output . '_' . $original_filename; // Prefix with 'ts' for testimonial
            // Server-side path where the file will be saved
            // NOTE: Ensure the folder '../assets/img/uploads/testimonials/' exists and is writeable.
            $folder = "../assets/uploads/testimonials/" . $newname; 

            if (move_uploaded_file($tempname, $folder)) {
                // Path stored in DB is relative to the web root
                $image_path_for_db = $newname;
            } else {
                $upload_success = false;
                $_SESSION['metadata'] = "Image Not Saved, Check permissions of the 'testimonials' folder.";
            }
        }

        // --- 3. DATABASE INSERT (Using prepared statement) ---
        // Proceed only if file upload succeeded (or if no file was uploaded) AND required text fields are present
        if ($upload_success && !empty($full_name) && !empty($content)) {
            
            // Target the 'quill_testimonials' table and its columns
            $insert_sql = "INSERT INTO quill_testimonials (testimonial_image, testimonial_content, testimonial_full_name, testimonial_profession, testimonial_rating) VALUES (?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $insert_sql);

            if ($stmt === false) {
                // Error preparing statement (e.g., table/column name incorrect)
                error_log("Failed to prepare statement: " . mysqli_error($conn));
                $_SESSION['metadata'] = "Error preparing database update. Check log for details.";
            } else {
                // Bind parameters: 'ssssi' = 4 strings (for image path, content, full name, profession), 1 integer (for rating)
                mysqli_stmt_bind_param($stmt, "ssssi", 
                    $image_path_for_db, $content, $full_name, $profession, $rating
                );

                if (mysqli_stmt_execute($stmt)) {
                    // Database insert successful
                    $_SESSION['metadata'] = "Testimonial Saved Successfully!";
                } else {
                    // Database insert failed
                    error_log("Failed to execute statement: " . mysqli_stmt_error($stmt));
                    $_SESSION['metadata'] = "Error saving testimonial to database: " . mysqli_stmt_error($stmt);
                }
                mysqli_stmt_close($stmt);
            }
        } elseif (!$upload_success) {
            // Error message already set during upload fail
        } else {
             // Handle case where required text fields are missing
             $_SESSION['metadata'] = "Error: Full Name and Testimonial Content are required.";
        }
        
        // --- 4. REDIRECT ---
        // Assuming 'quill-photos' is the correct page to redirect to
        header("Location: quill-photos");
        exit();
    }

    //UPDATE TESTIMONIAL INFO - TESTIMONIAL PAGE
    if (isset($_POST['ThisUpdateTst']) && $_POST['ThisUpdateTst'] == 1) {
      

        // 1. Retrieve required inputs
        $testimonial_id = (int)$_POST['testimonial_id'];
        $full_name = $_POST['testimonial_full_name'] ?? '';
        $content = $_POST['testimonial_content'] ?? '';
        $profession = $_POST['testimonial_profession'] ?? '';
        $rating = (int)($_POST['testimonial_rating'] ?? 5);  
        
        // Current image path stored in a hidden field from the modal
        $current_image_path = $_POST['current_image_path'] ?? null; 
        $image_path_for_db = $current_image_path; // Assume current path unless updated

        // 2. Handle new file upload (input name is 'testimonial_image_new')
        $upload_success = true;
        $new_image_file = $_FILES["testimonial_image_new"] ?? null;

        if ($new_image_file && !empty($new_image_file["name"]) && is_uploaded_file($new_image_file["tmp_name"])) {
            
            // Generate unique filename
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $output = substr(str_shuffle($permitted_chars), 0, 8);
            $original_filename = basename($new_image_file["name"]);
            $newname = 'ts_update_'.$output . '_' . $original_filename;
            
            // Server-side path where the file will be saved
            $folder = "../assets/uploads/testimonials/" . $newname; 

            if (move_uploaded_file($new_image_file["tmp_name"], $folder)) {
                
                // Set new path for DB
                $image_path_for_db = $newname;

                // Attempt to delete old image file if it existed
                if ($current_image_path) {
                    $old_file_path = "../assets/uploads/testimonials/" . $current_image_path; // Reconstruct server path
                    if (file_exists($old_file_path) && !is_dir($old_file_path)) {
                        unlink($old_file_path);
                    }
                }
                
            } else {
                $upload_success = false;
                $_SESSION['metadata'] = "Image update failed: File not saved. Check permissions.";
            }
        }
        
        // --- 3. DATABASE UPDATE (Using prepared statement) ---
        if ($upload_success && !empty($full_name) && !empty($content)) {
            
            $update_sql = "UPDATE quill_testimonials 
                           SET testimonial_image = ?, 
                               testimonial_content = ?, 
                               testimonial_full_name = ?, 
                               testimonial_profession = ?, 
                               testimonial_rating = ?
                           WHERE id = ?";

            $stmt = mysqli_prepare($conn, $update_sql);

            if ($stmt === false) {
                error_log("Update prepare failed: " . mysqli_error($conn));
                $_SESSION['metadata'] = "Error preparing update statement.";
            } else {
                // Bind parameters: 'ssssii' = 4 strings (image, content, name, profession), 2 integers (rating, id)
                mysqli_stmt_bind_param($stmt, "ssssii", 
                    $image_path_for_db, $content, $full_name, $profession, $rating, $testimonial_id
                );

                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['metadata'] = "Testimonial Updated Successfully!";
                } else {
                    error_log("Update execute failed: " . mysqli_stmt_error($stmt));
                    $_SESSION['metadata'] = "Error updating testimonial in database.";
                }
                mysqli_stmt_close($stmt);
            }
        } elseif (!$upload_success) {
            // Error message already set during upload fail
        } else {
             $_SESSION['metadata'] = "Error: Full Name and Testimonial Content are required for update.";
        }
        
        // --- 4. REDIRECT ---
        header("Location: quill-photos");
        exit();
    }

    //DELETE TESTIMONIAL INFO - TESTIMONIAL PAGE
    if (isset($_POST['DeleteTestimonial']) && $_POST['DeleteTestimonial'] == 1) {
         

        $testimonial_id = (int)$_POST['testimonial_id'];
        // This variable is passed from the hidden field in the delete modal
        $image_path_for_deletion = $_POST['testimonial_image_path'] ?? null;

        // 1. Delete file from the file system (if one exists)
        if (!empty($image_path_for_deletion)) {
            $file_to_delete = "../assets/uploads/testimonials/" . $image_path_for_deletion; // Reconstruct server path

            // Check if the file exists and is not a directory before attempting unlink
            if (file_exists($file_to_delete) && !is_dir($file_to_delete)) {
                if (unlink($file_to_delete)) {
                    error_log("Testimonial image deleted successfully: " . $file_to_delete);
                } else {
                    // Log the error but continue to delete the DB record
                    error_log("Warning: Failed to delete image file from disk: " . $file_to_delete);
                }
            } else {
                 error_log("Warning: Image file not found or path invalid for deletion: " . $file_to_delete);
            }
        }


        // 2. Delete database record using prepared statement
        $delete_sql = "DELETE FROM quill_testimonials WHERE id = ?";
        
        $stmt = mysqli_prepare($conn, $delete_sql);

        if ($stmt === false) {
            error_log("Delete prepare failed: " . mysqli_error($conn));
            $_SESSION['metadata'] = "Error preparing delete statement.";
        } else {
            // Bind parameter: 'i' = integer (for ID)
            mysqli_stmt_bind_param($stmt, "i", $testimonial_id);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['metadata'] = "Testimonial Deleted Successfully!";
            } else {
                error_log("Delete execute failed: " . mysqli_stmt_error($stmt));
                $_SESSION['metadata'] = "Error deleting testimonial from database.";
            }
            mysqli_stmt_close($stmt);
        }
        
        // --- 3. REDIRECT ---
        header("Location: quill-photos");
        exit();
    }

    //ADD NEW DOCUMENT - DOCUMENT MODAL
    if (isset($_POST['addNewDocument']) && $_POST['addNewDocument'] == 1) {
    
        // 1. Retrieve text inputs
        $document_title = $_POST['document_title'] ?? '';
        $document_description = $_POST['document_description'] ?? '';
    
        // Simple validation for required fields
        if (empty($document_title)) {
            $_SESSION['metadata'] = "Error: Document Title is required.";
            header("Location: quill-photos");
            exit();
        }
        
        // 2. File handling preparation
        $uploaded_file = $_FILES["document_file"] ?? null;
        $original_filename = basename($uploaded_file["name"] ?? '');
        $tempname = $uploaded_file["tmp_name"] ?? '';
    
        // Check if a file was actually uploaded and is valid
        if (empty($original_filename) || !is_uploaded_file($tempname)) {
            $_SESSION['metadata'] = "Error: No file uploaded or upload failed.";
            header("Location: quill-photos");
            exit();
        }
        
        // --- SERVER-SIDE PDF VALIDATION ---
        // Check file type using mime_content_type for security
        $file_mime_type = mime_content_type($tempname);
        
        // Accept common MIME types for PDF
        if ($file_mime_type !== 'application/pdf' && $file_mime_type !== 'application/x-pdf') {
            $_SESSION['metadata'] = "Error: Only PDF files are allowed for upload. Detected type: " . $file_mime_type;
            // Optionally delete the temp file if not done automatically
            @unlink($tempname); 
            header("Location: quill-photos");
            exit();
        }
        
        // 3. Generate unique filename
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $output = substr(str_shuffle($permitted_chars), 0, 8);
        
        // Prefix for documents to distinguish them
        $newname = 'doc_' . $output . '_' . $original_filename;
        
        // Server-side folder path where the file will be saved
        // Ensure the permissions are set correctly for this directory on your server.
        // NOTE: This assumes a directory '../assets/uploads/documents/' exists.
        $folder = "../assets/uploads/documents/" . $newname;
        
        // Path stored in the database
        $document_path_for_db = $newname;
        
        // --- 4. FILE UPLOAD ---
        if (move_uploaded_file($tempname, $folder)) {
            
            // --- 5. DATABASE INSERT (Using prepared statement) ---
            // Target table: quill_documents (Inferred schema provided in the next file)
            $insert_sql = "INSERT INTO quill_documents (document_name, document_title, document_description) VALUES (?, ?, ?)";
            
            $stmt = mysqli_prepare($conn, $insert_sql);
    
            if ($stmt === false) {
                error_log("Document upload prepare failed: " . mysqli_error($conn));
                $_SESSION['metadata'] = "Error preparing database insert for document.";
            } else {
                // Bind parameters: 'sss' = 3 strings (path, title, description)
                mysqli_stmt_bind_param($stmt, "sss", $document_path_for_db, $document_title, $document_description);
    
                if (mysqli_stmt_execute($stmt)) {
                    // Database insert successful
                    $_SESSION['metadata'] = "Document Uploaded and Info Saved Successfully!";
                } else {
                    // Database insert failed
                    error_log("Document upload execute failed: " . mysqli_stmt_error($stmt));
                    $_SESSION['metadata'] = "Error saving document info to database.";
                }
                mysqli_stmt_close($stmt);
            }
            
        } else {
            // File upload failed
            $_SESSION['metadata'] = "Document Not Saved. Check permissions of the 'documents' upload folder.";
        }
        
        // --- 6. REDIRECT ---
        header("Location: quill-photos"); // Redirect to the appropriate management page
        exit();
    }

    //DELETE DOCUMENT INFO - DOCUMENT MANAGEMENT
    if (isset($_POST['DeleteDocument']) && $_POST['DeleteDocument'] == 1) {
         
        $document_id = (int)$_POST['document_id'];
        // This variable is passed from the hidden field in the delete modal (e.g., 'assets/uploads/documents/doc_...').
        $document_file_path = $_POST['document_file_path'] ?? null;
    
        // 1. Delete file from the file system (if one exists)
        if (!empty($document_file_path)) {
            // Construct the server path by going up one directory (from the script execution point)
            // and appending the full relative path stored in the database.
            $file_to_delete = "../assets/uploads/documents/" . $document_file_path; 
    
            // Check if the file exists and is not a directory before attempting unlink
            if (file_exists($file_to_delete) && !is_dir($file_to_delete)) {
                if (unlink($file_to_delete)) {
                    error_log("Document file deleted successfully: " . $file_to_delete);
                } else {
                    // Log the error but continue to delete the DB record
                    error_log("Warning: Failed to delete document file from disk: " . $file_to_delete);
                }
            } else {
                 error_log("Warning: Document file not found or path invalid for deletion: " . $file_to_delete);
            }
        }
    
    
        // 2. Delete database record using prepared statement
        // Target table: quill_documents
        $delete_sql = "DELETE FROM quill_documents WHERE id = ?";
        
        $stmt = mysqli_prepare($conn, $delete_sql);
    
        if ($stmt === false) {
            error_log("Document delete prepare failed: " . mysqli_error($conn));
            $_SESSION['metadata'] = "Error preparing document delete statement.";
        } else {
            // Bind parameter: 'i' = integer (for ID)
            mysqli_stmt_bind_param($stmt, "i", $document_id);
    
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['metadata'] = "Document Deleted Successfully!";
            } else {
                error_log("Document delete execute failed: " . mysqli_stmt_error($stmt));
                $_SESSION['metadata'] = "Error deleting document from database.";
            }
            mysqli_stmt_close($stmt);
        }
        
        // --- 3. REDIRECT ---
        header("Location: quill-photos"); // Redirect to the appropriate management page
        exit();
    }

?> 
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Manage Content . Helentor Amstaffs</title>
    <link rel="apple-touch-icon" href="../assets/img/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
 

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/selects/select2.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/toggle/switchery.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/validation/form-validation.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/pickers/daterange/daterange.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<?php include ("includes-header.php"); ?>


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="navigation-header"><span>Helentor Amstaffs</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
                </li>
                <li class="nav-item"><a href="mi-dashboard"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Email Application">Dashboard</span></a>
                </li>
                <li class="nav-item"><a href="javascript:void(0);"><i class="feather icon-globe"></i><span class="menu-title" data-i18n="Dashboard">Web Pages</span><span class="badge badge badge-primary badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="pages-manage" data-i18n="eCommerce">Manage Pages</a>
                        </li>
                        <li class="active"><a class="menu-item" href="quill-photos" data-i18n="eCommerce">Manage Content</a>
                        </li>
                    </ul>
                </li>
                
               
                <li class=" navigation-header"><span>Authentication</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i>
                </li>
                <li class="nav-item"><a href="account-settings"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Email Application">Mange Profile</span></a>
                </li>
                <li class="nav-item">
                    <a href="users-manage">
                        <i class="feather icon-users"></i>
                        <span class="menu-title" data-i18n="Email Application">Mange Users</span>
                        <?php 
                            $har_survey0 ="SELECT COUNT(*) as total FROM users";
                            $har_survey1 = mysqli_query($conn,$har_survey0) or die(mysqli_error($con));
                            $har_survey2 = mysqli_fetch_assoc($har_survey1);                
                        ?>
                        <span class="badge badge badge-success badge-pill float-right mr-3"><?php echo $har_survey2['total'];?></span>
                    </a>
                </li>  
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Manage Media & Content</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="mi-dashboard">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Media</a>
                                </li>
                                <li class="breadcrumb-item active">Manage Media & Content
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                       <a class="btn btn-primary square" href="mi-dashboard"><i class="fa fa-home"></i> Home Page</a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i class="feather icon-file-text"></i>
                                        Documents
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-carousel" data-toggle="pill" href="#account-vertical-carousel" aria-expanded="false">
                                        <i class="feather icon-play"></i>
                                        Home Carousel
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-about" data-toggle="pill" href="#account-vertical-about" aria-expanded="false">
                                        <i class="feather icon-info"></i>
                                        About Section
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-headers" data-toggle="pill" href="#account-vertical-headers" aria-expanded="false">
                                        <i class="feather icon-layout"></i>
                                        Section Headers
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-gallery" data-toggle="pill" href="#account-vertical-gallery" aria-expanded="false">
                                        <i class="feather icon-camera"></i>
                                        Gallery Page
                                    </a>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-blog" data-toggle="pill" href="#account-vertical-blog" aria-expanded="false">
                                        <i class="feather icon-feather"></i>
                                        Blog
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-listing" data-toggle="pill" href="#account-vertical-listing" aria-expanded="false">
                                        <i class="feather icon-list"></i>
                                        Item Listing
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-faqs" data-toggle="pill" href="#account-vertical-faqs" aria-expanded="false">
                                        <i class="feather icon-help-circle"></i>
                                        FAQs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-policy" data-toggle="pill" href="#account-vertical-policy" aria-expanded="false">
                                        <i class="feather icon-shield"></i>
                                        Privacy Policy
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-terms" data-toggle="pill" href="#account-vertical-terms" aria-expanded="false">
                                        <i class="feather icon-camera"></i>
                                        Terms & Conditions
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-testimonials" data-toggle="pill" href="#account-vertical-testimonials" aria-expanded="false">
                                        <i class="feather icon-file-text"></i>
                                        Testimonials
                                    </a>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-contact" data-toggle="pill" href="#account-vertical-contact" aria-expanded="false">
                                        <i class="feather icon-phone-incoming"></i>
                                        Contact Page
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">

                                            <!-- HOME PAGE -->
                                            <?php include 'quill.documents.php'; ?>

                                            <!-- ABOUT PAGE -->
                                            <?php include 'quill.about.php';?>

                                            <!-- GALLERY PAGE-->
                                            <?php include 'quill.gallery.php';?>

                                            <!-- CAROUSEL PAGE-->
                                            <?php include 'quill.carousel.php';?>

                                            <!-- SECTION HEADERS PAGE -->
                                            <?php include 'quill.section.php';?>

                                            <!-- CONTACT PAGE -->
                                            <?php include 'quill.contact.php'; ?>

                                            <!-- TESTIMONIALS --> 
                                            <?php include 'quill.testimonials.php' ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account setting page end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    
    <?php include("includes-footer.php");?>


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="app-assets/vendors/js/forms/toggle/switchery.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/account-setting.js"></script>
    <!-- END: Page JS-->

    <?php unset($_SESSION['metadata']); unset($_SESSION['wrong_metadata']); ?>


</body>
<!-- END: Body-->

</html>
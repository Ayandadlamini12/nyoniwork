<?php 
    include 'includes-request.php';
    
 
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
        $dog_is = $_POST['dog_is'] ?? '';
        $dog_status = $_POST['dog_status'] ?? 'inactive'; 
        $dog_id = null; 
        
        // --- 2. DATABASE INSERT: Insert Dog into quill_dogs ---
        if (!empty($dog_name)) {
            
            $insert_dog_sql = "INSERT INTO quill_dogs (dog_name, dog_information, status, dog_is) VALUES (?, ?, ?, ?)";
            $stmt_dog = mysqli_prepare($conn, $insert_dog_sql);
            
            if ($stmt_dog === false) {
                $upload_success = false;
                $error_message = "Error preparing dog insert statement: " . mysqli_error($conn);
            } else {
                mysqli_stmt_bind_param($stmt_dog, "ssss", $dog_name, $dog_info, $dog_status, $dog_is);
                
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
                        mysqli_stmt_bind_param($stmt_gallery, "is", $dog_id, $newname);
                        
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
        
        header("Location: kb-dogs"); 
        exit();
    }

    // =========================================================================
    // DOG GALLERY LOGIC
    // =========================================================================
    if (isset($_POST['DogGallery']) && $_POST['DogGallery'] == 1) {
        
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
        $dog_id = $_POST['dog_id'] ?? ''; 
         
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
                        mysqli_stmt_bind_param($stmt_gallery, "is", $dog_id, $newname);
                        
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
                    $error_message .= " | Note: No valid images were attached.";
                }
            }
        }
        
        // --- 4. REDIRECTION AND FEEDBACK ---
        if ($upload_success) {
            $_SESSION['metadata'] = "Gallery Saved Successfully! ({$image_count} Images added).";
        } else {
            // Use the accumulated error message
            $_SESSION['metadata'] = "Error saving dog: " . $error_message;
        }
        
        header("Location: kb-dogs"); 
        exit();
    }


    // DOG DETAILS SECTION - UPDATE CONTENT
    if (isset($_POST['updateDogDetails']) && $_POST['updateDogDetails'] == 1) {
    
        // --- 1. SANITIZE AND GET POST VARIABLES ---
        
        // CRITICAL: Get the ID of the dog to be updated
        $dog_id = (int)($_POST['dog_id'] ?? 0); 
        
        // Get and sanitize the fields to be updated
        $dog_name = $_POST['dog_name'] ?? '';
        $dog_information = $_POST['dog_information'] ?? '';
        $dog_status = $_POST['dog_status'] ?? '';
    
        // Sanitize string inputs (basic sanitation, further validation is recommended)
        $dog_name = htmlspecialchars(trim($dog_name));
        $dog_information = htmlspecialchars(trim($dog_information));
        $dog_status = htmlspecialchars(trim($dog_status));
    
        // Variable for success/failure handling
        $update_successful = false;
    
        // --- 2. VALIDATION ---
        if ($dog_id <= 0) {
            $_SESSION['metadata'] = "Error: Dog ID not provided for update.";
        } elseif (empty($dog_name) || empty($dog_information) || empty($dog_status)) {
            $_SESSION['metadata'] = "Error: All fields are required.";
        } else {
            
            // --- 3. DATABASE UPDATE (No Image Logic Needed) ---
            
            $update_sql = "UPDATE quill_dogs
                           SET dog_name = ?, 
                               dog_information = ?, 
                               status = ?
                           WHERE id = ?";
    
            $stmt = mysqli_prepare($conn, $update_sql);
    
            if ($stmt) {
                // Bind parameters: 3 strings (name, info, status), 1 integer (id)
                mysqli_stmt_bind_param($stmt, "sssi",
                    $dog_name,
                    $dog_information,
                    $dog_status,
                    $dog_id
                );
    
                if (mysqli_stmt_execute($stmt)) {
                    
                    // Check if any row was actually updated
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        $_SESSION['metadata'] = "Dog Details Updated Successfully!";
                        $update_successful = true;
                    } else {
                        $_SESSION['metadata'] = "No changes detected for Dog ID: " . $dog_id . ".";
                        $update_successful = true; // Still a successful operation, just no changes
                    }
                    
                } else {
                    error_log("Failed to execute update statement: " . mysqli_stmt_error($stmt));
                    $_SESSION['metadata'] = "Error updating dog details (Database execution failed).";
                }
                mysqli_stmt_close($stmt);
            } else {
                error_log("Failed to prepare statement: " . mysqli_error($conn));
                $_SESSION['metadata'] = "Error preparing database update statement.";
            }
        }
        
        // Redirect back to the dog management page
        header("Location: kb-dogs"); 
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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
 

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/selects/select2.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/toggle/switchery.min.css">
    <!-- END: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/quill/katex.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/quill/monokai-sublime.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/quill/quill.bubble.css">

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
    <style>
        /* Adjust height for the Quill editor */
        #editor-container {
            height: 300px; 
            background-color: white;
        }
        .container { max-width: 800px; margin-top: 50px; }
    </style>

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
                        <li><a class="menu-item" href="quill-photos" data-i18n="eCommerce">Manage Content</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a href="javascript:void(0);"><i class="feather icon-target"></i><span class="menu-title" data-i18n="Dashboard">Knowledge Base</span></a>
                    <ul class="menu-content">
                        <li class="active"><a class="menu-item" href="kb-dogs" data-i18n="eCommerce">Our Dogs</a>
                        </li>
                        <li><a class="menu-item" href="kb-shows" data-i18n="eCommerce">Show Info</a>
                        </li>
                        <li><a class="menu-item" href="kb-litter" data-i18n="eCommerce">Next Litter</a>
                        </li>
                        <li><a class="menu-item" href="kb-dogs" data-i18n="eCommerce">Important Documents</a>
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
                                <li class="breadcrumb-item"><a href="mi-dashboard" class="text-dark">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="text-dark">Media</a>
                                </li>
                                <li class="breadcrumb-item active">Manage Media & Content
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                       <a class="btn btn-dark square" href="mi-dashboard"><i class="fa fa-home"></i> Home Page</a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row"> 
                        <!-- right content section -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <?php if (isset($_SESSION['metadata'])): ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <strong><?php echo $_SESSION['metadata']; ?></strong>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION['wrong_metadata'])): ?>
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <strong><?php echo $_SESSION['wrong_metadata']; ?></strong>
                                            </div>
                                        <?php endif; ?>  
                                        <div class="row match-height">
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mr-1">
                                                <a data-toggle="modal" data-target="#addNewDog" class="btn btn-info">Add New Dog</a>
                                                <a data-toggle="modal" data-target="#DogGallery" class="btn btn-outline-secondary">Upload Gallery</a>
                                        
                                                <div class="modal fade text-left" id="addNewDog" tabindex="-1" role="dialog" aria-labelledby="myModalLabelAddNewDog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabelAddNewDog">Add New Dog Information & Gallery</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="kb-dogs" enctype="multipart/form-data" method="POST">
                                                                    <div class="modal-body">
                                                                        
                                                                        <label>Dog Name:</label>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control border-dark" style="color: black;" name="dog_name" required placeholder="Enter Dog's Name">
                                                                            <input type="hidden" name="addNewDog" value="1">
                                                                        </div>
                                        
                                                                        <label>Information/Bio:</label>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control border-dark" style="color: black;" name="dog_information" rows="4" placeholder="Enter Dog's Information"></textarea>
                                                                        </div>
                                                                        
                                                                        <label>Status (Visible on Site):</label>
                                                                        <div class="form-group">
                                                                            <select class="form-control border-dark" name="dog_status" required style="color: black;">
                                                                                <option value="Yes">Yes</option>
                                                                                <option value="No">No</option>
                                                                            </select>
                                                                        </div>

                                                                        <label>Dog Info Is?:</label>
                                                                        <div class="form-group">
                                                                            <select class="form-control border-dark" name="dog_is" required style="color: black;">
                                                                                <option value="Knowledge Base">Knowledge Base</option>
                                                                                <option value="Gallery">Gallery</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <hr>
                                        
                                                                        <label for="dogGalleryFiles">Upload Dog Gallery Images (Multiple)</label>
                                                                        <div class="form-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="dogGalleryFiles" name="dog_gallery_images[]" required multiple>
                                                                                <label class="custom-file-label" for="dogGalleryFiles">Choose files</label>
                                                                            </div>
                                                                            <small class="form-text text-muted">Select multiple image files at once.</small>
                                                                        </div>
                                        
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                                                        <input type="submit" class="btn btn-outline-primary btn-lg" value="Save Dog">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade text-left" id="DogGallery" tabindex="-1" role="dialog" aria-labelledby="myModalDogGallery" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalDogGallery">Upload Dog Gallery</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="kb-dogs" enctype="multipart/form-data" method="POST">
                                                                    <div class="modal-body">
                                                                        
                                                                       <?php
                                                                             
                                                                            $dogs = [];
                                                                            
                                                                            // Select the dog's ID and Name
                                                                            $sql_dogs = "SELECT id, dog_name FROM quill_dogs ORDER BY dog_name ASC";
                                                                            $result_dogs = $conn->query($sql_dogs);
                                                                            
                                                                            if ($result_dogs && $result_dogs->num_rows > 0) {
                                                                                // Fetch all results into the $dogs array
                                                                                while ($row = $result_dogs->fetch_assoc()) {
                                                                                    $dogs[] = $row;
                                                                                }
                                                                            }
                                                                            ?>
                                                                            
                                                                            <label>Select Dog:</label>
                                                                            <div class="form-group">
                                                                                <select class="form-control border-dark" name="dog_id" required style="color: black;">
                                                                                    <option value="">Select Dog</option>
                                                                                    
                                                                                    <?php 
                                                                                    if (!empty($dogs)) :
                                                                                        foreach ($dogs as $dog) : 
                                                                                            // Use dog's ID as the value and the dog's name for display
                                                                                            $dog_id = htmlspecialchars($dog['id']);
                                                                                            $dog_name = htmlspecialchars($dog['dog_name']);
                                                                                    ?>
                                                                                            <option value="<?php echo $dog_id; ?>"><?php echo $dog_name; ?></option>
                                                                                    <?php 
                                                                                        endforeach;
                                                                                    else :
                                                                                    ?>
                                                                                        <option value="" disabled>No Dogs Available</option>
                                                                                    <?php
                                                                                    endif;
                                                                                    ?>
                                                                                </select>
                                                                                <input type="hidden" name="DogGallery" value="1">
                                                                            </div>
                                                                        
                                                                        <hr>
                                        
                                                                        <label for="dogGalleryFiles">Upload Dog Gallery Images (Multiple)</label>
                                                                        <div class="form-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="dogGalleryFiles" name="dog_gallery_images[]" required multiple>
                                                                                <label class="custom-file-label" for="dogGalleryFiles">Choose files</label>
                                                                            </div>
                                                                            <small class="form-text text-muted">Select multiple image files at once.</small>
                                                                        </div>
                                        
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                                                        <input type="submit" class="btn btn-outline-primary btn-lg" value="Upload Gallery">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="form-section"><hr></h4> 

                                        <div class="row">
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Dog Name</th>  
                                                        <th>Visible on Site</th> 
                                                        <th>Dog Info Is?</th>
                                                        <th>Manage</th> 
                                                        <th style="text-align: center;">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $count=1;
                                                        $sel_query="SELECT * FROM quill_dogs ORDER BY id ASC";
                                                        $result = mysqli_query($conn,$sel_query) or die(mysqli_error($con));
                                                        while($row = mysqli_fetch_assoc($result)) { 
    
                                                            $this_status = $row['status'];
                                                            if ($this_status == 'Yes') {
                                                                $display_this = '<div class="badge badge-success badge-pill" style="width:100%;">Yes</div>';
                                                            }elseif ($this_status == 'No') {
                                                                $display_this = '<div class="badge badge-danger badge-pill" style="width:100%;">No</div>';
                                                            } 
             
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $count++; ?></td>
                                                        <td><?php echo $row["dog_name"];?></td>
                                                        <td><?php echo $row["status"];?></td> 
                                                        <td><?php echo $row["dog_is"];?></td> 
                                                        <td> 
                                                           <div class="btn-group float-md-center" role="group" aria-label="Button group with nested dropdown">
                                                                <a class="btn btn-success text-white" data-toggle="modal" data-target="#viewDog<?php echo $row['id']; ?>">
                                                                    <i class="feather icon-eye"></i>
                                                                </a> 
                                                                <a class="btn btn-secondary text-white" data-toggle="modal" data-target="#deleteDogGallery<?php echo $row['id']; ?>">
                                                                    <i class="feather icon-image"></i>
                                                                </a>   
                                                            </div>
                                                        </td>
                                                        <td> 
                                                           <div class="btn-group float-md-center" role="group" aria-label="Button group with nested dropdown"> 
                                                                <a class="btn btn-primary text-white" data-toggle="modal" data-target="#editDogDetailsModal<?php echo $row['id']; ?>">
                                                                    <i class="feather icon-edit"></i>
                                                                </a>
                                                                <a href="quill-entire?id=<?php echo $row['id']; ?>" class="btn btn-danger text-white">
                                                                    <i class="feather icon-trash"></i>
                                                                </a>  
                                                            </div>
                                                            <?php include 'quill.kmodals.php';?>
                                                        </td>
                                                    </tr> 
                                                    <?php $count++; } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Dog Name</th>  
                                                        <th>Visible on Site</th>
                                                        <th>Dog Info Is?</th>
                                                        <th>Manage</th>   
                                                        <th style="text-align: center;">Actions</th>
                                                    </tr>
                                                </tfoot>
                                            </table>     
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
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/forms/quill/highlight.min.js"></script>
    <script src="app-assets/vendors/js/forms/quill/quill.js"></script>
    <script src="app-assets/vendors/js/forms/quill/katex.min.js"></script>
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        // 1. Initialize Quill
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Write your amazing blog content here...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });
    
        // 2. Hook into the form submission event
        var form = document.getElementById('blogPostForm');
        var hiddenContentInput = document.getElementById('blog_content_hidden');
        
        // Crucial step: Before submitting, copy Quill's content to the hidden input
        form.onsubmit = function() {
            // Get the HTML content from the Quill editor
            var htmlContent = quill.root.innerHTML;
            
            // Check if the content is just the default placeholder/empty state
            // You might want a stricter check depending on your requirements
            if (htmlContent === '<p><br></p>') {
                hiddenContentInput.value = ''; // Ensure empty content submits as empty string
            } else {
                // Set the value of the hidden input field
                hiddenContentInput.value = htmlContent;
            }
    
            // The form will now submit with the blog content in $_POST['blog_content']
            return true; 
        };
    
        // 1. Initialize Quill
        var quill1 = new Quill('#editor-containers', {
            theme: 'snow',
            placeholder: 'Write your amazing blog content here...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });
    
        // 2. Hook into the form submission event
        var form1 = document.getElementById('blogPostForm1');
        var hiddenContentInput1 = document.getElementById('blog_content_hidden1');
        
        // Crucial step: Before submitting, copy Quill's content to the hidden input
        form1.onsubmit = function() {
            // Get the HTML content from the Quill editor
            var htmlContent1 = quill.root.innerHTML;
            
            // Check if the content is just the default placeholder/empty state
            // You might want a stricter check depending on your requirements
            if (htmlContent1 === '<p><br></p>') {
                hiddenContentInput1.value = ''; // Ensure empty content submits as empty string
            } else {
                // Set the value of the hidden input field
                hiddenContentInput1.value = htmlContent1;
            }
    
            // The form will now submit with the blog content in $_POST['blog_content']
            return true; 
        };

    </script>
    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/account-setting.js"></script>
    <!-- END: Page JS-->

     <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/forms/quill/form-text-editor.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script> 
    <script src="app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>

    <!-- END: Page JS-->

    <?php unset($_SESSION['metadata']); unset($_SESSION['wrong_metadata']); ?> 


</body>
<!-- END: Body-->

</html>
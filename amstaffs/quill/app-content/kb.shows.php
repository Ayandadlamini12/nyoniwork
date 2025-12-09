<?php 
    include 'includes-request.php';
    //ADD NEW DOCUMENT - DOCUMENT MODAL
    if (isset($_POST['addNewDocument']) && $_POST['addNewDocument'] == 1) {
    
        // 1. Retrieve text inputs
        $document_title = $_POST['document_title'] ?? '';
        $document_description = $_POST['document_description'] ?? '';
    
        // Simple validation for required fields
        if (empty($document_title)) {
            $_SESSION['metadata'] = "Error: Document Title is required.";
            header("Location: kb-shows");
            exit();
        }
        
        // 2. File handling preparation
        $uploaded_file = $_FILES["document_file"] ?? null;
        $original_filename = basename($uploaded_file["name"] ?? '');
        $tempname = $uploaded_file["tmp_name"] ?? '';
    
        // Check if a file was actually uploaded and is valid
        if (empty($original_filename) || !is_uploaded_file($tempname)) {
            $_SESSION['metadata'] = "Error: No file uploaded or upload failed.";
            header("Location: kb-shows");
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
            header("Location: kb-shows");
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
        $folder = "../assets/uploads/shows/" . $newname;
        
        // Path stored in the database
        $document_path_for_db = $newname;
        
        // --- 4. FILE UPLOAD ---
        if (move_uploaded_file($tempname, $folder)) {
            
            // --- 5. DATABASE INSERT (Using prepared statement) ---
            // Target table: quill_documents (Inferred schema provided in the next file)
            $insert_sql = "INSERT INTO quill_shows (document_name, document_title, document_description) VALUES (?, ?, ?)";
            
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
        header("Location: kb-shows"); // Redirect to the appropriate management page
        exit();
    }

    //DELETE DOCUMENT INFO - DOCUMENT MANAGEMENT
    if (isset($_POST['DeleteDocument']) && $_POST['DeleteDocument'] == 1) {
         
        $document_id = (int)$_POST['document_id'];
        // This variable is passed from the hidden field in the delete modal (e.g., 'assets/uploads/shows/doc_...').
        $document_file_path = $_POST['document_file_path'] ?? null;
    
        // 1. Delete file from the file system (if one exists)
        if (!empty($document_file_path)) {
            // Construct the server path by going up one directory (from the script execution point)
            // and appending the full relative path stored in the database.
            $file_to_delete = "../assets/uploads/shows/" . $document_file_path; 
    
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
        // Target table: quill_shows
        $delete_sql = "DELETE FROM quill_shows WHERE id = ?";
        
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
        header("Location: kb-shows"); // Redirect to the appropriate management page
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
                        <li><a class="menu-item" href="kb-shows" data-i18n="eCommerce">Manage Content</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a href="javascript:void(0);"><i class="feather icon-target"></i><span class="menu-title" data-i18n="Dashboard">Knowledge Base</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="kb-dogs" data-i18n="eCommerce">Our Dogs</a>
                        </li>
                        <li class="active"><a class="menu-item" href="kb-shows" data-i18n="eCommerce">Show Info</a>
                        </li>
                        <li><a class="menu-item" href="kb-litter" data-i18n="eCommerce">Next Litter</a>
                        </li>
                        <li><a class="menu-item" href="quill-photos" data-i18n="eCommerce">Important Documents</a>
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
                                        <!--shows -->
 
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
    <h4 class="form-section"><i class="fa fa-media"></i> SHOW INFORMATION</h4>

    <div class="row">
    <div class="col-md-12 form-group">  
        <div class="row match-height">
            <?php
            // 1. SELECT Query for shows
            $sql_docs = "SELECT * FROM quill_shows
                         ORDER BY document_uploaded_at DESC"; 
            
            // Execute the query
            $result_docs = $conn->query($sql_docs);
            
            // Check for query errors
            if ($result_docs === false) {
                echo "<p class='text-danger'>Database query for shows failed: " . $conn->error . "</p>";
                $result_docs = (object) ['num_rows' => 0]; // Set result to prevent further errors
            }
            
            if ($result_docs->num_rows > 0) {
                // 2. Loop through the fetched document results
                while($doc_row = $result_docs->fetch_assoc()) {
                    // Map Document columns to PHP variables
                    $document_id = htmlspecialchars($doc_row['id']);
                    $d_title = htmlspecialchars($doc_row['document_title']);
                    $d_description = htmlspecialchars($doc_row['document_description']);
                    $d_filename = htmlspecialchars($doc_row['document_name']); // Stored file path/name
                    $d_uploaded_at = date('Y-m-d H:i', strtotime($doc_row['document_uploaded_at'])); // Formatted date
                    
                    // Assuming shows are stored in a dedicated server directory
                    // NOTE: You must adjust the path below to match your server structure
                    $full_file_path = "assets/shows/" . $d_filename; 
                    
                    // Simple logic to determine a document type icon (e.g., based on extension)
                    $file_ext = pathinfo($d_filename, PATHINFO_EXTENSION);
                    $icon_class = 'feather icon-file'; 
                    if (strtolower($file_ext) === 'pdf') {
                        $icon_class = 'feather icon-file-text';
                    } elseif (in_array(strtolower($file_ext), ['doc', 'docx'])) {
                         $icon_class = 'feather icon-file-plus';
                    }
            ?> 

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 document-item mb-1">
    <div class="card shadow-lg border-0 h-100 rounded-lg">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title text-primary d-flex align-items-center mb-2">
                    <!-- Icon based on the file type (since we only allow PDF, we can use a standard PDF icon) -->
                    <i class="feather icon-file-text mr-2" style="font-size: 7.5rem;"></i> 
                    <?php echo htmlspecialchars($d_title); ?>
                </h4>
                <p class="card-text text-muted mb-1">
                    <small>Uploaded: <?php echo htmlspecialchars($d_uploaded_at); ?></small>
                </p>
                <p class="card-text text-dark">
                    <?php echo htmlspecialchars(substr($d_description, 0, 100)); ?> 
                    <?php echo (strlen($d_description) > 100) ? '...' : ''; ?>
                </p>
            </div>
            <div class="card-body"> 
                
                <!-- VIEW BUTTON: Triggers the Modal -->
                <a href="#" data-toggle="modal" data-target="#viewDocModal<?php echo $document_id; ?>" class="btn btn-outline-dark rounded-pill">
                    <i class="feather icon-eye"></i> View Document
                </a>
                
                <!-- DELETE BUTTON: Triggers the Delete Confirmation Modal -->
                <a data-toggle="modal" data-target="#deleteDocModal<?php echo $document_id; ?>" class="btn btn-outline-danger rounded-pill">
                    <i class="feather icon-trash-2"></i> Delete
                </a>
                
            </div>
        </div>
    </div>
</div>

<!-- 1. VIEW PDF MODAL (Using iframe for inline viewing) -->
<div class="modal fade" id="viewDocModal<?php echo $document_id; ?>" tabindex="-1" role="dialog" aria-labelledby="viewDocModalLabel<?php echo $document_id; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDocModalLabel<?php echo $document_id; ?>">Viewing: <?php echo htmlspecialchars($d_title); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" style="min-height: 80vh;">
                <!-- 
                    Using an iframe to embed the PDF. The 'document_path' should be the relative 
                    path stored in the database (e.g., assets/uploads/shows/...). 
                    The path must be correct relative to the script running this.
                -->
                <iframe 
                    src="../assets/uploads/shows/<?php echo htmlspecialchars($d_filename); ?>" 
                    style="width: 100%; height: 80vh; border: none;"
                    frameborder="0"
                    allowfullscreen
                    title="PDF Viewer for <?php echo htmlspecialchars($d_title); ?>"
                >
                    <p>It looks like your browser does not support iframes. You can <a href="../assets/uploads/shows/<?php echo htmlspecialchars($d_filename); ?>" target="_blank">download the PDF here</a>.</p>
                </iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close Viewer</button>
            </div>
        </div>
    </div>
</div>


<!-- 2. DELETE CONFIRMATION MODAL -->
<div class="modal fade" id="deleteDocModal<?php echo $document_id; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteDocModalLabel<?php echo $document_id; ?>" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteDocModalLabel<?php echo $document_id; ?>">Confirm Deletion</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="kb-shows" method="POST">
                <div class="modal-body text-center">
                    <p>Are you sure you want to delete the document "<strong><?php echo htmlspecialchars($d_title); ?></strong>"?</p>
                    <small class="text-danger">This action cannot be undone and will delete the file from the server.</small>
                    
                    <input type="hidden" name="DeleteDocument" value="1">
                    <input type="hidden" name="document_id" value="<?php echo $document_id; ?>">
                    <input type="hidden" name="document_file_path" value="<?php echo htmlspecialchars($d_filename); ?>">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete It</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
            
          

            <?php 
                } // End while loop
            } else { 
            ?>
            <div class="col-12">
                <p class="text-center text-danger mt-2">No shows have been uploaded yet.</p>
            </div>
            <?php 
            } // End if num_rows
            ?>
        </div>
    </div> 
</div>

<div class="row mb-4"> 
    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
        <!-- Button to trigger the New Document Modal -->
        <a data-toggle="modal" data-target="#NewDocument" class="btn btn-outline-dark">
            <i class="feather icon-upload-cloud mr-1"></i> New Show Info
        </a>
    
        <!-- NEW DOCUMENT UPLOAD MODAL -->
        <div class="modal fade text-left" id="NewDocument" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNewDocument" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabelNewDocument">Upload New Show Content</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                        <!-- The form action should point to your PHP handler script (e.g., 'quill-shows.php' or 'kb-shows' as per your reference) -->
                        <form action="kb-shows" enctype="multipart/form-data" method="POST">
                            <div class="modal-body">
                                
                                <input type="hidden" name="addNewDocument" value="1">
                                
                                <!-- Document Title -->
                                <label>Title:</label>
                                <div class="form-group"> 
                                    <input type="text" class="form-control border-dark" style="color: black;" name="document_title" required="" placeholder="Enter Show Title">
                                </div> 
                                
                                <!-- Document Description -->
                                <label>Description:</label>
                                <div class="form-group">
                                    <textarea class="form-control border-dark" style="color: black;" name="document_description" placeholder="A brief description of the document content." rows="5"></textarea> 
                                </div>
                                
                                <!-- File Upload Input (Document) -->
                                <label for="documentFileUpload">Select Show File:</label>
                                <div class="form-group">  
                                    <div class="custom-file">
                                        <!-- Field name matches database column: document_name (stores the filename) -->
                                        <!-- Added accept="application/pdf" to restrict file types -->
                                        <input type="file" class="custom-file-input" id="documentFileUpload" name="document_file" required accept="application/pdf">
                                        <label class="custom-file-label" for="documentFileUpload">Choose file</label>
                                    </div>  
                                    <!-- Updated text to reflect PDF-only restriction -->
                                    <small class="text-muted">Max file size: 5MB. Allowed format: PDF only.</small>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="reset" class="btn btn-outline-dark btn-lg" data-dismiss="modal" value="Close">
                                <input type="submit" class="btn btn-outline-primary btn-lg" value="Save Info">
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
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
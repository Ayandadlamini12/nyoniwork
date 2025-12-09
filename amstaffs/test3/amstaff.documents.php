<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Documents . Helentor Amstaffs</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicons -->
        <link href="img/favicon.ico" rel="icon">
        <link href="img/favicon.ico" rel="apple-touch-icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Teko:wght@300..700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">


    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid header-top">
            <div class="nav-shaps-2"></div>
            <div class="container d-flex align-items-center">
                <div class="d-flex align-items-center h-100">
                    <a href="#" class="navbar-brand" style="height: 125px;"> 
                        <img src="img/logo.png" alt="Logo">
                    </a>
                </div>
                <div class="w-100 h-100">
                    <?php include 'amstaff.top.bar.php';?>
                    <div class="nav-bar px-0 py-lg-0" style="height: 80px;">
                        <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-lg-end">
                            <a href="#" class="navbar-brand-2"> 
                                 <img src="img/logo.png" alt="Logo" style="width: 70%;">
                            </a> 
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                                <span class="fa fa-bars"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <div class="navbar-nav mx-0 mx-lg-auto">
                                    <a href="./" class="nav-item nav-link">Home</a>
                                    <a href="about-us" class="nav-item nav-link">About</a>
                                    <a href="our-services" class="nav-item nav-link">Services</a>
                                    <a href="breed" class="nav-item nav-link ">Breed</a>
                                    <a href="gallery" class="nav-item nav-link">Gallery</a>
                                    <a href="blog" class="nav-item nav-link">Blog</a>
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link active" data-bs-toggle="dropdown">
                                            <span class="dropdown-toggle">Resources</span>
                                        </a>
                                        <div class="dropdown-menu"> 
                                            <a href="javascript:void(0);" class="dropdown-item">FAQs</a>
                                            <a href="documents" class="dropdown-item">Documents</a>
                                            <a href="testimonials" class="dropdown-item">Testimonial</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Privacy Policy</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Terms & Conditions</a>
                                        </div>
                                    </div>
                                    <a href="contact-us" class="nav-item nav-link">Contact</a>
                                    <div class="nav-btn ps-3">
                                        <!--<button class="btn-search btn btn-primary btn-md-square mt-2 mt-lg-0 mb-4 mb-lg-0 flex-shrink-0" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button> -->
                                        <a href="#breed" class="btn btn-primary py-2 px-4 ms-0 ms-lg-3"> <span>Get Started</span></a>
                                    </div>
                                    <div class="nav-shaps-1"></div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center bg-primary">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="btn bg-light border nput-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Documents</h4>
                   
            </div>
        </div>
        <!-- Header End -->
  
<style>
    /* Custom CSS replacing Tailwind for better isolation */
    :root {
        --primary-color: #4f46e5; /* Indigo 600 */
        --primary-hover: #4338ca; /* Indigo 700 */
        --text-dark: #1f2937; /* Gray 900 */
        --text-medium: #6b7280; /* Gray 600 */
        --text-light: #9ca3af; /* Gray 400 */
        --background-light: #f7f9fc;
        --card-border: #f3f4f6; /* Gray 100 */
    }

    /* Base Layout */
    .document-section {
        background-color: var(--background-light);
        padding: 3rem 0; /* py-12 */
    }
    @media (min-width: 768px) {
        .document-section {
            padding: 4rem 0; /* md:py-16 */
        }
    }
    .custom-container {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        padding-left: 1rem; /* px-4 */
        padding-right: 1rem; /* px-4 */
    }
    @media (min-width: 640px) {
        .custom-container { padding-left: 1.5rem; padding-right: 1.5rem; } /* sm:px-6 */
    }
    @media (min-width: 1024px) {
        .custom-container { padding-left: 2rem; padding-right: 2rem; } /* lg:px-8 */
    }
    .max-w-4xl { max-width: 56rem; }
    .mx-auto { margin-left: auto; margin-right: auto; }
    .text-center { text-align: center; }
    .pb-8 { padding-bottom: 2rem; }
    @media (min-width: 768px) { .md-pb-12 { padding-bottom: 3rem; } }

    /* Typography */
    .uppercase { text-transform: uppercase; }
    .text-primary-sm { 
        color: var(--primary-color); 
        font-size: 0.875rem; /* text-sm */
        font-weight: 600; 
        letter-spacing: 0.05em; /* tracking-wider */
        margin-bottom: 0.5rem;
    }
    .main-title {
        color: var(--text-dark);
        font-size: 2.25rem; /* text-4xl */
        line-height: 1.2; /* leading-tight */
        font-weight: 800; /* font-extrabold */
        margin-bottom: 1rem;
    }
    @media (min-width: 640px) { .main-title { font-size: 3rem; } } /* sm:text-5xl */
    @media (min-width: 1024px) { .main-title { font-size: 3.75rem; } } /* lg:text-6xl */
    
    .subtitle {
        font-size: 1.125rem; /* text-lg */
        color: var(--text-medium);
        max-width: 42rem;
        margin-left: auto;
        margin-right: auto;
    }
    .text-muted { color: var(--text-medium); }
    .text-dark { color: var(--text-dark); }
    .text-xs { font-size: 0.75rem; }
    .text-sm { font-size: 0.875rem; }
    .text-xl { font-size: 1.25rem; }
    .font-bold { font-weight: 700; }
    .leading-tight { line-height: 1.25; }
    
    /* Grid Layout */
    .document-grid {
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 2rem; /* gap-8 */
    }
    @media (min-width: 768px) {
        .document-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } /* md:grid-cols-2 */
    }
    @media (min-width: 1024px) {
        .document-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } /* lg:grid-cols-3 */
    }
    
    /* Utility for Empty State to Span 3 Columns on large screen */
    @media (min-width: 1024px) {
        .lg-col-span-3 {
            grid-column: span 3 / span 3;
        }
    }
    /* Styling for Empty State Card */
    .document-card-empty {
        text-align: center;
        padding-top: 3rem; /* py-12 */
        padding-bottom: 3rem; /* py-12 */
        background-color: white;
        border-radius: 1rem; /* rounded-xl */
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-lg */
    }
    .text-gray-500 { color: #6b7280; }
    .text-gray-400 { color: #9ca3af; }
    .text-lg { font-size: 1.125rem; }


    /* Document Card */
    .document-card {
        background-color: white;
        padding: 1.5rem; /* p-6 */
        border-radius: 1rem; /* rounded-2xl */
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-xl */
        border: 1px solid var(--card-border);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .document-card-top-row {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
    }
    .document-icon {
        color: var(--primary-color);
        margin-right: 1rem;
    }

    /* View Button */
    .btn-view {
        background-color: var(--primary-color);
        color: white;
        font-size: 0.875rem; /* text-sm */
        padding: 0.5rem 1.5rem; /* px-6 py-2 */
        border-radius: 9999px; /* rounded-full */
        transition: background-color 0.15s ease-in-out;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    }
    .btn-view:hover {
        background-color: var(--primary-hover);
    }
    .justify-center { justify-content: center; }
    .border-t { border-top: 1px solid var(--card-border); }
    .pt-4 { padding-top: 1rem; }
    .mb-3 { margin-bottom: 0.75rem; }
    .mb-4 { margin-bottom: 1rem; }
    .mb-6 { margin-bottom: 1.5rem; }
    
    /* Modal Styling Adjustments */
    .modal-content { border-radius: 1rem; }
    .modal-header { 
        background-color: var(--card-border);
        border-bottom: 1px solid #e5e7eb;
    }
    .modal-footer {
        background-color: var(--card-border);
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
    }
    .modal-btn-close {
        background-color: var(--text-medium);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        transition: background-color 0.15s ease-in-out;
    }
    .modal-btn-close:hover {
        background-color: #4b5563; /* Gray 700 */
    }
</style>

<!-- Documents Start: Beautiful and Responsive Header -->
<div class="document-section">
    <div class="custom-container">
        <div class="text-center mx-auto pb-8 md-pb-12 max-w-4xl"> 
            <h1 class="main-title text-dark">
                Check Out Our Latest Resources
            </h1>
            <p class="subtitle">
                This is a list of our essential documents relating to pup care, purchasing guidelines, and fraud prevention information.
            </p>
        </div>
        
        <?php
         
        $document_data = []; 
        if (isset($conn)) {
             // Fetch all documents, ordered by creation date (newest first)
             $select_sql = "SELECT id, document_title, document_description, document_name, document_uploaded_at FROM quill_documents ORDER BY id ASC";
             $result = mysqli_query($conn, $select_sql);
             
             if ($result && mysqli_num_rows($result) > 0) {
                 while ($row = mysqli_fetch_assoc($result)) {
                     $document_data[] = $row;
                 }
                 mysqli_free_result($result);
             }
        } else {
             // Display an error if the database connection is missing
             echo '<div class="text-center py-4 text-red-500">Error: Database connection not available. Cannot fetch documents.</div>';
        }

        ?>

        <!-- Grid for Document Cards -->
        <div class="document-grid">
            
            <?php if (!empty($document_data)): ?>
                <?php foreach ($document_data as $row): 
                    $document_id = $row['id'];
                    $d_title = $row['document_title'];
                    $d_description = $row['document_description'];
                    $document_path = $row['document_name']; 
                    $d_uploaded_at = date('M d, Y', strtotime($row['document_uploaded_at']));
                ?>

                <!-- DOCUMENT CARD ITEM START -->
                <div class="document-item">
                    <div class="document-card">
                        <div>
                            <!-- Document Icon and Title -->
                            <div class="document-card-top-row">
                                <i class="feather icon-file-text document-icon" style="font-size: 2.5rem;"></i>
                                <h4 class="text-xl font-bold text-dark leading-tight"><?php echo htmlspecialchars($d_title); ?></h4>
                            </div>
                            <!-- Metadata -->
                            <p class="text-xs text-muted mb-3">
                                Published: <?php echo htmlspecialchars($d_uploaded_at); ?>
                            </p>
                            <!-- Description -->
                            <p class="text-muted text-sm mb-6">
                                <?php echo nl2br(htmlspecialchars(substr($d_description, 0, 150))); ?> 
                                <?php echo (strlen($d_description) > 150) ? '...' : ''; ?>
                            </p>
                        </div>
                        
                        <!-- Actions (Only View Button) -->
                        <div class="flex justify-center border-t pt-4"> 
                            <!-- VIEW BUTTON: Now opens the document directly in a new tab -->
                            <a href="assets/uploads/documents/<?php echo htmlspecialchars($document_path); ?>" target="_blank" class="btn btn-dark btn-action">
                                <i class="feather icon-eye mr-1"></i> View Document
                            </a>
                        </div>
                    </div>
                </div>
                <!-- DOCUMENT CARD ITEM END -->
                
                
                
                <?php endforeach; ?>
            <?php else: ?>
                <!-- This div now uses the custom class lg-col-span-3 for correct 3-column span on large screens -->
                <div class="document-item lg-col-span-3 document-card-empty">
                    <i class="feather icon-folder-minus text-gray-400 mb-3" style="font-size: 3rem;"></i>
                    <p class="text-lg text-gray-500">No documents are currently available.</p>
                    <p class="text-sm text-gray-400">Please check back later.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Documents End -->

    <?php include 'amstaff.footer.php'; ?>
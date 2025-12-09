<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Gallery . Helentor Amstaffs</title>
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

        <style>
    /* Custom CSS for Gallery Section */
    :root {
        --primary-color: #4f46e5; /* Indigo 600 */
        --text-dark: #1f2937; /* Gray 900 */
        --text-medium: #6b7280; /* Gray 600 */
        --background-light: #f7f9fc;
        --card-border: #e5e7eb; /* Gray 200 */
        --lightbox-bg: rgba(0, 0, 0, 0.9);
    }

    /* Base Layout */
    .gallery-section {
        background-color: var(--background-light);
        padding: 3rem 0; /* py-12 */
    }
    @media (min-width: 768px) {
        .gallery-section {
            padding: 4rem 0; /* md:py-16 */
        }
    }
    .custom-container {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        padding-left: 1rem; /* px-4 */
        padding-right: 1rem; /* px-4 */
        max-width: 72rem; /* Max width for content */
    }
    @media (min-width: 640px) {
        .custom-container { padding-left: 1.5rem; padding-right: 1.5rem; }
    }
    @media (min-width: 1024px) {
        .custom-container { padding-left: 2rem; padding-right: 2rem; }
    }
    .text-center { text-align: center; }

    /* Typography */
    .text-primary-sm { 
        color: var(--primary-color); 
        font-size: 0.875rem; 
        font-weight: 600; 
        letter-spacing: 0.05em; 
        margin-bottom: 0.5rem;
    }
    .main-title {
        color: var(--text-dark);
        font-size: 2.5rem; 
        line-height: 1.2; 
        font-weight: 800; 
        margin-bottom: 1rem;
    }
    .subtitle {
        font-size: 1.125rem;
        color: var(--text-medium);
        max-width: 42rem;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 3rem;
    }
    .text-muted { color: var(--text-medium); }
    .text-dark { color: var(--text-dark); }
    .font-bold { font-weight: 700; }
    
    /* Grid Layout */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 2rem; /* gap-8 */
    }
    @media (min-width: 640px) {
        .gallery-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } /* sm:grid-cols-2 */
    }
    @media (min-width: 1024px) {
        .gallery-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } /* lg:grid-cols-3 */
    }

    /* Gallery Card */
    .gallery-card {
        background-color: white;
        border-radius: 1rem; /* rounded-xl */
        overflow: hidden; /* Ensures image respects border-radius */
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        height: 100%;
        display: flex;
        flex-direction: column;
        cursor: pointer; /* Indicate clickable element */
    }
    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .gallery-image-container {
        width: 100%;
        /* 4:3 Aspect Ratio: Padding top is (3/4 * 100%) = 75% */
        padding-top: 75%; 
        position: relative;
        overflow: hidden;
    }
    .gallery-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the container without distortion */
        transition: transform 0.5s ease-in-out;
    }
    .gallery-card:hover .gallery-image {
        transform: scale(1.05);
    }

    .gallery-content {
        padding: 1.5rem; /* p-6 */
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .gallery-title {
        font-size: 1.5rem; /* text-2xl */
        font-weight: 700;
        color: var(--primary-color);
        margin-top: 0;
        margin-bottom: 0.5rem;
    }
    .gallery-description {
        font-size: 0.9rem; /* text-sm */
        color: var(--text-medium);
        margin-bottom: 0;
    }
    
    /* Empty State */
    .empty-state {
        grid-column: 1 / -1; /* Span all columns */
        text-align: center;
        padding: 4rem 2rem;
        background-color: white;
        border-radius: 1rem;
        border: 2px dashed var(--card-border);
    }
    .text-gray-400 { color: #9ca3af; }
    .text-gray-500 { color: #6b7280; }
    
    /* ============================================== */
    /* Lightbox/Modal Styles for Zoom */
    /* ============================================== */
    .lightbox-modal {
        position: fixed;
        z-index: 1000; 
        inset: 0;
        width: 100vw;
        height: 100vh;
        overflow-y: auto;
        background-color: var(--lightbox-bg);
        padding: 2rem 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .lightbox-modal.is-visible {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .lightbox-content {
        width: min(90vw, 1200px);
        max-height: 90vh;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 1rem;
    }

    .lightbox-image {
        width: 100%;
        height: auto;
        max-height: calc(90vh - 8rem);
        object-fit: contain;
        display: block;
        border-radius: 0.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    #caption-title {
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        margin: 0 0 0.5rem 0;
    }
    
    #caption-description {
        color: #ddd;
        font-size: 1rem;
        text-align: center;
        padding: 0 1rem;
        max-width: 800px;
    }

    .lightbox-close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: white;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
        cursor: pointer;
    }

    .lightbox-close:hover,
    .lightbox-close:focus {
        color: var(--primary-color);
        text-decoration: none;
        cursor: pointer;
    }
</style>

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
                                    <a href="breed" class="nav-item nav-link">Breed</a>
                                    <a href="gallery" class="nav-item nav-link active">Gallery</a>
                                    <a href="blog" class="nav-item nav-link">Blog</a>
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
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
                                        <a href="#gallery" class="btn btn-primary py-2 px-4 ms-0 ms-lg-3"> <span>Get Started</span></a>
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
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Gallery</h4>
                   
            </div>
        </div>
        <!-- Header End -->

        <!-- Explore Start -->
        <div class="container-fluid explore py-1 wow zoomIn" data-wow-delay="0.2s">
            <div class="container py-5 text-center">
                <h3 class="text-dark mb-3"> Check Our Gallery</h3> 
                <!-- Grid for Gallery Cards -->
                <div class="gallery-grid">

                    <?php 
                        // --- 1. Configuration & Path Setup ---
                        // Change the image base path to the dogs directory
                        $image_base_path = 'assets/uploads/dogs/';
                        $detail_page_url = 'dog-gallery';  
                        $sql_gallery = "
                            SELECT
                                d.id AS dog_id,
                                d.dog_name AS gallery_title,
                                d.dog_information AS gallery_description,
                                (SELECT dog_image_path FROM quill_dog_gallery WHERE dog_id = d.id ORDER BY id ASC LIMIT 1) AS gallery_image
                            FROM
                                quill_dogs d
                            WHERE
                                d.dog_is = 'Gallery'
                            ORDER BY
                                d.id ASC
                        ";
                        
                        // Execute the query
                        $result_gallery = $conn->query($sql_gallery);
                        
                        // --- 3. Loop Through Database Results ---
                        if ($result_gallery && $result_gallery->num_rows > 0) {
                            while ($row = $result_gallery->fetch_assoc()) {
                                
                                // --- 4. Process Data and Determine URL ---
                                $dog_id = (int)$row['dog_id'];
                                $title = htmlspecialchars($row['gallery_title']);
                                // Use dog_information for the description
                                $description = htmlspecialchars($row['gallery_description'] ?? 'Click for more details.');
                                $image_filename = htmlspecialchars($row['gallery_image']);
                                
                                // Construct the full image source path
                                // Check if an image was found, otherwise use a placeholder
                                if (!empty($image_filename)) {
                                    $image_src = $image_base_path . $image_filename;
                                } else {
                                    // Placeholder if no image is available
                                    $image_src = 'https://placehold.co/600x450/e0e0e0/555555?text=No+Image';
                                }
                
                                // Construct the URL with the dog ID
                                $url = $detail_page_url . '?each=' . $dog_id;
                    ?>

                    <div class="gallery-item">
                        <div class="gallery-card">
                            <div class="gallery-image-container">
                                <img src="<?php echo $image_src; ?>" alt="<?php echo $title; ?>" class="gallery-image" onerror="this.onerror=null; this.src='https://placehold.co/600x450/e0e0e0/555555?text=Image+Error'">
                            </div>

                            <div class="gallery-content">
                                <div class="mb-3">
                                    <h2 class="gallery-title text-dark"><?php echo $title; ?></h2>
                                    <p class="gallery-description" style="text-align: justify;"><?php echo $description; ?></p> 
                                </div>
                                <div>
                                    <a href="<?php echo $url; ?>" class="btn btn-primary">View Gallery</a>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <?php
                            } // End of while loop
                            
                            // Free the result set memory
                            $result_gallery->free();
                        } else {
                            // Message if no records are found
                            echo '<p>No dogs found for the main gallery display.</p>';
                        }
                    ?>
                </div>
            </div>  
        </div> 
        <!-- Explore End --> 
   
    <?php include 'amstaff.footer.php'; ?>

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

        <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s" style="background: white;">
            <div class="container py-5"> 
                <div class="row g-5">
                   
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="footer-item">
                            <h4 class="text-dark mb-4">Check Our Galley</h4>
                            <div class="row g-2">

                                <?php
         
        
        $gallery_data = []; 
        $image_base_path = 'assets/uploads/gallery/';  
        
        if (isset($conn)) { 
             $select_sql = "SELECT id, gallery_title, gallery_description, gallery_image FROM quill_gallery ORDER BY id ASC";
             $result = mysqli_query($conn, $select_sql);
             
             if ($result && mysqli_num_rows($result) > 0) {
                 while ($row = mysqli_fetch_assoc($result)) {
                     $gallery_data[] = $row;
                 }
                 mysqli_free_result($result);
             }
        } else {
             // Display an error if the database connection is missing
             echo '<div class="text-center py-4 text-red-500">Error: Database connection not available. Cannot fetch gallery items.</div>';
        }

        ?>

        <!-- Grid for Gallery Cards -->
        <div class="gallery-grid">
            
            <?php if (!empty($gallery_data)): ?>
                <?php foreach ($gallery_data as $item):
                    $image_src_raw = $image_base_path . ($item['gallery_image'] ?? '');
                    $title_raw = $item['gallery_title'] ?? '';
                    $description_raw = $item['gallery_description'] ?? '';

                    $image_src_attr = htmlspecialchars($image_src_raw, ENT_QUOTES, 'UTF-8');
                    $title_attr = htmlspecialchars($title_raw, ENT_QUOTES, 'UTF-8');
                    $description_html = nl2br(htmlspecialchars($description_raw, ENT_QUOTES, 'UTF-8'));

                    $image_src_js = json_encode($image_src_raw, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
                    $title_js = json_encode($title_raw, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
                    $description_js = json_encode($description_raw, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
                ?>

                <!-- GALLERY CARD ITEM START -->
                <div class="gallery-item">
                    <!-- Added onclick handler to the gallery-card to trigger the lightbox -->
                    <div class="gallery-card" 
                         onclick='openLightbox(event, <?php echo $image_src_js; ?>, <?php echo $title_js; ?>, <?php echo $description_js; ?>)'>
                        
                        <!-- Image Container -->
                        <div class="gallery-image-container">
                            
                            <img 
                                src="<?php echo $image_src_attr; ?>" 
                                alt="<?php echo $title_attr; ?>" 
                                class="gallery-image"
                                onerror="this.onerror=null; this.src='https://placehold.co/600x450/e0e0e0/555555?text=Image+Not+Found'"
                            >
                        </div>
                        
                        <!-- Content Block -->
                        <div class="gallery-content">
                            <div>
                                <h2 class="gallery-title text-dark"><?php echo $title_attr; ?></h2>
                                <p class="gallery-description"><?php echo $description_html; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- GALLERY CARD ITEM END -->
                
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty State -->
                <div class="empty-state">
                    <i class="feather icon-image text-gray-400" style="font-size: 3rem;"></i>
                    <p class="text-lg text-gray-500 font-bold">No Gallery Photos Available</p>
                    <p class="text-sm text-gray-400">The photo gallery is currently empty. Please add items to display them here.</p>
                </div>
            <?php endif; ?>
        </div>
        

        <!-- ========================================================================================= -->
<!-- 3. LIGHTBOX MODAL STRUCTURE -->
<!-- ========================================================================================= -->
<div id="lightbox-modal" class="lightbox-modal" onclick="closeLightbox(event)">
    <span class="lightbox-close" onclick="closeLightbox(event)">&times;</span>
    <div class="lightbox-content">
        <img id="lightbox-image" class="lightbox-image" src="" alt="Zoomed Gallery Image">
        <h3 id="caption-title"></h3>
        <p id="caption-description"></p>
    </div>
</div>
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

 <!-- ========================================================================================= -->
<!-- 4. JAVASCRIPT FOR LIGHTBOX FUNCTIONALITY -->
<!-- ========================================================================================= -->
<script>
    /**
     * Opens the image lightbox with the specified content.
     * @param {string} src - The image source path.
     * @param {string} title - The image title.
     * @param {string} description - The image description.
     */
    function openLightbox(clickEvent, src, title, description) {
        if (clickEvent) {
            clickEvent.stopPropagation();
        }

        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-image');
        const titleEl = document.getElementById('caption-title');
        const descEl = document.getElementById('caption-description');

        if (modal && img && titleEl && descEl) {
            img.src = src;
            titleEl.textContent = title;
            descEl.textContent = description;

            modal.classList.add('is-visible');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }
    }

    function hideLightbox() {
        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-image');
        const titleEl = document.getElementById('caption-title');
        const descEl = document.getElementById('caption-description');

        if (modal && modal.classList.contains('is-visible')) {
            modal.classList.remove('is-visible');
            document.body.style.overflow = '';
        }

        if (img) {
            img.removeAttribute('src');
        }
        if (titleEl) {
            titleEl.textContent = '';
        }
        if (descEl) {
            descEl.textContent = '';
        }
    }

    /**
     * Closes the image lightbox.
     * Only closes if the click target is the close button or the modal background itself.
     * @param {Event} event - The click event.
     */
    function closeLightbox(event) {
        const modal = document.getElementById('lightbox-modal');
        
        if (!modal) {
            return;
        }

        const clickedCloseButton = event && event.target.classList.contains('lightbox-close');
        const clickedBackdrop = event && event.target === modal;

        if (clickedBackdrop || clickedCloseButton) {
            hideLightbox();
        }
    }

    // Optional: Close lightbox on ESC key press
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('lightbox-modal');
            if (modal && modal.classList.contains('is-visible')) {
                hideLightbox();
            }
        }
    });

</script>

    <?php include 'amstaff.footer.php'; ?>

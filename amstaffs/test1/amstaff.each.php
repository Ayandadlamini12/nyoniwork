<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Our Dogs . Helentor Amstaffs</title>
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/photoswipe.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>


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
                                        <a href="#services" class="btn btn-primary py-2 px-4 ms-0 ms-lg-3"> <span>Get Started</span></a>
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

        <?php 
           $id=$_REQUEST['each'];  
        ?>

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Dogs</h4>
                   
            </div>
        </div>
        <!-- Header End -->

   <!-- Contact Start -->
        <div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-12 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="mb-1">    
    <?php
        $dog_id = (int)($_GET['each'] ?? 0);        
        
        if ($dog_id <= 0) {
            echo '<p class="text-danger">Error: Missing or invalid Dog ID.</p>';
            exit;
        }
                        
        $dog_name = '';
        $gallery_images = [];
        $total_images = 0;
        $pswp_gallery_id = "dogGalleryPsWP" . $dog_id; 
        $image_base_path = 'assets/uploads/dogs/'; // Web path prefix
        
        // --- 1. Get Dog Name ---
        $sql_dog_name = "SELECT dog_name FROM quill_dogs WHERE id = ?";
        // ... (Database execution logic for $dog_name remains the same)
        if ($stmt_name = mysqli_prepare($conn, $sql_dog_name)) {
            mysqli_stmt_bind_param($stmt_name, "i", $dog_id);
            mysqli_stmt_execute($stmt_name);
            $result_name = mysqli_stmt_get_result($stmt_name);
            if ($row_name = mysqli_fetch_assoc($result_name)) {
                $dog_name = htmlspecialchars($row_name['dog_name']);
            }
            mysqli_stmt_close($stmt_name);
        }

        if (empty($dog_name)) {
            echo '<p class="text-danger">Error: Dog not found for ID ' . $dog_id . '.</p>';
            exit;
        }
        
        // --- 2. Get Gallery Image Paths ---
        $sql_images = "SELECT dog_image_path FROM quill_dog_gallery WHERE dog_id = ? ORDER BY id ASC";
        $stmt_images = mysqli_prepare($conn, $sql_images);
        
        if ($stmt_images) {
            mysqli_stmt_bind_param($stmt_images, "i", $dog_id);
            mysqli_stmt_execute($stmt_images);
            $result_images = mysqli_stmt_get_result($stmt_images);
            
            while ($row = mysqli_fetch_assoc($result_images)) {
                $gallery_images[] = $row;
            }
            
            $total_images = count($gallery_images);
            mysqli_stmt_close($stmt_images);
        }
    ?>

    <h2 class="mb-4">Gallery for <?php echo $dog_name; ?></h2>

    <?php if ($total_images > 0) : ?>
        <?php 
            $hero_swiper_id = 'dogHeroSwiper' . $dog_id;
            $thumb_swiper_id = 'dogThumbSwiper' . $dog_id;
        ?>
        <div class="dog-gallery-wrapper">
            <div id="<?php echo $pswp_gallery_id; ?>" class="pswp-gallery swiper dog-hero-swiper" data-pswp-uid="1">
                <div class="swiper-wrapper">
                    <?php foreach ($gallery_images as $index => $image):
                        $image_filename = htmlspecialchars($image['dog_image_path']);
                        $image_full_path = $image_base_path . $image_filename;
                        $image_caption = $dog_name . " Photo " . ($index + 1);

                        $full_width = 1600; 
                        $full_height = 1200; 

                        $image_server_path = __DIR__ . '/' . $image_full_path; 
                        $image_server_path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $image_server_path);
                        
                        if (file_exists($image_server_path)) {
                            $size = @getimagesize($image_server_path); 
                            if ($size) {
                                $full_width = $size[0];
                                $full_height = $size[1];
                            }
                        }
                    ?>
                        <div class="swiper-slide">
                            <a href="<?php echo $image_full_path; ?>" 
                               data-pswp-width="<?php echo $full_width; ?>"
                               data-pswp-height="<?php echo $full_height; ?>"
                               data-pswp-caption="<?php echo $image_caption; ?>"
                               class="dog-hero-slide" 
                               title="<?php echo $image_caption; ?>">
                                <img class="dog-hero-img" 
                                    src="<?php echo $image_full_path; ?>" 
                                    alt="Slide <?php echo $index + 1; ?>"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='https://placehold.co/1200x800/e0e0e0/555555?text=Image+Error';">
                            </a>
                            <div class="dog-hero-caption">
                                <span><?php echo $image_caption; ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>

            <div id="<?php echo $thumb_swiper_id; ?>" class="swiper dog-thumb-swiper mt-4">
                <div class="swiper-wrapper">
                    <?php foreach ($gallery_images as $index => $image):
                        $image_filename = htmlspecialchars($image['dog_image_path']);
                        $image_full_path = $image_base_path . $image_filename;
                    ?>
                        <div class="swiper-slide">
                            <div class="dog-thumb-card">
                                <img 
                                    src="<?php echo $image_full_path; ?>" 
                                    alt="Thumb <?php echo $index + 1; ?>"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='https://placehold.co/300x200/e0e0e0/555555?text=Image+Error';">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <style>
.dog-gallery-wrapper {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.dog-hero-swiper {
    width: 100%;
    border-radius: 1.5rem;
    overflow: hidden;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    position: relative;
    padding-bottom: 3rem;
    box-shadow: 0 35px 60px rgba(15, 23, 42, 0.35);
}

.dog-hero-slide {
    display: block;
    position: relative;
}

.dog-hero-img {
    width: 100%;
    height: 520px;
    object-fit: cover;
}

.dog-hero-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 1.25rem 1.75rem;
    background: linear-gradient(180deg, rgba(15,23,42,0) 0%, rgba(15,23,42,0.85) 100%);
    color: #f8fafc;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    font-weight: 600;
}

.dog-hero-swiper .swiper-button-next,
.dog-hero-swiper .swiper-button-prev {
    color: #f8fafc;
}

.dog-hero-swiper .swiper-pagination-bullet {
    background: rgba(248, 250, 252, 0.5);
}

.dog-hero-swiper .swiper-pagination-bullet-active {
    background: #f8fafc;
}

.dog-thumb-swiper {
    width: 100%;
    padding: 0.5rem 0;
}

.dog-thumb-card {
    width: 100%;
    height: 120px;
    border-radius: 1rem;
    overflow: hidden;
    position: relative;
    box-shadow: inset 0 0 0 1px rgba(226, 232, 240, 0.25);
}

.dog-thumb-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.dog-thumb-swiper .swiper-slide-thumb-active .dog-thumb-card img {
    transform: scale(1.05);
    box-shadow: 0 15px 30px rgba(15, 23, 42, 0.35);
}

@media (max-width: 768px) {
    .dog-hero-img {
        height: 320px;
    }

    .dog-thumb-card {
        height: 90px;
    }
}
</style>
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const thumbSwiper = new Swiper('#<?php echo $thumb_swiper_id; ?>', {
                    spaceBetween: 12,
                    slidesPerView: 5,
                    watchSlidesProgress: true,
                    breakpoints: {
                        0: { slidesPerView: 3 },
                        576: { slidesPerView: 4 },
                        992: { slidesPerView: 6 }
                    }
                });

                const heroSwiper = new Swiper('#<?php echo $pswp_gallery_id; ?>', {
                    spaceBetween: 24,
                    navigation: {
                        nextEl: '#<?php echo $pswp_gallery_id; ?> .swiper-button-next',
                        prevEl: '#<?php echo $pswp_gallery_id; ?> .swiper-button-prev',
                    },
                    pagination: {
                        el: '#<?php echo $pswp_gallery_id; ?> .swiper-pagination',
                        clickable: true,
                    },
                    thumbs: { swiper: thumbSwiper }
                });
            });
        </script>

    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            No gallery images found for **<?php echo $dog_name; ?>**.
        </div>
    <?php endif; ?>
</div>
                </div>
            </div>
        </div> 
        <!-- Contact End -->

    <script type="module">
  import PhotoSwipeLightbox from 'https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/photoswipe-lightbox.esm.js';

  const lightbox = new PhotoSwipeLightbox({
    // Attach the lightbox to the gallery element ID
    gallery: '#<?php echo $pswp_gallery_id; ?>', 
    children: 'a',
    // Path to the PhotoSwipe UI library
    pswpModule: () => import('https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/photoswipe.esm.js')
  });

  lightbox.init();
</script>    

    <?php include 'amstaff.footer.php'; ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Home . Helentor Amstaffs</title>
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
                                    <a href="./" class="nav-item nav-link active">Home</a>
                                    <a href="about-us" class="nav-item nav-link">About</a>
                                    <a href="our-services" class="nav-item nav-link">Sevices</a>
                                    <a href="breed" class="nav-item nav-link">Breed</a>
                                    <a href="gallery" class="nav-item nav-link">Gallery</a>
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
                                        <a href="#about" class="btn btn-primary py-2 px-4 ms-0 ms-lg-3"> <span>Get Started</span></a>
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


        <!-- Carousel Start -->
        <div class="header-carousel owl-carousel overflow-hidden bg-dark">
            <div class="header-carousel-item hero-section">
                <div class="hero" style="background-image: url(img/slider/slide-1.jpg); background-repeat: no-repeat; background-position: center center; background-size: cover; width: 100%; height: 700px; display: flex; align-items: center; position: relative; overflow: hidden;"></div>
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                    <h4 class="text-primary text-uppercase fw-bold mb-4">Welcome to Helentor Amstaffs</h4>
                                    <h1 class="display-1 text-white mb-4">Ethical Breeding</h1>
                                    <p class="mb-5 fs-5">Our dogs are not caged; they enjoy free-running on our bushveld farm in Pretoria East. We are committed to ethical breeding practices. 
                                    </p>
                                    <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                        <a class="btn btn-dark py-3 px-4 px-md-5 me-2" href="#"><i class="fas fa-play-circle me-2"></i> <span>Watch Video</span></a>
                                        <a class="btn btn-primary py-3 px-4 px-md-5 ms-2" href="about-us"><span>Learn More</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item hero-section">
                <div class="hero" style="background-image: url(img/slider/slide-2.jpg); background-repeat: no-repeat; background-position: center center; background-size: cover; width: 100%; height: 700px; display: flex; align-items: center; position: relative; overflow: hidden;"></div>
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                    <h4 class="text-primary text-uppercase fw-bold mb-4">KUSA Shows</h4>
                                    <h1 class="display-2 text-white mb-4">Dog Shows?</h1>
                                    <p class="mb-5 fs-5">There is much more to showing your puppy than just showing up! Read our guide for all the information you need to start your show career. 
                                    </p>
                                    <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                        <a class="btn btn-dark py-3 px-4 px-md-5 me-2" href="#"><i class="fas fa-play-circle me-2"></i> <span>Watch Video</span></a>
                                        <a class="btn btn-primary py-3 px-4 px-md-5 ms-2" href="about-us"><span>Learn More</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item hero-section">
                <div class="hero" style="background-image: url(img/slider/slide-3.jpg); background-repeat: no-repeat; background-position: center center; background-size: cover; width: 100%; height: 700px; display: flex; align-items: center; position: relative; overflow: hidden;"></div>
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                    <h4 class="text-primary text-uppercase fw-bold mb-4">Ethical</h4>
                                    <h1 class="display-2 text-white mb-4">Pre-Approved</h1>
                                    <p class="mb-5 fs-5">We apply selective breeding based on bookings only. Puppies are allocated to pre-approved homes; we do not engage in random breeding.
                                    </p>
                                    <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                        <a class="btn btn-dark py-3 px-4 px-md-5 me-2" href="#"><i class="fas fa-play-circle me-2"></i> <span>Watch Video</span></a>
                                        <a class="btn btn-primary py-3 px-4 px-md-5 ms-2" href="about-us"><span>Learn More</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item hero-section">
                <div class="hero" style="background-image: url(img/slider/slide-4.jpg); background-repeat: no-repeat; background-position: center center; background-size: cover; width: 100%; height: 700px; display: flex; align-items: center; position: relative; overflow: hidden;"></div>
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                    <h4 class="text-primary text-uppercase fw-bold mb-4">Resources</h4>
                                    <h1 class="display-2 text-white mb-4">Essential Documents</h1>
                                    <p class="mb-5 fs-5">This list of documents covers everything from taking care of your new pup and purchasing agreements to crucial information...
                                    </p>
                                    <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                        <a class="btn btn-dark py-3 px-4 px-md-5 me-2" href="#"><i class="fas fa-play-circle me-2"></i> <span>Watch Video</span></a>
                                        <a class="btn btn-primary py-3 px-4 px-md-5 ms-2" href="about-us"><span>Learn More</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->

        <!-- About Start -->
        <div class="container-fluid about pt-5" id="about">
            <div class="container pt-5">
                <div class="row g-5">
                    <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="about-content h-100">
                            <h4 class="text-primary">About Helentor Amstaffs</h4>
                            <h1 class="display-4 text-white mb-4">Breeding Amstaffs for Health, Temperament, and True Breed Standard.</h1>
                            <p class="mb-4">As registered KUSA breeders, we are devoted to producing high-quality American Staffordshire Terriers from champion bloodlines, focusing on exceptional socialization and genetic integrity.</p>
                            <div class="tab-class pb-4">
                                <ul class="nav d-flex mb-2">
                                    <li class="nav-item mb-3">
                                        <a class="d-flex py-2 active" data-bs-toggle="pill" href="#tab-1">
                                            <span style="width: 150px;">Our Standards</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <a class="d-flex py-2 mx-3" data-bs-toggle="pill" href="#tab-2">
                                            <span style="width: 150px;">Puppy Care</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <a class="d-flex py-2" data-bs-toggle="pill" href="#tab-3">
                                            <span style="width: 150px;">Our Goal</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane fade show p-0 active">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex align-items-center border-top border-bottom py-4">
                                                    <span class="fas fa-medal text-white fa-4x me-4"></span>
                                                    <p class="mb-0">We adhere to the strict American Staffordshire Terrier breed standard set by the Kennel Union of Southern Africa (KUSA). Our focus is on structurally sound dogs with excellent genetic health and stable, confident temperaments.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane fade show p-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex align-items-center border-top border-bottom py-4">
                                                    <span class="fas fa-syringe text-white fa-4x me-4"></span>
                                                    <p class="mb-0">Our puppies are raised using advanced early socialization techniques. They receive all necessary vaccinations, microchips, and extensive health checks before being placed with their carefully selected forever families.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-3" class="tab-pane fade show p-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex align-items-center border-top border-bottom py-4">
                                                    <span class="fas fa-rocket text-white fa-4x me-4"></span>
                                                    <p class="mb-0">Based on a large, secure farm, our dogs have ample space for exercise and development. We maintain the highest standards of cleanliness and ethical care, ensuring a happy and enriching environment for all our Amstaffs.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 align-items-center">
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-primary py-3 px-5"> <span>Contact Us</span></a>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex flex-shrink-0 ps-4">
                                        <a href="#" class="btn btn-light btn-lg-square position-relative wow tada" data-wow-delay=".9s">
                                            <i class="fa fa-phone-alt fa-2x"></i>
                                            <div class="position-absolute" style="top: 5px; right: 5px;">
                                                <span><i class="fa fa-comment-dots text-dark"></i></span>
                                            </div>
                                        </a>
                                        <div class="d-flex flex-column ms-3">
                                            <span>Call to Our Experts</span>
                                            <a href="tel:+ 0123 456 7890"><span class="text-white">Cell: +27 (82) 329 2610</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="about-img h-100">
                            <div class="about-img-inner d-flex h-100">
                                <img src="img/about/about-2.webp" class="img-fluid w-100" style="object-fit: cover;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
 
        <!-- Features Start -->
        <div class="container-fluid feature bg-white py-1">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-dark"> Why Choose Us</h4>
                    <h1 class="display-4 mb-4">Our Commitment to Quality</h1>
                    <p class="mb-0">At Helentor, we are dedicated to preserving and bettering the American Staffordshire Terrier breed. Our puppies are raised with health, temperament, and conformity to breed standards as our highest priorities.
                    </p>
                </div>
                <div class="feature-carousel owl-carousel">
                    <div class="feature-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-img">
                            <img src="img/design/feature-1.webp" class="img-fluid w-100"  alt="">
                        </div>
                        <div class="feature-content p-4">
                            <h4 class="mb-3">Health & DNA Tested Parents</h4>
                            <p class="mb-4">All our breeding dogs undergo comprehensive DNA profiling and health checks to ensure the healthiest possible puppies.
                            </p>
                            <a href="#" class="btn btn-primary py-2 px-4"> <span>Read More</span></a>
                        </div>
                    </div>
                    <div class="feature-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="feature-img">
                            <img src="img/design/feature-2.webp" class="img-fluid w-100"  alt="">
                        </div>
                        <div class="feature-content p-4">
                            <h4 class="mb-3">Early Socialization Program</h4>
                            <p class="mb-4">Our puppies receive crucial early neurological stimulation and are exposed to various sights, sounds, and people to ensure stable temperaments.
                            </p>
                            <a href="#" class="btn btn-primary py-2 px-4"> <span>Read More</span></a>
                        </div>
                    </div>
                    <div class="feature-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="feature-img">
                            <img src="img/design/feature-3.webp" class="img-fluid w-100"  alt="">
                        </div>
                        <div class="feature-content p-4">
                            <h4 class="mb-3">KUSA Registered Champions</h4>
                            <p class="mb-4">Our dogs are selectively bred from champions with proven pedigrees, ensuring they meet the highest standards of the American Staffordshire Terrier breed.
                            </p>
                            <a href="#" class="btn btn-primary py-2 px-4"> <span>Read More</span></a>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-img">
                            <img src="img/design/feature-4.webp" class="img-fluid w-100"  alt="">
                        </div>
                        <div class="feature-content p-4">
                            <h4 class="mb-3">Dedicated Lifetime Support</h4>
                            <p class="mb-4">We offer ongoing advice and support for the lifetime of your dog, building a community of knowledgeable and responsible Amstaff owners.
                            </p>
                            <a href="#" class="btn btn-primary py-2 px-4"> <span>Read More</span></a>
                        </div>
                    </div>
                </div>
                <div class="feature-shaps"></div>
            </div>
        </div>
        <!-- Features End -->

 

        

        <!-- Explore Start -->
        <div class="container-fluid explore py-5 wow zoomIn" data-wow-delay="0.2s">
            <div class="container py-5 text-center">
                <h1 class="display-1 text-dark mb-0"> IMPORTANT DOCUMENTS</h1>
                <p>Explore a list of our important documents relating to taking care of a new pup, buying your new pup and scams and fraud info.</p>
                <a class="btn btn-dark py-3 px-4 px-md-5 me-2" href="documents"><i class="fas fa-file me-2"></i> <span>Open</span></a>
            </div>
        </div>
        <!-- Explore End -->
  


        <!-- Testimonial Start -->
        <div class="container-fluid testimonial bg-dark py-5" style="margin-bottom: 90px;">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Testimonial</h4>
                    <h1 class="display-4 text-white">What Our Customers Are Saying</h1>
                </div>
                <div class="testimonial-carousel owl-carousel wow fadeInUp" data-wow-delay="0.2s">

                    <?php
 
                        $sql_testimonials = "SELECT * FROM quill_testimonials ORDER BY testimonial_created_at DESC";
                        $result_testimonials = $conn->query($sql_testimonials);
                        
                        // Check for query success
                        if ($result_testimonials === false) {
                            // Output a message if the database query fails
                            echo "<p class='text-danger text-center'>Error fetching testimonials: " . $conn->error . "</p>";
                        } else {
                            // 2. Check if any testimonials were found
                            if ($result_testimonials->num_rows > 0) {
                                
                                // 3. Loop through the fetched results and generate the HTML block for each testimonial
                                while($testimonial = $result_testimonials->fetch_assoc()) {
                                    
                                    // Sanitize and retrieve data
                                    $t_content = htmlspecialchars($testimonial['testimonial_content']);
                                    $t_full_name = htmlspecialchars($testimonial['testimonial_full_name']);
                                    $t_profession = htmlspecialchars($testimonial['testimonial_profession']);
                                    $t_rating = (int)$testimonial['testimonial_rating'];
                                    $t_image_path = htmlspecialchars($testimonial['testimonial_image']);
                                    
                                    // Determine image source
                                    // Note: The path is retrieved from the DB (e.g., 'assets/img/uploads/...'). 
                                    // If your front-end page is in a different folder, you may need to adjust the path prefix (e.g., prepend '../').
                                    $image_src = !empty($t_image_path) 
                                               ? $t_image_path 
                                               : 'https://placehold.co/100x100/343a40/ffffff?text=U'; // Placeholder if no image (U for User)
                        
                                    // Check if it's the simple placeholder for conditional styling
                                    $is_placeholder = strpos($image_src, 'placehold.co') !== false;
                        ?>
                        
                        <div class="testimonial-item mx-auto" style="max-width: 900px;">
                            <span class="fa fa-quote-left fa-3x quote-icon"></span>
                            
                            <div class="testimonial-img mb-4">
                                <!-- Image display -->
                                <img src="assets/uploads/testimonials/<?php echo $image_src; ?>"  class="img-fluid rounded-circle"  alt="<?php echo $t_full_name; ?>'s Photo" style="width: 100px; height: 100px; object-fit: cover; <?php echo $is_placeholder ? 'background-color: #343a40;' : ''; ?>"
                                    onerror="this.onerror=null;this.src='https://placehold.co/100x100/343a40/ffffff?text=U';"
                                >
                            </div>
                            
                            <p class="fs-4 text-white mb-4">
                                <?php echo $t_content; ?>
                            </p>
                            
                            <div class="d-block">
                                <h4 class="text-white"><?php echo $t_full_name; ?></h4>
                                <p class="m-0 pb-3"><?php echo $t_profession; ?></p>
                                
                                <!-- Star Rating Logic -->
                                <div class="d-flex">
                                    <?php 
                                    // Loop 5 times for 5 stars
                                    for ($i = 1; $i <= 5; $i++): 
                                        // Use 'fas fa-star text-primary' for filled, and 'fas fa-star text-white' for empty (to match template style)
                                        $star_class = ($i <= $t_rating) ? 'fas fa-star text-primary' : 'fas fa-star text-white';
                                    ?>
                                        <i class="<?php echo $star_class; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                                } // End of while loop
                            } else {
                                // Message if no testimonials are in the database
                                echo "<p class='text-center text-white'>No testimonials available yet.</p>";
                            }
                        }
                        ?> 
                </div>
            </div>
        </div>
        <!-- Testimonial End --> 

        <!-- Blog Start -->
        <div class="container-fluid blog py-5">
      <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
          <h4 class="text-dark">Our Blogs</h4>
          <h1 class="display-4 mb-4">Check out our latest stories</h1>
          <p class="mb-0">Dive into articles covering breeding best practices, puppy care, showing tips, and everything else you need to know about responsible dog ownership and the Amstaff breed.
          </p>
        </div>
        <div class="blog-carousel owl-carousel">
          <div class="blog-item wow fadeInUp" data-wow-delay="0.2s">
            <div class="blog-img p-4 pb-0">
              <a href="javascript:void(0);">
                <img src="img/blog/blog-1.jpg" class="img-fluid w-100" alt="Puppy sleeping in a new home">
              </a>
            </div>
            <div class="blog-content p-4">
              <div class="blog-comment d-flex justify-content-between py-2 px-3 mb-4">
                <div class="small"><span class="fa fa-user text-primary me-2"></span> Helentor Staff</div>
                <div class="small"><span class="fa fa-calendar text-primary me-2"></span> 10 Nov 2025</div>
              </div>
              <a href="javascript:void(0);" class="h4 d-inline-block mb-3">Bringing Home Your New Puppy</a>
              <p class="mb-3">Our guide to the first week: setting up a safe space, house training, and introducing your new family member.</p>
              <a href="read-blog" class="btn btn-dark py-2 px-4 ms-2"> <span class="me-2">Read More</span> <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="blog-item wow fadeInUp" data-wow-delay="0.4s">
            <div class="blog-img p-4 pb-0">
              <a href="javascript:void(0);">
                <img src="img/blog/blog-2.jpg" class="img-fluid w-100" alt="Dog being handled in a show ring">
              </a>
            </div>
            <div class="blog-content p-4">
              <div class="blog-comment d-flex justify-content-between py-2 px-3 mb-4">
                <div class="small"><span class="fa fa-user text-primary me-2"></span> Nunia & Hermann</div>
              </div>
              <a href="javascript:void(0);" class="h4 d-inline-block mb-3">Understanding KUSA Shows</a>
              <p class="mb-3">Tips and tricks for preparing your Amstaff for the show ring, from grooming essentials to ring etiquette.</p>
              <a href="read-blog" class="btn btn-dark py-2 px-4 ms-2"> <span class="me-2">Read More</span> <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="blog-item wow fadeInUp" data-wow-delay="0.6s">
            <div class="blog-img p-4 pb-0">
              <a href="javascript:void(0);">
                <img src="img/blog/blog-3.jpg" class="img-fluid w-100" alt="Healthy adult dog running outdoors">
              </a>
            </div>
            <div class="blog-content p-4">
              <div class="blog-comment d-flex justify-content-between py-2 px-3 mb-4">
                <div class="small"><span class="fa fa-user text-primary me-2"></span> Vet Advice</div>
                <div class="small"><span class="fa fa-calendar text-primary me-2"></span> 15 Oct 2025</div>
              </div>
              <a href="javascript:void(0);" class="h4 d-inline-block mb-3">The Importance of DNA Profiling</a>
              <p class="mb-3">Learn why DNA health screening and profiling are crucial for improving breed standard and ensuring healthy litters.</p>
              <a href="read-blog" class="btn btn-dark py-2 px-4 ms-2"> <span class="me-2">Read More</span> <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
          <div class="blog-item">
            <div class="blog-img p-4 pb-0">
              <a href="javascript:void(0);">
                <img src="img/blog/blog-4.jpg" class="img-fluid w-100" alt="Puppy playing with a toy">
              </a>
            </div>
            <div class="blog-content p-4">
              <div class="blog-comment d-flex justify-content-between py-2 px-3 mb-4">
                <div class="small"><span class="fa fa-user text-primary me-2"></span> Helentor Staff</div>
              </div>
              <a href="javascript:void(0);" class="h4 d-inline-block mb-3">Avoiding Scams when Buying a Pup</a>
              <p class="mb-3">Essential security tips and red flags to watch out for to ensure a safe and ethical purchase from a registered breeder.</p>
              <a href="read-blog" class="btn btn-dark py-2 px-4 ms-2"> <span class="me-2">Read More</span> <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
        <!-- Blog End -->


    <?php include 'amstaff.footer.php'; ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Blog . Helentor Amstaffs</title>
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
                                    <a href="breed" class="nav-item nav-link">Breed</a>
                                    <a href="gallery" class="nav-item nav-link">Gallery</a>
                                    <a href="blog" class="nav-item nav-link active">Blog</a>
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

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Blog</h4>
                   
            </div>
        </div>
        <!-- Header End -->

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
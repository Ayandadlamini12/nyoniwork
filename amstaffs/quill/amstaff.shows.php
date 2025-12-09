<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Shows . Helentor Amstaffs</title>
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

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Show Information</h4>
                   
            </div>
        </div>
        <!-- Header End -->

   <!-- Contact Start -->
        <div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-12 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="mb-1">  
                            <h4 class="text-dark mb-4">Open Shows</h4>
                            <p class="mb-4">
                                These are shows that can be entered on the day. Open shows are usually held over 1 days and frequently attract an entry of about 300-400 dogs. Classes are held for each individual breed, there are also mixed classes for breeds which do not have their own separate classes (these are usually the rarer/less numerically strong breeds) This is a great way to get started and is how we started. Show goers are all very Helpful and will assist you to learn the skill required to show your dog.
                            </p>
                            <h4 class="text-dark mb-4">Championship Shows</h4>
                            <p class="mb-4">
                                These are the biggest shows. They attract and entry of between 10-12,000 dogs and must be entered 5-7 weeks in advance. They are normally held over 3 or 4 days and include classes for most kennel club recognised breeds. Details of when and where a show will be held are published on the <a href="https://www.kusa.co.za/">Kusa</a> Website as well as on <a href="http://www.showdogs.co.za/">Showdogs</a> Website.

                            </p>
                            <h4 class="text-dark mb-4">Entering your dog for champion and open shows</h4>
                            <p class="mb-1">
                                A dog must be a minimum of 12 Weeks of age in order to enter a show. Any dog that has been spayed or neutered may be shown subject to permission from the Kennel Club, they are then entered as per normal and compete alongside all other dogs. Owners of dogs which have had any type of surgery must apply to the Kennel club for permission to show…the KC will then make a decision as to whether the dog may be shown or not depending on the surgery performed. 
                            </p>
                            <p class="mb-1">
                                In order to enter a show, you must first obtain a show schedule, these are available on sites and explain and list all available classes at the show in question, they can be obtained through the show secretary.
                            </p>
                            <p class="mb-4">
                                Once you have obtained a schedule look through it and find which classes your dog is eligible for. Each breed will have a set of classes and all the classes are explained in the schedule, for example ‘puppy’ is for dogs between the ages of 6 and 12 months and Junior is for dogs up to the age of 18 months. Other classes are defined by the number of wins a dog has previously achieved while attending other shows. Having decided in which classes you wish to enter your dog fill in the form and send it along with your payment to the address as instructed.
                            </p>
                            <h4 class="text-dark mb-4">Training your dog for shows</h4>
                            <p class="mb-1">
                                In order for you and your dog to learn show techniques you may find it helpful to attend a local ring craft class. Here you will be shown how to stand and move your dog and what else is expected of you. 
                            </p>
                        </div>
                        </div>
                        <div class="d-flex ms-2 mb-1">
                            <a class="btn btn-dark py-1 px-3 px-sm-4 me-2" href="assets/uploads/documents/doc_tBLgjGvW_PREPARATION.pdf"> <span>Learn More</span> <i class="fas fa-chevron-circle-right"></i></a> 
                        </div>
                       
                    </div>
                    
                     
                </div>
            </div>
        </div>
        <!-- Contact End -->

    <?php include 'amstaff.footer.php'; ?>
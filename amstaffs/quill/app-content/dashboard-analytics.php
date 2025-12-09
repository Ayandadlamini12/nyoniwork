<?php
    require('includes-request.php');
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
    <title>Dashboard . Helentor Amstaffs</title> 
    <link rel="apple-touch-icon" href="../assets/img/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/weather-icons/climacons.min.css">
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
    <!-- link(rel='stylesheet', type='text/css', href=app_assets_path+'/css'+rtl+'/pages/users.css')-->
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
                <li class="nav-item active"><a href="mi-dashboard"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Email Application">Dashboard</span></a>
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
                        <li><a class="menu-item" href="kb-dogs" data-i18n="eCommerce">Our Dogs</a>
                        </li>
                        <li><a class="menu-item" href="kb-shows" data-i18n="eCommerce">Show Info</a>
                        </li>
                        <li><a class="menu-item" href="kb-litter" data-i18n="eCommerce">Next Litter</a>
                        </li>
                        <li><a class="menu-item" href="quill-photos" data-i18n="eCommerce">Important Documents</a>
                        </li>
                    </ul>
                </li>

             

                <li class=" navigation-header"><span>Authentication</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i>
                </li>
                <li class=" nav-item"><a href="account-settings"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Email Application">Mange Profile</span></a>
                </li> 
                <li class=" nav-item">
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
            </div>
            <div class="content-body"> 
                <section id="stats-icon-subtitle-bg"> 

                    <div class="row">
                        <div class="col-xl-6 col-md-12">
                            <div class="card overflow-hidden">
                                <div class="card-content">
                                    <div class="media align-items-stretch bg-gradient-x-primary white">
                                        <div class="p-2 media-middle">
                                            <i class="feather icon-users font-large-2 white"></i>
                                        </div>
                                        <div class="media-body p-2">
                                            <h4>Total</h4>
                                            <span>System Users</span>
                                        </div>
                                        <div class="media-right p-2 media-middle">
                                            <?php 
                                                $har_survey0="SELECT COUNT(*) as total FROM users";
                                                $har_survey1 = mysqli_query($conn,$har_survey0) or die(mysqli_error($con));
                                                $har_survey2 = mysqli_fetch_assoc($har_survey1);                
                                            ?>
                                            <h1><?php echo $har_survey2['total'];?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="media align-items-stretch bg-gradient-x-warning white">
                                        <div class="p-2 media-middle">
                                            <i class="feather icon-chrome font-large-2 white"></i>
                                        </div>
                                        <div class="media-body p-2">
                                            <h4>Total </h4>
                                            <span>Web Pages</span>
                                        </div>
                                        <div class="media-right p-2 media-middle">
                                             
                                            <h1>15</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                                            <div class="card">
                                                                <div class="card-content"> 
                                                                    <?php
                                                                        // Define the base path for your carousel images
                                                                        $image_base_path = '../assets/uploads/carousel/';
                                                                         
                                                                        $sql = "SELECT id, carousel_image, carousel_title, carousel_subtitle, carousel_description, carousel_position FROM quill_carousel ORDER BY carousel_position ASC";
                                                                        $result = $conn->query($sql);
                                                                        
                                                                        $carousel_slides = [];
                                                                        if ($result && $result->num_rows > 0) { 
                                                                            while ($row = $result->fetch_assoc()) {
                                                                                $carousel_slides[] = $row;
                                                                            }
                                                                            $slide_count = count($carousel_slides);
                                                                        } else {
                                                                            // Handle case where no carousel slides are found
                                                                            $slide_count = 0;  

                                                                            echo '<p class="text-center">No carousel items have been added yet.</p>';
                                                                        }
                                                                        
                                                                        // Only render the carousel structure if there are slides
                                                                        if ($slide_count > 0):
                                                                        ?>
                                                                        
                                                                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                                                        
                                                                            <!-- Carousel Indicators -->
                                                                            <ol class="carousel-indicators">
                                                                                <?php
                                                                                // Loop to generate the pagination indicators
                                                                                for ($i = 0; $i < $slide_count; $i++):
                                                                                    // The first indicator (index 0) must have the 'active' class
                                                                                    $indicator_class = ($i === 0) ? 'active' : '';
                                                                                ?>
                                                                                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php echo $indicator_class; ?>"></li>
                                                                                <?php endfor; ?>
                                                                            </ol>
                                                                        
                                                                            <!-- Wrapper for slides -->
                                                                            <div class="carousel-inner" role="listbox">
                                                                                <?php
                                                                                $i = 0;
                                                                                // Loop through the retrieved slides to generate the carousel items
                                                                                foreach ($carousel_slides as $slide):
                                                                                    // The first carousel item (index 0) must have the 'active' class
                                                                                    $item_class = ($i === 0) ? 'active' : '';
                                                                        
                                                                                    // Construct the full image URL path
                                                                                    $image_url = $image_base_path . htmlspecialchars($slide['carousel_image']);
                                                                                    
                                                                                    // Use title for alt text for accessibility
                                                                                    $alt_text = htmlspecialchars($slide['carousel_title']);
                                                                                ?>
                                                                                    <div class="carousel-item <?php echo $item_class; ?>">
                                                                                        <img src="<?php echo $image_url; ?>" class="d-block w-100" alt="<?php echo $alt_text; ?>">
                                                                                        
                                                                                        <!-- Optional: Carousel Caption -->
                                                                                        <div class="carousel-caption d-none d-md-block">
                                                                                            <h3><?php echo htmlspecialchars($slide['carousel_title']); ?></h3>
                                                                                            <?php if (!empty($slide['carousel_subtitle'])): ?>
                                                                                                <h5><?php echo htmlspecialchars($slide['carousel_subtitle']); ?></h5>
                                                                                            <?php endif; ?>
                                                                                            <p><?php echo nl2br(htmlspecialchars($slide['carousel_description'])); ?></p>
                                                                                            <a data-toggle="modal" data-target="#UpdateCarousel<?php echo htmlspecialchars($slide['id']); ?>" class="btn btn-success">Update Info</a>
                                                                                            <?php
                                                                                                if ($slide['carousel_position'] == 1) {
                                                                                                    // code...
                                                                                                }else{
                                                                                            ?>
                                                                                                <a data-toggle="modal" data-target="#DeleteCarousel<?php echo htmlspecialchars($slide['id']); ?>" class="btn btn-danger">Delete Info</a>
                                                                                            <?php }?> 
                                                                                        </div> 
                                                                                    </div>

                                                                                    <!-- UPDATE MODAL -->
                                                                                    <div class="modal fade text-left" id="UpdateCarousel<?php echo htmlspecialchars($slide['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalUpdateCarousel<?php echo htmlspecialchars($slide['id']); ?>" aria-hidden="true">
                                                                                        <div class="modal-dialog" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h4 class="modal-title" id="myModalUpdateCarousel<?php echo htmlspecialchars($slide['id']); ?>">Carousel Management</h4>
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div class="modal-body"> 
                                                                                                    <form action="quill-photos" enctype="multipart/form-data" method="POST">
                                                                                                        <div class="modal-body">
                                                                                                            <label for="basicInputFile">
                                                                                                                Upload New Image <b class="text-danger">Leave Blank if Not Changing Current Image</b>
                                                                                                            </label>
                                                                                                            <div class="form-group"> 
                                                                                                                <div class="custom-file">
                                                                                                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="carousel_image">
                                                                                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                                                                </div> 
                                                                                                            </div>
                                                                                                                
                                                                                                            <label>Carousel Title:</label>
                                                                                                            <div class="form-group"> 
                                                                                                                <input type="text" class="form-control" name="carousel_title" required="" placeholder="Enter Title" value="<?php echo htmlspecialchars($slide['carousel_title']); ?>">
                                                                                                                <input type="hidden" name="UpdateCarousel" value="1">
                                                                                                                <input type="hidden" name="carousel_id" value="<?php echo htmlspecialchars($slide['id']); ?>">
                                                                                                            </div>
 
                                                                                                            <label>Carousel Sub-Title:</label>
                                                                                                            <div class="form-group"> 
                                                                                                                <input type="text" class="form-control" name="carousel_subtitle" required="" placeholder="Enter Subtitle" value="<?php echo htmlspecialchars($slide['carousel_subtitle']); ?>"> 
                                                                                                            </div>  

                                                                                       
                                                                                                            <label>Carosel Description:</label>
                                                                                                            <div class="form-group">
                                                                                                                <textarea class="form-control" name="carousel_description" placeholder="Enter Description" rows="4"><?php echo htmlspecialchars($slide['carousel_description']); ?></textarea> 
                                                                                                            </div>

                                                                                                            <label>Carousel Position:</label>
                                                                                                            <div class="form-group"> 
                                                                                                                <input type="text" class="form-control" name="carousel_position" readonly value="Position <?php echo htmlspecialchars($slide['carousel_position']); ?>">
                                                                                                                <input type="hidden" class="form-control" name="carousel_old_image" required="" value="<?php echo htmlspecialchars($slide['carousel_image']); ?>"> 
                                                                                                            </div> 
                                                                                                        </div>
                                                                                                        <div class="modal-footer">
                                                                                                            <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                                                                                            <input type="submit" class="btn btn-outline-primary btn-lg" value="Update Info">
                                                                                                        </div>
                                                                                                    </form> 
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- DELETE MODAL -->
                                                                                    <div class="modal fade text-left" id="DeleteCarousel<?php echo htmlspecialchars($slide['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalDeleteCarousel<?php echo htmlspecialchars($slide['id']); ?>" aria-hidden="true">
                                                                                        <div class="modal-dialog" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h4 class="modal-title" id="myModalDeleteCarousel<?php echo htmlspecialchars($slide['id']); ?>">Carousel Management</h4>
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div class="modal-body"> 
                                                                                                    <form action="quill-photos" enctype="multipart/form-data" method="POST">
                                                                                                        <div class="modal-body"> 
                                                                                                            <div class="form-group"> 
                                                                                                                <img src="../assets/uploads/carousel/<?php echo htmlspecialchars($slide['carousel_image']); ?>" class="img-fluid" style="width: 100%;"> 
                                                                                                            </div>
                                                                                                                
                                                                                                            <label><b>Carousel Title:</b></label>
                                                                                                            <div class="form-group"> 
                                                                                                                <p><?php echo htmlspecialchars($slide['carousel_title']); ?></p>
                                                                                                                <input type="hidden" name="DeleteCarousel" value="1">
                                                                                                                <input type="hidden" name="carousel_id" value="<?php echo htmlspecialchars($slide['id']); ?>">
                                                                                                            </div>
 
                                                                                                            <label><b>Carousel Sub-Title:</b></label>
                                                                                                            <div class="form-group"> 
                                                                                                                <p><?php echo htmlspecialchars($slide['carousel_subtitle']); ?></p>
                                                                                                            </div>  

                                                                                       
                                                                                                            <label><b>Carosel Description:</b></label>
                                                                                                            <div class="form-group">
                                                                                                                <p><?php echo htmlspecialchars($slide['carousel_description']); ?></p>
                                                                                                            </div>

                                                                                                            <label><b>Carousel Position:</b></label>
                                                                                                            <div class="form-group"> 
                                                                                                                <p>Position <?php echo htmlspecialchars($slide['carousel_position']); ?></p>
                                                                                                                <input type="hidden" class="form-control" name="carousel_old_image" required="" value="<?php echo htmlspecialchars($slide['carousel_image']); ?>"> 
                                                                                                            </div> 
                                                                                                        </div>
                                                                                                        <div class="modal-footer">
                                                                                                            <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                                                                                            <input type="submit" class="btn btn-outline-danger btn-lg" value="Delete Info">
                                                                                                        </div>
                                                                                                    </form> 
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                <?php
                                                                                    $i++;
                                                                                endforeach;
                                                                                ?>
                                                                            </div>
                                                                        
                                                                            <!-- Controls -->
                                                                            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                                                                                <span class="fa fa-angle-left icon-prev" aria-hidden="true"></span>
                                                                                <span class="sr-only">Previous</span>
                                                                            </a>
                                                                            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                                                                                <span class="fa fa-angle-right icon-next" aria-hidden="true"></span>
                                                                                <span class="sr-only">Next</span>
                                                                            </a>
                                                                        </div>
                                                                        
                                                                    <?php endif; ?> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 

                
                </section>
                <!-- // stats with icon, subtitle & bg gradient color section end -->

         
   

                
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
    <script src="app-assets/vendors/js/extensions/jquery.knob.min.js"></script>
    <script src="app-assets/js/scripts/extensions/knob.js"></script>
    <script src="app-assets/vendors/js/charts/raphael-min.js"></script>
    <script src="app-assets/vendors/js/charts/morris.min.js"></script>
    <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"></script>
    <script src="app-assets/data/jvector/visitor-data.js"></script>
    <script src="app-assets/vendors/js/charts/chart.min.js"></script>
    <script src="app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="app-assets/vendors/js/extensions/unslider-min.js"></script>
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-climacon.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.min.css">
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/dashboard-analytics.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
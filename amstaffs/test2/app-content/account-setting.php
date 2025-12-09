<?php 
    include 'includes-request.php';
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
    <title>Account Setting . Helentor Amstaffs</title>
    <link rel="apple-touch-icon" href="../assets/img/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
 

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/selects/select2.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/toggle/switchery.min.css">
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
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/validation/form-validation.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/pickers/daterange/daterange.css">
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
                <li class="nav-item"><a href="mi-dashboard"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Email Application">Dashboard</span></a>
                </li>
                <li class="nav-item"><a href="javascript:void(0);"><i class="feather icon-globe"></i><span class="menu-title" data-i18n="Dashboard">Web Pages</span><span class="badge badge badge-primary badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="pages-manage" data-i18n="eCommerce">Manage Pages</a>
                        </li>
                        <li><a class="menu-item" href="quill-photos" data-i18n="Analytics">Manage Content</a> </li>
                    </ul>
                </li>
                
               
                <li class=" navigation-header"><span>Authentication</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i>
                </li>
                <li class="active nav-item"><a href="account-settings"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Email Application">Mange Profile</span></a>
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
                    <h3 class="content-header-title mb-0">Account setting</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="mi-dashboard" class="text-dark">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="text-dark">Users</a>
                                </li>
                                <li class="breadcrumb-item active">Account setting
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
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex text-dark active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i class="feather icon-user"></i>
                                        Personal Info
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex text-dark" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                        <i class="feather icon-lock"></i>
                                        Change Password
                                    </a>
                                </li> 
                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                               
                                                <form action="general-info" enctype="multipart/form-data" method="POST">
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

                                                     <div class="media">
                                                        
                                                    <a href="javascript: void(0);">
                                                        <img src="<?php echo $path;?>" class="rounded mr-70" alt="profile image" height="64" width="64">
                                                    </a>
                                                    <div class="media-body mt-75">
                                                        <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                            <label class="btn btn-md btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer square" for="account-upload">Upload New Photo</label>
                                                            <input type="file" id="account-upload" name="profile" hidden accept="image/*">
                                                            <input type="hidden" name="id" value="<?php echo $getUserId;?>">
                                                        </div>
                                                        <p class="text-muted ml-75 mt-50"><small>Allowed .jpg or .png Format with Height Equivalent to Width e.g. (100px x 100px)</small></p>
                                                    </div>
                                                </div>
                                                    <div class="row"> 
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">Full Name</label>
                                                                    <input type="text" class="form-control border-dark square" placeholder="Enter Full Name" value="<?php echo $row['har_fullname'];?>" required name="har_fullname">
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail">E-mail Address</label>
                                                                    <input type="email" class="form-control border-dark square" placeholder="Enter Email Address" value="<?php echo $row['har_email'];?>" name="har_email" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">Phone Number</label>
                                                                    <input type="text" class="form-control border-dark square" placeholder="Enter Contact No." value="<?php echo $row['har_phone'];?>" required name="har_phone">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">Date of Birth</label>
                                                                    <input type="date" class="form-control border-dark square" placeholder="Enter Date of Birth" value="<?php echo $row['har_date_of_birth'];?>" required name="har_date_of_birth">
                                                                </div>
                                                            </div>
                                                        </div> 

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">Address Info</label>
                                                                    <textarea class="form-control border-dark square" rows="5" name="har_address" required><?php echo $row['har_address'];?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" name="upload" class="btn btn-dark btn-block square">Update Information</button> 
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                <form action="change-password" method="POST">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-old-password">Old Password</label>
                                                                    <input type="hidden" name="id" value="<?php echo $getUserId; ?>">
                                                                    <input type="password" class="form-control border-dark square" id="account-old-password" required placeholder="Old Password" name="opassword">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-new-password">New Password</label>
                                                                    <input type="password" name="password" id="account-new-password" class="form-control border-dark square" placeholder="New Password" required minlength="8">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-retype-new-password">Retype New
                                                                        Password</label>
                                                                    <input type="password" name="rpassword" class="form-control border-dark square" required id="account-retype-new-password" data-validation-match-match="password" placeholder="Retype New Password" minlength="8">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-dark btn-block square">Change Password</button>
                                                        </div>
                                                    </div>
                                                </form>
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
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/account-setting.js"></script>
    <!-- END: Page JS-->

    <?php unset($_SESSION['metadata']); unset($_SESSION['wrong_metadata']); ?>


</body>
<!-- END: Body-->

</html>
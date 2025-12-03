<?php
ob_start();
include "../amstaff.conn.php";
session_start();

if (isset($_POST['submit'])) { 
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];  

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE har_email = ? AND har_status = 'Active'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['har_password'])) {
            $_SESSION['my_id'] = $row['id'];
            $_SESSION['my_name'] = $row['har_fullname'];
            $_SESSION['my_job'] = $row['har_role'];
            header("Location: mi-dashboard");
            exit();
        } else {
            $_SESSION['metadata'] = "Wrong Password Entered, Try Again!!";
            header("Location: ./");
            exit();
        }
    } else {
        $_SESSION['metadata'] = "No Account Associated with Username, Try Again!!";
        header("Location: ./");
        exit();
    }
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
    <title>Login . Helentor Amstaffs</title> 
    <link rel="apple-touch-icon" href="../assets/img/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/custom.css">
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
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/login-register.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column   blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-0 mb-1"><img src="../assets/img/lb.png" alt="branding logo" style="width: 30%;"></div>
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-0"><span>Please Provide Your Login Credentials</span></h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                       <form class="form-horizontal form-simple" action="" method="POST">
                                          <?php if (isset($_SESSION['metadata'])): ?>
                                             <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                   <span aria-hidden="true">×</span>
                                                </button>
                                                <strong><?php echo $_SESSION['metadata']; ?></strong>
                                             </div>
                                          <?php endif; ?>
                                          <fieldset class="form-group position-relative has-icon-left mb-1">
                                             <input type="email" name="username" class="form-control form-control-md border-secondary" id="user-name" placeholder="Enter Email Address" required>
                                             <div class="form-control-position">
                                                 <i class="feather icon-user"></i>
                                             </div>
                                          </fieldset>
                                          <fieldset class="form-group position-relative has-icon-left">
                                             <input type="password" name="password" class="form-control form-control-md border-secondary" id="user-password" placeholder="Enter Password" required>
                                             <div class="form-control-position">
                                                <i class="fa fa-key"></i>
                                             </div>
                                          </fieldset> 
                                            
                                          <button type="submit" name="submit" class="btn btn-secondary btn-lg btn-block square"><i class="feather icon-unlock"></i> Login</button>  
                                       </form>
                                    </div>
                                 </div>
                                 <div class="card-footer">
                                    <div class="">
                                        <p class="float-sm-center text-center m-0">Powered By <a href="javascript:void(0);" class="card-link">FMT Digital Agency</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/forms/form-login-register.js"></script>
    <!-- END: Page JS-->
    <?php unset($_SESSION['metadata']); ?>


</body>
<!-- END: Body-->

</html>
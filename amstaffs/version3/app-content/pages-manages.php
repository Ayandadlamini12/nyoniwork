<?php
    require('includes-request.php');

    if (isset($_POST['deletion']) && $_POST['deletion'] == 1) {

        // Retrieve form data
        $client_id = $_POST['client_id'];
        $update ="DELETE FROM pages WHERE id=".$client_id;
        mysqli_query($conn, $update) or die(mysqli_error($conn));
        $_SESSION['my_metadata'] = "Page Deleted Successfully!";
        header("Location: pages-manage");
        exit();
    }

    if (isset($_POST['blocking']) && $_POST['blocking'] == 1) {

        // Retrieve form data
        $client_id = $_POST['client_id'];
        $update_status = $_POST['update_status'];
        $update ="UPDATE pages SET status = '$update_status' WHERE id=".$client_id;
        mysqli_query($conn, $update) or die(mysqli_error($conn));
        $_SESSION['my_metadata'] = "Page Status Updated Successful!";
        header("Location: pages-manage");
        exit();
    }
  
    
    if (isset($_POST['addpage']) && $_POST['addpage'] == 1) {
        
        // 1. Sanitize and retrieve form data
        $page_name = $_POST['page_name'] ?? '';
        $page_key = $_POST['page_key'] ?? '';
        $page_status = $_POST['page_status'] ?? '';
        $page_nav = $_POST['page_nav'] ?? '';
     
        try {
            
            // --- 2. SQL Query for INSERT (Using positional placeholders ?) ---
            $sql = "INSERT INTO pages (
                page, page_key, status, page_nav
            ) VALUES (
                ?, ?, ?, ?
            )";
    
            // Prepare the statement
            $stmt = $conn->prepare($sql);
            
            if ($stmt === false) {
                throw new Exception("Insert Prepare Failed: " . $conn->error);
            }
    
            $types = "ssss"; // Fullname, Email, Password, Phone, Address, DOB, Role, Status, Profile, RegDate
            
            $stmt->bind_param($types, 
                $page_name, 
                $page_key, 
                $page_status,
                $page_nav
            );
    
            // Execute the prepared statement
            $stmt->execute(); 
    
            // Check if the insert was successful
            if ($stmt->affected_rows > 0) {
                $_SESSION['my_metadata'] = "New Page Created!";
                $stmt->close();
                header("Location: ./pages-manage");
                exit();
            } else {
                // Check for execution error
                $_SESSION['my_metadata'] = "An Error Occured: Page was not inserted. MySQL Error: " . $stmt->error;
                $stmt->close();
                header("Location: ./pages-manage");
                exit();
            }
            
        } catch (Exception $e) {
            // Handle database or prepare errors
            error_log("Database/Code Error: " . $e->getMessage());
            $_SESSION['my_metadata'] = "A critical error occurred during registration. Error: " . $e->getMessage();
            header("Location: ./pages-manage");
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
    <title>Pages . Helentor Amstaffs</title>
    <link rel="apple-touch-icon" href="../assets/img/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
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
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-callout.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

        <style type="text/css">
    /* General alert styling */
    .alert {
        padding: 20px 25px;
        margin: 20px 0;
        border-radius: 12px; /* Smooth rounded corners */
        position: relative;
        color: #fff; /* White text */
        background: linear-gradient(135deg, #343a40, #495057); /* Purple gradient */
        border: none; /* No solid border */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 16px;
        font-weight: 500;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2); /* Soft shadow */
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    /* Hover effect */
    .alert:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
    }

    /* Close button styling */
    .alert .close {
        position: absolute;
        top: 12px;
        right: 15px;
        border: none;
        background: none;
        font-size: 22px;
        cursor: pointer;
        color: #fff;
        transition: transform 0.2s ease, color 0.2s ease;
    }

    /* Hover effect for close button */
    .alert .close:hover {
        color: #ff4081; /* Pinkish hover */
        transform: rotate(90deg); /* Rotates when hovered */
    }
</style>

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
                        <li class="active"><a class="menu-item" href="pages-manage" data-i18n="eCommerce">Manage Pages</a>
                        </li>
                        <li><a class="menu-item" href="quill-photos" data-i18n="Analytics">Manage Content</a> </li>
                    </ul>
                </li>
                 
    
                <li class=" navigation-header"><span>Authentication</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i>
                </li>
                <li class="nav-item"><a href="account-settings"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Email Application">Manage Profile</span></a>
                </li> 
                <li class="nav-item">
                    <a href="users-manage">
                        <i class="feather icon-users"></i>
                        <span class="menu-title" data-i18n="Email Application">Manage Users</span>
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
                    <h3 class="content-header-title mb-0">Pages</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="mi-dashboard">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Manage</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Pages</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <a class="btn btn-primary square" href="mi-dashboard"><i class="feather icon-home"></i> Home Page</a>
                        <a class="btn btn-secondary text-white" data-toggle="modal" data-target="#defaultNew"><i class="feather icon-plus"></i> New Page</a> 

                        <div class="modal fade text-left" id="defaultNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNew" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelNew">Page Management</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h5>PAGE INFO</h5>
                                                                            <form action="pages-manage" method="POST">
                                                                               <div class="modal-body">
                                                                                   
                                                                                   <!-- Full Name -->
                                                                                   <label>Page Name:</label>
                                                                                   <div class="form-group"> 
                                                                                       <input type="text" class="form-control" name="page_name" required="" placeholder="Enter Page Name (Home)">
                                                                                       <input type="hidden" name="addpage" value="1">
                                                                                   </div>
                                                                                   
                                                                                   <!-- Email Address -->
                                                                                   <label>Page Key:</label>
                                                                                   <div class="form-group"> 
                                                                                       <input type="text" class="form-control" name="page_key" required="" placeholder="Enter Page Key (home_page)">
                                                                                   </div>  
                                                                            
                                                                                   <!-- User Role -->
                                                                                   <label>Page Status:</label>
                                                                                   <div class="form-group">
                                                                                       <select class="form-control" required name="page_status"> 
                                                                                           <option value="">Select Status</option>
                                                                                           <option value="Active">Active</option>
                                                                                           <option value="Inactive">Inactive</option>
                                                                                       </select>
                                                                                   </div>

                                                                                   <!-- User Role -->
                                                                                   <label>Navigation Type:</label>
                                                                                   <div class="form-group">
                                                                                       <select class="form-control" required name="page_nav"> 
                                                                                           <option value="">Select Type</option>
                                                                                           <option value="Main Nav">Main Nav</option>
                                                                                           <option value="Dropdown Nav">Dropdown Nav</option>
                                                                                       </select>
                                                                                   </div>
                                                                                   
                                                                               </div>
                                                                               <div class="modal-footer">
                                                                                   <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                                                                   <input type="submit" class="btn btn-outline-primary btn-lg" value="Save Info">
                                                                               </div>
                                                                           </form>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                    </div>
                </div>
            </div>
            <div class="content-body"> 

                <!-- Zero configuration table -->
                <section id="configuration">
                    <?php if (isset($_SESSION['my_metadata'])): ?>
                        <div class="alert">
                            <?php echo $_SESSION['my_metadata']; ?>
                            <button class="close" onclick="this.parentElement.style.display='none';">&times;</button>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">WEB PAGES</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Page Name</th>
                                                    <th>Page Key</th> 
                                                    <th style="text-align: center;">Status</th> 
                                                    <th>Page Navigation</th> 
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $count=1;
                                                    $sel_query="SELECT * FROM pages ORDER BY page, page_nav ASC";
                                                    $result = mysqli_query($conn,$sel_query) or die(mysqli_error($con));
                                                    while($row = mysqli_fetch_assoc($result)) { 

                                                        $this_status = $row['status'];
                                                        if ($this_status == 'Active') {
                                                            $display_this = '<div class="badge badge-success badge-pill" style="width:100%;">Active</div>';
                                                        }elseif ($this_status == 'Inactive') {
                                                            $display_this = '<div class="badge badge-danger badge-pill" style="width:100%;">Inactive</div>';
                                                        }

                                                        if ($this_status != 'Active') {
                                                            $new_text = 'Are You Sure You Want To De-activate Page?';
                                                            $update_status = 'Inactive';
                                                        }elseif ($this_status == 'Active') {
                                                            $new_text = 'Are You Sure You Want To Active Page?';
                                                            $update_status = 'Active';
                                                        } 
 
                                                ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row["page"];?></td>
                                                    <td><?php echo $row["page_key"];?></td>
                                                    <td><?php echo $display_this;?></td>
                                                    <td><?php echo $row["page_nav"];?></td>
                                                    <td> 
                                                        <div class="btn-group float-md-center" role="group" aria-label="Button group with nested dropdown"> 
                                                            
                                                            <a class="btn btn-danger text-white" data-toggle="modal" data-target="#defaultDelete<?php echo $row['id']; ?>">
                                                                <i class="feather icon-trash"></i>
                                                            </a> 
                                                            <!-- DELETE MODAL -->
                                                            <div class="modal fade text-left" id="defaultDelete<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDelete<?php echo $row['id']; ?>" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelDelete<?php echo $row['id']; ?>">CONFIRMATION</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <form action="users-manage" method="POST">
                                                                                <div class="modal-body">
                                                                                    <!-- Reference No -->
                                                                                    <label>Are You Sure You Want To Delete Page?</label>
                                                                                    <div class="form-group"> 
                                                                                         <input type="hidden" name="deletion" value="1">
                                                                                         <input type="hidden" name="client_id" value="<?php echo $row['id']; ?>">
                                                                                    </div> 
                                                                             
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                                                                    <input type="submit" class="btn btn-outline-danger btn-lg" value="Delete">
                                                                                </div>
                                                                            </form>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- // BLOCK / UNBLOCK -->
                                                            <a class="btn btn-secondary text-white" data-toggle="modal" data-target="#defaultBlock<?php echo $row['id']; ?>">
                                                                <i class="feather icon-repeat"></i>
                                                            </a> 
                                                            <!-- BLOCK / UNBLOCK MODAL -->
                                                            <div class="modal fade text-left" id="defaultBlock<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelBlock<?php echo $row['id']; ?>" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelBlock<?php echo $row['id']; ?>">CONFIRMATION</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <form action="users-manage" method="POST">
                                                                                <div class="modal-body">
                                                                                    <!-- Reference No -->
                                                                                    <label><?php echo $new_text;?></label>
                                                                                    <div class="form-group"> 
                                                                                         <input type="hidden" name="blocking" value="1">
                                                                                         <input type="hidden" name="client_id" value="<?php echo $row['id']; ?>">
                                                                                         <input type="hidden" name="update_status" value="<?php echo $update_status; ?>">
                                                                                    </div> 
                                                                             
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input type="reset" class="btn btn-outline-danger btn-lg" data-dismiss="modal" value="Close">
                                                                                    <input type="submit" class="btn btn-outline-secondary btn-lg" value="Submit">
                                                                                </div>
                                                                            </form>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr> 
                                                 <?php $count++; } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Page Name</th>
                                                    <th>Page Key</th>  
                                                    <th style="text-align: center;">Status</th>
                                                    <th>Page Navigation</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <?php include("includes-footer.php");?>


    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <script src="app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <?php unset($_SESSION['metadata']); unset($_SESSION['wrong_metadata']); ?>


</body>
<!-- END: Body-->
 

</html>
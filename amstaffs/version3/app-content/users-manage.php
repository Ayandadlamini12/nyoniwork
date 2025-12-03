<?php
    require('includes-request.php');

    if (isset($_POST['deletion']) && $_POST['deletion'] == 1) {

        // Retrieve form data
        $client_id = $_POST['client_id'];
        $update ="DELETE FROM users WHERE id=".$client_id;
        mysqli_query($conn, $update) or die(mysqli_error($conn));
        $_SESSION['my_metadata'] = "User Info Deleted Successful!";
        header("Location: users-manage");
        exit();
    }

    if (isset($_POST['blocking']) && $_POST['blocking'] == 1) {

        // Retrieve form data
        $client_id = $_POST['client_id'];
        $update_status = $_POST['update_status'];
        $update ="UPDATE users SET har_status = '$update_status' WHERE id=".$client_id;
        mysqli_query($conn, $update) or die(mysqli_error($conn));
        $_SESSION['my_metadata'] = "User Status Updated Successful!";
        header("Location: users-manage");
        exit();
    }
  
    
    if (isset($_POST['adduser']) && $_POST['adduser'] == 1) {
        
        // 1. Sanitize and retrieve form data
        $fullname = $_POST['har_fullname'] ?? '';
        $email = $_POST['har_email'] ?? '';
        $password = $_POST['har_password'] ?? '';
        $phone = $_POST['har_phone'] ?? null;
        $address = $_POST['har_address'] ?? null;
        $date_of_birth = $_POST['har_date_of_birth'] ?? null;
        $role = $_POST['har_role'] ?? null;
        
        // --- NEW: Key Variable (Timestamp) ---
        $har_registration_date = date('Y-m-d H:i:s'); 
        
        // Set default values
        $status = 'Active'; 
        $profile = 'default.jpg'; 
    
        // --- NEW: Basic Validation and Error Checking ---
        
        // Check if required fields are empty
        if (empty($fullname) || empty($email) || empty($password)) {
            $_SESSION['my_metadata'] = "Error: Full name, Email, and Password are required.";
            header("Location: ./users-manage");
            exit();
        }
        
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['my_metadata'] = "Error: Invalid email format.";
            header("Location: ./users-manage");
            exit();
        }
        
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
     
        try {
            
            // --- 1. Check if email already exists (Validation) ---
            // Using MySQLi's positional placeholder (?)
            $check_sql = "SELECT har_email FROM users WHERE har_email = ?";
            
            $check_stmt = $conn->prepare($check_sql); 
            
            // Check if the prepare failed
            if ($check_stmt === false) {
                throw new Exception("Email Check Prepare Failed: " . $conn->error);
            }
    
            // Bind the parameter: 's' for string
            $check_stmt->bind_param("s", $email);
            $check_stmt->execute();
            
            // Get the result set
            $result = $check_stmt->get_result();
    
            // Check the number of rows returned
            if ($result->num_rows > 0) {
                // Email already exists in the database
                $check_stmt->close();
                $_SESSION['my_metadata'] = "Error: The email address **$email** is already registered.";
                header("Location: ./users-manage");
                exit();
            }
            
            // Close the statement for the email check before moving to INSERT
            $check_stmt->close();
            
            // --- 2. SQL Query for INSERT (Using positional placeholders ?) ---
            $sql = "INSERT INTO users (
                har_fullname, har_email, har_password, har_phone, 
                har_address, har_date_of_birth, har_role, har_status, 
                har_profile, har_registration_date
            ) VALUES (
                ?, ?, ?, ?, 
                ?, ?, ?, ?, 
                ?, ?
            )";
    
            // Prepare the statement
            $stmt = $conn->prepare($sql);
            
            if ($stmt === false) {
                throw new Exception("Insert Prepare Failed: " . $conn->error);
            }
    
            // 3. Bind parameters (total of 10 parameters)
            // 's' for string. Assuming all fields are strings (or nulls are handled correctly by mysqli/MariaDB)
            $types = "ssssssssss"; // Fullname, Email, Password, Phone, Address, DOB, Role, Status, Profile, RegDate
            
            $stmt->bind_param($types, 
                $fullname, 
                $email, 
                $hashed_password, 
                $phone, // May need to adjust type if you enforce integer/numeric
                $address, 
                $date_of_birth, 
                $role, 
                $status, 
                $profile, 
                $har_registration_date
            );
    
            // Execute the prepared statement
            $stmt->execute(); 
    
            // Check if the insert was successful
            if ($stmt->affected_rows > 0) {
                $_SESSION['my_metadata'] = "New User Created Successfully!";
                $stmt->close();
                header("Location: ./users-manage");
                exit();
            } else {
                // Check for execution error
                $_SESSION['my_metadata'] = "An Error Occured: User was not inserted. MySQL Error: " . $stmt->error;
                $stmt->close();
                header("Location: ./users-manage");
                exit();
            }
            
        } catch (Exception $e) {
            // Handle database or prepare errors
            error_log("Database/Code Error: " . $e->getMessage());
            $_SESSION['my_metadata'] = "A critical error occurred during registration. Error: " . $e->getMessage();
            header("Location: ./users-manage");
            exit();
        }
    } 

    if (isset($_POST['USERROLE']) && $_POST['USERROLE'] == 1) {
       // Example variables - replace these with your actual data
       $har_id = $_POST['har_id']; // ID of the record to update
       $har_role = $_POST['har_role']; // ID of the record to update

 
       
       // Prepare the statement to prevent SQL injection
       $stmt = $conn->prepare("UPDATE users SET har_role = ? WHERE id = ?");
       
       // Bind parameters: string, string, string, integer (adjust data types as needed)
       $stmt->bind_param("si", $har_role, $har_id);
       
       // Execute the statement
       if ($stmt->execute()) {
           $_SESSION['my_metadata'] = "User Role Has Been Updated!!";
           header("Location: ./users-manage");
           exit();
       } else {
           $_SESSION['my_metadata'] = "An Error Occured!! ". $stmt->error;
           header("Location: ./users-manage");
           exit();
       }
       
       $stmt->close();
       $conn->close();
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
    <title>Users . Helentor Amstaffs</title>
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
                        <li><a class="menu-item" href="pages-manage" data-i18n="eCommerce">Manage Pages</a>
                        </li>
                        <li><a class="menu-item" href="quill-photos" data-i18n="Analytics">Manage Content</a> </li>
                    </ul>
                </li>
                
                <li class=" navigation-header"><span>Authentication</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i>
                </li>
                <li class=" nav-item"><a href="account-settings"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Email Application">Mange Profile</span></a>
                </li> 
                <li class="nav-item active">
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
                    <h3 class="content-header-title mb-0">Users</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="mi-dashboard">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Manage</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Users</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <a class="btn btn-primary square" href="mi-dashboard"><i class="feather icon-home"></i> Home Page</a>
                        <a class="btn btn-secondary text-white" data-toggle="modal" data-target="#defaultNew"><i class="feather icon-plus"></i> New User</a> 

                        <div class="modal fade text-left" id="defaultNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNew" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelNew">USER MANAGEMENT</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h5>USER INFO</h5>
                                                                            <form action="users-manage" method="POST">
                                                                               <div class="modal-body">
                                                                                   
                                                                                   <!-- Full Name -->
                                                                                   <label>Full Name:</label>
                                                                                   <div class="form-group"> 
                                                                                       <input type="text" class="form-control" name="har_fullname" required="" placeholder="Enter Full Name">
                                                                                       <input type="hidden" name="adduser" value="1">
                                                                                   </div>
                                                                                   
                                                                                   <!-- Email Address -->
                                                                                   <label>Email Address:</label>
                                                                                   <div class="form-group"> 
                                                                                       <input type="email" class="form-control" name="har_email" required="" placeholder="Enter Email Address">
                                                                                       <input type="hidden" class="form-control" name="har_password" required="" placeholder="Enter password" value="12345678"> 
                                                                                   </div> 
                                                                                   
                                                                                   <!-- Phone Number -->
                                                                                   <label>Phone Number</label>
                                                                                   <div class="form-group"> 

                                                                                       <input type="text" class="form-control" name="har_phone" required="" placeholder="Enter Phone Number">
                                                                                   </div>
                                                                           
                                                                                   <!-- Address -->
                                                                                   <label>Address</label>
                                                                                   <div class="form-group">
                                                                                       <textarea class="form-control" name="har_address" required placeholder="Enter Address"></textarea>
                                                                                       
                                                                                   </div>
                                                                           
                                                                                   <!-- Date of Birth -->
                                                                                   <label>Date of Birth</label>
                                                                                   <div class="form-group"> 
                                                                                       <input type="date" class="form-control" name="har_date_of_birth" required="">
                                                                                   </div>
                                                                           
                                                                                   <!-- User Role -->
                                                                                   <label>User Role:</label>
                                                                                   <div class="form-group">
                                                                                       <!-- Kept select element, updated name attribute to match data structure from Canvas -->
                                                                                       <select class="form-control" required name="har_role"> 
                                                                                           <option value="">Select Role</option>
                                                                                           <option value="Super Admin">Super Admin</option>
                                                                                           <option value="Editor">Editor</option>
                                                                                           <option value="Blog Manager">Blog Manager</option> 
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
                                    <h4 class="card-title">SYSTEM USERS</h4>
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
                                                    <th>Role</th>
                                                    <th>Full Name</th>
                                                    <th>Email Address</th>
                                                    <th>Phone #</th> 
                                                    <th style="text-align: center;">Status</th> 
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $count=1;
                                                    $sel_query="SELECT * FROM users ORDER BY har_role DESC";
                                                    $result = mysqli_query($conn,$sel_query) or die(mysqli_error($con));
                                                    while($row = mysqli_fetch_assoc($result)) { 

                                                        $this_status = $row['har_status'];
                                                        if ($this_status == 'Online') {
                                                            $display_this = '<div class="badge badge-success badge-pill" style="width:100%;">Online</div>';
                                                        }elseif ($this_status == 'Offline') {
                                                            $display_this = '<div class="badge badge-danger badge-pill" style="width:100%;">Offline</div>';
                                                        }
                                                        elseif ($this_status == 'Blocked') {
                                                            $display_this = '<div class="badge badge-danger badge-pill" style="width:100%;">Blocked</div>';
                                                        }else{
                                                            $display_this = '<div class="badge badge-info badge-pill" style="width:100%;">Active</div>';
                                                        }

                                                        // USER ROLES

                                                        $this_role = $row['har_role'];
                                                        if ($this_role == 'Super Admin') {
                                                            $display_role = '<div class="badge badge-secondary badge-pill" style="width:100%;">Super Admin</div>';
                                                        }elseif ($this_role == 'Editor') {
                                                            $display_role = '<div class="badge badge-warning badge-pill" style="width:100%;">Editor</div>';
                                                        }
                                                        elseif ($this_role == 'Blog Manager') {
                                                            $display_role = '<div class="badge badge-success badge-pill" style="width:100%;">Blog Manager</div>';
                                                        }else{
                                                            $display_role = '<div class="badge badge-danger badge-pill" style="width:100%;">Not Assigned</div>';
                                                        }

                                                        if ($this_status != 'Blocked') {
                                                            $new_text = 'Are You Sure You Want To Block User?';
                                                            $update_status = 'Blocked';
                                                        }elseif ($this_status == 'Blocked') {
                                                            $new_text = 'Are You Sure You Want To Un-block User?';
                                                            $update_status = 'Active';
                                                        }
                                                ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $display_role;?></td>
                                                    <td><?php echo $row["har_fullname"];?></td>
                                                    <td><a href="mailto:<?php echo $row["har_email"];?>"><?php echo $row["har_email"];?></a></td>
                                                    <td><?php echo $row["har_phone"];?></td>
                                                    <td><center><?php echo $display_this;?></center></td>  
                                                    <td> 
                                                        <div class="btn-group float-md-center" role="group" aria-label="Button group with nested dropdown"> 
                                                            <a class="btn btn-info text-white" data-toggle="modal" data-target="#defaultView<?php echo $row['id']; ?>">
                                                                <i class="feather icon-eye"></i>
                                                            </a> 
                                                            <!-- VIEW MODAL -->
                                                            <div class="modal fade text-left" id="defaultView<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelView<?php echo $row['id']; ?>" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelView<?php echo $row['id']; ?>">USER INFO</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <form action="users-manage" method="POST">
                                                                                <input type="hidden" name="USERROLE" value="1">
                                                                                <input type="hidden" name="har_id" value="<?php echo $row['id'];?>">
                                                                                <center> 
                                                                                    <a href="javascript: void(0);">
                                                                                        <img src="<?php $new_path = 'uploads/profiles/'.$row["har_profile"]; echo $new_path;?>" class="rounded mr-70" alt="profile image" height="64" width="64">
                                                                                    </a> 
                                                                            </center>
                                                                                <div class="modal-body">
                                                                                    <div class="card-body">
                                                                                       
                                                                                        <div class="row g-2">
                                                                                            
                                                                                            <!-- Full Name -->
                                                                                            <div class="col-12">
                                                                                                <div class="row">
                                                                                                    <!-- Label takes 4 columns (1/3 width) -->
                                                                                                    <div class="col-4 font-weight-bold">Full Name:</div>
                                                                                                    <!-- Value takes 8 columns (2/3 width) -->
                                                                                                    <div class="col-8"><?php echo $row["har_fullname"];?></div>
                                                                                                </div>
                                                                                                <hr class="my-1">
                                                                                            </div>
                                                                                    
                                                                                            <!-- Email Address -->
                                                                                            <div class="col-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-4 font-weight-bold">Email Address:</div>
                                                                                                    <div class="col-8"><?php echo $row["har_email"];?></div>
                                                                                                </div>
                                                                                                <hr class="my-1">
                                                                                            </div>
                                                                                    
                                                                                            <!-- Phone # -->
                                                                                            <div class="col-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-4 font-weight-bold">Phone #:</div>
                                                                                                    <div class="col-8"><?php echo $row["har_phone"];?></div>
                                                                                                </div>
                                                                                                <hr class="my-1">
                                                                                            </div>
                                                                                    
                                                                                            <!-- Date of Birth -->
                                                                                            <div class="col-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-4 font-weight-bold">Date of Birth:</div>
                                                                                                    <div class="col-8"><?php echo $row["har_date_of_birth"];?></div>
                                                                                                </div>
                                                                                                <hr class="my-1">
                                                                                            </div>
                                                                                    
                                                                                            <!-- User Role -->
                                                                                            <div class="col-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-4 font-weight-bold">User Role:</div>
                                                                                                    <div class="col-8"><?php echo $row["har_role"];?></div>
                                                                                                </div>
                                                                                                <hr class="my-1">
                                                                                            </div>
                                                                                    
                                                                                            <!-- Date of Registration -->
                                                                                            <div class="col-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-4 font-weight-bold">Creation Date:</div>
                                                                                                    <div class="col-8"><?php echo $row["har_registration_date"];?></div>
                                                                                                </div>
                                                                                                <hr class="my-1">
                                                                                            </div>
                                                                                    
                                                                                            <!-- Last Login -->
                                                                                            <div class="col-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-4 font-weight-bold">Last Login:</div>
                                                                                                    <div class="col-8"><?php echo $row["har_last_login"];?></div>
                                                                                                </div>
                                                                                                <hr class="my-1">
                                                                                            </div>
                                                                                    
                                                                                            <!-- Address Info (Last Item - No separator below) -->
                                                                                            <div class="col-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-4 font-weight-bold">Address Info:</div>
                                                                                                    <div class="col-8"><?php echo $row["har_address"];?></div>
                                                                                                </div>
                                                                                                <hr class="my-1">
                                                                                            </div>

                                                                                            <div class="col-12">
                                                                                                <div class="form-group">
                                                                                                    <div class="controls">
                                                                                                        <label for="account-name">Update User Role</label>
                                                                                                        <div class="form-group">
                                                                                                        <select class="form-control" name="har_role" required>
                                                                                                        <option value="
                                                                                                            <?php echo htmlspecialchars($row['har_role']); ?>">
                                                                                                            <?php echo htmlspecialchars($row['har_role']); ?>
                                                                                                        </option> 
                                                                                                        <option value="Super Admin">Super Admin</option>
                                                                                                        <option value="Editor">Editor</option>
                                                                                                        <option value="Blog Manager">Blog Manager</option>

                                                                                                        </select>
                                                                                                    </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div> 
                                                                                            
                                                                                        </div>
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
                                                                                    <label>Are You Sure You Want To Delete Record?</label>
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
                                                    <th>Role</th>
                                                    <th>Full Name</th>
                                                    <th>Email Address</th> 
                                                    <th>Phone #</th> 
                                                    <th>Status</th>
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
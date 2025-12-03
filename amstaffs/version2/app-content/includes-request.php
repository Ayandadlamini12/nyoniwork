<?php  
  ob_start();
  session_start();  
  require('../amstaff.conn.php');
  
  if(isset($_SESSION['my_id'])=="") {
    header("Location: ./");
  }
  $getUserId = $_SESSION['my_id'];
  $getUser = $_SESSION['my_name'];
  $getJob = $_SESSION['my_job'];

  $index0 ="SELECT * FROM users WHERE id = '$getUserId'";
  $index1 = mysqli_query($conn,$index0) or die(mysqli_error($conn));
  if($row = mysqli_fetch_assoc($index1)) { 
    $user = $row['har_fullname'];
    $status = $row['har_status'];
    $title = $row['har_role'];
    $profile = $row['har_profile'];

    $path = "uploads/profiles/$profile"; 
  }
?> 

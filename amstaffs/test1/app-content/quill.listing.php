<div role="tabpanel" class="tab-pane" id="account-vertical-services" aria-labelledby="account-pill-services" aria-expanded="false">
    <h4 class="form-section mb-0"><i class="fa fa-media"></i> Services / Why Choose Us / Knowledge Base</h4> 
                                          
                <section id="tabs-with-icons">
                    <div class="row match-height">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card"> 
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-linetriangle" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="baseIcon-tab31" data-toggle="tab" aria-controls="tabIcon31" href="#tabIcon31" role="tab" aria-selected="true"><i class="fa fa-play"></i> Knowledge Base</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="baseIcon-tab32" data-toggle="tab" aria-controls="tabIcon32" href="#tabIcon32" role="tab" aria-selected="false"><i class="fa fa-flag"></i> Why Choose Us</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="baseIcon-tab33" data-toggle="tab" aria-controls="tabIcon33" href="#tabIcon33" role="tab" aria-selected="false"><i class="fa fa-cog"></i> Services</a>
                                            </li> 
                                        </ul>
                                        <div class="tab-content px-1 pt-1">
                                            <div class="tab-pane active" id="tabIcon31" role="tabpanel" aria-labelledby="baseIcon-tab31">
                                                <div class="row">
                                                    <?php
                                                     
                                                        $sql = "SELECT * FROM quill_listing WHERE list_category='Knowledge Base' ORDER BY id ASC";
                                                    
                                                        // Execute the query
                                                        $result = $conn->query($sql);
                                                    
                                                        // Check for query errors (optional, but good practice)
                                                        if ($result === false) {
                                                            echo "<p class='text-danger'>Database query failed: " . $conn->error . "</p>";
                                                            // Optionally exit or set $result to an empty set to prevent further errors
                                                            $result = (object) ['num_rows' => 0];
                                                        }
                                                    ?>
                                                    
                                                    <div class="col-md-12 form-group"> 
                                                        <div class="row match-height">
                                                            <?php
                                                                if ($result->num_rows > 0) {
                                                                    // 3. Loop through the fetched results
                                                                    while($row = $result->fetch_assoc()) {
                                                                        // $image_id is the unique ID from the database for deletion
                                                                        $image_id = htmlspecialchars($row['id']);
                                                                        $image_title0 = htmlspecialchars($row['gallery_title']);
                                                                        $image_title1 = htmlspecialchars($row['gallery_description']);
                                                                        $image_title2 = htmlspecialchars($row['list_category']);
                                                                        $image_path = htmlspecialchars($row['gallery_image']);
                                                            ?> 
                                                            
                                                            <div class="col-xl-4 col-md-6 col-sm-12">
                                                                <div class="card">
                                                                    <div class="card-content">
                                                                        <img class="card-img-top img-fluid" src="../assets/uploads/listing/<?php echo $image_path; ?>" alt="Gallery">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title"><?php echo $image_title0; ?></h4>
                                                                            <p class="card-text"><?php echo $image_title1; ?></p>
                                                                            <a data-toggle="modal" data-target="#defaultNewList<?php echo $image_id; ?>" class="btn btn-outline-secondary">Manage</a>
                                                                            <a data-toggle="modal" data-target="#deleteNewListing<?php echo $image_id; ?>" class="btn btn-outline-danger">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 

                                                            <div class="modal fade text-left" id="defaultNewList<?php echo $image_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNewList<?php echo $image_id; ?>" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelNewList<?php echo $image_id; ?>">Services / Why Choose Us</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <form action="quill-photos" enctype="multipart/form-data" method="POST">
                                                                                <div class="modal-body"> 
                                                                                    <div class="form-group"> 
                                                                                        <center><img class="card-img-top img-fluid" src="../assets/uploads/listing/<?php echo $image_path; ?>" alt="Gallery"></center>
                                                                                        <input type="hidden" name="ThisUpdateListing" value="1">
                                                                                        <input type="hidden" name="content_id" value="<?php echo $image_id; ?>">
                                                                                        <input type="hidden" name="old_gallery_image" value="<?php echo $image_path; ?>">
                                                                                    </div>

                                                                                    <label for="basicInputFile">
                                                                                        Upload New Image <b class="text-danger">Leave Blank if Not Changing Current Image</b>
                                                                                    </label>
                                                                                    <div class="form-group"> 
                                                                                        <div class="custom-file">
                                                                                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="gallery_image">
                                                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                                        </div> 
                                                                                    </div>
                                                                                   
                                                                                        <!-- Email Address -->
                                                                                    <label>Image Title:</label>
                                                                                    <div class="form-group"> 
                                                                                        <input type="text" class="form-control border-dark" style="color: black;" name="content_title" required="" value="<?php echo $image_title0; ?>" placeholder="Enter Image Title">
                                                                                    </div> 

                                                                                    <!-- Email Address -->
                                                                                    <label>Image Description:</label>
                                                                                    <div class="form-group">
                                                                                        <textarea class="form-control border-dark" style="color: black;" name="content_description" placeholder="Enter Image Description"><?php echo $image_title1; ?></textarea> 
                                                                                    </div> 
                                                                                    <label>Category:</label>
                                                                                    <div class="form-group">
                                                                                        <select class="form-control border-dark" style="color: black;" name="list_category" required>
                                                                                            <option value="<?php echo $image_title2; ?>"><?php echo $image_title2; ?></option>
                                                                                            <option value="Services">Services</option>
                                                                                            <option value="Why Choose Us">Why Choose Us</option>
                                                                                            <option value="Knowledge Base">Knowledge Base</option>
                                                                                        </select> 
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

                                                            <div class="modal fade text-left" id="deleteNewListing<?php echo $image_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNewListing<?php echo $image_id; ?>" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelNewListing<?php echo $image_id; ?>">Services / Why Choose Us</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <form action="quill-photos" method="POST">
                                                                               <div class="modal-body">
                                                                                       
                                                                                    <div class="form-group"> 
                                                                                       <center><img class="card-img-top img-fluid" src="../assets/uploads/listing/<?php echo $image_path; ?>" alt="Gallery"></center>
                                                                                       <input type="hidden" name="deleteImageListing" value="1">
                                                                                       <input type="hidden" name="content_id" value="<?php echo $image_id; ?>">
                                                                                        <input type="hidden" name="content_value" value="<?php echo $image_path; ?>">
                                                                                    </div>
                                                                                   
                                                                                        <!-- Email Address -->
                                                                                    <h4><?php echo $image_title0; ?></h4> 
                                                                            
                                                                                    <!-- User Role -->
                                                                                    <p><?php echo $image_title1; ?></p> 
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input type="reset" class="btn btn-outline-secondary btn-lg"data-dismiss="modal" value="Close">
                                                                                    <input type="submit" class="btn btn-outline-danger btn-lg" value="Delete Info">
                                                                                </div>
                                                                            </form> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php }} ?>
                                                        </div>    
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tabIcon32" role="tabpanel" aria-labelledby="baseIcon-tab32">
                                                <div class="row">
                                                    <?php
                                                     
                                                        $sql = "SELECT * FROM quill_listing WHERE list_category='Why Choose Us' ORDER BY id ASC";
                                                    
                                                        // Execute the query
                                                        $result = $conn->query($sql);
                                                    
                                                        // Check for query errors (optional, but good practice)
                                                        if ($result === false) {
                                                            echo "<p class='text-danger'>Database query failed: " . $conn->error . "</p>";
                                                            // Optionally exit or set $result to an empty set to prevent further errors
                                                            $result = (object) ['num_rows' => 0];
                                                        }
                                                    ?>
                                                    
                                                    <div class="col-md-12 form-group"> 
                                                        <div class="row match-height">
                                                            <?php
                                                                if ($result->num_rows > 0) {
                                                                    // 3. Loop through the fetched results
                                                                    while($row = $result->fetch_assoc()) {
                                                                        // $image_id is the unique ID from the database for deletion
                                                                        $image_id = htmlspecialchars($row['id']);
                                                                        $image_title0 = htmlspecialchars($row['gallery_title']);
                                                                        $image_title1 = htmlspecialchars($row['gallery_description']);
                                                                        $image_title2 = htmlspecialchars($row['list_category']);
                                                                        $image_path = htmlspecialchars($row['gallery_image']);
                                                            ?> 
                                                            
                                                            <div class="col-xl-4 col-md-6 col-sm-12">
                                                                <div class="card">
                                                                    <div class="card-content">
                                                                        <img class="card-img-top img-fluid" src="../assets/uploads/listing/<?php echo $image_path; ?>" alt="Gallery">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title"><?php echo $image_title0; ?></h4>
                                                                            <p class="card-text"><?php echo $image_title1; ?></p>
                                                                            <a data-toggle="modal" data-target="#defaultNewList<?php echo $image_id; ?>" class="btn btn-outline-secondary">Manage</a>
                                                                            <a data-toggle="modal" data-target="#deleteNewListing<?php echo $image_id; ?>" class="btn btn-outline-danger">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 

                                                            <div class="modal fade text-left" id="defaultNewList<?php echo $image_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNewList<?php echo $image_id; ?>" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelNewList<?php echo $image_id; ?>">Services / Why Choose Us</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <form action="quill-photos" enctype="multipart/form-data" method="POST">
                                                                                <div class="modal-body"> 
                                                                                    <div class="form-group"> 
                                                                                        <center><img class="card-img-top img-fluid" src="../assets/uploads/listing/<?php echo $image_path; ?>" alt="Gallery"></center>
                                                                                        <input type="hidden" name="ThisUpdateListing" value="1">
                                                                                        <input type="hidden" name="content_id" value="<?php echo $image_id; ?>">
                                                                                        <input type="hidden" name="old_gallery_image" value="<?php echo $image_path; ?>">
                                                                                    </div>

                                                                                    <label for="basicInputFile">
                                                                                        Upload New Image <b class="text-danger">Leave Blank if Not Changing Current Image</b>
                                                                                    </label>
                                                                                    <div class="form-group"> 
                                                                                        <div class="custom-file">
                                                                                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="gallery_image">
                                                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                                        </div> 
                                                                                    </div>
                                                                                   
                                                                                        <!-- Email Address -->
                                                                                    <label>Image Title:</label>
                                                                                    <div class="form-group"> 
                                                                                        <input type="text" class="form-control border-dark" style="color: black;" name="content_title" required="" value="<?php echo $image_title0; ?>" placeholder="Enter Image Title">
                                                                                    </div> 

                                                                                    <!-- Email Address -->
                                                                                    <label>Image Description:</label>
                                                                                    <div class="form-group">
                                                                                        <textarea class="form-control border-dark" style="color: black;" name="content_description" placeholder="Enter Image Description"><?php echo $image_title1; ?></textarea> 
                                                                                    </div> 
                                                                                    <label>Category:</label>
                                                                                    <div class="form-group">
                                                                                        <select class="form-control border-dark" style="color: black;" name="list_category" required>
                                                                                            <option value="<?php echo $image_title2; ?>"><?php echo $image_title2; ?></option>
                                                                                            <option value="Services">Services</option>
                                                                                            <option value="Why Choose Us">Why Choose Us</option>
                                                                                            <option value="Knowledge Base">Knowledge Base</option>
                                                                                        </select> 
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

                                                            <div class="modal fade text-left" id="deleteNewListing<?php echo $image_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNewListing<?php echo $image_id; ?>" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelNewListing<?php echo $image_id; ?>">Services / Why Choose Us</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <form action="quill-photos" method="POST">
                                                                               <div class="modal-body">
                                                                                       
                                                                                    <div class="form-group"> 
                                                                                       <center><img class="card-img-top img-fluid" src="../assets/uploads/listing/<?php echo $image_path; ?>" alt="Gallery"></center>
                                                                                       <input type="hidden" name="deleteImageListing" value="1">
                                                                                       <input type="hidden" name="content_id" value="<?php echo $image_id; ?>">
                                                                                        <input type="hidden" name="content_value" value="<?php echo $image_path; ?>">
                                                                                    </div>
                                                                                   
                                                                                        <!-- Email Address -->
                                                                                    <h4><?php echo $image_title0; ?></h4> 
                                                                            
                                                                                    <!-- User Role -->
                                                                                    <p><?php echo $image_title1; ?></p> 
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input type="reset" class="btn btn-outline-secondary btn-lg"data-dismiss="modal" value="Close">
                                                                                    <input type="submit" class="btn btn-outline-danger btn-lg" value="Delete Info">
                                                                                </div>
                                                                            </form> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php }} ?>
                                                        </div>    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabIcon33" role="tabpanel" aria-labelledby="baseIcon-tab33">
                                                <div class="row">
                                                    <?php
                                                     
                                                        $sql = "SELECT * FROM quill_listing WHERE list_category='Services' ORDER BY id ASC";
                                                    
                                                        // Execute the query
                                                        $result = $conn->query($sql);
                                                    
                                                        // Check for query errors (optional, but good practice)
                                                        if ($result === false) {
                                                            echo "<p class='text-danger'>Database query failed: " . $conn->error . "</p>";
                                                            // Optionally exit or set $result to an empty set to prevent further errors
                                                            $result = (object) ['num_rows' => 0];
                                                        }
                                                    ?>
                                                    
                                                    <div class="col-md-12 form-group"> 
                                                        <div class="row match-height">
                                                            <?php
                                                                if ($result->num_rows > 0) {
                                                                    // 3. Loop through the fetched results
                                                                    while($row = $result->fetch_assoc()) {
                                                                        // $image_id is the unique ID from the database for deletion
                                                                        $image_id = htmlspecialchars($row['id']);
                                                                        $image_title0 = htmlspecialchars($row['gallery_title']);
                                                                        $image_title1 = htmlspecialchars($row['gallery_description']);
                                                                        $image_title2 = htmlspecialchars($row['list_category']);
                                                                        $image_path = htmlspecialchars($row['gallery_image']);
                                                            ?> 
                                                            
                                                            <div class="col-xl-4 col-md-6 col-sm-12">
                                                                <div class="card">
                                                                    <div class="card-content">
                                                                        <img class="card-img-top img-fluid" src="../assets/uploads/listing/<?php echo $image_path; ?>" alt="Gallery">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title"><?php echo $image_title0; ?></h4>
                                                                            <p class="card-text"><?php echo $image_title1; ?></p>
                                                                            <a data-toggle="modal" data-target="#defaultNewList<?php echo $image_id; ?>" class="btn btn-outline-secondary">Manage</a>
                                                                            <a data-toggle="modal" data-target="#deleteNewListing<?php echo $image_id; ?>" class="btn btn-outline-danger">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 

                                                            <div class="modal fade text-left" id="defaultNewList<?php echo $image_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNewList<?php echo $image_id; ?>" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelNewList<?php echo $image_id; ?>">Services / Why Choose Us</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <form action="quill-photos" enctype="multipart/form-data" method="POST">
                                                                                <div class="modal-body"> 
                                                                                    <div class="form-group"> 
                                                                                        <center><img class="card-img-top img-fluid" src="../assets/uploads/listing/<?php echo $image_path; ?>" alt="Gallery"></center>
                                                                                        <input type="hidden" name="ThisUpdateListing" value="1">
                                                                                        <input type="hidden" name="content_id" value="<?php echo $image_id; ?>">
                                                                                        <input type="hidden" name="old_gallery_image" value="<?php echo $image_path; ?>">
                                                                                    </div>

                                                                                    <label for="basicInputFile">
                                                                                        Upload New Image <b class="text-danger">Leave Blank if Not Changing Current Image</b>
                                                                                    </label>
                                                                                    <div class="form-group"> 
                                                                                        <div class="custom-file">
                                                                                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="gallery_image">
                                                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                                        </div> 
                                                                                    </div>
                                                                                   
                                                                                        <!-- Email Address -->
                                                                                    <label>Image Title:</label>
                                                                                    <div class="form-group"> 
                                                                                        <input type="text" class="form-control border-dark" style="color: black;" name="content_title" required="" value="<?php echo $image_title0; ?>" placeholder="Enter Image Title">
                                                                                    </div> 

                                                                                    <!-- Email Address -->
                                                                                    <label>Image Description:</label>
                                                                                    <div class="form-group">
                                                                                        <textarea class="form-control border-dark" style="color: black;" name="content_description" placeholder="Enter Image Description"><?php echo $image_title1; ?></textarea> 
                                                                                    </div> 
                                                                                    <label>Category:</label>
                                                                                    <div class="form-group">
                                                                                        <select class="form-control border-dark" style="color: black;" name="list_category" required>
                                                                                            <option value="<?php echo $image_title2; ?>"><?php echo $image_title2; ?></option>
                                                                                            <option value="Services">Services</option>
                                                                                            <option value="Why Choose Us">Why Choose Us</option>
                                                                                            <option value="Knowledge Base">Knowledge Base</option>
                                                                                        </select> 
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

                                                            <div class="modal fade text-left" id="deleteNewListing<?php echo $image_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNewListing<?php echo $image_id; ?>" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelNewListing<?php echo $image_id; ?>">Services / Why Choose Us</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <form action="quill-photos" method="POST">
                                                                               <div class="modal-body">
                                                                                       
                                                                                    <div class="form-group"> 
                                                                                       <center><img class="card-img-top img-fluid" src="../assets/uploads/listing/<?php echo $image_path; ?>" alt="Gallery"></center>
                                                                                       <input type="hidden" name="deleteImageListing" value="1">
                                                                                       <input type="hidden" name="content_id" value="<?php echo $image_id; ?>">
                                                                                        <input type="hidden" name="content_value" value="<?php echo $image_path; ?>">
                                                                                    </div>
                                                                                   
                                                                                        <!-- Email Address -->
                                                                                    <h4><?php echo $image_title0; ?></h4> 
                                                                            
                                                                                    <!-- User Role -->
                                                                                    <p><?php echo $image_title1; ?></p> 
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input type="reset" class="btn btn-outline-secondary btn-lg"data-dismiss="modal" value="Close">
                                                                                    <input type="submit" class="btn btn-outline-danger btn-lg" value="Delete Info">
                                                                                </div>
                                                                            </form> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php }} ?>
                                                        </div>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </section>
                <!-- Tabs with Icons end -->

                                                     
                                                    
                                                
                                                    <div class="row"> 
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <a data-toggle="modal" data-target="#addNewListing" class="btn btn-outline-danger">New Info</a>

                                                            <div class="modal fade text-left" id="addNewListing" tabindex="-1" role="dialog" aria-labelledby="myModalLabelAddNewListing" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabelAddNewListing">Services / Why Choose Us / Knowledge Base</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> 
                                                                            <form action="quill-photos" enctype="multipart/form-data" method="POST">
                                                                                    <div class="modal-body">
                                                                                        <label for="basicInputFile">Upload New Image</label>
                                                                                        <div class="form-group">  
                                                                                            <div class="custom-file">
                                                                                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="gallery_image" required>
                                                                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                                            </div>  
                                                                                        </div>
                                                                                    
                                                                                        <label>Title:</label>
                                                                                        <div class="form-group"> 
                                                                                            <input type="text" class="form-control border-dark" style="color: black;" name="gallery_title" required="" placeholder="Enter Image Title">
                                                                                            <input type="hidden" name="addNewImageListing" value="1">
                                                                                        </div> 
 
                                                                                        <label>Description:</label>
                                                                                        <div class="form-group">
                                                                                            <textarea class="form-control border-dark" style="color: black;" name="gallery_description" placeholder="Enter Image Description"></textarea> 
                                                                                        </div>

                                                                                        <label>Category:</label>
                                                                                        <div class="form-group">
                                                                                            <select class="form-control border-dark" name="list_category" required style="color: black;">
                                                                                                <option value="">Select Category</option>
                                                                                                <option value="Services">Services</option>
                                                                                                <option value="Why Choose Us">Why Choose Us</option>
                                                                                                <option value="Knowledge Base">Knowledge Base</option>
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
<!-- GALLERY PAGE-->
<div role="tabpanel" class="tab-pane" id="account-vertical-testimonials" aria-labelledby="account-pill-testimonials" aria-expanded="false">

    <!-- GALLERY IMAGES -->
    <h4 class="form-section"><i class="fa fa-media"></i> TESTIMONIALS</h4>

    <div class="row">
        <?php
        // 1. SELECT Query for Testimonials
        $sql = "SELECT * FROM quill_testimonials
                ORDER BY id DESC"; // Ordering by ID descending to show newest first
    
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
                        // Map Testimonial columns to PHP variables
                        $testimonial_id = htmlspecialchars($row['id']);
                        $t_full_name = htmlspecialchars($row['testimonial_full_name']);
                        $t_profession = htmlspecialchars($row['testimonial_profession']);
                        $t_content = htmlspecialchars($row['testimonial_content']);
                        $t_rating = (int)$row['testimonial_rating']; // Cast to integer
                        $t_image_path = htmlspecialchars($row['testimonial_image']);
                        
                        // Fallback for image path in case it's stored relative to the root, or is empty
                        $display_image_path = !empty($t_image_path) ? $t_image_path : 'https://placehold.co/400x300/CCCCCC/000000?text=No+Image';
                ?> 
    
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <?php if (!empty($t_image_path)): ?>
                            <img class="card-img-top img-fluid" src="../assets/uploads/testimonials/<?php echo $display_image_path; ?>" alt="<?php echo $t_full_name; ?>'s Photo">
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center bg-light-secondary" style="height: 200px; font-size: 1.5rem; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                                No Image Provided
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <!-- Rating Stars -->
                            <div class="d-flex mb-2">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php if ($i <= $t_rating): ?>
                                        <i class="feather icon-star text-warning" style="font-size: 1.2rem;"></i>
                                    <?php else: ?>
                                        <i class="feather icon-star text-light" style="font-size: 1.2rem;"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <span class="ml-1 text-muted">(<?php echo $t_rating; ?>/5)</span>
                            </div>

                            <h4 class="card-title"><?php echo $t_full_name; ?></h4>
                            <p class="card-text text-muted mb-2"><?php echo $t_profession; ?></p>
                            
                            <!-- Display a snippet of the testimonial -->
                            <p class="card-text" style="text-justify: ;"><?php echo substr($t_content, 0, 500) . (strlen($t_content) > 500 ? '...' : ''); ?></p>
                            
                            <a data-toggle="modal" data-target="#manageTst<?php echo $testimonial_id; ?>" class="btn btn-outline-secondary">Manage</a>
                            <a data-toggle="modal" data-target="#deleteTst<?php echo $testimonial_id; ?>" class="btn btn-outline-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- MANAGE/UPDATE MODAL -->
            <div class="modal fade text-left" id="manageTst<?php echo $testimonial_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelManageTst<?php echo $testimonial_id; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabelManageTst<?php echo $testimonial_id; ?>">Manage Testimonial</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"> 
                            <!-- NOTE: You will need to create the PHP logic for 'ThisUpdateTst' flag -->
                            <form action="quill-photos" enctype="multipart/form-data" method="POST">
                               <div class="modal-body">

                                    <div class="form-group"> 
                                        <center>
                                            <img class="card-img-top img-fluid w-50" src="../assets/uploads/testimonials/<?php echo $display_image_path; ?>" alt="<?php echo $t_full_name; ?>'s Photo">
                                        </center>
                                        <input type="hidden" name="ThisUpdateTst" value="1">
                                        <input type="hidden" name="testimonial_id" value="<?php echo $testimonial_id; ?>">
                                        <input type="hidden" name="current_image_path" value="<?php echo $t_image_path; ?>">
                                    </div>
                                    
                                    <!-- New Image Upload (Optional) -->
                                    <label for="newImageUpload">Upload New Image (Replaces Current)</label>
                                    <div class="form-group">  
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="newImageUpload" name="testimonial_image_new">
                                            <label class="custom-file-label" for="newImageUpload">Choose file</label>
                                        </div>  
                                    </div>

                                    <!-- Full Name -->
                                    <label>Full Name:</label>
                                    <div class="form-group"> 
                                        <input type="text" class="form-control border-dark" style="color: black;" name="testimonial_full_name" required="" value="<?php echo $t_full_name; ?>" placeholder="Enter Full Name">
                                    </div> 

                                    <!-- Profession -->
                                    <label>Profession / Title:</label>
                                    <div class="form-group"> 
                                        <input type="text" class="form-control border-dark" style="color: black;" name="testimonial_profession" value="<?php echo $t_profession; ?>" placeholder="e.g., CEO, Happy Customer">
                                    </div>
                                    
                                    <!-- Rating -->
                                    <label>Rating (1-5):</label>
                                    <div class="form-group"> 
                                        <input type="number" class="form-control border-dark" style="color: black;" name="testimonial_rating" value="<?php echo $t_rating; ?>" min="1" max="5" required>
                                    </div>

                                    <!-- Testimonial Content -->
                                    <label>Testimonial Content:</label>
                                    <div class="form-group">
                                        <textarea class="form-control border-dark" style="color: black;" name="testimonial_content" placeholder="Enter the full testimonial content" rows="5" required><?php echo $t_content; ?></textarea> 
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
            <div class="modal fade text-left" id="deleteTst<?php echo $testimonial_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDeleteTst<?php echo $testimonial_id; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabelDeleteTst<?php echo $testimonial_id; ?>">Delete Testimonial</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"> 
                            <!-- NOTE: You will need to create the PHP logic for 'DeleteTestimonial' flag -->
                            <form action="quill-photos" method="POST">
                               <div class="modal-body">
                                    
                                    <div class="form-group"> 
                                        <center>
                                            <img class="card-img-top img-fluid w-50" src="../assets/uploads/testimonials/<?php echo $display_image_path; ?>" alt="<?php echo $t_full_name; ?>'s Photo">
                                        </center>
                                        <input type="hidden" name="DeleteTestimonial" value="1">
                                        <input type="hidden" name="testimonial_id" value="<?php echo $testimonial_id; ?>">
                                        <input type="hidden" name="testimonial_image_path" value="<?php echo $t_image_path; ?>">
                                    </div>
                                    
                                    <h4>Are you sure you want to delete the testimonial from: <?php echo $t_full_name; ?>?</h4> 
                                    <p class="text-danger">This action cannot be undone.</p>
                                    
                                    <p>Profession: <?php echo $t_profession; ?></p>
                                    <p>Rating: <?php echo $t_rating; ?>/5</p>

                               </div>
                               <div class="modal-footer">
                                    <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                    <input type="submit" class="btn btn-outline-danger btn-lg" value="Yes, Delete">
                               </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
            <?php }} else { ?>
                <div class="col-12">
                    <p class="text-center text-muted">No testimonials found. Add a new one to get started!</p>
                </div>
            <?php } ?>
        </div>   
    </div>
</div>
        
        
    
    <div class="row"> 
        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
            <a data-toggle="modal" data-target="#NewTestimonial" class="btn btn-outline-success">New Testimonial</a>
    
            <div class="modal fade text-left" id="NewTestimonial" tabindex="-1" role="dialog" aria-labelledby="myModalLabelTestimonial" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabelTestimonial">Testimonial Management</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"> 
                            <form action="quill-photos" enctype="multipart/form-data" method="POST">
                                <div class="modal-body">
                                    
                                    <!-- Testimonial Image (Photo of the person) -->
                                    <label for="basicInputFile">Upload Person's Image (Optional)</label>
                                    <div class="form-group">  
                                        <div class="custom-file">
                                            <!-- Field name changed to match column: testimonial_image -->
                                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="testimonial_image">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>  
                                    </div>
                                    
                                    <!-- Full Name -->
                                    <label>Full Name:</label>
                                    <div class="form-group"> 
                                        <!-- Field name changed to match column: testimonial_full_name -->
                                        <input type="text" class="form-control border-dark" style="color: black;" name="testimonial_full_name" required="" placeholder="Enter Full Name">
                                        <input type="hidden" name="addNewTestimonial" value="1">
                                    </div> 
                                    
                                    <!-- Profession / Company -->
                                    <label>Profession / Title:</label>
                                    <div class="form-group"> 
                                        <!-- New field for profession/title: testimonial_profession -->
                                        <input type="text" class="form-control border-dark" style="color: black;" name="testimonial_profession" placeholder="e.g., CEO, Happy Customer, Marketing Manager">
                                    </div>
    
                                    <!-- Rating -->
                                    <label>Rating (1-5):</label>
                                    <div class="form-group"> 
                                        <!-- New field for rating: testimonial_rating -->
                                        <input type="number" class="form-control border-dark" style="color: black;" name="testimonial_rating" value="5" min="1" max="5" required>
                                    </div>
    
                                    <!-- Testimonial Content -->
                                    <label>Testimonial Content:</label>
                                    <div class="form-group">
                                        <!-- Field name changed to match column: testimonial_content -->
                                        <textarea class="form-control border-dark" style="color: black;" name="testimonial_content" placeholder="Enter the full testimonial content" rows="5" required></textarea> 
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
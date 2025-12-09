<div role="tabpanel" class="tab-pane" id="account-vertical-gallery" aria-labelledby="account-pill-gallery" aria-expanded="false">

    <!-- GALLERY IMAGES -->
 
     
        <h4 class="form-section"><i class="fa fa-media"></i> GALLERY IMAGES</h4> 

        <div class="row">
            <?php
         
            $sql = "SELECT * 
                    FROM quill_gallery
                    ORDER BY id ASC";
        
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
                                $image_path = htmlspecialchars($row['gallery_image']);
                    ?> 
                    
                    <div class="col-xl-4 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <img class="card-img-top img-fluid" src="../assets/uploads/gallery/<?php echo $image_path; ?>" alt="Gallery">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $image_title0; ?></h4>
                                    <p class="card-text"><?php echo $image_title1; ?></p>
                                    <a data-toggle="modal" data-target="#defaultNewIma<?php echo $image_id; ?>" class="btn btn-outline-secondary">Manage</a>
                                    <a data-toggle="modal" data-target="#deleteNew<?php echo $image_id; ?>" class="btn btn-outline-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="modal fade text-left" id="defaultNewIma<?php echo $image_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNewIma<?php echo $image_id; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabelNewIma<?php echo $image_id; ?>">Image Management</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"> 
                                    <form action="quill-photos" enctype="multipart/form-data" method="POST">
                                       <div class="modal-body">

                                           <div class="form-group"> 
   <center><img class="card-img-top img-fluid" src="../assets/uploads/gallery/<?php echo $image_path; ?>" alt="Gallery"></center>
   <input type="hidden" name="ThisUpdate" value="1">
   <input type="hidden" name="content_id" value="<?php echo $image_id; ?>">
</div>
                                       
<!-- Email Address -->
<label>Image Title:</label>
<div class="form-group"> 
    <input type="text" class="form-control border-dark" style="color: darkgrey;" name="content_title" required="" value="<?php echo $image_title0; ?>" placeholder="Enter Image Title">
</div> 

<!-- Email Address -->
<label>Image Description:</label>
<div class="form-group">
    <textarea class="form-control border-dark" style="color: darkgrey;" name="content_description" placeholder="Enter Image Description"><?php echo $image_title1; ?></textarea> 
</div>  
       
                                        </div>
                                        <div class="modal-footer">
<input type="reset" class="border-dark btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
<input type="submit" class="border-dark btn btn-outline-primary btn-lg" value="Update Info">
                                        </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade text-left" id="deleteNew<?php echo $image_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNewDelete<?php echo $image_id; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabelNewDelete<?php echo $image_id; ?>">Image Management</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"> 
                                    <form action="quill-photos" method="POST">
                                       <div class="modal-body">
                                           
<div class="form-group"> 
   <center><img class="card-img-top img-fluid" src="../assets/uploads/gallery/<?php echo $image_path; ?>" alt="Gallery"></center>
   <input type="hidden" name="deleteImage" value="1">
   <input type="hidden" name="content_id" value="<?php echo $image_id; ?>">
   <input type="hidden" name="content_value" value="<?php echo $image_path; ?>">
</div>
                                       
<!-- Email Address -->
<h4><?php echo $image_title0; ?></h4> 
                                
<!-- User Role -->
<p><?php echo $image_title1; ?></p> 
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
                    <?php }} ?>
                </div>    
            </div>
        </div> 
        
    
        <div class="row"> 
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                <a data-toggle="modal" data-target="#addNew" class="btn btn-outline-danger">Upload New Image</a>

                <div class="modal fade text-left" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabelAddNew" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabelAddNew">Image Management</h4>
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
                                       
<!-- Email Address -->
<label>Image Title:</label>
<div class="form-group"> 
    <input type="text" class="form-control" name="gallery_title" required="" placeholder="Enter Image Title">
    <input type="hidden" name="addNewImage" value="1">
</div> 

<!-- Email Address -->
<label>Image Description:</label>
<div class="form-group">
    <textarea class="form-control" name="gallery_description" placeholder="Enter Image Description"></textarea> 
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
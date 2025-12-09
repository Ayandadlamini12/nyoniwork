<div class="tab-pane fade " id="account-vertical-about" role="tabpanel" aria-labelledby="account-pill-about" aria-expanded="false">

                                                <h4 class="form-section"><i class="fa fa-media"></i> ABOUT SECTION</h4>
                                                <div class="row match-height">
                                                    <?php 
                                                    
                                                        $image_base_path = '../assets/uploads/about/';
                                                         
                                                        $sql = "SELECT * FROM quill_about ORDER BY id ASC LIMIT 1";
                                                        $result = $conn->query($sql);
                                                        
                                                        $about_data = null;
                                                        if ($result && $result->num_rows > 0) {
                                                            $about_data = $result->fetch_assoc();
                                                        }
                                                        
                                                        // Helper function to safely output text with HTML escaping
                                                        function safe_output($text) {
                                                            return htmlspecialchars($text ?? '');
                                                        }
                                                        
                                                        // Only display the structure if data was retrieved
                                                        if ($about_data):
                                                            // Construct the full image URL path if an image exists, otherwise use a placeholder
                                                            $image_url = !empty($about_data['about_image']) 
                                                                ? $image_base_path . safe_output($about_data['about_image']) 
                                                                : 'https://placehold.co/190x190/eeeeee/333333?text=Placeholder+Image';
                                                    ?>
                                                    
                                                    <!-- Outer container based on user's template (col-md-12) -->
                                                    <div class="col-md-12 col-sm-12">
                                                        
                                                        <!-- Main About Content Section (Title, Description, Image) -->
                                                        <div class="card border-primary bg-transparent mb-1">
                                                            <div class="card-content">
                                                                <div class="card-body pt-3"> 

                                                                    <!-- Image Section - Using float-left for layout -->
                                                                    <img 
                                                                        src="<?php echo $image_url; ?>" 
                                                                        alt="<?php echo safe_output($about_data['about_title']); ?> Image" 
                                                                        width="190" 
                                                                        class="float-left mr-3 mb-0"
                                                                        style="max-width: 100%; height: auto;"
                                                                    >
                                                                    
                                                                    <!-- Title and Subtitle -->
                                                                    <h2 class="card-title mt-3"><?php echo safe_output($about_data['about_title']); ?></h2>
                                                                    
                                                                    <?php if (!empty($about_data['about_subtitle'])): ?>
                                                                        <h3 class="card-subtitle text-muted mb-1"><?php echo safe_output($about_data['about_subtitle']); ?></h3>
                                                                    <?php endif; ?>
                                                    
                                                                    <!-- Main Description -->
                                                                    <div class="card-text text-left clearfix">
                                                                        <p><?php echo nl2br(safe_output($about_data['about_description'])); ?></p>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Separate section to display the three feature heads and statements -->
                                                        <div class="row mt-1">
                                                            
                                                            <?php 
                                                            // Loop through the three sections (head1/statement1, head2/statement2, etc.)
                                                            for ($i = 1; $i <= 3; $i++): 
                                                                $head = $about_data['about_head' . $i] ?? '';
                                                                $statement = $about_data['about_statement' . $i] ?? '';
                                                                
                                                                // Only display the column if the section has content
                                                                if (!empty($head) || !empty($statement)):
                                                            ?>
                                                                <div class="col-md-4 mb-0">
                                                                    <div class="card shadow-sm h-100">
                                                                        <div class="card-body">
                                                                            <?php if (!empty($head)): ?>
                                                                                <h5 class="text-primary mb-0"><?php echo safe_output($head); ?></h5>
                                                                            <?php endif; ?>
                                                                            
                                                                            <?php if (!empty($statement)): ?>
                                                                                <p class="card-text text-justify">
                                                                                    <?php echo nl2br(safe_output($statement)); ?>
                                                                                </p>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php 
                                                                endif;
                                                            endfor; 
                                                            ?>
                                                            <div class="col-md-12">
                                                                <a data-toggle="modal" data-target="#UpdateAbout<?php echo safe_output($about_data['id']); ?>" class="btn btn-outline-secondary">Update Info</a> 
                                                                 
                                                                <div class="modal fade text-left" id="UpdateAbout<?php echo safe_output($about_data['id']); ?>" tabindex="-1" role="dialog" aria-labelledby=" myModalUpdateAbout" aria-hidden="true">
                                                                    <div class="modal-dialog modal-md" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header bg-primary text-white">
                                                                                <h4 class="modal-title" id="myModalUpdateAbout">About Content</h4>
                                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body"> 
                                                                                 
                                                                                <form action="quill-photos" enctype="multipart/form-data" method="POST">
                                                                                     
                                                                                    <input type="hidden" name="UpdateAbout" value="1"> 
                                                                                    <input type="hidden" name="about_id" value="<?php echo htmlspecialchars($about_data['id'] ?? 1); ?>"> 
                                                                                    <input type="hidden" name="about_old_image" value="<?php echo htmlspecialchars($about_data['about_image'] ?? ''); ?>">
                                                                
                                                                                     
                                                                
                                                                                    <h5 class="text-primary mb-1 mt-2">1. Main Page Information</h5>
                                                                
                                                                                    <label for="aboutTitle">Title:</label>
                                                                                    <div class="form-group"> 
                                                                                        <input type="text" class="form-control border-dark" style="color: darkgrey;" id="aboutTitle" name="about_title" required placeholder="Enter Main Title" value="<?php echo htmlspecialchars($about_data['about_title'] ?? ''); ?>">
                                                                                    </div>
                                                                                    
                                                                                    <label for="aboutSubtitle">Subtitle:</label>
                                                                                    <div class="form-group"> 
                                                                                        <input type="text" class="form-control border-dark" style="color: darkgrey;" id="aboutSubtitle" name="about_subtitle" placeholder="Enter Subtitle" value="<?php echo htmlspecialchars($about_data['about_subtitle'] ?? ''); ?>"> 
                                                                                    </div>
                                                                
                                                                                    <label for="aboutDescription">Description:</label>
                                                                                    <div class="form-group">
                                                                                        <textarea class="form-control border-dark" style="color: darkgrey;" id="aboutDescription" name="about_description" placeholder="Enter Main Description" rows="6"><?php echo htmlspecialchars($about_data['about_description'] ?? ''); ?></textarea> 
                                                                                    </div>
                                                                
                                                                                    <!-- Image Upload -->
                                                                                    <label for="aboutImageUpload">
                                                                                        Upload New Image <b class="text-danger">Leave Blank if Not Changing Current Image</b>
                                                                                    </label>
                                                                                    <div class="form-group"> 
                                                                                        <div class="custom-file">
                                                                                            <input type="file" class="custom-file-input" id="aboutImageUpload" name="about_image">
                                                                                            <label class="custom-file-label" for="aboutImageUpload">Choose file</label>
                                                                                        </div> 
                                                                                        <small class="form-text text-muted mt-2">Current Image: 
                                                                                            <?php echo !empty($about_data['about_image']) ? htmlspecialchars($about_data['about_image']) : 'None'; ?>
                                                                                        </small>
                                                                                    </div> 
                                                                                    
                                                                                    <?php 
                                                                                    // Loop through the three sections to generate input fields
                                                                                    for ($i = 1; $i <= 3; $i++): 
                                                                                    ?>
                                                                                        <h5 class="text-primary mb-1 mt-1">2. Feature Section <?php echo $i; ?></h5>
                                                                                        
                                                                                        <label for="aboutHead<?php echo $i; ?>">Heading <?php echo $i; ?>:</label>
                                                                                        <div class="form-group"> 
                                                                                            <input type="text" class="form-control border-dark" style="color: darkgrey;" id="aboutHead<?php echo $i; ?>" name="about_head<?php echo $i; ?>" placeholder="Enter Heading <?php echo $i; ?>" value="<?php echo htmlspecialchars($about_data['about_head' . $i] ?? ''); ?>">
                                                                                        </div>
                                                                                        
                                                                                        <label for="aboutStatement<?php echo $i; ?>">Statement/Content <?php echo $i; ?>:</label>
                                                                                        <div class="form-group"> 
                                                                                            <textarea class="form-control border-dark" style="color: darkgrey;" id="aboutStatement<?php echo $i; ?>" name="about_statement<?php echo $i; ?>" placeholder="Enter Content <?php echo $i; ?>" rows="4"><?php echo htmlspecialchars($about_data['about_statement'. $i] ?? ''); ?></textarea>
                                                                                        </div>
                                                                                    <?php 
                                                                                    endfor; 
                                                                                    ?> 
                                                                                    <div class="modal-footer">
                                                                                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                                                                        <input type="submit" class="btn btn-primary btn-lg" value="Update Content">
                                                                                    </div>
                                                                                </form> 
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    
                                                    </div>
                                                    
                                                    <?php else: ?>
                                                        <!-- Fallback if no data is present in the table -->
                                                        <div class="col-md-12">
                                                            <p class="alert alert-warning text-center">About page content has not been set in the CMS yet.</p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div> 
                                            </div>
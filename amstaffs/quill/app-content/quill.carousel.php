<div role="tabpanel" class="tab-pane" id="account-vertical-carousel" aria-labelledby="account-pill-carousel" aria-expanded="false">
 
                                                 
                                                    <h4 class="form-section"><i class="fa fa-media"></i> CAROUSEL IMAGES</h4>

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
                                                                                                                <input type="text" class="form-control border-dark" style="color: darkgrey;" name="carousel_title" required="" placeholder="Enter Title" value="<?php echo htmlspecialchars($slide['carousel_title']); ?>">
                                                                                                                <input type="hidden" name="UpdateCarousel" value="1">
                                                                                                                <input type="hidden" name="carousel_id" value="<?php echo htmlspecialchars($slide['id']); ?>">
                                                                                                            </div>
 
                                                                                                            <label>Carousel Sub-Title:</label>
                                                                                                            <div class="form-group"> 
                                                                                                                <input type="text" class="form-control border-dark" style="color: darkgrey;" name="carousel_subtitle" required="" placeholder="Enter Subtitle" value="<?php echo htmlspecialchars($slide['carousel_subtitle']); ?>"> 
                                                                                                            </div>  

                                                                                       
                                                                                                            <label>Carosel Description:</label>
                                                                                                            <div class="form-group">
                                                                                                                <textarea class="form-control border-dark" style="color: darkgrey;" name="carousel_description" placeholder="Enter Description" rows="4"><?php echo htmlspecialchars($slide['carousel_description']); ?></textarea> 
                                                                                                            </div>

                                                                                                            <label>Carousel Position:</label>
                                                                                                            <div class="form-group"> 
                                                                                                                <input type="text" class="form-control border-dark" style="color: darkgrey;" name="carousel_position" readonly value="Position <?php echo htmlspecialchars($slide['carousel_position']); ?>">
                                                                                                                <input type="hidden" class="form-control border-dark" style="color: darkgrey;" name="carousel_old_image" required="" value="<?php echo htmlspecialchars($slide['carousel_image']); ?>"> 
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
                                                                                                                <input type="hidden" class="form-control border-dark" style="color: darkgrey;" name="carousel_old_image" required="" value="<?php echo htmlspecialchars($slide['carousel_image']); ?>"> 
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
                                                
                                                    <div class="row"> 
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <a data-toggle="modal" data-target="#addNewCarousel" class="btn btn-outline-danger">New Carousel Info</a>

                                                            <div class="modal fade text-left" id="addNewCarousel" tabindex="-1" role="dialog" aria-labelledby="myModalNewCarousel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalNewCarousel">Carousel Management</h4>
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
                                                                                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="carousel_image" required>
                                                                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                                            </div> 
                                                                                        </div>
                                                                                    
                                                                                        <label>Carousel Title:</label>
                                                                                        <div class="form-group"> 
                                                                                            <input type="text" class="form-control border-dark" style="color: darkgrey;" name="carousel_title" required="" placeholder="Enter Title">
                                                                                            <input type="hidden" name="addNewCarousel" value="1">
                                                                                        </div>
 
                                                                                        <label>Carousel Sub-Title:</label>
                                                                                        <div class="form-group"> 
                                                                                            <input type="text" class="form-control border-dark" style="color: darkgrey;" name="carousel_subtitle" required="" placeholder="Enter Subtitle">
                                                                                            <input type="hidden" name="addNewCarousel" value="1">
                                                                                        </div>  

                                                                                       
                                                                                        <label>Carosel Description:</label>
                                                                                        <div class="form-group">
                                                                                            <textarea class="form-control border-dark" style="color: darkgrey;" name="carousel_description" placeholder="Enter Description"></textarea> 
                                                                                        </div>

                                                                                        <?php 

                                                                                            $max_positions = 4; 
                                                                                            $all_positions = range(1, $max_positions); 
                                                                                            $sql_used = "SELECT carousel_position FROM quill_carousel";
                                                                                            $result_used = $conn->query($sql_used);
                                                                                            
                                                                                            $used_positions = [];
                                                                                            if ($result_used && $result_used->num_rows > 0) {
                                                                                                while ($row = $result_used->fetch_assoc()) { 
                                                                                                    $used_positions[] = (int) $row['carousel_position'];
                                                                                                }
                                                                                            }
                                                                                             
                                                                                            $available_positions = array_diff($all_positions, $used_positions);
                                                                                             
                                                                                            $position_names = [
                                                                                                1 => 'Start',
                                                                                                2 => 'Second',
                                                                                                3 => 'Third',
                                                                                                4 => 'Last',
                                                                                            ];
                                                                                             
                                                                                            $has_available_position = !empty($available_positions);
                                                                                            
                                                                                            ?>
                                                                                            
                                                                                            <label>Carousel Position:</label>
                                                                                            <div class="form-group">
                                                                                                <select class="form-control border-dark" style="color: darkgrey;" name="carousel_position" required <?php echo $has_available_position ? '' : 'disabled'; ?>>
                                                                                                    
                                                                                                    <?php if ($has_available_position): ?>
                                                                                                        <option value="">Select Position</option>
                                                                                            
                                                                                                        <?php 
                                                                                                        foreach ($available_positions as $position): 
                                                                                                            $name = $position_names[$position] ?? "Position " . $position;
                                                                                                        ?>
                                                                                                            <option value="<?php echo $position; ?>">
                                                                                                                <?php echo htmlspecialchars($name); ?>
                                                                                                            </option>
                                                                                                        <?php endforeach; ?>
                                                                                            
                                                                                                    <?php else: ?>
                                                                                                        <option value="" selected>No position for new carousel</option>
                                                                                                    <?php endif; ?>
                                                                                            
                                                                                                </select>
                                                                                                <?php if (!$has_available_position): ?>
                                                                                                    <small class="form-text text-danger">All 4 carousel positions are currently full. Please edit or delete an existing slide to free up a slot.</small>
                                                                                                <?php endif; ?>
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
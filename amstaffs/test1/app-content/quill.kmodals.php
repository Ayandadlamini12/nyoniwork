<?php
 
    $dog_id = $row['id'];
    $dog_name = htmlspecialchars($row['dog_name']);
    $dog_info = nl2br(htmlspecialchars($row['dog_information']));
    $dog_status = htmlspecialchars($row['status']);
     
    $sql_gallery = "SELECT dog_image_path FROM quill_dog_gallery WHERE dog_id = ?";
    $stmt_gallery = $conn->prepare($sql_gallery);
    
    if ($stmt_gallery === false) {
        // Handle SQL preparation error if necessary
        $gallery_images = [];
    } else {
        $stmt_gallery->bind_param("i", $dog_id);
        $stmt_gallery->execute();
        $result_gallery = $stmt_gallery->get_result();
        
        // Fetch all results into an associative array
        $gallery_images = $result_gallery->fetch_all(MYSQLI_ASSOC); 
        $stmt_gallery->close();
    }
    
    $total_images = count($gallery_images);
     
    $carousel_id = "dogCarousel" . $dog_id; 
?>

<div class="modal fade text-left" id="viewDog<?php echo $dog_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelViewDog<?php echo $dog_id; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-uppercase" id="myModalLabelViewDog<?php echo $dog_id; ?>">DOG DETAILS: <?php echo $dog_name; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="mb-1 p-2 rounded shadow-sm">
                    <h5 class="text-primary text-uppercase"><?php echo $dog_name; ?></h5>
                    <p class="card-text text-dark mb-1"><?php echo $dog_info; ?></p>
                    <h5 class="text-primary text-uppercase">VISIBLE ON SITE?: <b class="text-dark text-uppercase"><?php echo $dog_status; ?></b></h5> 
                </div>
                
                <hr class="mb-1">

                <h5 class="text-primary text-uppercase mb-1">Gallery (<?php echo $total_images; ?> images)</h5>

                <?php if ($total_images > 0) : ?>

                    <div id="<?php echo $carousel_id; ?>" class="carousel slide mb-1" data-ride="carousel" data-interval="false">
                        <div class="carousel-inner border rounded">
                            
                            <?php foreach ($gallery_images as $index => $image): 
                                $image_path = htmlspecialchars($image['dog_image_path']);
                                $image_label = $dog_name . " Gallery Image " . ($index + 1); 
                            ?>
                                <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                                    <img class="d-block w-100" src="../assets/uploads/dogs/<?php echo $image_path; ?>" alt="<?php echo $image_label; ?>" style="max-height: 500px; object-fit: cover;">
                                    <div class="carousel-caption d-none d-md-block bg-dark opacity-75 p-1 rounded">
                                        <p class="mb-0 small text-white text-uppercase"><?php echo $image_label; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            
                        </div>
                        
                        <?php if ($total_images > 1): ?>
                            <a class="carousel-control-prev" href="#<?php echo $carousel_id; ?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#<?php echo $carousel_id; ?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="row px-1">
                        <?php foreach ($gallery_images as $index => $image):
                            $image_path = htmlspecialchars($image['dog_image_path']);
                        ?>
                            <div class="col-2 col-md-2 mb-2">
                                <a data-target="#<?php echo $carousel_id; ?>" data-slide-to="<?php echo $index; ?>" 
                                   class="d-block rounded overflow-hidden shadow-sm p-0 transition-ease 
                                          <?php echo ($index === 0) ? 'border border-3 border-info' : 'border border-1 border-light'; ?>"
                                   style="cursor: pointer; transform: scale(<?php echo ($index === 0) ? '1.05' : '1'; ?>);">
                                    
                                    <img class="img-fluid w-100" 
                                         src="../assets/uploads/dogs/<?php echo $image_path; ?>" 
                                         alt="Thumbnail <?php echo $index + 1; ?>" 
                                         style="height: 60px; object-fit: cover;">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <style>
                        /* Optional: Add custom CSS to highlight and smooth transitions */
                        .transition-ease {
                            transition: all 0.2s ease-in-out;
                        }
                        .transition-ease:hover {
                            transform: scale(1.05);
                            opacity: 0.9;
                        }
                        .border-info {
                            border-color: #17a2b8 !important; /* Example Bootstrap Info color */
                        }
                    </style>

                <?php else : ?>
                    <div class="alert alert-warning" role="alert">
                        No gallery images found for <?php echo $dog_name; ?>.
                    </div>
                <?php endif; ?>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark btn-lg" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php
    // =========================================================================
    // PHP LOGIC: DATA FETCHING (UPDATED TO INCLUDE IMAGE ID)
    // =========================================================================
    
    // Assuming $row contains the data for the current dog from the quill_dogs table.
    $dog_id = $row['id'];
    $dog_name = htmlspecialchars($row['dog_name']);
    // We don't need $dog_info or $dog_status for this management modal, but keep for variable definition.
    $dog_info = nl2br(htmlspecialchars($row['dog_information']));
    $dog_status = htmlspecialchars($row['status']);
    $dog_is = htmlspecialchars($row['dog_is']);
    
    // --- 1. Query the Gallery Images for the current Dog ---
    // **CRITICAL UPDATE**: Fetch the image's unique ID for the delete button.
    $sql_gallery = "SELECT id, dog_image_path FROM quill_dog_gallery WHERE dog_id = ?";
    $stmt_gallery = $conn->prepare($sql_gallery);
    
    if ($stmt_gallery === false) {
        $gallery_images = [];
    } else {
        $stmt_gallery->bind_param("i", $dog_id);
        $stmt_gallery->execute();
        $result_gallery = $stmt_gallery->get_result();
        
        // Fetch all results into an associative array (now includes 'id' and 'dog_image_path')
        $gallery_images = $result_gallery->fetch_all(MYSQLI_ASSOC); 
        $stmt_gallery->close();
    }
    
    $total_images = count($gallery_images);
    // No need for $carousel_id in this delete modal.
?>

<div class="modal fade text-left" id="deleteDogGallery<?php echo $dog_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDeleteDogGallery<?php echo $dog_id; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h4 class="modal-title text-uppercase" id="myModalLabelDeleteDogGallery<?php echo $dog_id; ?>">🗑️ Manage Gallery for: <?php echo $dog_name; ?></h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                
                <h5 class="text-secondary mb-3">Total Images: <b class="text-danger"><?php echo $total_images; ?></b></h5>

                <?php if ($total_images > 0) : ?>

                    <div class="row">
                        <?php foreach ($gallery_images as $index => $image):
                            $image_id = htmlspecialchars($image['id']); // Image ID for deletion
                            $image_path = htmlspecialchars($image['dog_image_path']);
                        ?>
                        <div class="col-4 col-md-3 mb-4 image-grid-item">
                            <div class="card p-0 shadow-lg position-relative overflow-hidden rounded-lg gallery-card">
                                <img class="card-img-top w-100" src="../assets/uploads/dogs/<?php echo $image_path; ?>" alt="Image<?php echo $image_id; ?>" style="height: 140px; object-fit: cover;">
                
                                <a href="quill-one?id=<?php echo $image_id; ?>&image_name=<?php echo $image_path; ?>" class="btn btn-danger btn-sm p-2 delete-image-btn delete-btn-overlay" data-image-id="<?php echo $image_id; ?>" data-dog-name="<?php echo $dog_name; ?>"title="Delete Image">
                                    <i class="fa fa-trash"></i>
                                </a>

                                <div class="p-1 bg-dark text-center small text-white-50 text-italic">
                                    <?php echo $dog_name; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div> 

                <?php else : ?>
                    <div class="alert alert-info" role="alert">
                        No images found in the gallery for <?php echo $dog_name; ?>.
                    </div>
                <?php endif; ?> 
            </div>
            
            <div class="modal-footer">
                <a href="quill-all?id=<?php echo $dog_id; ?>" class="btn btn-outline-danger"> Delete All</a>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    /* 1. Ensure the card container is ready for custom styles */
    .gallery-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid #e0e0e0; /* Subtle light border */
    }
    .gallery-card:hover {
        transform: translateY(-3px); /* Lift effect */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; /* Stronger, softer shadow on hover */
    }
    .rounded-lg {
        border-radius: 0.5rem !important; /* Larger corner radius than default Bootstrap */
    }
    
    /* 2. Styling the Delete Button Overlay */
    .delete-btn-overlay {
        position: absolute; 
        top: 5px; /* Spacing from the top */
        right: 5px; /* Spacing from the right */
        border-radius: 50%; /* Make it a circular button */
        padding: 0.5rem; /* Larger touch target */
        opacity: 0.7; /* Slightly transparent when inactive */
        transition: opacity 0.2s ease, background-color 0.2s ease;
        z-index: 10;
    }
    .delete-btn-overlay:hover {
        opacity: 1; /* Fully opaque on hover */
        background-color: #dc3545; /* Ensure full red on hover */
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.5); /* Glowing red shadow on hover */
    }
    
    /* 3. Cleanup for button text (since we only show the icon now) */
    .delete-btn-overlay i {
        font-size: 1.1em;
    }
    
    /* Optional: Hide image ID on hover for a cleaner look */
    .gallery-card:hover .text-white-50 {
        background-color: #343a40; /* Darker background on hover */
        color: #fff !important;
    }
    
    /* Ensure images fill the space cleanly */
    .card-img-top {
        border-radius: 0.5rem 0.5rem 0 0 !important; /* Match top corners to card */
    }
</style>

<div class="modal fade text-left" id="editDogDetailsModal<?php echo $dog_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEditDogDetails<?php echo $dog_id; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="myModalLabelEditDogDetails<?php echo $dog_id; ?>">Update Dog Details: <?php echo $dog_name; ?></h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="kb-dogs" method="POST">
                    
                    <div class="modal-body">
                        
                        <input type="hidden" name="dog_id" value="<?php echo $dog_id; ?>"> 
                        <input type="hidden" name="updateDogDetails" value="1">

                        <label>Dog Name:</label>
                        <div class="form-group">
                            <input type="text" class="form-control border-dark" style="color: black;" name="dog_name" required 
                                   placeholder="Enter Dog's Name" 
                                   value="<?php echo htmlspecialchars($dog_name); ?>">
                        </div>
                        
                        <label>Information/Bio:</label>
                        <div class="form-group">
                            <textarea class="form-control border-dark" style="color: black;" name="dog_information" rows="4" required
                                      placeholder="Enter Dog's Information"><?php echo htmlspecialchars($dog_info); ?></textarea>
                        </div>
                        
                        <label>Status (Visible on Site):</label>
                        <div class="form-group">
                            <select class="form-control border-dark" name="dog_status" required style="color: black;">
                                <option value="Yes" <?php echo ($dog_status === 'Yes') ? 'selected' : ''; ?>>Yes</option>
                                <option value="No" <?php echo ($dog_status === 'No') ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>

                        <label>Dog Info Is?:</label>
                        <div class="form-group">
                            <select class="form-control border-dark" name="dog_is" required style="color: black;">
                                <option value="Knowledge Base" <?php echo ($dog_is === 'Knowledge Base') ? 'selected' : ''; ?>>Knowledge Base</option>
                                <option value="Gallery" <?php echo ($dog_is === 'Gallery') ? 'selected' : ''; ?>>Gallery</option>
                            </select>
                        </div>

                        
                        <hr>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-primary btn-lg" value="Update Details">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
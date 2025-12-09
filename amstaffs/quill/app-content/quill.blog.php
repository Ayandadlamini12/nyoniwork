<!-- GALLERY PAGE-->
<div role="tabpanel" class="tab-pane" id="account-vertical-blog" aria-labelledby="account-pill-blog" aria-expanded="false">

    <!-- GALLERY IMAGES -->
    <h4 class="form-section"><i class="fa fa-media"></i> BLOG</h4>

<?php
// Assume $conn is an active MySQLi database connection object established earlier in the script.

// 1. SELECT Query for Blog Posts
$sql = "SELECT * FROM quill_blog
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

<div class="row">
    <div class="col-md-12 form-group"> 
        <div class="row match-height">
            <?php
            if ($result->num_rows > 0) {
                // 3. Loop through the fetched results
                while($row = $result->fetch_assoc()) {
                    // Map Blog Post columns to PHP variables
                    $blog_id = htmlspecialchars($row['id']);
                    $b_title = htmlspecialchars($row['blog_title']);
                    $b_slug = htmlspecialchars($row['blog_slug']);
                    $b_content = htmlspecialchars($row['blog_content']);
                    $b_author = htmlspecialchars($row['blog_author']);
                    $b_category = htmlspecialchars($row['blog_category'] ?? 'Uncategorized');
                    $b_reading_time = (int)($row['blog_reading_time'] ?? 0); // Use 0 if null
                    $b_image_path = htmlspecialchars($row['blog_image']);
                    $b_is_published = (int)$row['blog_is_published'];
                    
                    // Determine display status and color
                    $status_text = $b_is_published ? 'Published' : 'Draft';
                    $status_color_class = $b_is_published ? 'text-success' : 'text-warning';
                    
                    // Fallback for image path/display
                    $display_image_path = !empty($b_image_path) ? $b_image_path : 'https://placehold.co/400x200/505050/FFFFFF?text=No+Featured+Image';
            ?> 
            
            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="card shadow-lg rounded-xl mb-4">
                    <div class="card-content">
                        <!-- Featured Image Display -->
                        <?php if (!empty($b_image_path)): ?>
                        <img class="card-img-top img-fluid" src="../assets/uploads/blog/<?php echo $b_image_path; ?>" alt="<?php echo $b_title; ?> Featured Image" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center bg-gray-200" style="height: 200px; font-size: 1.2rem; border-top-left-radius: 0.75rem; border-top-right-radius: 0.75rem;">
                                No Featured Image
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            
                            <h4 class="card-title text-primary font-weight-bold mb-1"><?php echo $b_title; ?></h4>
                            <p class="card-text mb-1">
                                <span class="badge badge-light-secondary mr-2">Category: <?php echo $b_category; ?></span>
                                <span class="badge badge-light-info">Author: <?php echo $b_author; ?></span>
                            </p>

                            <!-- Reading Time & Status -->
                            <div class="d-flex justify-content-between align-items-center mb-1 pt-1 border-top mt-2">
                                <p class="mb-0 text-muted">
                                    <i class="feather icon-clock mr-1"></i> 
                                    Reading Time: <strong><?php echo $b_reading_time; ?> min</strong>
                                </p>
                                <p class="mb-0 <?php echo $status_color_class; ?>">
                                    <i class="feather icon-circle mr-1"></i> 
                                    <strong><?php echo $status_text; ?></strong>
                                </p>
                            </div>
                             
                            
                            <a data-toggle="modal" data-target="#manageBlog<?php echo $blog_id; ?>" class="btn btn-outline-secondary"><i class="feather icon-eye"></i> Manage</a>
                            <a data-toggle="modal" data-target="#deleteBlog<?php echo $blog_id; ?>" class="btn btn-outline-danger"><i class="feather icon-trash"></i> Delete</a>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- MANAGE/UPDATE MODAL (for current blog post) -->
            <div class="modal fade text-left" id="manageBlog<?php echo $blog_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelManageBlog<?php echo $blog_id; ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabelManageBlog<?php echo $blog_id; ?>"><b class="text-primary">BLOG POST:</b><br> <?php echo $b_title; ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"> 
                            <!-- Form action placeholder, needs a PHP file to handle updates -->
                            <form id="blogPostForm1" action="quill-photos" enctype="multipart/form-data" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="UpdateBlogPost" value="1">
                                    <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
                                    <input type="hidden" name="current_image_path" value="<?php echo $b_image_path; ?>">
                                    <input type="hidden" name="blog_content" id="blog_content_hidden1">

                                    <!-- Current Image Preview -->
                                    <div class="form-group mb-4"> 
                                        <label>Current Featured Image:</label>
                                        <center>
                                            <img class="card-img-top img-fluid w-75 rounded-lg" src="../assets/uploads/blog/<?php echo $display_image_path; ?>" alt="<?php echo $b_title; ?> Image" style="max-height: 250px; object-fit: cover;">
                                        </center>
                                    </div>
                                    
                                    <!-- New Image Upload -->
                                    <label for="newImageUpload<?php echo $blog_id; ?>">Upload New Featured Image (Replaces Current)</label>
                                    <div class="form-group">  
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="newImageUpload<?php echo $blog_id; ?>" name="blog_image_new">
                                            <label class="custom-file-label" for="newImageUpload<?php echo $blog_id; ?>">Choose file</label>
                                        </div>  
                                    </div>

                                    <!-- Blog Title -->
                                    <label>Blog Title:</label>
                                    <div class="form-group"> 
                                        <input type="text" class="form-control border-dark" style="color: black;" name="blog_title" required="" value="<?php echo $b_title; ?>" placeholder="Enter the main title"style="color: black;">
                                    </div> 

                                    <!-- Blog Slug -->
                                    <label>URL Slug:</label>
                                    <div class="form-group"> 
                                        <input type="text" class="form-control border-dark" style="color: black;" name="blog_slug" value="<?php echo $b_slug; ?>" placeholder="e.g., my-first-post-2024"style="color: black;">
                                    </div>
                                    
                                    <div class="row">
                                        <!-- Blog Author -->
                                        <div class="col-md-6">
                                            <label>Author:</label>
                                            <div class="form-group"> 
                                                <input type="text" class="form-control border-dark" style="color: black;" name="blog_author" required="" value="<?php echo $b_author; ?>" placeholder="Your Name or Username"style="color: black;">
                                            </div>
                                        </div>
                                        
                                        <!-- Blog Category -->
                                        <div class="col-md-6">
                                            <label>Category (Optional):</label>
                                            <div class="form-group"> 
                                                <input type="text" class="form-control border-dark" style="color: black;" name="blog_category" value="<?php echo htmlspecialchars($row['blog_category']); ?>" placeholder="e.g., News, Tips, Updates"style="color: black;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <!-- Reading Time -->
                                        <div class="col-md-6">
                                            <label>Reading Time (Minutes):</label>
                                            <div class="form-group"> 
                                                <input type="number" class="form-control border-dark" style="color: black;" name="blog_reading_time" min="1" value="<?php echo $b_reading_time; ?>" placeholder="e.g., 5" style="color: black;">
                                            </div>
                                        </div>

                                        <!-- Publish Status -->
                                        <div class="col-md-6 d-flex align-items-center pt-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="manage_published_<?php echo $blog_id; ?>" name="blog_is_published" value="1" <?php echo $b_is_published ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="manage_published_<?php echo $blog_id; ?>">Publish Post Now</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quill Editor Structure (Your provided fixture) -->
                                    <label>Blog Content: <span class="text-danger">*</span></label>
                                    <div class="form-group mb-4"> 
                                        <section class="quill-editor">
                                            <!-- Use a distinct ID for Quill initialization -->
                                            <div id="editor-containers">
                                                <?php echo $b_content; ?> 
                                            </div>
                                        </section>
                                    </div>  
                                </div>
                                <div class="modal-footer">
                                    <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                    <input type="submit" class="btn btn-outline-primary btn-lg" value="Update Blog Post">
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>

            <!-- DELETE MODAL (for current blog post) -->
            <div class="modal fade text-left" id="deleteBlog<?php echo $blog_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDeleteBlog<?php echo $blog_id; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabelDeleteBlog<?php echo $blog_id; ?>">Delete Blog Post</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"> 
                            <!-- Form action placeholder, needs a PHP file to handle deletion -->
                            <form action="quill-photos" method="POST">
                               <div class="modal-body">
                                    <input type="hidden" name="DeleteBlogPost" value="1">
                                    <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
                                    <input type="hidden" name="blog_image_path" value="<?php echo $b_image_path; ?>">
                                    
                                    <h4>Are you sure you want to delete the post titled: <br/>"<?php echo $b_title; ?>"</h4> 
                                    <p class="text-danger">This action cannot be undone.</p>
                                    
                                    <p>Author: <?php echo $b_author; ?></p>
                                    <p>Reading Time: <?php echo $b_reading_time; ?> min</p>
                                    <p>Status: <span class="<?php echo $status_color_class; ?>"><?php echo $status_text; ?></span></p>

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
            <?php 
                } // End while loop
            } else { 
            ?>
                <div class="col-12">
                    <p class="text-center text-muted">No blog posts found. Add a new one to get started!</p>
                </div>
            <?php 
            } // End if/else block
            ?>
        </div>    
    </div>
</div>
        
        
    
    <!-- This HTML snippet provides a button and a modal form for adding new blog posts -->

<div class="row"> 
    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
        <a data-toggle="modal" data-target="#NewBlogPostModal" class="btn btn-outline-success">New Blog Post</a>
 
        <div class="modal fade text-left" id="NewBlogPostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelBlog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document"> <!-- Used modal-lg for more space for content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabelBlog">Blog Post Management</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 

                         
                        <!-- Form submits to 'quill-blog' (assuming this is your processing file) -->
                        <form id="blogPostForm" action="quill-photos" enctype="multipart/form-data" method="POST">
                            <div class="modal-body">
                                
                                <!-- Blog Title -->
                                <label>Blog Title: <span class="text-danger">*</span></label>
                                <div class="form-group"> 
                                    <input type="text" class="form-control border-dark" style="color: black;" name="blog_title" required="" placeholder="Enter the main title of the post">
                                    <input type="hidden" name="addNewBlogPost" value="1">
                                    <input type="hidden" name="blog_content" id="blog_content_hidden">
                                </div> 
                                
                                <!-- Blog Slug (Optional, for manual override) -->
                                <label>URL Slug (Optional):</label>
                                <div class="form-group"> 
                                    <input type="text" class="form-control border-dark" style="color: black;" name="blog_slug" placeholder="e.g., my-first-post-2024">
                                </div>
                                
                                <div class="row">
                                    <!-- Blog Author -->
                                    <div class="col-md-6">
                                        <label>Author: <span class="text-danger">*</span></label>
                                        <div class="form-group"> 
                                            <input type="text" class="form-control border-dark" style="color: black;" name="blog_author" required="" placeholder="Your Name or Username">
                                        </div>
                                    </div>
                                    
                                    <!-- Blog Category -->
                                    <div class="col-md-6">
                                        <label>Category (Optional):</label>
                                        <div class="form-group"> 
                                            <input type="text" class="form-control border-dark" style="color: black;" name="blog_category" placeholder="e.g., News, Tips, Updates">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <!-- Reading Time -->
                                    <div class="col-md-6">
                                        <label>Reading Time (Minutes):</label>
                                        <div class="form-group"> 
                                            <input type="number" class="form-control border-dark" style="color: black;" name="blog_reading_time" min="1" placeholder="e.g., 5">
                                        </div>
                                    </div>

                                    <!-- Publish Status -->
                                    <div class="col-md-6 d-flex align-items-center pt-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="blog_is_published" name="blog_is_published" value="1">
                                            <label class="form-check-label" for="blog_is_published">Publish Post Now</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Featured Image -->
                                <label for="blog_image_file">Upload Featured Image (Optional)</label>
                                <div class="form-group">  
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="blog_image_file" name="blog_image">
                                        <label class="custom-file-label" for="blog_image_file">Choose file</label>
                                    </div>  
                                </div>
                                
                                <!-- Quill Editor Structure (Your provided fixture) -->
                                <label>Blog Content: <span class="text-danger">*</span></label>
                                <div class="form-group mb-4"> 
                                    <section class="quill-editor">
                                        <!-- Use a distinct ID for Quill initialization -->
                                        <div id="editor-container">
                                            <h1 class="ql-align-left">Blog Text Here</h1> 
                                        </div>
                                    </section>
                                </div>
                                
                                
                            </div>
                            <div class="modal-footer">
                                <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                <input type="submit" class="btn btn-outline-primary btn-lg" value="Save Blog Post">
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
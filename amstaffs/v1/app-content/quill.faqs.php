    <!-- SECTION HEADERS PAGE -->
    <div class="tab-pane fade " id="account-vertical-faqs" role="tabpanel" aria-labelledby="account-pill-faqs" aria-expanded="false">

    <h4 class="form-section"><i class="fa fa-media"></i> FAQs</h4>
    <div class="row mb-4">
    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
        
        <!-- Button to trigger the New FAQ Modal -->
        <a data-toggle="modal" data-target="#NewFAQ" class="btn btn-outline-primary">
            <i class="feather icon-plus-square mr-1"></i> Add New FAQ
        </a>
    
        <!-- NEW FAQ INPUT MODAL -->
        <div class="modal fade text-left" id="NewFAQ" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNewFAQ" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabelNewFAQ">Add New Frequently Asked Question</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- The form action should point to your PHP handler script -->
                        <form action="quill-photos" method="POST">
                            <div class="modal-body">
                                
                                <input type="hidden" name="addNewFAQ" value="1">
                                
                                <!-- FAQ Question -->
                                <label>FAQ Question:</label>
                                <div class="form-group">
                                    <!-- Corresponds to 'faq_question' (VARCHAR) -->
                                    <input type="text" class="form-control" name="faq_question" required="" placeholder="e.g., How do I reset my password?">
                                </div>
                                
                                <!-- FAQ Answer -->
                                <label>Answer Content:</label>
                                <div class="form-group">
                                    <!-- Corresponds to 'faq_answer' (TEXT) -->
                                    <textarea class="form-control" name="faq_answer" required="" placeholder="Provide the detailed answer here." rows="5"></textarea>
                                </div>

                                <!-- Display Order -->
                                <label>Display Order (Optional):</label>
                                <div class="form-group">
                                    <!-- Corresponds to 'faq_order' (INT) -->
                                    <input type="number" class="form-control" name="faq_order" value="0" min="0" placeholder="0">
                                    <small class="text-muted">Enter a number to manually control the sorting order (0 is default).</small>
                                </div>
                                
                                <!-- Is Published Checkbox -->
                                <div class="form-group form-check mt-3">
                                    <!-- Corresponds to 'faq_is_published' (TINYINT) -->
                                    <input type="checkbox" class="form-check-input" id="faqIsPublished" name="faq_is_published" value="1" checked>
                                    <label class="form-check-label" for="faqIsPublished">Publish this FAQ immediately</label>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Close">
                                <input type="submit" class="btn btn-outline-primary btn-lg" value="Save FAQ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">  
                    <!-- HTML structure starts here --> 
                        
                    <?php
                        // Ensure $conn is available and connected to your MySQL database.
                        // This code fetches all FAQs, ordered by the 'faq_order' column.
                        
                        // 1. Fetch FAQs from the database
                        $select_faqs_sql = "SELECT id, faq_question, faq_answer, faq_order, faq_is_published FROM quill_faqs ORDER BY faq_order ASC, id ASC";
                        $faqs_result = mysqli_query($conn, $select_faqs_sql);
                        
                        if ($faqs_result === false) {
                            echo "<p class='alert alert-danger'>Error retrieving FAQs: " . mysqli_error($conn) . "</p>";
                            $faqs = [];
                        } else {
                            $faqs = mysqli_fetch_all($faqs_result, MYSQLI_ASSOC);
                            mysqli_free_result($faqs_result);
                        }
                        
                        // Check if any FAQs were found
                        if (count($faqs) == 0) {
                            echo "<div class='text-center p-5 border rounded'><p class='lead text-muted'>No Frequently Asked Questions have been added yet.</p></div>";
                            // Stop execution if no data is found
                            return; 
                        }
                        
                        $counter = 0;
                    ?>

                    <!-- Outer Accordion Wrapper -->
                    <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                        <?php foreach ($faqs as $item): 
                            $faq_id = htmlspecialchars($item['id']);
                            $question = htmlspecialchars($item['faq_question']);
                            $answer_display = nl2br(htmlspecialchars($item['faq_answer'])); // Use nl2br for displaying line breaks
                            $is_published = (int)$item['faq_is_published'];
                            
                            $heading_id = 'faqHeading' . $faq_id;
                            $accordion_id = 'faqAccordion' . $faq_id;
                            $accordion_link_text = $question;
                            
                            // Control initial state of the first item
                            $is_first_item = ($counter === 0);
                            $header_class = 'card-header d-flex justify-content-between align-items-center cursor-pointer';
                            $collapse_class = 'card-collapse collapse ' . ($is_first_item ? 'show' : '');
                            $aria_expanded = $is_first_item ? 'true' : 'false';
                    
                            // Styling for published/unpublished status
                            $status_color = $is_published ? 'text-success' : 'text-danger';
                            $status_icon = $is_published ? 'feather icon-check-circle' : 'feather icon-slash';
                            $status_label = $is_published ? 'Published' : 'Draft';
                        ?>
                            
                            <!-- Accordion Item Start -->
                            <div class="card accordion collapse-icon panel mb-1 box-shadow-0 border rounded-lg">
                                
                                <!-- ACCORDION HEADER (FAQ Question) -->
                                <div id="<?php echo $heading_id; ?>"
                                    role="tab"
                                    class="<?php echo $header_class; ?>"
                                    data-toggle="collapse"
                                    href="#<?php echo $accordion_id; ?>"
                                    aria-expanded="<?php echo $aria_expanded; ?>"
                                    aria-controls="<?php echo $accordion_id; ?>">
                                    
                                    <a class="h6 blue" href="#">
                                        <?php echo $accordion_link_text; ?>
                                    </a>
                    
                                    <!-- Status indicator -->
                                    <small class="<?php echo $status_color; ?> d-flex align-items-center">
                                        <i class="<?php echo $status_icon; ?> mr-1"></i> <?php echo $status_label; ?>
                                    </small>
                                </div>
                                
                                <!-- ACCORDION BODY (FAQ Answer and Controls) -->
                                <div id="<?php echo $accordion_id; ?>"
                                    role="tabpanel"
                                    data-parent="#accordionWrap1"
                                    aria-labelledby="<?php echo $heading_id; ?>"
                                    class="<?php echo $collapse_class; ?>">
                                    
                                    <div class="card-body border-top p-4">
                                        
                                        <!-- Display FAQ Answer -->
                                        <h5 class="font-bold text-lg mb-2 text-primary">Answer:</h5>
                                        <p class="card-text mb-4"><?php echo $answer_display; ?></p>
                                        
                                        <hr>
                    
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                             <small class="text-muted">Order: <?php echo htmlspecialchars($item['faq_order']); ?> | ID: <?php echo $faq_id; ?></small>
                                             
                                             <div>
                                                <!-- Edit Button (Triggers Modal) -->
                                                <a data-toggle="modal" data-target="#UpdateFAQ<?php echo $faq_id; ?>" class="btn btn-sm btn-outline-info mr-2">Edit</a>
                    
                                                <!-- Delete Button (Triggers Modal) -->
                                                <a data-toggle="modal" data-target="#DeleteFAQ<?php echo $faq_id; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                                             </div>
                                        </div>
                    
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Accordion Item End -->
                    
                    
                            <!-- ------------------------------------------------------------------- -->
        <!-- UPDATE FAQ MODAL (Modal is placed inside the loop for unique IDs) -->
        <!-- ------------------------------------------------------------------- -->
        <div class="modal fade text-left" id="UpdateFAQ<?php echo $faq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalUpdateFAQ" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h4 class="modal-title" id="myModalUpdateFAQ">Edit FAQ #<?php echo $faq_id; ?></h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- NOTE: Form action points to the handler we created earlier -->
                        <form action="quill-faqs-actions.php" method="POST">
                            <input type="hidden" name="UpdateFAQ" value="1">
                            <input type="hidden" name="faq_id" value="<?php echo $faq_id; ?>">
                            
                            <!-- FAQ Question -->
                            <label>FAQ Question:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="faq_question" required="" placeholder="e.g., How do I reset my password?" value="<?php echo $question; ?>">
                            </div>
                            
                            <!-- FAQ Answer -->
                            <label>Answer Content:</label>
                            <div class="form-group">
                                <!-- Note: We need the un-nl2br version for textarea editing -->
                                <textarea class="form-control" name="faq_answer" required="" placeholder="Provide the detailed answer here." rows="5"><?php echo htmlspecialchars($item['faq_answer']); ?></textarea>
                            </div>

                            <!-- Display Order -->
                            <label>Display Order (Optional):</label>
                            <div class="form-group">
                                <input type="number" class="form-control" name="faq_order" min="0" value="<?php echo htmlspecialchars($item['faq_order']); ?>">
                            </div>
                            
                            <!-- Is Published Checkbox -->
                            <div class="form-group form-check mt-3">
                                <input type="checkbox" class="form-check-input" id="updateFaqIsPublished<?php echo $faq_id; ?>" name="faq_is_published" value="1" <?php echo $is_published ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="updateFaqIsPublished<?php echo $faq_id; ?>">Publish this FAQ</label>
                            </div>

                            <div class="modal-footer">
                                <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="Close">
                                <input type="submit" class="btn btn-info btn-md" value="Save Changes">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- ------------------------------------------------------------------- -->
        <!-- DELETE FAQ MODAL (Simple Confirmation) -->
        <!-- ------------------------------------------------------------------- -->
        <div class="modal fade text-left" id="DeleteFAQ<?php echo $faq_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalDeleteFAQ" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h4 class="modal-title" id="myModalDeleteFAQ">Confirm Deletion</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger font-weight-bold">Are you sure you want to delete the FAQ:</p>
                        <p> "<?php echo $question; ?>"</p>
                        
                        <form action="quill-faqs-actions.php" method="POST">
                            <input type="hidden" name="DeleteFAQ" value="1">
                            <input type="hidden" name="faq_id" value="<?php echo $faq_id; ?>">
                            
                            <div class="modal-footer justify-content-between">
                                <input type="button" class="btn btn-outline-secondary" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-danger" value="Delete Forever">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php $counter++; endforeach; ?>
</div>
<!-- End Outer Accordion Wrapper -->
                            
                </div>
            </div>
        </div>
    </div>

    



                                            </div>
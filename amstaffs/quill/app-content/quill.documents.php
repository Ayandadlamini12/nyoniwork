<div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                                
    <!--DOCUMENTS -->
 
    <?php if (isset($_SESSION['metadata'])): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong><?php echo $_SESSION['metadata']; ?></strong>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['wrong_metadata'])): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong><?php echo $_SESSION['wrong_metadata']; ?></strong>
        </div>
    <?php endif; ?>
    <h4 class="form-section"><i class="fa fa-media"></i> IMPORTANT DOCUMENTS</h4>

    <div class="row">
    <div class="col-md-12 form-group">  
        <div class="row match-height">
            <?php
            // 1. SELECT Query for Documents
            $sql_docs = "SELECT * FROM quill_documents
                         ORDER BY document_uploaded_at DESC"; 
            
            // Execute the query
            $result_docs = $conn->query($sql_docs);
            
            // Check for query errors
            if ($result_docs === false) {
                echo "<p class='text-danger'>Database query for documents failed: " . $conn->error . "</p>";
                $result_docs = (object) ['num_rows' => 0]; // Set result to prevent further errors
            }
            
            if ($result_docs->num_rows > 0) {
                // 2. Loop through the fetched document results
                while($doc_row = $result_docs->fetch_assoc()) {
                    // Map Document columns to PHP variables
                    $document_id = htmlspecialchars($doc_row['id']);
                    $d_title = htmlspecialchars($doc_row['document_title']);
                    $d_description = htmlspecialchars($doc_row['document_description']);
                    $d_filename = htmlspecialchars($doc_row['document_name']); // Stored file path/name
                    $d_uploaded_at = date('Y-m-d H:i', strtotime($doc_row['document_uploaded_at'])); // Formatted date
                    
                    // Assuming documents are stored in a dedicated server directory
                    // NOTE: You must adjust the path below to match your server structure
                    $full_file_path = "assets/documents/" . $d_filename; 
                    
                    // Simple logic to determine a document type icon (e.g., based on extension)
                    $file_ext = pathinfo($d_filename, PATHINFO_EXTENSION);
                    $icon_class = 'feather icon-file'; 
                    if (strtolower($file_ext) === 'pdf') {
                        $icon_class = 'feather icon-file-text';
                    } elseif (in_array(strtolower($file_ext), ['doc', 'docx'])) {
                         $icon_class = 'feather icon-file-plus';
                    }
            ?> 

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 document-item mb-1">
    <div class="card shadow-lg border-0 h-100 rounded-lg">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title text-primary d-flex align-items-center mb-2">
                    <!-- Icon based on the file type (since we only allow PDF, we can use a standard PDF icon) -->
                    <i class="feather icon-file-text mr-2" style="font-size: 7.5rem;"></i> 
                    <?php echo htmlspecialchars($d_title); ?>
                </h4>
                <p class="card-text text-muted mb-1">
                    <small>Uploaded: <?php echo htmlspecialchars($d_uploaded_at); ?></small>
                </p>
                <p class="card-text text-dark">
                    <?php echo htmlspecialchars(substr($d_description, 0, 100)); ?> 
                    <?php echo (strlen($d_description) > 100) ? '...' : ''; ?>
                </p>
            </div>
            <div class="card-body"> 
                
                <!-- VIEW BUTTON: Triggers the Modal -->
                <a href="#" data-toggle="modal" data-target="#viewDocModal<?php echo $document_id; ?>" class="btn btn-outline-dark rounded-pill">
                    <i class="feather icon-eye"></i> View Document
                </a>
                
                <!-- DELETE BUTTON: Triggers the Delete Confirmation Modal -->
                <a data-toggle="modal" data-target="#deleteDocModal<?php echo $document_id; ?>" class="btn btn-outline-danger rounded-pill">
                    <i class="feather icon-trash-2"></i> Delete
                </a>
                
            </div>
        </div>
    </div>
</div>

<!-- 1. VIEW PDF MODAL (Using iframe for inline viewing) -->
<div class="modal fade" id="viewDocModal<?php echo $document_id; ?>" tabindex="-1" role="dialog" aria-labelledby="viewDocModalLabel<?php echo $document_id; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDocModalLabel<?php echo $document_id; ?>">Viewing: <?php echo htmlspecialchars($d_title); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" style="min-height: 80vh;">
                <!-- 
                    Using an iframe to embed the PDF. The 'document_path' should be the relative 
                    path stored in the database (e.g., assets/uploads/documents/...). 
                    The path must be correct relative to the script running this.
                -->
                <iframe 
                    src="../assets/uploads/documents/<?php echo htmlspecialchars($d_filename); ?>" 
                    style="width: 100%; height: 80vh; border: none;"
                    frameborder="0"
                    allowfullscreen
                    title="PDF Viewer for <?php echo htmlspecialchars($d_title); ?>"
                >
                    <p>It looks like your browser does not support iframes. You can <a href="../assets/uploads/documents/<?php echo htmlspecialchars($d_filename); ?>" target="_blank">download the PDF here</a>.</p>
                </iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close Viewer</button>
            </div>
        </div>
    </div>
</div>


<!-- 2. DELETE CONFIRMATION MODAL -->
<div class="modal fade" id="deleteDocModal<?php echo $document_id; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteDocModalLabel<?php echo $document_id; ?>" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteDocModalLabel<?php echo $document_id; ?>">Confirm Deletion</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="quill-photos" method="POST">
                <div class="modal-body text-center">
                    <p>Are you sure you want to delete the document "<strong><?php echo htmlspecialchars($d_title); ?></strong>"?</p>
                    <small class="text-danger">This action cannot be undone and will delete the file from the server.</small>
                    
                    <input type="hidden" name="DeleteDocument" value="1">
                    <input type="hidden" name="document_id" value="<?php echo $document_id; ?>">
                    <input type="hidden" name="document_file_path" value="<?php echo htmlspecialchars($d_filename); ?>">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete It</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
            
          

            <?php 
                } // End while loop
            } else { 
            ?>
            <div class="col-12">
                <p class="text-center text-danger mt-2">No documents have been uploaded yet.</p>
            </div>
            <?php 
            } // End if num_rows
            ?>
        </div>
    </div> 
</div>

<div class="row mb-4"> 
    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
        <!-- Button to trigger the New Document Modal -->
        <a data-toggle="modal" data-target="#NewDocument" class="btn btn-outline-dark">
            <i class="feather icon-upload-cloud mr-1"></i> Upload New Document
        </a>
    
        <!-- NEW DOCUMENT UPLOAD MODAL -->
        <div class="modal fade text-left" id="NewDocument" tabindex="-1" role="dialog" aria-labelledby="myModalLabelNewDocument" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabelNewDocument">Upload New Document</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                        <!-- The form action should point to your PHP handler script (e.g., 'quill-documents.php' or 'quill-photos' as per your reference) -->
                        <form action="quill-photos" enctype="multipart/form-data" method="POST">
                            <div class="modal-body">
                                
                                <input type="hidden" name="addNewDocument" value="1">
                                
                                <!-- Document Title -->
                                <label>Document Title:</label>
                                <div class="form-group"> 
                                    <input type="text" class="form-control border-dark" style="color: darkgrey;" name="document_title" required="" placeholder="e.g., Q3 Puppy Care">
                                </div> 
                                
                                <!-- Document Description -->
                                <label>Description (Optional):</label>
                                <div class="form-group">
                                    <textarea class="form-control border-dark" style="color: darkgrey;" name="document_description" placeholder="A brief description of the document content." rows="3"></textarea> 
                                </div>
                                
                                <!-- File Upload Input (Document) -->
                                <label for="documentFileUpload">Select Document File:</label>
                                <div class="form-group">  
                                    <div class="custom-file">
                                        <!-- Field name matches database column: document_name (stores the filename) -->
                                        <!-- Added accept="application/pdf" to restrict file types -->
                                        <input type="file" class="custom-file-input" id="documentFileUpload" name="document_file" required accept="application/pdf">
                                        <label class="custom-file-label" for="documentFileUpload">Choose file</label>
                                    </div>  
                                    <!-- Updated text to reflect PDF-only restriction -->
                                    <small class="text-muted">Max file size: 5MB. Allowed format: PDF only.</small>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="reset" class="btn btn-outline-dark btn-lg" data-dismiss="modal" value="Close">
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
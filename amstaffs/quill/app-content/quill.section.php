<!-- SECTION HEADERS PAGE -->
                                            <div class="tab-pane fade " id="account-vertical-headers" role="tabpanel" aria-labelledby="account-pill-headers" aria-expanded="false">

                                                <h4 class="form-section"><i class="fa fa-media"></i> SECTION HEADERS</h4>
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                                        <div class="card">
                                                            <div class="card-content"> 
                                                                <?php
 
                                                                    $sql = "SELECT id, section, title, subtitle, description FROM quill_section_headers ORDER BY title ASC";
                                                                    $section_count = 0; // Counter for unique IDs
                                                                    $headers = []; // Array to store fetched headers
                                                                    $error_message = ''; // Initialize error message
                                                                    
                                                                    // Check if $conn is a valid MySQLi connection object
                                                                    if ($conn instanceof mysqli) {
                                                                        
                                                                        // 2. Execute the Query directly since there are no parameters
                                                                        if ($result = mysqli_query($conn, $sql)) {
                                                                            
                                                                            // Fetch all rows into the $headers array
                                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                                $headers[] = $row;
                                                                            }
                                                                            
                                                                            // Free the result set
                                                                            mysqli_free_result($result);
                                                                            
                                                                        } else {
                                                                            // Handle query error
                                                                            error_log("MySQLi query failed: " . mysqli_error($conn));
                                                                            $error_message = "Database query failed: " . mysqli_error($conn);
                                                                        }
                                                                    } else {
                                                                        $error_message = "Database connection (\$conn) is not established.";
                                                                    }
                                                                    
                                                                ?>
                                                                    
                                                                <!-- HTML structure starts here -->
                                                                <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                                                                    
                                                                    <?php if (!empty($headers)): ?>
                                                                        <?php foreach ($headers as $item): 
                                                                            $section_count++;
                                                                            $heading_id = "heading" . $section_count;
                                                                            $accordion_id = "accordion" . $section_count;
                                                                             
                                                                            $is_first = ($section_count === 1);
                                                                            $collapse_class = $is_first ? 'collapse show' : 'collapse';
                                                                            
                                                                            // The header should be 'collapsed' unless it is the first item
                                                                            $header_class = $is_first ? 'card-header card-collapse-border' : 'card-header card-collapse-border collapsed';
                                                                            $aria_expanded = $is_first ? 'true' : 'false';
                                                                            
                                                                            // Graceful handling for NULL or empty data
                                                                            // If title is NULL, use section name as fallback for display in body
                                                                            $title_display = $item['title'] ?? 'N/A (Title is NULL)'; 
                                                                            $subtitle_display = $item['subtitle'] ?? 'N/A (Subtitle is NULL)';
                                                                            $description_display = $item['description'] ?? 'N/A (Description is NULL)';
                                                                                
                                                                            // Use the Title as the main Accordion Link Text. If Title is NUuse Subtitle.
                                                                            $accordion_link_text = htmlspecialchars($item['title'] ?? $item['subtitle'] ?? strtoupper($item['section']));
                                                                        ?>
                                                                                
                                                                        <div class="card accordion collapse-icon panel mb-0 box-shadow-0 border-0">
                                                                                    
                                                                            <!-- ACCORDION HEADER -->
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
                                                                            </div>
                                                                            
                                                                            <!-- ACCORDION BODY -->
                                                                            <div id="<?php echo $accordion_id; ?>" 
                                                                                 role="tabpanel" 
                                                                                 data-parent="#accordionWrap1" 
                                                                                 aria-labelledby="<?php echo $heading_id; ?>" 
                                                                                 class="<?php echo $collapse_class; ?>">
                                                                                
                                                                                <div class="card-body">
                                                                                    <!-- Display Section Data -->
                                                                                    <h5 class="font-bold text-lg mb-1">Title:</h5>
                                                                                    <p class="card-text mb-1"><?php echo htmlspecialchars($title_display); ?></p>
                                                                                    
                                                                                    <h5 class="font-bold text-lg mb-1">Subtitle:</h5>
                                                                                    <p class="card-text mb-1"><?php echo htmlspecialchars($subtitle_display); ?></p>
                                                                                    
                                                                                    <h5 class="font-bold text-lg mb-1">Description:</h5>
                                                                                    <p class="card-text"><?php echo nl2br(htmlspecialchars($description_display)); ?></p>
                                                                                            
                                                                                    <small class="text-muted mb-2 mt-2 block">Section Key: <?php echo htmlspecialchars(strtoupper($item['section'])); ?></small>
                                                                                    
                                                                                    <a data-toggle="modal" data-target="#UpdateHeader<?php echo htmlspecialchars($item['id']); ?>" class="btn btn-outline-danger">Update Info</a>

                                                                                    <div class="modal fade text-left" id="UpdateHeader<?php echo htmlspecialchars($item['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalUpdateSectionHeader" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-md" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header bg-primary text-white">
                                                                                                    <h4 class="modal-title" id="myModalUpdateSectionHeader">Edit Section Header: <?php echo htmlspecialchars($item['section']); ?></h4>
                                                                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    
                                                                                                    <!-- NOTE: Adjust the 'action' URL to your actual form handler file -->
                                                                                                    <form action="quill-photos" method="POST">
                                                                                                        
                                                                                                        <!-- Hidden fields for identification -->
                                                                                                        <input type="hidden" name="UpdateSectionHeader" value="1">
                                                                                                        <input type="hidden" name="section_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                                                                                        
                                                                                                        <!-- Section Key (Read-Only for Context) -->
                                                                                                        <h5 class="text-primary mb-1 mt-2">Section Key:</h5>
                                                                                                        <div class="form-group">
                                                                                                            <input type="text" class="form-control border-dark" style="color: darkgrey;" name="section_key_display" readonly value="<?php echo htmlspecialchars($item['section']); ?>">
                                                                                                            <input type="hidden" name="section_key" value="<?php echo htmlspecialchars($item['section']); ?>">
                                                                                                            <small class="form-text text-muted">This is the unique identifier and cannot be changed.</small>
                                                                                                        </div>
                                                                                    
                                                                                                        <!-- 1. Title Input (Corresponds to 'title' column) -->
                                                                                                        <h5 class="text-primary mb-1 mt-2">1. Main Title</h5>
                                                                                                        <label for="sectionTitle">Title:</label>
                                                                                                        <div class="form-group">
                                                                                                            <input type="text" class="form-control border-dark" style="color: darkgrey;" id="sectionTitle" name="section_title" placeholder="Enter Main Title" value="<?php echo htmlspecialchars($item['title']); ?>">
                                                                                                        </div>
                                                                                    
                                                                                                        <!-- 2. Subtitle Input (Corresponds to 'subtitle' column) -->
                                                                                                        <label for="sectionSubtitle">Subtitle:</label>
                                                                                                        <div class="form-group">
                                                                                                            <input type="text" class="form-control border-dark" style="color: darkgrey;" id="sectionSubtitle" name="section_subtitle" placeholder="Enter Subtitle" value="<?php echo htmlspecialchars($item['subtitle']); ?>">
                                                                                                        </div>
                                                                                    
                                                                                                        <!-- 3. Description Textarea (Corresponds to 'description' column) -->
                                                                                                        <label for="sectionDescription">Description:</label>
                                                                                                        <div class="form-group">
                                                                                                            <textarea class="form-control border-dark" style="color: darkgrey;" id="sectionDescription" name="section_description" placeholder="Enter Main Description" rows="6"><?php echo htmlspecialchars($item['description']); ?></textarea>
                                                                                                        </div>
                                                                                    
                                                                                                        <div class="modal-footer">
                                                                                                            <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="Close">
                                                                                                            <input type="submit" class="btn btn-primary btn-md" value="Update Info">
                                                                                                        </div>
                                                                                                    </form> 
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        <?php endforeach; ?>
                                                                    <?php else: ?>
                                                                        <div class="alert alert-warning p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded" role="alert">
                                                                            <?php echo $error_message ?: "No section headers found in the database."; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
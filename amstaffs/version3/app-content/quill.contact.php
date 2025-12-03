<div class="tab-pane fade " id="account-vertical-contact" role="tabpanel" aria-labelledby="account-pill-contact" aria-expanded="false">

                                                <h4 class="form-section"><i class="fa fa-media"></i> CONTACT PAGE</h4>
                                                <div class="row match-height">
                                                    <?php
 
                                                        if (!function_exists('safe_output')) {
                                                            function safe_output($string) {
                                                                return htmlspecialchars((string) $string, ENT_QUOTES, 'UTF-8');
                                                            }
                                                        } 

                                                        $contact_data = [];
                                                        $fetch_success = false;
                                                        
                                                        // 2. Fetch the single row of contact data
                                                        $sql = "SELECT * FROM quill_contact WHERE id = 1 LIMIT 1";
                                                        $result = mysqli_query($conn, $sql);
                                                        
                                                        if ($result) {
                                                            if (mysqli_num_rows($result) > 0) {
                                                                $contact_data = mysqli_fetch_assoc($result);
                                                                $fetch_success = true;
                                                            }
                                                            mysqli_free_result($result);
                                                        }
                                                        
                                                        // Fallback data structure for safety if the query fails or returns no rows
                                                        $defaults = [
                                                            'location_header' => 'Our Location', 'location' => '123 Main St, Anytown, USA',
                                                            'mail_header' => 'Email Us', 'mail' => 'info@example.com',
                                                            'call_header' => 'Call Us', 'call' => '+1 (555) 555-5555',
                                                            'follow_header' => 'Follow Us', 'gps_map_url' => '',
                                                            'sm_1' => 'facebook', 'sm_link1' => '#',
                                                            'sm_2' => 'twitter', 'sm_link2' => '#',
                                                            'sm_3' => 'instagram', 'sm_link3' => '#',
                                                            'sm_4' => 'linkedin', 'sm_link4' => '#',
                                                        ];
                                                        
                                                        // Merge fetched data with defaults, favoring fetched data
                                                        $data = $contact_data + $defaults;
                                                        
                                                        if (!$fetch_success) {
                                                            echo '<div class="alert alert-warning">Warning: Could not fetch contact data from the database. Displaying default values.</div>';
                                                        }
                                                    ?>
                                                        
                                                    <!-- HTML Template to Display Contact Information -->
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="card shadow-lg border-0 rounded-lg">
                                                            <div class="card-content">
                                                                <div class="card-body p-1"> 
                                                                    <!-- Main Header: Using Follow Header as a general title -->
                                                                    <h4 class="card-title text-info mb-1 text-center border-bottom pb-0">
                                                                        CONTACT INFORMATION
                                                                    </h4>
                                                        
                                                                    <!-- 1. LOCATION SECTION -->
                                                                    <div class="mb-1">
                                                                        <h5 class="text-primary font-weight-bold">
                                                                            <i class="fa fa-map-pin mr-2 text-info"></i> <?php echo safe_output($data['location_header']); ?>
                                                                        </h5>
                                                                        <p class="card-text text-muted ml-4"><?php echo nl2br(safe_output($data['location'])); ?></p>
                                                                    </div>
                                                        
                                                                    <!-- 2. EMAIL SECTION -->
                                                                    <div class="mb-1">
                                                                        <h5 class="text-primary font-weight-bold">
                                                                            <i class="fa fa-envelope mr-2 text-info"></i> <?php echo safe_output($data['mail_header']); ?>
                                                                        </h5>
                                                                        <p class="card-text text-muted ml-4">
                                                                            <a href="mailto:<?php echo safe_output($data['mail']); ?>" class="text-dark"><?php echo safe_output($data['mail']); ?></a>
                                                                        </p>
                                                                    </div>
                                                        
                                                                    <!-- 3. CALL SECTION -->
                                                                    <div class="mb-1">
                                                                        <h5 class="text-primary font-weight-bold">
                                                                            <i class="fa fa-phone mr-2 text-info"></i> <?php echo safe_output($data['call_header']); ?>
                                                                        </h5>
                                                                        <p class="card-text text-muted ml-4">
                                                                            <a href="tel:<?php echo safe_output($data['call']); ?>" class="text-dark"><?php echo safe_output($data['call']); ?></a>
                                                                        </p>
                                                                    </div>

                                                                    <!-- 4. FOLLOW SECTION -->
                                                                    <div class="mb-1">
                                                                        <h5 class="text-primary font-weight-bold">
                                                                            <i class="fa fa-instagram mr-2 text-info"></i> <?php echo safe_output($data['follow_header']); ?>
                                                                        </h5>
                                                                        <p class="card-text text-muted ml-4">
                                                                            <a href="javascript:void(0);" class="text-dark"><?php echo safe_output($data['follow']); ?></a>
                                                                        </p>
                                                                    </div>
                                                        
                                                                    <!-- Main Header: Using Follow Header as a general title -->
                                                                    <h4 class="card-title text-info mb-1 text-center border-bottom pb-0">
                                                                        SOCIAL MEDIA LINKS
                                                                    </h4>
                                                                    <!-- 4. SOCIAL MEDIA LINKS -->
                                                                    <div class="pt-1 d-flex justify-content-center mb-3">
                                                                        <?php for ($i = 1; $i <= 4; $i++): 
                                                                            $sm_name = $data["sm_{$i}"];
                                                                            $sm_link = $data["sm_link{$i}"];
                                                                            
                                                                            if (!empty($sm_link) && !empty($sm_name)):
                                                                                 
                                                                                $icon_class = 'fa-' . strtolower($sm_name); 
                                                                        ?>
                                                                        <a href="<?php echo safe_output($sm_link); ?>"  target="_blank"  class="btn btn-info rounded-circle mx-1"  title="<?php echo safe_output($sm_name); ?>" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                                            <i class="fa <?php echo safe_output($icon_class); ?> text-white"></i>
                                                                        </a>
                                                                        <?php 
                                                                            endif; 
                                                                            endfor; 
                                                                        ?>
                                                                    </div>
                                                        
                                                                    <!-- 5. GPS Map Link -->
                                                                    <?php if (!empty($data['gps_map_url'])): ?>
                                                                         
                                                                        <div class="col-12 wow fadeInUp mb-1" data-wow-delay="0.2s">
                                                                            <div class="h-100 overflow-hidden">
                                                                                <iframe class="w-100" style="height: 400px;" src="<?php echo safe_output($data['gps_map_url']); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <a data-toggle="modal" data-target="#UpdateContact<?php echo safe_output($data['id']); ?>" class="btn btn-outline-success">Update Info</a>

                                                                    <div class="modal fade text-left" id="UpdateContact<?php echo safe_output($data['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalUpdateContact" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header bg-primary text-white">
                                                                                    <h4 class="modal-title" id="myModalUpdateContact">Update Global Contact Details</h4>
                                                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    
                                                                                    <!-- NOTE: Adjust the 'action' URL to your actual form handler file -->
                                                                                    <form action="quill-photos" method="POST">
                                                                                        
                                                                                        <!-- Hidden field for identification -->
                                                                                        <input type="hidden" name="contact_id" value="<?php echo safe_output($data['id']); ?>">
                                                                                        <!-- Hidden field for identification -->
                                                                                        <input type="hidden" name="UpdateContact" value="1">
                                                                                        
                                                                                        <h5 class="text-info mb-1 mt-2">I. Location & Contact Headers</h5>
                                                                    
                                                                                        <!-- FOLLOW HEADER (General Title) -->
                                                                                        <div class="form-group">
                                                                                            <label for="followHeader">Follow Us Header:</label>
                                                                                            <input type="text" class="form-control" id="followHeader" name="follow_header" placeholder="e.g., Follow Our Journey" maxlength="255" value="<?php echo safe_output($data['follow_header']); ?>">
                                                                                        </div>
                                                                    
                                                                                        <div class="row">
                                                                                            <div class="col-md-4 form-group">
                                                                                                <label for="locationHeader">Location Header:</label>
                                                                                                <input type="text" class="form-control" id="locationHeader" name="location_header" placeholder="e.g., Find Us" maxlength="255" value="<?php echo safe_output($data['location_header']); ?>">
                                                                                            </div>
                                                                                            <div class="col-md-4 form-group">
                                                                                                <label for="mailHeader">Mail Header:</label>
                                                                                                <input type="text" class="form-control" id="mailHeader" name="mail_header" placeholder="e.g., Email Us" maxlength="255" value="<?php echo safe_output($data['mail_header']); ?>">
                                                                                            </div>
                                                                                            <div class="col-md-4 form-group">
                                                                                                <label for="callHeader">Call Header:</label>
                                                                                                <input type="text" class="form-control" id="callHeader" name="call_header" placeholder="e.g., Give Us A Call" maxlength="255" value="<?php echo safe_output($data['call_header']); ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        <h5 class="text-info mb-1 mt-2">II. Core Contact Details</h5>
                                                                                        
                                                                                        <!-- LOCATION (Textarea) -->
                                                                                        <div class="form-group">
                                                                                            <label for="locationText">Physical Location/Address:</label>
                                                                                            <textarea class="form-control" id="locationText" name="location" placeholder="Enter full physical address" rows="3"><?php echo safe_output($data['location']); ?></textarea>
                                                                                        </div>
                                                                    
                                                                                        <div class="row">
                                                                                            <!-- EMAIL ADDRESS -->
                                                                                            <div class="col-md-4 form-group">
                                                                                                <label for="mailAddress">Email Address:</label>
                                                                                                <input type="email" class="form-control" id="mailAddress" name="mail" placeholder="e.g., support@example.com" maxlength="255" value="<?php echo safe_output($data['mail']); ?>">
                                                                                            </div>
                                                                                            <!-- PHONE NUMBER -->
                                                                                            <div class="col-md-4 form-group">
                                                                                                <label for="callNumber">Phone Number:</label>
                                                                                                <input type="text" class="form-control" id="callNumber" name="call" placeholder="e.g., +1 (555) 123-4567" maxlength="255" value="<?php echo safe_output($data['call']); ?>">
                                                                                            </div>

                                                                                            <!-- PHONE NUMBER -->
                                                                                            <div class="col-md-4 form-group">
                                                                                                <label for="callNumber">Follow @:</label>
                                                                                                <input type="text" class="form-control" id="callNumber" name="follow" placeholder="@HellentorAmstaff" maxlength="255" value="<?php echo safe_output($data['follow']); ?>">
                                                                                            </div>
                                                                                        </div>
                                                                    
                                                                                        <!-- GPS MAP URL (Textarea) -->
                                                                                        <div class="form-group">
                                                                                            <label for="gpsMapUrl">GPS Map URL (iFrame/Link):</label>
                                                                                            <textarea class="form-control" id="gpsMapUrl" name="gps_map_url" placeholder="Paste the embed or direct URL for the map location" rows="4"><?php echo safe_output($data['gps_map_url']); ?></textarea>
                                                                                            <small class="form-text text-muted">Use the embed code or direct URL from Google Maps, etc.</small>
                                                                                        </div>
                                                                    
                                                                                        <h5 class="text-info mb-1 mt-4 border-top pt-1">III. Social Media Links</h5>
                                                                    
                                                                                        <?php for ($i = 1; $i <= 4; $i++): ?>
                                                                                        <div class="row mb-3">
                                                                                            <div class="col-md-4 form-group mb-0">
                                                                                                <label for="smName<?php echo $i; ?>">SM <?php echo $i; ?> Name (e.g., facebook):</label>
                                                                                                <input type="text" class="form-control" id="smName<?php echo $i; ?>" name="sm_<?php echo $i; ?>" placeholder="Icon Name (e.g., twitter)" maxlength="255" value="<?php echo safe_output($data["sm_{$i}"]); ?>">
                                                                                            </div>
                                                                                            <div class="col-md-8 form-group mb-0">
                                                                                                <label for="smLink<?php echo $i; ?>">SM <?php echo $i; ?> Link (URL):</label>
                                                                                                <input type="text" class="form-control" id="smLink<?php echo $i; ?>" name="sm_link<?php echo $i; ?>" placeholder="Full URL (e.g., https://...)" value="<?php echo safe_output($data["sm_link{$i}"]); ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php endfor; ?>
                                                                                        
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
                                                    </div>
                                                </div> 
                                            </div>
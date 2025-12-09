<div role="tabpanel" class="tab-pane" id="account-vertical-terms" aria-labelledby="account-pill-terms" aria-expanded="false">

                                                <!-- TERMS AND CONDITIONS -->
 
                                                 
                                                    <h4 class="form-section"><i class="fa fa-media"></i> TERMS AND CONDITIONS</h4> 

                                                    <?php
// NOTE: This file assumes $conn (the database connection object, e.g., MySQLi)
// is already defined and available in the scope where this code is included.

// Define the document key we want to display (e.g., 'terms_of_use' or 'privacy_policy')
$doc_key_to_fetch = 'terms_of_use';

// 1. Database Query for the Active Terms and Conditions
// Fetches the title, full content, and effective date for the currently active version of the document key.
$sql = "SELECT title, content, effective_date
        FROM quill_terms_conditions
        WHERE doc_key = ? AND is_active = 1
        ORDER BY effective_date DESC
        LIMIT 1";

// Prepare the statement to prevent SQL injection (Recommended practice)
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    // Handle prepare error
    echo "<p class='text-danger'>SQL Prepare failed: " . $conn->error . "</p>";
    $result = (object) ['num_rows' => 0]; // Create dummy object for safe check below
} else {
    // Bind the parameter (s = string)
    $stmt->bind_param("s", $doc_key_to_fetch);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result set
    $result = $stmt->get_result();

    // Check for query errors (though already checked by prepare, good for execution errors)
    if ($result === false) {
        echo "<p class='text-danger'>Database query failed during execution.</p>";
        $result = (object) ['num_rows' => 0];
    }
}
?>

<div class="row">
    <div class="col-md-12 form-group">
        <?php
        $title = "Loading...";
        $content = "Document content is unavailable at this time.";
        $effective_date_display = "";

        if (isset($result) && $result->num_rows > 0) {
            // Fetch the single active row
            $row = $result->fetch_assoc();
            
            // Extract and sanitize the data
            $title = htmlspecialchars($row['title']);
            $content = $row['content']; // Displaying raw content (assumed safe HTML)
            
            $effective_date = $row['effective_date'];
            if (!empty($effective_date)) {
                // Format the effective date for display
                $effective_date_display = "<small class='text-muted'>Effective Date: " . date('F j, Y', strtotime($effective_date)) . "</small>";
            }
            
            // Close the statement
            $stmt->close();

        } else if (isset($stmt)) {
            // Close the statement if it was prepared but no rows found
            $stmt->close();
            $title = "Terms of Use Not Found";
        }
        ?>
        
        <div class="card shadow-sm border-0 rounded-lg">
            <div class="card-header bg-white border-bottom p-4">
                <h2 class="card-title text-primary mb-1"><?php echo $title; ?></h2>
                <?php echo $effective_date_display; ?>
            </div>
            <div class="card-body p-4">
                <!-- Display the document content -->
                <div class="terms-content">
                    <?php 
                        // Note: If the content is stored as simple markdown or plain text, 
                        // you might want to wrap it in nl2br() or parse it here.
                        // Assuming the LONGTEXT field stores HTML or rich text:
                        echo $content; 
                    ?>
                </div>

                <?php if ($result->num_rows === 0): ?>
                    <p class="text-center text-muted mt-3">The active document for '<?php echo htmlspecialchars($doc_key_to_fetch); ?>' could not be loaded from the database.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
                                            </div>
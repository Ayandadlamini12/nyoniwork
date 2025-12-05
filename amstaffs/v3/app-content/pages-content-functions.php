<?php
/**
 * Updates a specific content section for a page using INSERT...ON DUPLICATE KEY UPDATE.
 *
 * @param mysqli $conn The database connection object.
 * @param string $page_key The page key (e.g., 'home_page').
 * @param string $section_key The content block key (e.g., 'hero_headline').
 * @param string $new_value The new content value.
 * @return bool True on success, false on failure.
 */
function updatePageContent($conn, $page_key, $section_key, $new_value) {
    // 1. Sanitize the value for database storage (essential for security and integrity)
    // We use htmlspecialchars to prevent XSS and ensure special characters are stored correctly.
    $safe_value = htmlspecialchars($new_value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // 2. Prepare the statement for atomic update/insert
    $stmt = $conn->prepare("
        INSERT INTO pages_content (page_key, section_key, content_value, content_type)
        VALUES (?, ?, ?, 'text') 
        ON DUPLICATE KEY UPDATE content_value = ?
    ");
    
    if (!$stmt) {
        error_log("Failed to prepare statement for updatePageContent: " . $conn->error);
        return false;
    }

    // Bind parameters: 'ssss' means four strings (page_key, section_key, content_value, content_value)
    $stmt->bind_param("ssss", $page_key, $section_key, $safe_value, $safe_value);
    
    $success = $stmt->execute();
    $stmt->close();
    
    if (!$success) {
        error_log("Failed to execute updatePageContent: " . $stmt->error);
    }
    
    return $success;
}

$content = [];
    if (isset($conn) && $conn) {
        // Use prepared statements for security and efficiency
        $stmt = $conn->prepare("SELECT section_key, content_value FROM pages_content WHERE page_key = ?");
        
        if ($stmt === false) {
             // Failed to prepare the statement (database error)
             $message .= '<div class="alert alert-danger">Database query preparation failed: ' . $conn->error . '</div>';
        } else {
            // Bind the page key and execute the query
            $stmt->bind_param("s", $page_key);
            $stmt->execute();
            $result = $stmt->get_result();

            // Loop through results and populate the $content associative array
            // Keys (section_key) become array indices, Values (content_value) become array values.
            while ($row = $result->fetch_assoc()) {
                $content[$row['section_key']] = $row['content_value'];
            }
            $stmt->close();
        }
    } else {
        // Warning if the database connection failed
        $message .= '<div class="alert alert-warning">Warning: Database connection ($conn) is not available. Using default/empty content.</div>';
    }
    // -------------------------------------------------------------------------
    // --- END: DATABASE CONTENT RETRIEVAL ---
?>
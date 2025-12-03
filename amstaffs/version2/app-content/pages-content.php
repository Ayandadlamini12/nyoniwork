<?php
    // Assuming this loads the database connection ($conn) and session info.
    require('includes-request.php'); 
 
    /**
      * Updates a specific content section for a page using INSERT...ON DUPLICATE KEY UPDATE.
      *
      * @param mysqli $conn The database connection object.
      * @param string $page_key The page key (e.g., 'home_page').
      * @param string $section_key The content block key (e.g., 'hero_headline').
      * @param string $new_value The new content value.
      * @return bool True on success, false on failure.
      */

    // Define a comprehensive list of approximately 200 Bootstrap Icons, grouped for clarity.
    $icons = [
        // Group 1: Pet/Animal & Common Symbols (Approx 25)
        'bi-house-heart-fill' => 'Home Heart',
        'bi-star' => 'Star',
        'bi-cloud-sun-fill' => 'Sun Cloud',
        'bi-tree-fill' => 'Tree',
        'bi-flower1' => 'Flower',
        'bi-heart-fill' => 'Heart',
        'bi-cup-hot-fill' => 'Hot Cup',
        'bi-stars' => 'Stars',
        'bi-moon-stars-fill' => 'Moon Stars',
        'bi-umbrella-fill' => 'Umbrella',
        'bi-gift-fill' => 'Gift',
        'bi-globe2' => 'Globe',
        'bi-fire' => 'Fire',
        'bi-water' => 'Water',
        'bi-brightness-high-fill' => 'Sun',
        'bi-gem' => 'Gemstone',
        'bi-bell-fill' => 'Bell Alert',
        'bi-award' => 'Award',
        'bi-mortarboard-fill' => 'Graduation Cap',
        'bi-book-half' => 'Book',
        'bi-camera-fill' => 'Camera',
        'bi-film' => 'Film',
        'bi-music-note-list' => 'Music List',
        'bi-mic-fill' => 'Microphone',
        'bi-headphones' => 'Headphones',
        'bi-puzzle-fill' => 'Puzzle',
    
        // Group 2: Business & Finance (Approx 35)
        'bi-briefcase-fill' => 'Briefcase',
        'bi-currency-dollar' => 'Dollar Sign',
        'bi-cash-coin' => 'Cash Coin',
        'bi-wallet2' => 'Wallet',
        'bi-bank' => 'Bank',
        'bi-receipt-cutoff' => 'Receipt',
        'bi-piggy-bank-fill' => 'Piggy Bank',
        'bi-bar-chart-line-fill' => 'Line Chart (Growth)',
        'bi-pie-chart-fill' => 'Pie Chart',
        'bi-calculator' => 'Calculator', 
        'bi-building-fill' => 'Building',
        'bi-shop-window' => 'Shop Window',
        'bi-truck' => 'Delivery Truck',
        'bi-box-seam-fill' => 'Warehouse Box',
        'bi-box-fill' => 'Box',
        'bi-arrow-bar-right' => 'Sign In',
        'bi-arrow-bar-left' => 'Sign Out',
        'bi-people' => 'Users',
        'bi-person-badge-fill' => 'ID Card',
        'bi-clipboard-check-fill' => 'Clipboard Check',
        'bi-card-checklist' => 'Tasks',
        'bi-diagram-3-fill' => 'Diagram',
        'bi-chat-left-text-fill' => 'Comments',
        'bi-megaphone-fill' => 'Bullhorn (Marketing)',
        'bi-send-fill' => 'Paper Plane (Send)',
        'bi-lightbulb' => 'Lightbulb',
        'bi-share-fill' => 'Share',
        'bi-shield-lock-fill' => 'Lock Shield',
        'bi-fingerprint' => 'Fingerprint',
        'bi-calendar-check-fill' => 'Calendar Check',
        'bi-clock-fill' => 'Clock',
        'bi-stopwatch-fill' => 'Stopwatch',
        'bi-credit-card-fill' => 'Credit Card',
        'bi-tags-fill' => 'Tags',
    
        // Group 3: Technology & Web (Approx 40)
        'bi-code-slash' => 'Code Brackets',
        'bi-display-fill' => 'Desktop Monitor',
        'bi-phone-fill' => 'Mobile Phone',
        'bi-hdd-stack-fill' => 'Server Stack',
        'bi-database-fill' => 'Database',
        'bi-wifi' => 'WiFi',
        'bi-rss' => 'RSS Feed',
        'bi-ethernet' => 'Ethernet',
        'bi-keyboard-fill' => 'Keyboard',
        'bi-mouse-fill' => 'Mouse',
        'bi-tablet-fill' => 'Tablet',
        'bi-laptop-fill' => 'Laptop',
        'bi-terminal-fill' => 'Terminal',
        'bi-bug-fill' => 'Bug (Debug)',
        'bi-wrench' => 'Wrench',
        'bi-tools' => 'Tools',
        'bi-gear-fill' => 'Gear (Cogs)',
        'bi-robot' => 'Robot (AI)',
        'bi-cpu-fill' => 'Microchip',
        'bi-power' => 'Power Off',
        'bi-save-fill' => 'Save (Disk)',
        'bi-cloud-arrow-up-fill' => 'Upload',
        'bi-cloud-arrow-down-fill' => 'Download',
        'bi-link-45deg' => 'Link',
        'bi-link' => 'Unlink',
        'bi-envelope-fill' => 'Envelope (Mail)',
        'bi-at' => 'At Symbol (@)',
        'bi-hash' => 'Hashtag',
        'bi-qr-code' => 'QR Code',
        'bi-upc-scan' => 'Barcode',
        'bi-search' => 'Search',
        'bi-funnel-fill' => 'Filter',
        'bi-sliders' => 'Sliders (Settings)',
        'bi-arrows-angle-contract' => 'Compress',
        'bi-arrows-angle-expand' => 'Expand',
        'bi-arrow-repeat' => 'Sync/Refresh',
        'bi-arrow-counterclockwise' => 'Undo',
        'bi-arrow-clockwise' => 'Redo',
        'bi-trash-fill' => 'Trash/Delete',
        'bi-folder-fill' => 'Folder',
    
        // Group 4: Creative & Media (Approx 35)
        'bi-images' => 'Images',
        'bi-collection-play-fill' => 'Video Collection',
        'bi-volume-up-fill' => 'Volume Up',
        'bi-volume-mute-fill' => 'Volume Mute',
        'bi-play-circle-fill' => 'Play Button',
        'bi-pause-circle-fill' => 'Pause Button',
        'bi-stop-circle-fill' => 'Stop Button',
        'bi-disc-fill' => 'Compact Disc',
        'bi-palette-fill' => 'Palette (Art)',
        'bi-brush-fill' => 'Paint Brush',
        'bi-compass-fill' => 'Compass',
        'bi-pencil-fill' => 'Pencil',
        'bi-blockquote-left' => 'Quote',
        'bi-pin-fill' => 'Thumbtack',
        'bi-scissors' => 'Scissors (Cut)',
        'bi-magic' => 'Magic Wand',
        'bi-controller' => 'Gamepad',
        'bi-dice-5-fill' => 'Dice',
        'bi-journals' => 'Journals',
        'bi-router-fill' => 'Router',
        'bi-activity' => 'Activity',
        'bi-grid-fill' => 'Grid',
        'bi-list-ul' => 'List',
        'bi-question-diamond-fill' => 'Question Diamond',
        'bi-info-circle-fill' => 'Info Circle',
        'bi-exclamation-triangle-fill' => 'Warning',
        'bi-check-circle-fill' => 'Check Circle',
        'bi-x-circle-fill' => 'Times Circle',
        'bi-plus-circle-fill' => 'Plus Circle',
        'bi-dash-circle-fill' => 'Minus Circle',
        'bi-toggle-on' => 'Toggle On',
        'bi-toggle-off' => 'Toggle Off',
        'bi-map-fill' => 'Map',
        'bi-geo-alt-fill' => 'Map Marker',
        'bi-bookmarks-fill' => 'Bookmarks',
    
        // Group 5: Health, Transport & Safety (Approx 35) 
        'bi-hospital-fill' => 'Hospital',
        'bi-bandaid-fill' => 'First Aid',
        'bi-capsule-pill' => 'Pills',
        'bi-eyedropper' => 'Syringe',
        'bi-person-vcard-fill' => 'Doctor Card',
        'bi-lungs-fill' => 'Lungs',
        'bi-virus' => 'Virus',
        'bi-car-front-fill' => 'Car',
        'bi-airplane-fill' => 'Plane',
        'bi-tsunami' => 'Ship',
        'bi-bicycle' => 'Bicycle',
        'bi-bus-front-fill' => 'Bus',
        'bi-train-front-fill' => 'Train/Subway', 
        'bi-sign-stop-fill' => 'Stop Sign',
        'bi-tools' => 'Tools',
        'bi-life-preserver' => 'Life Ring',
        'bi-shield-check' => 'Shield Check', 
        'bi-person-fill-lock' => 'Person Locked',
        'bi-key-fill' => 'Key',
        'bi-unlock-fill' => 'Unlock',
        'bi-megaphone-fill' => 'Megaphone',
        'bi-broadcast-pin' => 'Broadcast Pin',
        'bi-tv-fill' => 'Television',
        'bi-router-fill' => 'Router',
        'bi-speedometer2' => 'Speedometer',
        'bi-hand-thumbs-up-fill' => 'Thumbs Up',
        'bi-hand-thumbs-down-fill' => 'Thumbs Down',
        'bi-person-arms-up' => 'Person Happy',
        'bi-person-fill-gear' => 'User Settings',
        'bi-person-fill-check' => 'User Check',
        'bi-person-fill-x' => 'User Remove',
        'bi-person-heart' => 'User Heart',
    
        // Group 6: Fitness, Food & Misc (Approx 30)
        'bi-person-walking' => 'Walking', 
        'bi-person-wheelchair' => 'Wheelchair',
        'bi-trophy-fill' => 'Trophy',
        'bi-heart-pulse-fill' => 'Heartbeat', 
        'bi-egg-fill' => 'Egg',
        'bi-cookie' => 'Cookie', 
        'bi-basket-fill' => 'Shopping Basket',
        'bi-cart-fill' => 'Shopping Cart',
        'bi-currency-exchange' => 'Exchange',
        'bi-recycle' => 'Recycle',
        'bi-thunderbolt-fill' => 'Lightning Bolt',
        'bi-plug-fill' => 'Plug',
        'bi-magnet-fill' => 'Magnet',
        'bi-binoculars-fill' => 'Binoculars',
        'bi-rulers' => 'Ruler',
        'bi-scissors' => 'Scissors',
        'bi-signpost-2-fill' => 'Signpost',
        'bi-hourglass-split' => 'Hourglass',
        'bi-trash2-fill' => 'Trash Can',
        'bi-printer-fill' => 'Printer',
        'bi-globe-asia-australia-fill' => 'Globe Asia',
        'bi-wifi-off' => 'Wifi Off',
        'bi-battery-full' => 'Battery Full',
        'bi-graph-up' => 'Graph-Up',
        'bi-graph-up' => 'Graph-Up',
    ];
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
 
    // Data Keys for the current page being edited
    // NOTE: This assumes page_key and page_name are passed via GET/REQUEST from your CMS dashboard
    $page_key = $_REQUEST['page_key'] ?? 'home_page'; // Default to 'home_page' if missing
    $page_name = $_REQUEST['page_name'] ?? 'Home';
    $message = '';

    // Array of all editable fields used in the CMS form (matching the section_key in pages_content)
    // Array of all editable fields used in the CMS form (matching the section_key in pages_content)
    $editable_fields = [
        // SECTION 1: HERO AREA
        'hero_headline' => 'Hero Section Headline',
        'hero_description' => 'Hero Section Description',
        // 'hero_image_path' => 'Hero Image Path (Image handling needs separate logic)', // Exclude image for now

        // SECTION 2: FLOATING METRICS
        'metric_kusa_number' => 'KUSA Metric Number (e.g., 100%)',
        'metric_kusa_label' => 'KUSA Metric Label',
        'metric_years_number' => 'Years Metric Number (e.g., 25+)',
        'metric_years_label' => 'Years Metric Label',
        
        // SECTION 3: HERO FEATURES (NEW SECTION)
        'feature_1_icon' => 'Feature 1 Icon Class',
        'feature_1_title' => 'Feature 1 Title',
        'feature_1_text' => 'Feature 1 Text',
        
        'feature_2_icon' => 'Feature 2 Icon Class',
        'feature_2_title' => 'Feature 2 Title',
        'feature_2_text' => 'Feature 2 Text',
        
        'feature_3_icon' => 'Feature 3 Icon Class',
        'feature_3_title' => 'Feature 3 Title',
        'feature_3_text' => 'Feature 3 Text',
        
        'feature_4_icon' => 'Feature 4 Icon Class',
        'feature_4_title' => 'Feature 4 Title',
        'feature_4_text' => 'Feature 4 Text',

        // SECTION 4: FEATURED SERVICES
        'service_1_title' => 'Service 1 Title',
        'service_1_text' => 'Service 1 Text',
        'service_1_icon' => 'Service 1 Icon Class',
        
        'service_2_title' => 'Service 2 Title',
        'service_2_text' => 'Service 2 Text',
        'service_2_icon' => 'Service 2 Icon Class',

        'service_3_title' => 'Service 3 Title',
        'service_3_text' => 'Service 3 Text',
        'service_3_icon' => 'Service 3 Icon Class',
        
        'service_4_title' => 'Service 4 Title',
        'service_4_text' => 'Service 4 Text',
        'service_4_icon' => 'Service 4 Icon Class',
    ];

    
    /**
     * Fetches all content for a given page key.
     * Moved from the conversational history, ensuring it uses the global $conn object.
     * @param mysqli $conn The database connection object.
     * @param string $page_key The unique key for the page (e.g., 'home_page').
     * @return array An associative array of content: [section_key => content_value]
     */
    function getPageContent($conn, $page_key) {
        $content = [];
        // Use prepared statement to prevent SQL injection
        // The error you previously encountered was likely due to $stmt->bind_param("s", $data_key0); 
        // using an uninitialized variable, so we correct it to use the function's $page_key parameter.
        $stmt = $conn->prepare("SELECT section_key, content_value FROM pages_content WHERE page_key = ?");
        
        if (!$stmt) {
             error_log("getPageContent preparation failed: " . $conn->error);
             return $content; 
        }

        $stmt->bind_param("s", $page_key);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Store content with section_key as the key
                $content[$row['section_key']] = htmlspecialchars_decode($row['content_value']);
            }
        }
        $stmt->close();
        return $content;
    }

    
    // 1. Handle POST Request (Updating Content)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $all_updates_successful = true;

        foreach ($editable_fields as $key => $label) {
            $new_value = $_POST[$key] ?? '';
            
            // Call the function from the included file
            if (!updatePageContent($conn, $page_key, $key, $new_value)) {
                $message .= "Error updating {$label}.<br>";
                $all_updates_successful = false;
            }
        }

        if ($all_updates_successful && empty($message)) {
            $message = "All content for '{$page_name}' updated successfully!";
        } else if (!$all_updates_successful) {
             $message = "Some updates failed. Check logs for details. " . $message;
        }
    }

    // 2. Fetch the latest content for the form fields
    // This runs on first load OR after a successful POST to show the latest values
    $content = getPageContent($conn, $page_key);

    /**
     * 
    * Helper function to render the initial selected icon and the full list of options.
    * This is used for the custom HTML structure.
    */
    function hero_render_icon_picker_html($hero_number, $content, $icons) {
        $field_name = 'herofeature_' . $hero_number . '_icon';
        
        // --- STEP 1: RETRIEVE THE SAVED VALUE ---
        // If a value exists in the $content array (from MySQL), use it.
        // Otherwise, default to 'bi-star'.
        $current_icon_class = $content[$field_name] ?? 'bi-star';
        
        // Look up the human-readable label for the icon.
        $current_icon_label = $icons[$current_icon_class] ?? 'Star';
                                                        
        // Ensure we have a valid default if the stored value is missing or invalid
        if (!isset($icons[$current_icon_class])) {
            $current_icon_class = 'bi-star';
            $current_icon_label = 'Star';
        }
                                                        
        $html = "<div class=\"custom-icon-picker\" data-target=\"{$field_name}\">";
                                                        
        // --- STEP 2: RENDER THE VISIBLE DISPLAY WITH THE SAVED ICON ---
        // This is the element the user sees initially, showing the current value.
        $html .= "<div class=\"picker-display square\" data-selected-value=\"{$current_icon_class}\">";
        // The key part: the database value is placed directly into the <i> tag's class.
        $html .= "<i class=\"bi {$current_icon_class}\"></i> <span class=\"icon-label\">{$current_icon_label}</span>";
        $html .= "</div>";
                                                        
        // --- STEP 3: RENDER ALL OPTIONS (HIDDEN BY DEFAULT), ADDING ACTIVE CLASS TO SELECTED ITEM ---
        // This list contains all possible icons.
        $html .= "<ul class=\"picker-options\">";
        foreach ($icons as $value => $label) {
            
            // Check if this option matches the currently selected value from the database
            $is_active = ($value === $current_icon_class) ? ' active' : '';
                                                        
            $html .= "<li data-value=\"{$value}\" data-label=\"{$label}\" class=\"icon-option{$is_active}\">";
            $html .= "<i class=\"bi {$value}\"></i> {$label}";
            $html .= "</li>";
        }
        $html .= "</ul>";
                                                        
        // Hidden input field to store the actual value for form submission
        $html .= "<input type=\"hidden\" name=\"{$field_name}\" id=\"{$field_name}\" value=\"{$current_icon_class}\">";
        $html .= "</div>";
                                                        
        return $html;
     }
     // SERVICES RENDER
    function render_icon_picker_html($service_number, $content, $icons) {
        $field_name = 'service_' . $service_number . '_icon';
        
        // --- STEP 1: RETRIEVE THE SAVED VALUE ---
        // If a value exists in the $content array (from MySQL), use it.
        // Otherwise, default to 'bi-star'.
        $current_icon_class = $content[$field_name] ?? 'bi-star';
        
        // Look up the human-readable label for the icon.
        $current_icon_label = $icons[$current_icon_class] ?? 'Star';
                                                        
        // Ensure we have a valid default if the stored value is missing or invalid
        if (!isset($icons[$current_icon_class])) {
            $current_icon_class = 'bi-star';
            $current_icon_label = 'Star';
        }
                                                        
        $html = "<div class=\"custom-icon-picker\" data-target=\"{$field_name}\">";
                                                        
        // --- STEP 2: RENDER THE VISIBLE DISPLAY WITH THE SAVED ICON ---
        // This is the element the user sees initially, showing the current value.
        $html .= "<div class=\"picker-display square\" data-selected-value=\"{$current_icon_class}\">";
        // The key part: the database value is placed directly into the <i> tag's class.
        $html .= "<i class=\"bi {$current_icon_class}\"></i> <span class=\"icon-label\">{$current_icon_label}</span>";
        $html .= "</div>";
                                                        
        // --- STEP 3: RENDER ALL OPTIONS (HIDDEN BY DEFAULT), ADDING ACTIVE CLASS TO SELECTED ITEM ---
        // This list contains all possible icons.
        $html .= "<ul class=\"picker-options\">";
        foreach ($icons as $value => $label) {
            
            // Check if this option matches the currently selected value from the database
            $is_active = ($value === $current_icon_class) ? ' active' : '';
                                                        
            $html .= "<li data-value=\"{$value}\" data-label=\"{$label}\" class=\"icon-option{$is_active}\">";
            $html .= "<i class=\"bi {$value}\"></i> {$label}";
            $html .= "</li>";
        }
        $html .= "</ul>";
                                                        
        // Hidden input field to store the actual value for form submission
        $html .= "<input type=\"hidden\" name=\"{$field_name}\" id=\"{$field_name}\" value=\"{$current_icon_class}\">";
        $html .= "</div>";
                                                        
        return $html;
     }
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Page Content . Helentor Amstaffs</title>
    <link rel="apple-touch-icon" href="../assets/img/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-callout.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

    <style type="text/css">
        /* General alert styling */
        .alert {
            padding: 20px 25px;
            margin: 20px 0;
            border-radius: 12px; /* Smooth rounded corners */
            position: relative;
            color: #fff; /* White text */
            background: linear-gradient(135deg, #343a40, #495057); /* Purple gradient */
            border: none; /* No solid border */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px;
            font-weight: 500;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2); /* Soft shadow */
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
    
        /* Hover effect */
        .alert:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }
    
        /* Close button styling */
        .alert .close {
            position: absolute;
            top: 12px;
            right: 15px;
            border: none;
            background: none;
            font-size: 22px;
            cursor: pointer;
            color: #fff;
            transition: transform 0.2s ease, color 0.2s ease;
        }
    
        /* Hover effect for close button */
        .alert .close:hover {
            color: #ff4081; /* Pinkish hover */
            transform: rotate(90deg); /* Rotates when hovered */
        }
    
        /* CSS for the Custom Icon Picker Component */
        .custom-icon-picker {
            position: relative;
            cursor: pointer;
        }
        
        .picker-display {
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            height: calc(1.5em + 0.75rem + 10px);
            border: 1px solid #d3dbe6;
            border-radius: 0;
            background-color: #fff;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        
        .picker-display:after {
            content: "\25BE"; /* Down arrow for dropdown look */
            margin-left: auto;
            font-size: 0.8rem;
            color: #495057;
        }
        
        .picker-display i {
            /* Updated selector for Bootstrap Icons */
            margin-right: 8px;
            font-size: 1.25rem;
            width: 20px; /* Ensure icon area is fixed */
            text-align: center;
        }
        
        .picker-options {
            position: absolute;
            z-index: 1000;
            width: 100%;
            max-height: 250px;
            overflow-y: auto;
            border: 1px solid #ced4da;
            border-top: none;
            background-color: #fff;
            list-style: none;
            padding: 0;
            margin-top: -1px; /* Overlap border */
            border-radius: 0 0 0.25rem 0.25rem;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            display: none; /* Hidden by default */
        }
        
        .picker-options.open {
            display: block;
        }
        
        .icon-option {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            transition: background-color 0.1s;
        }
        
        .icon-option:hover {
            background-color: #f8f9fa;
        }
        
        .icon-option i {
            /* Updated selector for Bootstrap Icons */
            margin-right: 10px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }
                                            
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <?php include ("includes-header.php"); ?>


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="navigation-header"><span>Helentor Amstaffs</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
                </li>
                <li class="nav-item"><a href="mi-dashboard"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Email Application">Dashboard</span></a>
                </li>
                <li class="active nav-item"><a href="javascript:void(0);"><i class="feather icon-globe"></i><span class="menu-title" data-i18n="Dashboard">Web Pages</span><span class="badge badge badge-primary badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="pages-manage" data-i18n="eCommerce">Manage Pages</a>
                        </li>
                        <li class="has-sub is-shown"><a class="menu-item" href="#" data-i18n="Vertical">Page Content</a>
                            <ul class="menu-content" style="">
                                
                                <?php 
                                    $selpages="SELECT * FROM pages ORDER BY page_nav DESC";
                                    $selresults = mysqli_query($conn,$selpages) or die(mysqli_error($con));
                                    while($selrow = mysqli_fetch_assoc($selresults)) { 
                                        
                                        $page_keyss0 = $selrow['page'];
                                        $page_keyss1 = $selrow['page_key'];  
 
                                ?>
                                <li class="active"><a class="menu-item" href="pages-content?page_key=<?php echo $page_keyss1;?>&page_name=<?php echo $page_keyss0;?>" data-i18n="Modern Menu"><?php echo $page_keyss0;?></a>
                                </li>
                                <?php } ?>
                                 
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="registration-manage"><i class="feather icon-user-check"></i>
                        <span class="menu-title" data-i18n="Email Application">Registration</span>
                        <span class="badge badge badge-danger badge-pill float-right mr-3">New</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="survey-manage"><i class="feather icon-check-circle"></i>
                        <span class="menu-title" data-i18n="Email Application">Surverys Info</span>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="appointments-manage"><i class="feather icon-calendar"></i>
                        <span class="menu-title" data-i18n="Email Application">Appointments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="slot-manage"><i class="feather icon-watch"></i>
                        <span class="menu-title" data-i18n="Email Application">Time Slots</span>
                    </a>
                </li> 

    
                <li class=" navigation-header"><span>Authentication</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i>
                </li>
                <li class="nav-item"><a href="account-settings"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Email Application">Manage Profile</span></a>
                </li> 
                <li class="nav-item">
                    <a href="users-manage">
                        <i class="feather icon-users"></i>
                        <span class="menu-title" data-i18n="Email Application">Manage Users</span>
                        <?php 
                            $har_survey0 ="SELECT COUNT(*) as total FROM users";
                            $har_survey1 = mysqli_query($conn,$har_survey0) or die(mysqli_error($con));
                            $har_survey2 = mysqli_fetch_assoc($har_survey1);                
                        ?>
                        <span class="badge badge badge-success badge-pill float-right mr-3"><?php echo $har_survey2['total'];?></span>
                    </a>
                </li>  
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Pages</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="mi-dashboard">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Manage</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Pages</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <a class="btn btn-primary square" href="mi-dashboard"><i class="feather icon-home"></i> Home Page</a>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">CMS: Update <?php echo $page_name; ?> Content</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <?php 
                                        if ($page_key == "home_page") {
                                    ?>
                                    <div class="card-body">
                                        <form class="form" method="POST" action="pages-content?page_key=<?php echo htmlspecialchars($data_key0); ?>&page_name=<?php echo htmlspecialchars($data_key1); ?>">

                                        <?php if ($message): ?>
                                            <div class="alert <?php echo str_contains($message, 'Error') ? 'alert-danger' : 'alert-success'; ?>">
                                                <?php echo $message; ?>
                                            </div>
                                        <?php endif; ?>
                                    
                                        <div class="form-body">
                                    
                                            <!-- =========================
                                                1. HERO SECTION
                                            ========================== --> 
                                            <h4 class="form-section"><i class="fa fa-pencil"></i> Hero Section (Headline & Description)</h4>
                                        
                                            <div class="form-group">
                                                <label for="hero_headline">Hero Section Headline</label>
                                                <input type="text"
                                                    id="hero_headline"
                                                    class="form-control square"
                                                    name="hero_headline"
                                                    value="<?php echo htmlspecialchars($content['hero_headline'] ?? ''); ?>"
                                                    required>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="hero_description">Hero Section Description</label>
                                                <textarea id="hero_description"
                                                        class="form-control square"
                                                        name="hero_description"
                                                        rows="3"
                                                        required><?php echo htmlspecialchars($content['hero_description'] ?? ''); ?></textarea>
                                            </div>
                                        
                                        
                                            <!-- =========================
                                                2. FLOATING METRICS (Existing Metrics)
                                            ========================== -->
                                            <h4 class="form-section"><i class="fa fa-line-chart"></i> Metrics (Hero Image)</h4>


                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <a href="javascript: void(0);">
                                                        <img src="../assets/img/home/about-8.webp" class="rounded mr-20" alt="profile image" height="683" width="1024">
                                                    </a>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <div class="media">
                                                        <div class="media-body mt-75">
                                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                <label class="btn btn-md btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer square" for="account-upload">Upload New Photo</label>
                                                                <input type="file" id="account-upload" name="profile" hidden accept="image/*">
                                                                <input type="hidden" name="id" value="<?php echo $getUserId;?>">
                                                            </div>
                                                            <p class="text-muted ml-75 mt-50"><small>Allowed .jpg, .png or .wepb Format & Preferred Dimensions: <b class="text-danger">(1024px x 683px)</b></small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="metric_kusa_number">Metric 1: Number (e.g., 100%)</label>
                                                    <input type="text"
                                                            id="metric_kusa_number"
                                                            class="form-control square"
                                                            name="metric_kusa_number"
                                                            value="<?php echo htmlspecialchars($content['metric_kusa_number'] ?? ''); ?>"
                                                            required>
                                                </div>
                                        
                                                <div class="col-md-6 form-group">
                                                    <label for="metric_kusa_label">Metric 1: Label (e.g., KUSA Registered)</label>
                                                    <input type="text"
                                                            id="metric_kusa_label"
                                                            class="form-control square"
                                                            name="metric_kusa_label"
                                                            value="<?php echo htmlspecialchars($content['metric_kusa_label'] ?? ''); ?>"
                                                            required>
                                                </div>
                                            </div>
                                        
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="metric_years_number">Metric 2: Number (e.g., 25+)</label>
                                                    <input type="text"
                                                            id="metric_years_number"
                                                            class="form-control square"
                                                            name="metric_years_number"
                                                            value="<?php echo htmlspecialchars($content['metric_years_number'] ?? ''); ?>"
                                                            required>
                                                </div>
                                        
                                                <div class="col-md-6 form-group">
                                                    <label for="metric_years_label">Metric 2: Label (e.g., Years Experience)</label>
                                                    <input type="text"
                                                            id="metric_years_label"
                                                            class="form-control square"
                                                            name="metric_years_label"
                                                            value="<?php echo htmlspecialchars($content['metric_years_label'] ?? ''); ?>"
                                                            required>
                                                </div>
                                            </div> 

                                            <!-- =========================================================================
                                              2.1 HERO FEATURED SERVICES (4 Items with Custom Visual Icon Pickers - Bootstrap Icons)
                                            ========================================================================== -->
                                            <h4 class="form-section"><i class="bi bi-gear-fill"></i> Hero Featured Services</h4>
                                             

                                            <!-- HERO FEATURE 1 --> 

                                            <div class="row">
                                                <div class="col-4">
                                                    <!-- Service 1 Icon Picker (Visual Icons) -->
                                                    <div class="form-group">
                                                        <label>Hero Feature 1 Icon</label>
                                                        <?php echo hero_render_icon_picker_html(1, $content, $icons); ?>
                                                    </div>
                                                </div>

                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="herofeature_1_title">Hero Feature 1 Title</label>
                                                        <input type="text" id="herofeature_1_title" class="form-control square" name="herofeature_1_title" value="<?php echo htmlspecialchars($content['herofeature_1_title'] ?? ''); ?>" required>
                                                    </div>
                                                </div> 

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="herofeature_1_text">Hero Feature 1 Text</label>
                                                        <textarea id="herofeature_1_text" class="form-control square" name="herofeature_1_text" rows="2" required><?php echo htmlspecialchars($content['herofeature_1_text'] ?? ''); ?></textarea>
                                                    </div>
                                                </div>

                                            </div>  
                                            
                                            <hr class="mb-2 my-0">

                                            <!-- HERO FEATURE 2 --> 

                                            <div class="row">
                                                <div class="col-4">
                                                    <!-- Service 2 Icon Picker (Visual Icons) -->
                                                    <div class="form-group">
                                                        <label>Hero Feature 2 Icon</label>
                                                        <?php echo hero_render_icon_picker_html(2, $content, $icons); ?>
                                                    </div>
                                                </div>

                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="herofeature_2_title">Hero Feature 2 Title</label>
                                                        <input type="text" id="herofeature_2_title" class="form-control square" name="herofeature_2_title" value="<?php echo htmlspecialchars($content['herofeature_2_title'] ?? ''); ?>" required>
                                                    </div>
                                                </div> 

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="herofeature_2_text">Hero Feature 2 Text</label>
                                                        <textarea id="herofeature_2_text" class="form-control square" name="herofeature_2_text" rows="2" required><?php echo htmlspecialchars($content['herofeature_2_text'] ?? ''); ?></textarea>
                                                    </div>
                                                </div>

                                            </div>  
                                            
                                            <hr class="mb-2 my-0">

                                            <!-- HERO FEATURE 3 --> 

                                            <div class="row">
                                                <div class="col-4">
                                                    <!-- Service 3 Icon Picker (Visual Icons) -->
                                                    <div class="form-group">
                                                        <label>Hero Feature 3 Icon</label>
                                                        <?php echo hero_render_icon_picker_html(3, $content, $icons); ?>
                                                    </div>
                                                </div>

                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="herofeature_3_title">Hero Feature 3 Title</label>
                                                        <input type="text" id="herofeature_3_title" class="form-control square" name="herofeature_3_title" value="<?php echo htmlspecialchars($content['herofeature_3_title'] ?? ''); ?>" required>
                                                    </div>
                                                </div> 

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="herofeature_3_text">Hero Feature 3 Text</label>
                                                        <textarea id="herofeature_3_text" class="form-control square" name="herofeature_3_text" rows="2" required><?php echo htmlspecialchars($content['herofeature_3_text'] ?? ''); ?></textarea>
                                                    </div>
                                                </div>

                                            </div>  
                                            
                                            <hr class="mb-2 my-0">

                                            <!-- HERO FEATURE 4 --> 

                                            <div class="row">
                                                <div class="col-4">
                                                    <!-- Service 4 Icon Picker (Visual Icons) -->
                                                    <div class="form-group">
                                                        <label>Hero Feature 4 Icon</label>
                                                        <?php echo hero_render_icon_picker_html(4, $content, $icons); ?>
                                                    </div>
                                                </div>

                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="herofeature_4_title">Hero Feature 4 Title</label>
                                                        <input type="text" id="herofeature_4_title" class="form-control square" name="herofeature_4_title" value="<?php echo htmlspecialchars($content['herofeature_4_title'] ?? ''); ?>" required>
                                                    </div>
                                                </div> 

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="herofeature_4_text">Hero Feature 4 Text</label>
                                                        <textarea id="herofeature_4_text" class="form-control square" name="herofeature_4_text" rows="2" required><?php echo htmlspecialchars($content['herofeature_4_text'] ?? ''); ?></textarea>
                                                    </div>
                                                </div>

                                            </div>  
                                            
                                            <hr class="my-0">

                                            <!-- =========================================================================
                                              3. FEATURED SERVICES (4 Items with Custom Visual Icon Pickers - Bootstrap Icons)
                                            ========================================================================== -->
                                            <h4 class="form-section"><i class="bi bi-gear-fill"></i> Featured Services</h4>
                                             

                                            <!-- SERVICE 1 --> 

                                            <div class="row">
                                                <div class="col-4">
                                                    <!-- Service 1 Icon Picker (Visual Icons) -->
                                                    <div class="form-group">
                                                        <label>Service 1 Icon</label>
                                                        <?php echo render_icon_picker_html(1, $content, $icons); ?>
                                                    </div>
                                                </div>

                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="service_1_title">Service 1 Title</label>
                                                        <input type="text" id="service_1_title" class="form-control square" name="service_1_title" value="<?php echo htmlspecialchars($content['service_1_title'] ?? ''); ?>" required>
                                                    </div>
                                                </div> 

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="service_1_text">Service 1 Text</label>
                                                        <textarea id="service_1_text" class="form-control square" name="service_1_text" rows="2" required><?php echo htmlspecialchars($content['service_1_text'] ?? ''); ?></textarea>
                                                    </div>
                                                </div>

                                            </div>  
                                            
                                            <hr class="mb-2 my-0">

                                            <!-- SERVICE 2 --> 

                                            <div class="row">
                                                <div class="col-4">
                                                    <!-- Service 2 Icon Picker (Visual Icons) -->
                                                    <div class="form-group">
                                                        <label>Service 2 Icon</label>
                                                        <?php echo render_icon_picker_html(2, $content, $icons); ?>
                                                    </div>
                                                </div>

                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="service_2_title">Service 2 Title</label>
                                                        <input type="text" id="service_2_title" class="form-control square" name="service_2_title" value="<?php echo htmlspecialchars($content['service_2_title'] ?? ''); ?>" required>
                                                    </div>
                                                </div> 

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="service_2_text">Service 2 Text</label>
                                                        <textarea id="service_2_text" class="form-control square" name="service_2_text" rows="2" required><?php echo htmlspecialchars($content['service_2_text'] ?? ''); ?></textarea>
                                                    </div>
                                                </div>

                                            </div>  
                                            
                                            <hr class="mb-2 my-0">

                                            <!-- SERVICE 3 --> 

                                            <div class="row">
                                                <div class="col-4">
                                                    <!-- Service 3 Icon Picker (Visual Icons) -->
                                                    <div class="form-group">
                                                        <label>Service 3 Icon</label>
                                                        <?php echo render_icon_picker_html(3, $content, $icons); ?>
                                                    </div>
                                                </div>

                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="service_3_title">Service 3 Title</label>
                                                        <input type="text" id="service_3_title" class="form-control square" name="service_3_title" value="<?php echo htmlspecialchars($content['service_3_title'] ?? ''); ?>" required>
                                                    </div>
                                                </div> 

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="service_3_text">Service 3 Text</label>
                                                        <textarea id="service_3_text" class="form-control square" name="service_3_text" rows="2" required><?php echo htmlspecialchars($content['service_3_text'] ?? ''); ?></textarea>
                                                    </div>
                                                </div>

                                            </div>  
                                            
                                            <hr class="mb-2 my-0">

                                            <!-- SERVICE 4 --> 

                                            <div class="row">
                                                <div class="col-4">
                                                    <!-- Service 4 Icon Picker (Visual Icons) -->
                                                    <div class="form-group">
                                                        <label>Service 4 Icon</label>
                                                        <?php echo render_icon_picker_html(4, $content, $icons); ?>
                                                    </div>
                                                </div>

                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="service_4_title">Service 4 Title</label>
                                                        <input type="text" id="service_4_title" class="form-control square" name="service_4_title" value="<?php echo htmlspecialchars($content['service_4_title'] ?? ''); ?>" required>
                                                    </div>
                                                </div> 

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="service_4_text">Service 4 Text</label>
                                                        <textarea id="service_4_text" class="form-control square" name="service_4_text" rows="2" required><?php echo htmlspecialchars($content['service_4_text'] ?? ''); ?></textarea>
                                                    </div>
                                                </div>

                                            </div>  
                                            
                                            <hr class="my-0">
                                            
                                            
                                            
                                            
                                            <script>
                                                document.addEventListener('DOMContentLoaded', () => {
                                                // Select all custom icon picker components
                                                const pickers = document.querySelectorAll('.custom-icon-picker');
                                            
                                                pickers.forEach(picker => {
                                                    const display = picker.querySelector('.picker-display');
                                                    const optionsList = picker.querySelector('.picker-options');
                                                    const hiddenInput = picker.querySelector('input[type="hidden"]');
                                            
                                                    // Toggle the options list visibility when the display element is clicked
                                                    display.addEventListener('click', (e) => {
                                                        // Close all other open lists
                                                        document.querySelectorAll('.picker-options.open').forEach(openlist => {
                                                            if (openlist !== optionsList) {
                                                                openlist.classList.remove('open');
                                                            }
                                                        });
                                            
                                                        optionsList.classList.toggle('open');
                                                        e.stopPropagation();
                                                    });
                                            
                                                    // Handle selection of an icon option
                                                    optionsList.querySelectorAll('.icon-option').forEach(option => {
                                                        option.addEventListener('click', (e) => {
                                                            const newValue = option.getAttribute('data-value'); // e.g., bi-star
                                                            const newLabel = option.getAttribute('data-label');
                                            
                                                            // 1. Update the hidden input field (the actual form value)
                                                            hiddenInput.value = newValue;
                                            
                                                            // 2. Update the visual display
                                                            const iconElement = display.querySelector('i');
                                                            const labelElement = display.querySelector('.icon-label');
                                            
                                                            // IMPORTANT: Update to use the 'bi' prefix and the new class
                                                            iconElement.className = `bi ${newValue}`;
                                                            labelElement.textContent = newLabel;
                                                            display.setAttribute('data-selected-value', newValue);
                                            
                                                            // 3. Close the options list
                                                            optionsList.classList.remove('open');
                                                            e.stopPropagation();
                                                        });
                                                    });
                                            
                                                    // Close the options list if user clicks outside the picker
                                                    document.addEventListener('click', (e) => {
                                                        if (!picker.contains(e.target) && optionsList.classList.contains('open')) {
                                                            optionsList.classList.remove('open');
                                                        }
                                                    });
                                                });
                                                });
                                            </script>
                
                                            <!-- =========================
                                                4. SKILLS SECTION (NEW)
                                            ========================== --> 
                                            <h4 class="form-section"><i class="fa fa-graduation-cap"></i> Skills Section</h4>
                
                                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                            <h5 class="mt-0">Skill <?php echo $i; ?></h5>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="skill_<?php echo $i; ?>_name">Skill <?php echo $i; ?> Name</label>
                                                    <input type="text"
                                                            id="skill_<?php echo $i; ?>_name"
                                                            class="form-control square"
                                                            name="skill_<?php echo $i; ?>_name"
                                                            value="<?php echo htmlspecialchars($content['skill_'.$i.'_name'] ?? ''); ?>"
                                                            placeholder="e.g., Breeding"
                                                            required>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="skill_<?php echo $i; ?>_value">Skill <?php echo $i; ?> Value (0-100)</label>
                                                    <input type="number"
                                                            id="skill_<?php echo $i; ?>_value"
                                                            class="form-control square"
                                                            name="skill_<?php echo $i; ?>_value"
                                                            value="<?php echo htmlspecialchars($content['skill_'.$i.'_value'] ?? ''); ?>"
                                                            min="0" max="100"
                                                            placeholder="e.g., 90"
                                                            required>
                                                </div>
                                            </div>
                                            <?php endfor; ?>
                
                                            <?php
 

                                            // ==========================================================================
                                            // 5. STATS SECTION (NEW) - HTML START
                                            // ==========================================================================
                                            ?>
                                            <h4 class="form-section"><i class="fa fa-calculator"></i> Statistics / Counter Section</h4>
                                            
                                            <?php
                                            /**
                                             * Renders the form group for a single Stat item with a number, unit, label, and description.
                                             * This is designed for the "Stats Section" form fields.
                                             *
                                             * @param int $index The stat number (1, 2, 3, or 4).
                                             * @param array $content Array of content data (e.g., $content['stat_1_number']).
                                             * @return void Outputs the HTML directly.
                                             */
                                            function render_stat_form_group(int $index, array $content) {
                                                // Generate dynamic keys based on your expected SQL section_key format (e.g., stat_1_number)
                                                $num_key = "stat_{$index}_number";
                                                $unit_key = "stat_{$index}_unit";
                                                $label_key = "stat_{$index}_label";
                                                $desc_key = "stat_{$index}_description";
                                                $label_prefix = "Stat {$index}";
                                                ?>
                                            
                                                <div class="card shadow-sm mb-0">
                                                    <div class="card-body">
                                                        <h6 class="card-title text-primary"><?php echo $label_prefix; ?> Details</h6>
                                            
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="<?php echo $num_key; ?>"><?php echo $label_prefix; ?> **Number/Value**</label>
                                                                    <input type="text" id="<?php echo $num_key; ?>" class="form-control square" name="<?php echo $num_key; ?>" value="<?php echo htmlspecialchars($content[$num_key] ?? ''); ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="<?php echo $unit_key; ?>"><?php echo $label_prefix; ?> Unit/Suffix</label>
                                                                    <input type="text" id="<?php echo $unit_key; ?>" class="form-control square" name="<?php echo $unit_key; ?>" value="<?php echo htmlspecialchars($content[$unit_key] ?? ''); ?>" placeholder="e.g., Ha, %, +, st" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                            
                                                        <div class="form-group">
                                                            <label for="<?php echo $label_key; ?>"><?php echo $label_prefix; ?> Label/Title</label>
                                                            <input type="text" id="<?php echo $label_key; ?>" class="form-control square" name="<?php echo $label_key; ?>" value="<?php echo htmlspecialchars($content[$label_key] ?? ''); ?>" required>
                                                        </div>
                                            
                                                        <div class="form-group">
                                                            <label for="<?php echo $desc_key; ?>"><?php echo $label_prefix; ?> Description</label>
                                                            <textarea id="<?php echo $desc_key; ?>" class="form-control square" name="<?php echo $desc_key; ?>" rows="2" required><?php echo htmlspecialchars($content[$desc_key] ?? ''); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <?php
                                                // Add a separator only if it's not the last stat block
                                                if ($index < 4): 
                                                ?>
                                                    <hr class="mb-0 my-0">
                                                <?php 
                                                endif;
                                            }
                                            
                                             
                                            
                                            // This loop is what executes the function and generates the form HTML.
                                            if (isset($content) && is_array($content)) {
                                                // We render 4 stat blocks.
                                                for ($i = 1; $i <= 4; $i++) {
                                                    render_stat_form_group($i, $content);
                                                }
                                            } else {
                                                // Fallback if the database content variable is not loaded.
                                                echo '<p class="alert alert-danger">Error: The $content data array is not available. Stats form fields cannot be populated.</p>';
                                            }
                                             
                                            ?>
                
                                            <!-- =========================
                                                6. CLIENTS SECTION (NEW)
                                            ========================== -->
                                            <h4 class="form-section"><i class="fa fa-users"></i> Clients / Logos Section</h4> 
                
                                            <div class="row">
                                                <?php 

                                                    // 2. SQL Query to fetch the images (Client Logos)
                                                    // We specifically target 'image' content_type and the 'client_logo_' section_keys
                                                    $sql = "SELECT id, content_value FROM pages_content WHERE page_key = 'home_page' AND content_type = 'image'AND section_key LIKE 'client_logo_%' ORDER BY id ASC";
                                                    
                                                    $result = $conn->query($sql);
                                                    ?>
                                                    
                                                    <div class="col-md-12 form-group"> 
                                                        <div class="image-gallery-container" style="display: flex; flex-wrap: wrap; gap: 20px;">
                                                            <?php
                                                            if ($result->num_rows > 0) {
                                                                // 3. Loop through the fetched results
                                                                while($row = $result->fetch_assoc()) {
                                                                    // $image_id is the unique ID from the database for deletion
                                                                    $image_id = htmlspecialchars($row['id']);
                                                                    // $image_path is the file path for display
                                                                    $image_path = htmlspecialchars($row['content_value']);
                                                            ?>
                                                                <div class="image-item" style="border: 1px solid #ccc; padding: 10px; text-align: center;">
                                                                    <img src="<?php echo $image_path; ?>" 
                                                                         class="rounded" 
                                                                         alt="Client image" 
                                                                         height="60" 
                                                                         width="120"
                                                                         style="display: block; margin-bottom: 10px;">
                                                                    
                                                                    <button class="btn btn-sm btn-danger btn-square delete-btn" data-id="<?php echo $image_id; ?>"onclick="confirmDelete(<?php echo $image_id; ?>)">
                                                                        <i class="fa fa-trash"></i> Delete
                                                                    </button>
                                                                </div>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "<p>No client logos found in the database.</p>";
                                                            }
                                                            // 5. Close the database connection
                                                            $conn->close();
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        // Simple JavaScript function to handle the confirmation and redirect
                                                        // For a production CMS, this would typically use AJAX
                                                        function confirmDelete(id) {
                                                            if (confirm('Are you sure you want to delete this image?')) {
                                                                // Redirects to a script that will handle the SQL DELETE query
                                                                window.location.href = 'delete_image.php?id=' + id;
                                                            }
                                                        }
                                                    </script>
                                                <div class="col-md-12 form-group">
                                                    <div class="media">
                                                        <div class="media-body mt-75">
                                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                <label class="btn btn-md btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer square" for="account-upload">Upload New Logos</label>
                                                                <input type="file" id="account-upload" name="profile" hidden accept="image/*">
                                                                <input type="hidden" name="id" value="<?php echo $getUserId;?>">
                                                            </div>
                                                            <p class="text-muted ml-75 mt-50"><small>Allowed .jpg, .png or .wepb Format & Preferred Dimensions: <b class="text-danger">(1024px x 683px)</b></small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                
                                        </div>
                                    
                                        <!-- FORM ACTIONS -->
                                        <div class="form-actions right mt-1">
                                            <button type="reset" class="btn btn-warning mr-1">
                                                <i class="feather icon-x"></i> Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check-square-o"></i> Save All Changes
                                            </button>
                                            <a href="index.php" target="_blank" class="btn btn-secondary">
                                                View Live Page
                                            </a>
                                        </div>
                                    
                                        </form>
                                    </div>
                                    <?php }

                                        elseif ($page_key == "about_page") {
                                            // code...
                                    ?>
                                    <div class="card-body">
                                        <form class="form" method="POST" action="pages-content?page_key=<?php echo htmlspecialchars($data_key0); ?>&page_name=<?php echo htmlspecialchars($data_key1); ?>" enctype="multipart/form-data">

                                        <?php if ($message): ?>
                                            <div class="alert <?php echo str_contains($message, 'Error') ? 'alert-danger' : 'alert-success'; ?>">
                                                <?php echo $message; ?>
                                            </div>
                                        <?php endif; ?>
                                    
                                        <div class="form-body">
                                        
                                            <h4 class="form-section"><i class="fa fa-pencil"></i> About Page Content</h4>
                                        
                                            <div class="form-group">
                                                <label for="about_headline">Main Headline (H2)</label>
                                                <input type="text"
                                                    id="about_headline"
                                                    class="form-control square"
                                                    name="about_headline"
                                                    value="<?php echo htmlspecialchars($content['about_headline'] ?? ''); ?>"
                                                    required>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="about_intro_lead">Introductory Lead Paragraph</label>
                                                <textarea id="about_intro_lead"
                                                        class="form-control square"
                                                        name="about_intro_lead"
                                                        rows="2"
                                                        required><?php echo htmlspecialchars($content['about_intro_lead'] ?? ''); ?></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="about_text_1">First Content Paragraph</label>
                                                <textarea id="about_text_1"
                                                        class="form-control square"
                                                        name="about_text_1"
                                                        rows="3"
                                                        required><?php echo htmlspecialchars($content['about_text_1'] ?? ''); ?></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="about_text_2">Second Content Paragraph</label>
                                                <textarea id="about_text_2"
                                                        class="form-control square"
                                                        name="about_text_2"
                                                        rows="3"
                                                        required><?php echo htmlspecialchars($content['about_text_2'] ?? ''); ?></textarea>
                                            </div>
                                        
                                            <hr>
                                    
                                            <h4 class="form-section"><i class="fa fa-image"></i> About Section Image</h4>
                                    
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <a href="javascript: void(0);">
                                                        <img src="<?php echo htmlspecialchars($content['about_image_path'] ?? '../assets/img/placeholder.png'); ?>" 
                                                             class="rounded mr-20 img-fluid" 
                                                             alt="About Us Image" 
                                                             style="max-width: 400px; height: auto;">
                                                    </a>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <div class="media">
                                                        <div class="media-body mt-75">
                                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                <label class="btn btn-md btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer square" for="about-upload">Upload New Photo</                                    label>
                                                                <input type="file" id="about-upload" name="about_image_path" hidden accept="image/*">
                                                            </div>
                                                            <p class="text-muted ml-75 mt-50"><small>Allowed .jpg, .png or .webp Format & Preferred Dimensions: <b class="text-danger">(                                    e.g., 600px x 800px)</b></small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <hr>
                                    
                                            <h4 class="form-section"><i class="fa fa-line-chart"></i> Metrics (Years, Pairs, Champions)</h4>
                                        
                                            <?php 
                                            // Array to easily loop through the metrics
                                            $metrics = [
                                                1 => 'years', // Corresponds to 'Years of Passion'
                                                2 => 'pairs', // Corresponds to 'Breeding Pairs'
                                                3 => 'champs' // Corresponds to 'Champion Bloodlines'
                                            ];
                                            
                                            foreach ($metrics as $i => $key_prefix):
                                                $number_key = "metric_{$key_prefix}_number";
                                                $label_key = "metric_{$key_prefix}_label";
                                            ?>
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label for="<?php echo $number_key; ?>">Metric <?php echo $i; ?>: Number (e.g., 25, 10, 3)</label>
                                                        <input type="text"
                                                                id="<?php echo $number_key; ?>"
                                                                class="form-control square"
                                                                name="<?php echo $number_key; ?>"
                                                                value="<?php echo htmlspecialchars($content[$number_key] ?? ''); ?>"
                                                                required>
                                                    </div>
                                                
                                                    <div class="col-md-6 form-group">
                                                        <label for="<?php echo $label_key; ?>">Metric <?php echo $i; ?>: Label (e.g., Years of Passion)</label>
                                                        <input type="text"
                                                                id="<?php echo $label_key; ?>"
                                                                class="form-control square"
                                                                name="<?php echo $label_key; ?>"
                                                                value="<?php echo htmlspecialchars($content[$label_key] ?? ''); ?>"
                                                                required>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                    
                                            <div class="form-actions text-right">
                                                <button type="submit" class="btn btn-success square">
                                                    <i class="fa fa-check-square-o"></i> Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                        
                                    </div>
                                    <?php }?>
                                </div>
                           </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <?php include("includes-footer.php");?>


    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <script src="app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <?php unset($_SESSION['metadata']); unset($_SESSION['wrong_metadata']); ?>


</body>
<!-- END: Body-->
 

</html>
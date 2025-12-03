<?php
    require_once __DIR__ . '/../app-content/includes-request.php';

    $current_route = 'pages';
    $user_name = $_SESSION['fullname'] ?? 'Admin User';
    $user_role = $_SESSION['userrole'] ?? 'Administrator';

    if (isset($_POST['deletion']) && $_POST['deletion'] == '1') {
        $client_id = (int) ($_POST['client_id'] ?? 0);
        if ($client_id) {
            $delete = "DELETE FROM pages WHERE id = ?";
            $stmt = mysqli_prepare($conn, $delete);
            mysqli_stmt_bind_param($stmt, "i", $client_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $_SESSION['my_metadata'] = "Page deleted successfully.";
        }
        header("Location: pages.php");
        exit();
    }

    if (isset($_POST['blocking']) && $_POST['blocking'] == '1') {
        $client_id = (int) ($_POST['client_id'] ?? 0);
        $update_status = $_POST['update_status'] ?? 'Inactive';
        if ($client_id && in_array($update_status, ['Active', 'Inactive'], true)) {
            $update = "UPDATE pages SET status = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $update);
            mysqli_stmt_bind_param($stmt, "si", $update_status, $client_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $_SESSION['my_metadata'] = "Page status updated to {$update_status}.";
        }
        header("Location: pages.php");
        exit();
    }

    if (isset($_POST['addpage']) && $_POST['addpage'] == '1') {
        $page_name = trim($_POST['page_name'] ?? '');
        $page_key = trim($_POST['page_key'] ?? '');
        $page_status = $_POST['page_status'] ?? 'Inactive';
        $page_nav = $_POST['page_nav'] ?? 'Main Nav';

        if ($page_name && $page_key && $page_status && $page_nav) {
            $sql = "INSERT INTO pages (page, page_key, status, page_nav) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ssss", $page_name, $page_key, $page_status, $page_nav);
                if ($stmt->execute()) {
                    $_SESSION['my_metadata'] = "New page \"{$page_name}\" created.";
                } else {
                    $_SESSION['my_metadata'] = "Failed to create page: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $_SESSION['my_metadata'] = "Database error: " . $conn->error;
            }
        } else {
            $_SESSION['my_metadata'] = "Please complete all required fields.";
        }
        header("Location: pages.php");
        exit();
    }

    $pages = [];
    $result = mysqli_query($conn, "SELECT * FROM pages ORDER BY page, page_nav ASC");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pages[] = $row;
        }
        mysqli_free_result($result);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helentor Console · Manage Pages</title>
    <link rel="shortcut icon" href="../app-content/assets/img/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Space+Grotesk:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/modern.css">
</head>
<body data-theme="light">
    <div class="app-shell">
        <aside class="app-sidebar" id="appSidebar">
            <div class="sidebar-brand d-flex align-items-center mb-4">
                <div class="brand-icon me-2">
                    <i class="ri-shield-star-line"></i>
                </div>
                <div>
                    <div class="brand-title">Helentor</div>
                    <small class="text-muted">Control Center</small>
                </div>
            </div>
            <div class="sidebar-user mb-4">
                <div class="avatar">
                    <span><?php echo strtoupper(substr($user_name, 0, 1)); ?></span>
                </div>
                <div>
                    <p class="m-0 fw-semibold"><?php echo htmlspecialchars($user_name); ?></p>
                    <small class="text-muted"><?php echo htmlspecialchars($user_role); ?></small>
                </div>
            </div>
            <nav class="sidebar-nav">
                <p class="nav-label">Overview</p>
                <a href="dashboard.php" class="nav-link <?php echo $current_route === 'dashboard' ? 'active' : ''; ?>">
                    <i class="ri-dashboard-line"></i><span>Dashboard</span>
                </a>
                <a href="pages.php" class="nav-link <?php echo $current_route === 'pages' ? 'active' : ''; ?>">
                    <i class="ri-pages-line"></i><span>Manage Pages</span>
                </a>
                <p class="nav-label">Operations</p>
                <a href="../app-content/quill.photos.manage.php" class="nav-link">
                    <i class="ri-layout-column-line"></i><span>Manage Content</span>
                </a>
                <a href="../app-content/users-manage.php" class="nav-link">
                    <i class="ri-group-line"></i><span>Users</span>
                </a>
                <a href="../app-content/account-setting.php" class="nav-link">
                    <i class="ri-user-settings-line"></i><span>Profile</span>
                </a>
                <a href="../app-content/logout.php" class="nav-link text-danger">
                    <i class="ri-logout-circle-line"></i><span>Logout</span>
                </a>
            </nav>
        </aside>

        <div class="app-content">
            <header class="app-header">
                <div class="d-flex align-items-center gap-2">
                    <button class="icon-btn" id="sidebarToggle" aria-label="Toggle sidebar">
                        <i class="ri-menu-line"></i>
                    </button>
                    <div>
                        <p class="text-uppercase text-muted small mb-1">Content infrastructure</p>
                        <h1 class="app-title mb-0">Manage Pages</h1>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="icon-btn" id="modeToggle" aria-label="Toggle dark mode">
                        <i class="ri-moon-line"></i>
                    </button>
                    <button class="btn btn-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#addPageModal">
                        <i class="ri-add-line"></i>
                        <span>New Page</span>
                    </button>
                </div>
            </header>

            <main class="app-main">
                <?php if (!empty($_SESSION['my_metadata'])): ?>
                    <div class="alert alert-warning border-0 rounded-3 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><?php echo htmlspecialchars($_SESSION['my_metadata']); ?></div>
                            <button class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                    <?php unset($_SESSION['my_metadata']); ?>
                <?php endif; ?>

                <section class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-3">
                            <div>
                                <p class="text-uppercase text-muted small mb-1">Inventory</p>
                                <h4 class="mb-0">Published pages</h4>
                            </div>
                            <div class="text-muted small">
                                Total entries: <?php echo count($pages); ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle" id="pagesTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Page</th>
                                        <th>Key</th>
                                        <th>Status</th>
                                        <th>Navigation</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pages as $index => $page): ?>
                                        <?php
                                            $status_badge = $page['status'] === 'Active'
                                                ? '<span class="badge text-bg-success rounded-pill px-3">Active</span>'
                                                : '<span class="badge text-bg-secondary rounded-pill px-3">Inactive</span>';
                                            $next_status = $page['status'] === 'Active' ? 'Inactive' : 'Active';
                                        ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($page['page']); ?></td>
                                            <td><code><?php echo htmlspecialchars($page['page_key']); ?></code></td>
                                            <td><?php echo $status_badge; ?></td>
                                            <td><?php echo htmlspecialchars($page['page_nav']); ?></td>
                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#statusModal<?php echo $page['id']; ?>">
                                                        <i class="ri-refresh-line"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $page['id']; ?>">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="statusModal<?php echo $page['id']; ?>" tabindex="-1" aria-labelledby="statusModalLabel<?php echo $page['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="statusModalLabel<?php echo $page['id']; ?>">Update status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <p class="mb-0">Set <strong><?php echo htmlspecialchars($page['page']); ?></strong> to <strong><?php echo $next_status; ?></strong>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                Confirm
                                                            </button>
                                                        </div>
                                                        <input type="hidden" name="blocking" value="1">
                                                        <input type="hidden" name="client_id" value="<?php echo $page['id']; ?>">
                                                        <input type="hidden" name="update_status" value="<?php echo $next_status; ?>">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="deleteModal<?php echo $page['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $page['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?php echo $page['id']; ?>">Delete page</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <p>Delete <strong><?php echo htmlspecialchars($page['page']); ?></strong>? This cannot be undone.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">
                                                                Delete
                                                            </button>
                                                        </div>
                                                        <input type="hidden" name="deletion" value="1">
                                                        <input type="hidden" name="client_id" value="<?php echo $page['id']; ?>">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="app-footer">
                <div>© <?php echo date('Y'); ?> Helentor Amstaffs · Modern CMS</div>
                <div class="d-flex gap-3">
                    <a href="../app-content/quill.policy.php">Privacy</a>
                    <a href="../app-content/quill.terms.php">Terms</a>
                </div>
            </footer>
        </div>
    </div>

    <div class="modal fade" id="addPageModal" tabindex="-1" aria-labelledby="addPageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPageModalLabel">Create page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Page name</label>
                            <input type="text" name="page_name" class="form-control" required placeholder="e.g. About Us">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Page key</label>
                            <input type="text" name="page_key" class="form-control" required placeholder="e.g. about_page">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="page_status" class="form-select" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Navigation type</label>
                            <select name="page_nav" class="form-select" required>
                                <option value="Main Nav">Main Nav</option>
                                <option value="Dropdown Nav">Dropdown Nav</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save page</button>
                    </div>
                    <input type="hidden" name="addpage" value="1">
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/modern.js"></script>
    <script>
        $(function () {
            $('#pagesTable').DataTable({
                pageLength: 10,
                order: [[1, 'asc']],
                language: { search: "_INPUT_", searchPlaceholder: "Search pages..." }
            });
        });
    </script>
</body>
</html>

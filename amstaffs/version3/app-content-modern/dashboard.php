<?php
    require_once __DIR__ . '/../app-content/includes-request.php';

    $user_name = $_SESSION['fullname'] ?? 'Admin User';
    $user_role = $_SESSION['userrole'] ?? 'Administrator';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helentor Console · Modern Dashboard</title>
    <link rel="shortcut icon" href="../app-content/assets/img/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Space+Grotesk:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css">
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
                <a href="#" class="nav-link active">
                    <i class="ri-dashboard-line"></i><span>Dashboard</span>
                </a>
                <a href="../app-content/pages-manage.php" class="nav-link">
                    <i class="ri-pages-line"></i><span>Manage Pages</span>
                </a>
                <a href="../app-content/quill.photos.manage.php" class="nav-link">
                    <i class="ri-layout-column-line"></i><span>Manage Content</span>
                </a>
                <p class="nav-label">Operations</p>
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
                    <h1 class="app-title mb-0">Welcome back, <?php echo htmlspecialchars($user_name); ?></h1>
                </div>
                <div class="header-actions d-flex align-items-center gap-2">
                    <button class="icon-btn" id="modeToggle" aria-label="Toggle dark mode">
                        <i class="ri-moon-line"></i>
                    </button>
                    <button class="btn btn-primary d-flex align-items-center gap-1">
                        <i class="ri-flashlight-line"></i>
                        <span>Quick Action</span>
                    </button>
                </div>
            </header>

            <main class="app-main">
                <section class="quick-actions row g-3">
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="quick-card">
                            <div class="icon">
                                <i class="ri-add-circle-line"></i>
                            </div>
                            <div>
                                <p class="label">Create Page</p>
                                <a href="../app-content/pages-manage.php" class="stretched-link">Launch</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="quick-card">
                            <div class="icon">
                                <i class="ri-image-edit-line"></i>
                            </div>
                            <div>
                                <p class="label">Gallery Upload</p>
                                <a href="../app-content/quill.photos.manage.php" class="stretched-link">Open manager</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="quick-card">
                            <div class="icon">
                                <i class="ri-chat-smile-2-line"></i>
                            </div>
                            <div>
                                <p class="label">Testimonials</p>
                                <a href="../app-content/quill.testimonials.php" class="stretched-link">Review entries</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="quick-card">
                            <div class="icon">
                                <i class="ri-notification-3-line"></i>
                            </div>
                            <div>
                                <p class="label">Alerts</p>
                                <a href="#" class="stretched-link">View logs</a>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="widgets row g-4">
                    <div class="col-xl-8">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="text-uppercase text-muted small mb-1">Engagement</p>
                                        <h4 class="mb-0">Content Performance</h4>
                                    </div>
                                    <select class="form-select form-select-sm w-auto" aria-label="Select timeframe">
                                        <option>Last 30 days</option>
                                        <option>Last 90 days</option>
                                        <option>Year to date</option>
                                    </select>
                                </div>
                                <div class="chart-area">
                                    <canvas id="performanceChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <p class="text-uppercase text-muted small mb-1">Pipeline</p>
                                <h4 class="mb-3">Content Workflow</h4>
                                <ul class="timeline flex-grow-1">
                                    <li>
                                        <span class="dot"></span>
                                        <div>
                                            <p class="title">Homepage hero refresh</p>
                                            <small>Awaiting design input</small>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="dot"></span>
                                        <div>
                                            <p class="title">Breed guide article</p>
                                            <small>Editor review · 70% ready</small>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="dot"></span>
                                        <div>
                                            <p class="title">Gallery curation</p>
                                            <small>12 images pending metadata</small>
                                        </div>
                                    </li>
                                </ul>
                                <button class="btn btn-outline-primary w-100 mt-3">Open Planner</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="row g-4">
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="text-uppercase text-muted small mb-1">Visitors</p>
                                        <h4 class="mb-0">Channel distribution</h4>
                                    </div>
                                </div>
                                <div class="chart-area chart-area-sm">
                                    <canvas id="trafficChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="text-uppercase text-muted small mb-1">Tasks</p>
                                        <h4 class="mb-0">Team check-ins</h4>
                                    </div>
                                    <button class="btn btn-light btn-sm">Add</button>
                                </div>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="badge rounded-pill bg-primary-subtle text-primary">UX</span>
                                            <div>
                                                <p class="mb-0 fw-semibold">Review onboarding screens</p>
                                                <small class="text-muted">Due tomorrow</small>
                                            </div>
                                        </div>
                                        <i class="ri-more-2-line text-muted"></i>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="badge rounded-pill bg-success-subtle text-success">CMS</span>
                                            <div>
                                                <p class="mb-0 fw-semibold">Document privacy updates</p>
                                                <small class="text-muted">In progress</small>
                                            </div>
                                        </div>
                                        <i class="ri-more-2-line text-muted"></i>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div class="d-flex align-items-center gap-3">
                                                <span class="badge rounded-pill bg-warning-subtle text-warning">Dev</span>
                                            <div>
                                                <p class="mb-0 fw-semibold">Automate gallery sync</p>
                                                <small class="text-muted">Backlog</small>
                                            </div>
                                        </div>
                                        <i class="ri-more-2-line text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="app-footer">
                <div>© <?php echo date('Y'); ?> Helentor Amstaffs · Built for modern collaboration</div>
                <div class="d-flex gap-3">
                    <a href="../app-content/quill.policy.php">Privacy</a>
                    <a href="../app-content/quill.terms.php">Terms</a>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <script src="assets/js/modern.js"></script>
</body>
</html>

<?php
// Admin layout: sidebar + main. Set $adminPage before including: 'overview' | 'testimonials' | 'inquiries' | 'solutions' | 'users' | 'password_requests' | 'profile'
if (!isset($adminPage)) $adminPage = 'overview';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($adminTitle) ? htmlspecialchars($adminTitle) . ' – ' : ''; ?>Admin – <?php echo htmlspecialchars($COMPANY_NAME_SHORT); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles.css">
    <style>
        body.admin-body { margin: 0; min-height: 100vh; background: #020617; color: var(--text); display: flex; flex-direction: column; }
        .admin-topbar { background: #0f172a; border-bottom: 1px solid #1e293b; padding: 0.75rem 1.5rem; display: flex; align-items: center; justify-content: space-between; }
        .admin-topbar .brand { font-weight: 600; font-size: 1rem; }
        .admin-topbar-links { display: flex; align-items: center; gap: 1rem; font-size: 0.9rem; }
        .admin-topbar-links a { color: var(--primary-dark); }
        .admin-topbar-links a:hover { color: #60a5fa; }
        .admin-wrap { display: flex; flex: 1; }
        .admin-sidebar { width: 220px; min-width: 220px; background: #0f172a; border-right: 1px solid #1e293b; padding: 1rem 0; display: flex; flex-direction: column; }
        .admin-sidebar nav { flex: 1; }
        .admin-sidebar nav ul { list-style: none; margin: 0; padding: 0; }
        .admin-sidebar .sidebar-bottom { margin-top: auto; padding-top: 1rem; border-top: 1px solid #1e293b; }
        .admin-sidebar .sidebar-bottom a { display: block; padding: 0.6rem 1.25rem; color: #94a3b8; text-decoration: none; font-size: 0.9rem; }
        .admin-sidebar .sidebar-bottom a:hover { background: #1e293b; color: #fff; }
        .admin-sidebar .sidebar-bottom a.active { background: rgba(37, 99, 235, 0.15); color: var(--primary-dark); border-left: 3px solid var(--primary-dark); padding-left: calc(1.25rem - 3px); }
        .admin-sidebar nav a { display: block; padding: 0.6rem 1.25rem; color: #94a3b8; text-decoration: none; font-size: 0.9rem; }
        .admin-sidebar nav a:hover { background: #1e293b; color: #fff; }
        .admin-sidebar nav a.active { background: rgba(37, 99, 235, 0.15); color: var(--primary-dark); border-left: 3px solid var(--primary-dark); padding-left: calc(1.25rem - 3px); }
        .admin-main { flex: 1; padding: 1.5rem 2rem; overflow: auto; }
        @media (max-width: 768px) {
            .admin-wrap { flex-direction: column; }
            .admin-sidebar { width: 100%; border-right: none; border-bottom: 1px solid #1e293b; }
            .admin-sidebar nav { display: flex; flex-wrap: wrap; gap: 0.25rem; padding: 0 0.5rem; }
            .admin-sidebar nav a { padding: 0.5rem 0.75rem; }
            .admin-sidebar nav a.active { border-left: none; border-bottom: 3px solid var(--primary-dark); padding-left: 0.75rem; }
            .admin-sidebar .sidebar-bottom a { padding: 0.5rem 0.75rem; }
            .admin-sidebar .sidebar-bottom a.active { border-left: none; border-bottom: 3px solid var(--primary-dark); padding-left: 0.75rem; }
        }
    </style>
</head>
<body class="admin-body">
<div class="admin-topbar">
    <span class="brand">Admin – <?php echo htmlspecialchars($COMPANY_NAME_SHORT); ?></span>
    <span class="admin-topbar-links">
        <a href="<?php echo $BASE_URL; ?>/index.php">View site</a>
        <a href="<?php echo $BASE_URL; ?>/auth/logout.php">Logout</a>
    </span>
</div>
<div class="admin-wrap">
    <aside class="admin-sidebar">
        <nav>
            <ul>
                <li><a href="<?php echo $BASE_URL; ?>/admin/dashboard.php" class="<?php echo $adminPage === 'overview' ? 'active' : ''; ?>">Overview</a></li>
                <li><a href="<?php echo $BASE_URL; ?>/admin/testimonials.php" class="<?php echo $adminPage === 'testimonials' ? 'active' : ''; ?>">Testimonials</a></li>
                <li><a href="<?php echo $BASE_URL; ?>/admin/inquiries.php" class="<?php echo $adminPage === 'inquiries' ? 'active' : ''; ?>">Inquiries</a></li>
                <li><a href="<?php echo $BASE_URL; ?>/admin/solutions.php" class="<?php echo $adminPage === 'solutions' ? 'active' : ''; ?>">ES Solutions</a></li>
                <li><a href="<?php echo $BASE_URL; ?>/admin/users.php" class="<?php echo $adminPage === 'users' ? 'active' : ''; ?>">Users</a></li>
                <li><a href="<?php echo $BASE_URL; ?>/admin/password-requests.php" class="<?php echo $adminPage === 'password_requests' ? 'active' : ''; ?>">Password requests</a></li>
            </ul>
        </nav>
        <div class="sidebar-bottom">
            <a href="<?php echo $BASE_URL; ?>/profile.php" class="<?php echo $adminPage === 'profile' ? 'active' : ''; ?>">Profile</a>
        </div>
    </aside>
    <main class="admin-main">

<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
session_start();

if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: ' . $BASE_URL . '/auth/login.php');
    exit;
}

$format = $_GET['format'] ?? 'csv';
$date = date('Y-m-d');

if ($format === 'pdf') {
    // Build the HTML report into a buffer, then render as real PDF with Dompdf.
    ob_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin report – <?php echo htmlspecialchars($date); ?></title>
    <style>
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 13px; color: #0f172a; padding: 16px; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        h2 { font-size: 16px; margin-top: 18px; margin-bottom: 6px; }
        table { width: 100%; border-collapse: collapse; margin-top: 4px; }
        th, td { border: 1px solid #e5e7eb; padding: 4px 6px; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; font-size: 12px; }
        .muted { color: #6b7280; font-size: 12px; }
        .section { page-break-inside: avoid; margin-top: 14px; }
    </style>
</head>
<body>
<h1>Admin report</h1>
<div class="muted">Generated on <?php echo htmlspecialchars($date); ?></div>

<div class="section">
    <h2>Summary</h2>
    <table>
        <tbody>
        <?php
        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'pending'");
            echo '<tr><th>Pending inquiries</th><td>' . (int) $stmt->fetchColumn() . '</td></tr>';
        } catch (Throwable $e) {}
        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'answered'");
            echo '<tr><th>Answered inquiries</th><td>' . (int) $stmt->fetchColumn() . '</td></tr>';
        } catch (Throwable $e) {}
        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'resolved'");
            echo '<tr><th>Resolved inquiries</th><td>' . (int) $stmt->fetchColumn() . '</td></tr>';
        } catch (Throwable $e) {}
        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM testimonials");
            echo '<tr><th>Total testimonials</th><td>' . (int) $stmt->fetchColumn() . '</td></tr>';
        } catch (Throwable $e) {}
        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM users");
            echo '<tr><th>Total users</th><td>' . (int) $stmt->fetchColumn() . '</td></tr>';
        } catch (Throwable $e) {}
        ?>
        </tbody>
    </table>
</div>

<div class="section">
    <h2>Inquiries</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Business name</th><th>ES system</th><th>Message</th><th>Status</th><th>Created</th>
        </tr>
        </thead>
        <tbody>
        <?php
        try {
            $stmt = $pdo->query("SELECT id, name, email, COALESCE(business_name, subject), COALESCE(es_system,''), message, status, created_at FROM inquiries ORDER BY created_at DESC");
        } catch (Throwable $e) {
            $stmt = $pdo->query("SELECT id, name, email, subject, message, status, created_at FROM inquiries ORDER BY created_at DESC");
        }
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            if (count($row) === 7) {
                $row = [$row[0], $row[1], $row[2], $row[3] ?? '', '', $row[4], $row[5], $row[6]];
            }
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . htmlspecialchars((string) $cell) . '</td>';
            }
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<div class="section">
    <h2>Testimonials</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Company</th><th>Sector</th><th>Solution</th><th>Quote</th><th>Rating</th><th>Status</th><th>Created</th>
        </tr>
        </thead>
        <tbody>
        <?php
        try {
            $stmt = $pdo->query("SELECT id, name, company, sector, solution, quote, rating, COALESCE(status,'approved'), created_at FROM testimonials ORDER BY created_at DESC");
        } catch (Throwable $e) {
            $stmt = $pdo->query("SELECT id, name, company, sector, solution, quote, rating, created_at FROM testimonials ORDER BY created_at DESC");
        }
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            if (count($row) === 8) {
                $row = array_merge($row, ['approved']);
            }
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . htmlspecialchars((string) $cell) . '</td>';
            }
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<div class="section">
    <h2>Users</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Created</th>
        </tr>
        </thead>
        <tbody>
        <?php
        try {
            $stmt = $pdo->query("SELECT id, name, email, role, status, created_at FROM users ORDER BY created_at DESC");
            while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                echo '<tr>';
                foreach ($row as $cell) {
                    echo '<td>' . htmlspecialchars((string) $cell) . '</td>';
                }
                echo '</tr>';
            }
        } catch (Throwable $e) {}
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php
    $html = ob_get_clean();

    // Use Dompdf to generate a real PDF if installed (composer require dompdf/dompdf).
    $autoloadPath = __DIR__ . '/../vendor/autoload.php';
    if (file_exists($autoloadPath)) {
        require_once $autoloadPath;
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="admin-report-' . $date . '.pdf"');
        echo $dompdf->output();
        exit;
    } else {
        // Fallback: show HTML so the admin can print / save as PDF manually
        header('Content-Type: text/html; charset=utf-8');
        echo $html;
        exit;
    }
}

// Default: original CSV export
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="admin-report-' . $date . '.csv"');

$out = fopen('php://output', 'w');
fputcsv($out, ['Report generated', $date]);

// Summary
fputcsv($out, []);
fputcsv($out, ['Summary']);
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'pending'");
    fputcsv($out, ['Pending inquiries', $stmt->fetchColumn()]);
} catch (Throwable $e) {}
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'answered'");
    fputcsv($out, ['Answered inquiries', $stmt->fetchColumn()]);
} catch (Throwable $e) {}
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'resolved'");
    fputcsv($out, ['Resolved inquiries', $stmt->fetchColumn()]);
} catch (Throwable $e) {}
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM testimonials");
    fputcsv($out, ['Total testimonials', $stmt->fetchColumn()]);
} catch (Throwable $e) {}
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    fputcsv($out, ['Total users', $stmt->fetchColumn()]);
} catch (Throwable $e) {}

// Inquiries
fputcsv($out, []);
fputcsv($out, ['Inquiries']);
fputcsv($out, ['ID', 'Name', 'Email', 'Business name', 'ES system', 'Message', 'Status', 'Created']);
try {
    $stmt = $pdo->query("SELECT id, name, email, COALESCE(business_name, subject), COALESCE(es_system,''), message, status, created_at FROM inquiries ORDER BY created_at DESC");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        fputcsv($out, $row);
    }
} catch (Throwable $e) {
    $stmt = $pdo->query("SELECT id, name, email, subject, message, status, created_at FROM inquiries ORDER BY created_at DESC");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        fputcsv($out, [$row[0], $row[1], $row[2], $row[3] ?? '', '', $row[4], $row[5], $row[6]]);
    }
}

// Testimonials
fputcsv($out, []);
fputcsv($out, ['Testimonials']);
fputcsv($out, ['ID', 'Name', 'Company', 'Sector', 'Solution', 'Quote', 'Rating', 'Status', 'Created']);
try {
    $stmt = $pdo->query("SELECT id, name, company, sector, solution, quote, rating, COALESCE(status,'approved'), created_at FROM testimonials ORDER BY created_at DESC");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        fputcsv($out, $row);
    }
} catch (Throwable $e) {
    try {
        $stmt = $pdo->query("SELECT id, name, company, sector, solution, quote, rating, created_at FROM testimonials ORDER BY created_at DESC");
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            fputcsv($out, array_merge($row, ['approved']));
        }
    } catch (Throwable $e2) {}
}

// Users
fputcsv($out, []);
fputcsv($out, ['Users']);
fputcsv($out, ['ID', 'Name', 'Email', 'Role', 'Status', 'Created']);
try {
    $stmt = $pdo->query("SELECT id, name, email, role, status, created_at FROM users ORDER BY created_at DESC");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        fputcsv($out, $row);
    }
} catch (Throwable $e) {}

fclose($out);
exit;

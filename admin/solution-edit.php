<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/solution-image-keys.php';
session_start();

if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: ' . $BASE_URL . '/auth/login.php');
    exit;
}

$slug = $_GET['slug'] ?? '';
$imageKeys = getSolutionImageKeys($slug);
$defaults = [
    'es-pos-system' => ['title' => 'es POS System', 'tagline' => 'Customer satisfaction billing system – easy, fast, reliable.'],
    'es-account-system' => ['title' => 'es Account System', 'tagline' => 'Integrated business and accounting – ledgers, vouchers and reports in one place.'],
    'es-distribution-system' => ['title' => 'es Distribution System', 'tagline' => 'Route, order and delivery management with clear stock visibility.'],
    'es-hire-purchasing' => ['title' => 'es Hire Purchasing', 'tagline' => 'Manage hire purchasing sales, instalments and outstanding.'],
    'es-color-lab-system' => ['title' => 'es Color Lab System', 'tagline' => 'Manage color lab and studio jobs, orders and billing.'],
    'es-workshop-system' => ['title' => 'es Workshop System', 'tagline' => 'Manage workshop jobs, hiring and service history.'],
    'es-gold-manufacturing' => ['title' => 'es Gold Manufacturing', 'tagline' => 'Automate gold manufacturing – orders, stock, wastage and payroll.'],
    'es-pawn-management' => ['title' => 'es Pawn Management', 'tagline' => 'Manage pawning, interest, reminders and gold stock.'],
    'es-gold-retail' => ['title' => 'es Gold Retail', 'tagline' => 'Handle gold retail invoicing, orders and stock.'],
    'es-hospital' => ['title' => 'es Hospital', 'tagline' => 'Manage channeling, OPD, lab and ward activities.'],
    'es-money-exchange' => ['title' => 'es Money Exchange', 'tagline' => 'Control currency rates, approvals and deposits.'],
    'es-time-attendance-hr' => ['title' => 'es Time Attendance & HR', 'tagline' => 'Capture time, run payroll and manage HR data.'],
    'es-hotel' => ['title' => 'es Hotel', 'tagline' => 'Manage hotel rooms, bookings, restaurant and billing.'],
    'es-restaurant' => ['title' => 'es Restaurant', 'tagline' => 'Run restaurant tables, KOT/BOT, recipes and billing.'],
    'es-filling-station' => ['title' => 'es Filling Station', 'tagline' => 'Track pump meters, sales, credit bills and fuel stock.'],
    'es-tire-shop' => ['title' => 'es Tire shop', 'tagline' => 'Manage tire sales, rebuild/DAG work, stock and accounts.'],
    'es-rice-mill' => ['title' => 'es Rice Mill', 'tagline' => 'Automate paddy intake, milling batches and finished rice stock.'],
    'es-mobile-app' => ['title' => 'es Mobile', 'tagline' => 'Mobile apps for billing, distribution and MIS reporting.'],
];

if (!isset($defaults[$slug])) {
    header('Location: ' . $BASE_URL . '/admin/solutions.php');
    exit;
}

$def = $defaults[$slug];
$title = $def['title'];
$tagline = $def['tagline'];
$solutionImages = []; // key => path

try {
    $stmt = $pdo->prepare('SELECT title, tagline FROM solutions WHERE slug = ?');
    $stmt->execute([$slug]);
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $title = $row['title'];
        $tagline = $row['tagline'];
    }
    $stmt = $pdo->prepare('SELECT image_key, image_path FROM solution_images WHERE solution_slug = ?');
    $stmt->execute([$slug]);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $solutionImages[$row['image_key']] = $row['image_path'];
    }
} catch (Throwable $e) {}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $tagline = trim($_POST['tagline'] ?? '');
    $imageSaved = false;

    if ($title === '') {
        $error = 'Title is required.';
    } else {
        try {
            $pdo->prepare('INSERT INTO solutions (slug, title, tagline) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE title = ?, tagline = ?')
                ->execute([$slug, $title, $tagline, $title, $tagline]);
            $message = 'Content saved.';
        } catch (Throwable $e) {
            $error = 'Could not save.';
        }
    }

    // Hero image upload (run even if content save failed, so user sees image errors)
    if (!empty($_FILES['hero_image']['name'])) {
        $uploadErr = $_FILES['hero_image']['error'] ?? UPLOAD_ERR_NO_FILE;
        if ($uploadErr !== UPLOAD_ERR_OK) {
            if ($uploadErr === UPLOAD_ERR_INI_SIZE || $uploadErr === UPLOAD_ERR_FORM_SIZE) {
                $error = ($error ? $error . ' ' : '') . 'Image too large. Try a smaller file (e.g. under 2 MB).';
            } else {
                $error = ($error ? $error . ' ' : '') . 'Image upload failed (code ' . $uploadErr . ').';
            }
        } else {
            $uploadDir = __DIR__ . '/../uploads/solutions/';
            $uploadDirOk = is_dir($uploadDir);
            if (!$uploadDirOk) {
                $uploadDirOk = @mkdir($uploadDir, 0755, true);
                if (!$uploadDirOk) {
                    $error = ($error ? $error . ' ' : '') . 'Upload folder could not be created.';
                }
            }
            if ($uploadDirOk) {
                $ext = strtolower(pathinfo($_FILES['hero_image']['name'], PATHINFO_EXTENSION)) ?: 'jpg';
                if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $error = ($error ? $error . ' ' : '') . 'Invalid image type. Use JPG, PNG, GIF or WebP.';
                } else {
                    $filename = $slug . '-hero-' . time() . '.' . $ext;
                    $path = $uploadDir . $filename;
                    if (move_uploaded_file($_FILES['hero_image']['tmp_name'], $path)) {
                        $relPath = 'uploads/solutions/' . $filename;
                        try {
                            $pdo->prepare('INSERT INTO solution_images (solution_slug, image_key, image_path) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE image_path = ?')
                                ->execute([$slug, 'hero', $relPath, $relPath]);
                            $solutionImages['hero'] = $relPath;
                            $imageSaved = true;
                        } catch (Throwable $e) {
                            $error = ($error ? $error . ' ' : '') . 'Image saved to server but database update failed.';
                        }
                    } else {
                        $error = ($error ? $error . ' ' : '') . 'Could not save image file (check folder permissions).';
                    }
                }
            }
        }
    }

    // Section images (other than hero)
    $uploadDir = __DIR__ . '/../uploads/solutions/';
    $uploadDirOk = is_dir($uploadDir) || @mkdir($uploadDir, 0755, true);
    if ($uploadDirOk && !empty($_FILES['section_image']['name'])) {
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        foreach ($imageKeys as $keyLabel) {
            $key = $keyLabel['key'];
            if ($key === 'hero') continue;
            $name = $_FILES['section_image']['name'][$key] ?? '';
            if ($name === '') continue;
            $err = $_FILES['section_image']['error'][$key] ?? UPLOAD_ERR_NO_FILE;
            if ($err !== UPLOAD_ERR_OK) continue;
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION)) ?: 'jpg';
            if (!in_array($ext, $allowedExt)) continue;
            $filename = $slug . '-' . $key . '-' . time() . '.' . $ext;
            $path = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['section_image']['tmp_name'][$key], $path)) {
                $relPath = 'uploads/solutions/' . $filename;
                try {
                    $pdo->prepare('INSERT INTO solution_images (solution_slug, image_key, image_path) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE image_path = ?')
                        ->execute([$slug, $key, $relPath, $relPath]);
                    $solutionImages[$key] = $relPath;
                    $imageSaved = true;
                } catch (Throwable $e) {}
            }
        }
    }

    if ($imageSaved) {
        $message = $message ? $message . ' Image uploaded.' : 'Image uploaded.';
    }
}

$adminPage = 'solutions';
$adminTitle = 'Edit ' . $slug;
include __DIR__ . '/header.php';
?>
<style>
    .admin-msg { padding: 0.6rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .admin-msg.success { background: #022c22; color: #bbf7d0; }
    .admin-msg.error { background: #450a0a; color: #fecaca; }
    .edit-form label { display: block; margin-bottom: 0.5rem; font-size: 0.9rem; }
    .edit-form input, .edit-form textarea { width: 100%; max-width: 400px; padding: 0.5rem; background: #020617; border: 1px solid #374151; border-radius: 0.5rem; color: #fff; }
    .edit-form .field { margin-bottom: 1rem; }
    .edit-form img { max-width: 300px; border-radius: 0.5rem; margin-top: 0.5rem; }
    .edit-form .section-image-field { padding: 0.75rem 0; border-bottom: 1px solid #1e293b; }
    .edit-form .img-thumb { max-width: 200px; }
</style>
<div class="section-header" style="margin-bottom:1.5rem;">
    <h2 class="section-title">Edit: <?php echo htmlspecialchars($slug); ?></h2>
</div>
<?php if ($message): ?><div class="admin-msg success"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
<?php if ($error): ?><div class="admin-msg error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

<form method="post" enctype="multipart/form-data" class="edit-form">
    <div class="field">
        <label>Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
    </div>
    <div class="field">
        <label>Tagline</label>
        <input type="text" name="tagline" value="<?php echo htmlspecialchars($tagline); ?>">
    </div>
    <h3 style="font-size:1rem;margin:1.5rem 0 0.75rem;">Section images</h3>
    <p style="font-size:0.85rem;color:var(--muted);margin-bottom:1rem;">This system has <?php echo count($imageKeys); ?> image slot(s). Upload per section; leave empty to keep the current image. Slots are defined in <code>includes/solution-image-keys.php</code>.</p>
    <?php foreach ($imageKeys as $keyLabel): ?>
    <?php $key = $keyLabel['key']; $label = $keyLabel['label']; $currentPath = $solutionImages[$key] ?? null; ?>
    <div class="field section-image-field">
        <label><?php echo htmlspecialchars($label); ?></label>
        <?php if ($currentPath): ?>
        <div><img src="<?php echo htmlspecialchars($BASE_URL . '/' . $currentPath); ?>" alt="<?php echo htmlspecialchars($label); ?>" class="edit-form img-thumb"></div>
        <?php endif; ?>
        <?php if ($key === 'hero'): ?>
        <input type="file" name="hero_image" accept="image/*">
        <?php else: ?>
        <input type="file" name="section_image[<?php echo htmlspecialchars($key); ?>]" accept="image/*">
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
    <button type="submit" class="cta-btn">Save</button>
</form>
<?php include __DIR__ . '/footer.php'; ?>

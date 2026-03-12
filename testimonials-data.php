<?php
// Shared testimonials data for homepage and testimonials page.
// Reads from MySQL database; falls back to JSON if DB fails or is empty.

$TESTIMONIALS = [];

try {
    require __DIR__ . '/includes/db.php';
    $stmt = $pdo->query("SELECT name, company, sector, solution, quote, rating, admin_reply FROM testimonials WHERE COALESCE(status,'approved') = 'approved' ORDER BY created_at DESC");
    if ($stmt) {
        $TESTIMONIALS = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
} catch (Throwable $e) {
    try {
        $stmt = $pdo->query('SELECT name, company, sector, solution, quote, rating FROM testimonials ORDER BY created_at DESC');
        if ($stmt) {
            $TESTIMONIALS = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        }
    } catch (Throwable $e2) {
        // DB failed; fall back to JSON
    }
}

if (empty($TESTIMONIALS)) {
    $jsonPath = __DIR__ . '/data/testimonials.json';
    if (file_exists($jsonPath)) {
        $json = json_decode(file_get_contents($jsonPath), true);
        if (is_array($json)) {
            foreach ($json as $t) {
                $TESTIMONIALS[] = [
                    'name'    => $t['name'] ?? '',
                    'company' => $t['company'] ?? '',
                    'sector'  => $t['sector'] ?? '',
                    'solution'=> $t['solution'] ?? '',
                    'quote'   => $t['quote'] ?? '',
                    'rating'  => $t['rating'] ?? null,
                    'admin_reply' => null,
                ];
            }
        }
    }
}


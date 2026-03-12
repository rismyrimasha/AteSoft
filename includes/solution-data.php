<?php
/**
 * Load solution overrides from DB for a given slug.
 * Sets $solutionTitle, $solutionTagline, $solutionImages (slug => path).
 * Call with $solutionSlug set before including.
 */
if (!isset($solutionSlug) || $solutionSlug === '') return;

$solutionTitle = null;
$solutionTagline = null;
$solutionImages = [];

try {
    require __DIR__ . '/db.php';
    $stmt = $pdo->prepare('SELECT title, tagline FROM solutions WHERE slug = ?');
    $stmt->execute([$solutionSlug]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $solutionTitle = $row['title'];
        $solutionTagline = $row['tagline'];
    }
    $stmt = $pdo->prepare('SELECT image_key, image_path FROM solution_images WHERE solution_slug = ?');
    $stmt->execute([$solutionSlug]);
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $solutionImages[$r['image_key']] = $r['image_path'];
    }
} catch (Throwable $e) {}

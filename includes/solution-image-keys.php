<?php
/**
 * Image slots per ES solution. Each solution has its own list of image keys.
 * Each key = one upload slot in admin and one placeholder on the solution page.
 *
 * To add images for a solution:
 * 1. Add (or edit) an entry below with 'key' (lowercase, hyphens) and 'label' (shown in admin).
 * 2. On the solution page (e.g. es-pos-system.php), use $solutionImgUrls['your-key'] for that section.
 * 3. Keys must match between this file and the solution page.
 */
$SOLUTION_IMAGE_KEYS = [
    'es-pos-system' => [
        ['key' => 'hero', 'label' => 'Hero / About overview'],
        ['key' => 'main-features', 'label' => 'Main features'],
        ['key' => 'front-office', 'label' => 'Front office'],
        ['key' => 'back-office', 'label' => 'Back office'],
        ['key' => 'barcode-writer', 'label' => 'Barcode writer'],
        ['key' => 'quick-view', 'label' => 'Quick view'],
        ['key' => 'auto-synchro', 'label' => 'Auto-synchro'],
        ['key' => 'mobile-pos', 'label' => 'Mobile POS'],
    ],
    'es-account-system' => [
        ['key' => 'hero', 'label' => 'Hero / Dashboard'],
        ['key' => 'reports', 'label' => 'Accounting reports'],
    ],
    'es-distribution-system' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'features', 'label' => 'Distribution features'],
        ['key' => 'mobile-distributor', 'label' => 'Mobile Distributor app'],
    ],
    'es-hire-purchasing' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'features', 'label' => 'Main hire purchasing features'],
    ],
    'es-color-lab-system' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'features', 'label' => 'Color lab features'],
    ],
    'es-workshop-system' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'features', 'label' => 'Workshop features'],
    ],
    'es-gold-manufacturing' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'features', 'label' => 'Gold manufacturing features'],
    ],
    'es-pawn-management' => [
        ['key' => 'hero', 'label' => 'Hero / Pawn overview'],
        ['key' => 'features', 'label' => 'Pawn features'],
        ['key' => 'mobile-pawning', 'label' => 'Mobile Pawning app'],
    ],
    'es-gold-retail' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'features', 'label' => 'Gold retail features'],
    ],
    'es-hospital' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'channeling', 'label' => 'Channeling module'],
    ],
    'es-money-exchange' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'features', 'label' => 'Money exchange features'],
    ],
    'es-time-attendance-hr' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'features', 'label' => 'Time & attendance features'],
    ],
    'es-hotel' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
    ],
    'es-restaurant' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'counter-billing', 'label' => 'Counter & billing'],
    ],
    'es-filling-station' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'features', 'label' => 'Filling station features'],
    ],
    'es-tire-shop' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
        ['key' => 'features', 'label' => 'Tire shop features'],
    ],
    'es-rice-mill' => [
        ['key' => 'hero', 'label' => 'Hero / Overview'],
    ],
    'es-mobile-app' => [
        ['key' => 'hero', 'label' => 'Hero / Mobile apps overview'],
        ['key' => 'mobile-pos', 'label' => 'Mobile POS app'],
        ['key' => 'mobile-distributor', 'label' => 'Mobile Distributor app'],
        ['key' => 'mobile-mis', 'label' => 'Mobile MIS app'],
        ['key' => 'mobile-pawning', 'label' => 'Mobile Pawning app'],
        ['key' => 'mobile-case', 'label' => 'Mobile Case Management app'],
    ],
];

function getSolutionImageKeys($slug) {
    global $SOLUTION_IMAGE_KEYS;
    if (isset($SOLUTION_IMAGE_KEYS[$slug])) {
        return $SOLUTION_IMAGE_KEYS[$slug];
    }
    return [['key' => 'hero', 'label' => 'Hero image']];
}

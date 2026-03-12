<?php
// Basic site configuration shared across pages.

$COMPANY_NAME       = 'At e Soft Computer Systems (Pvt) Ltd';
$COMPANY_NAME_SHORT = 'At e Soft';
$COMPANY_EMAIL      = 'atesoftws@gmail.com';
$COMPANY_PHONE      = '(+94) 714 600 300';
$COMPANY_FAX        = '(+94) 322 254 993';
$COMPANY_ADDR_LINE1 = 'No:30 Milanocity, Madahattiniya, Marawila,';
$COMPANY_ADDR_LINE2 = 'Sri Lanka.';

// Base URL of the site relative to the web root.
// If you access the site as http://localhost/company_website/,
// keep this as '/company_website'. Adjust if the folder name changes.
$BASE_URL = '/company_website';

// Use same session cookie for whole site (so login persists when moving from /admin/ to home etc.)
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['path' => $BASE_URL]);
}

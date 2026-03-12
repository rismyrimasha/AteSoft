<?php
require_once __DIR__ . '/config.php';

/**
 * Simple helper to send emails from the site (welcome, password reset, etc.).
 * Uses PHP's mail() with the company email as the From address.
 */
function send_app_mail(string $to, string $subject, string $body): void
{
    global $COMPANY_EMAIL, $COMPANY_NAME, $COMPANY_NAME_SHORT;

    $fromEmail = $COMPANY_EMAIL ?: 'no-reply@example.com';
    $fromName  = $COMPANY_NAME_SHORT ?? $COMPANY_NAME ?? 'At e Soft';

    $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
    $headers  = "From: {$fromName} <{$fromEmail}>\r\n";
    $headers .= "Reply-To: {$fromEmail}\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    try {
        @mail($to, $encodedSubject, $body, $headers);
    } catch (Throwable $e) {
        // Ignore mail errors; the site should still work even if email fails.
    }
}

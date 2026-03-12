<?php
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $BASE_URL . '/inquiry.php');
    exit;
}

$isUser = !empty($_SESSION['user_id']) && (($_SESSION['user_role'] ?? '') === 'user');
if (!$isUser) {
    $_SESSION['inquiry_error'] = 'Please log in to send an inquiry.';
    header('Location: ' . $BASE_URL . '/inquiry.php');
    exit;
}

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$business = trim($_POST['business_name'] ?? '');
$esSystem = trim($_POST['es_system'] ?? '');
$message = trim($_POST['message'] ?? '');
$userId  = !empty($_SESSION['user_id']) && ($_SESSION['user_role'] ?? '') === 'user' ? (int)$_SESSION['user_id'] : null;

$error = '';
if ($name === '') $error = 'Please enter your name.';
elseif ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $error = 'Please enter a valid email.';
elseif ($business === '') $error = 'Please enter your business name.';
elseif ($message === '') $error = 'Please enter your message.';

if ($error) {
    $_SESSION['inquiry_error'] = $error;
    $_SESSION['inquiry_name'] = $name;
    $_SESSION['inquiry_email'] = $email;
    $_SESSION['inquiry_business'] = $business;
    $_SESSION['inquiry_message'] = $message;
    $_SESSION['inquiry_es_system'] = $esSystem;
    header('Location: ' . $BASE_URL . '/inquiry.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO inquiries (user_id, name, email, business_name, es_system, message) VALUES (?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([$userId, $name, $email, $business, $esSystem ?: null, $message]);
    $_SESSION['inquiry_success'] = 'Thank you. Your inquiry has been sent. We will get back to you soon.';
} catch (Throwable $e) {
    $_SESSION['inquiry_error'] = 'An error occurred. Please try again or contact us directly.';
}

header('Location: ' . $BASE_URL . '/inquiry.php');
exit;

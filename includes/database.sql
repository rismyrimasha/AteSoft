-- At e Soft Computer Systems (Pvt) Ltd - Company Website
-- Combined database install script
--
-- How to use (phpMyAdmin):
-- 1) Create database `company_website` (utf8mb4)
-- 2) Select the database, then import this file
--
-- Notes:
-- - This script is written to be re-runnable (uses IF NOT EXISTS where possible).
-- - Some ALTER TABLE statements may fail if columns already exist; run them manually if needed.

SET NAMES utf8mb4;

-- ---------------------------------------------------------------------
-- 1) users
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(100) NULL COMMENT 'Optional; admins may login with username',
    password_hash VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_email (email),
    KEY idx_role (role),
    KEY idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert one admin so you can log in as admin (change in production!)
-- Password below is: password
INSERT INTO users (email, username, password_hash, name, role, status)
VALUES (
    'admin@atesoft.example',
    'admin',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'Administrator',
    'admin',
    'active'
)
ON DUPLICATE KEY UPDATE id = id;

-- Optional upgrades for users table (run one-by-one; may fail if column exists)
-- Profile image
ALTER TABLE users ADD COLUMN profile_image VARCHAR(255) NULL AFTER name;
-- Last login tracking
ALTER TABLE users ADD COLUMN last_login DATETIME NULL AFTER updated_at;

-- ---------------------------------------------------------------------
-- 2) testimonials
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS testimonials (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NULL,
    company VARCHAR(255) NOT NULL,
    sector VARCHAR(255) NULL,
    solution VARCHAR(255) NULL,
    quote TEXT NOT NULL,
    rating TINYINT UNSIGNED NULL,
    status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'approved',
    admin_reply TEXT NULL,
    admin_reply_at DATETIME NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_status (status),
    KEY idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 3) inquiries + replies
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS inquiries (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(500) NULL,
    message TEXT NOT NULL,
    status ENUM('pending', 'answered') NOT NULL DEFAULT 'pending',
    admin_reply TEXT NULL,
    admin_reply_at DATETIME NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_status (status),
    KEY idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inquiry upgrade: thread support, user_id, business_name, es_system, resolved status
ALTER TABLE inquiries ADD COLUMN user_id INT UNSIGNED NULL AFTER id;
ALTER TABLE inquiries ADD COLUMN business_name VARCHAR(255) NULL AFTER email;
ALTER TABLE inquiries ADD COLUMN es_system VARCHAR(100) NULL AFTER message;
ALTER TABLE inquiries MODIFY COLUMN status ENUM('pending', 'answered', 'resolved') NOT NULL DEFAULT 'pending';

CREATE TABLE IF NOT EXISTS inquiry_replies (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    inquiry_id INT UNSIGNED NOT NULL,
    sender_type ENUM('user', 'admin') NOT NULL,
    sender_id INT UNSIGNED NULL COMMENT 'user id for user, admin user id for admin',
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_inquiry (inquiry_id),
    FOREIGN KEY (inquiry_id) REFERENCES inquiries(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 4) solutions + images
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS solution_images (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    solution_slug VARCHAR(100) NOT NULL,
    image_key VARCHAR(80) NOT NULL COMMENT 'e.g. hero, about, main-features',
    image_path VARCHAR(500) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_solution_key (solution_slug, image_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS solutions (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(100) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    tagline VARCHAR(500) NULL,
    content LONGTEXT NULL COMMENT 'HTML or JSON for section content',
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 5) password reset tokens (legacy/optional)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS password_resets (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    token VARCHAR(64) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    expires_at DATETIME NOT NULL,
    KEY idx_token (token),
    KEY idx_user (user_id),
    CONSTRAINT fk_password_resets_user
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 6) admin-visible password reset requests (current flow)
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS password_reset_requests (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    user_id INT UNSIGNED NULL,
    requested_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending','done') NOT NULL DEFAULT 'pending',
    handled_at DATETIME NULL,
    KEY idx_status (status),
    KEY idx_requested_at (requested_at),
    KEY idx_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


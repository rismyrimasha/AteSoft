# At e Soft Company Website

Company website for **At e Soft Computer Systems (Pvt) Ltd**.

This is a PHP + MySQL website with:
- Public pages (solutions, testimonials, inquiry form)
- User authentication (register/login)
- Admin panel (inquiries, testimonials, solutions images, users)
- Manual password reset workflow via admin (password reset requests list + admin password reset)

---

## Tech stack

- **PHP** (works with WAMP/XAMPP)
- **MySQL / MariaDB**
- Plain CSS (`styles.css`)

---

## Quick start (Windows + WAMP/XAMPP)

### 1) Put the project into your web root

Example (WAMP):
- `C:\wamp64\www\company_website`

Example (XAMPP):
- `C:\xampp\htdocs\company_website`

### 2) Create the database + import SQL

1. Open **phpMyAdmin**
2. Create a database named: `company_website` (charset: `utf8mb4`)
3. Import:
   - `database/install.sql`

This creates all required tables (users, inquiries, testimonials, solutions, images, password reset requests, etc.).

### 3) Configure database connection

This repo **does not** commit real DB credentials.

1. Copy the example file:
   - `includes/db.example.php` → `includes/db.php`
2. Edit `includes/db.php` to match your MySQL user/password and DB name.

> `includes/db.php` is ignored by git (see `.gitignore`).

### 4) Set the base URL

Edit `includes/config.php`:

- `$BASE_URL = '/company_website';`

If you host in a different folder, update this value.

### 5) Open the site

- Home: `http://localhost/company_website/`
- Inquiry: `http://localhost/company_website/inquiry.php`
- Admin: `http://localhost/company_website/admin/dashboard.php`

---

## Admin login

`database/install.sql` creates a default admin user:

- **Username**: `admin`
- **Email**: `admin@atesoft.example`
- **Password**: `password`

After first login, change it immediately.

---

## Password reset (manual admin workflow)

Email sending may not be available on some local stacks. This project supports a manual workflow:

1. User submits **Forgot password** (`auth/forgot-password.php`)
2. Request is logged in DB table: `password_reset_requests` with status `pending`
3. Admin views pending requests:
   - `Admin → Password requests`
4. Admin resets the user password:
   - `Admin → Users → Reset password`
5. Admin marks the request as done:
   - `Password requests → Mark as done`

---

## Notes for GitHub

- Sensitive/local files are ignored in `.gitignore`:
  - `includes/db.php`
  - upload folders (if created)
  - logs, IDE config folders

---

## License

Internal project for At e Soft Computer Systems (Pvt) Ltd.


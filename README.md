## At e Soft Company Website

Official website for **At e Soft Computer Systems (Pvt) Ltd**.

This project is a PHP + MySQL website with:
- Public pages (solutions, testimonials, inquiry form)
- User authentication (register/login)
- Admin panel (manage inquiries, testimonials, users, ES solutions images/content)
- Manual password reset workflow (admin can reset user passwords; reset requests are tracked in admin)

---

## Tech Stack

- **PHP** (works well with WAMP/XAMPP)
- **MySQL / MariaDB**
- **HTML/CSS** (project `styles.css`)
- **PDO** for database access

---

## Project Structure (high level)

- `index.php` – homepage
- `solutions.php` – solutions list
- `es-*.php` – individual ES solution pages
- `testimonials.php` – testimonials page
- `inquiry.php` / `inquiry-submit.php` – inquiry form + submit handler
- `auth/` – login/register/forgot password
- `admin/` – admin panel pages
- `includes/`
  - `config.php` – base URL + company info
  - `db.php` – database connection (NOT committed)
  - `db.example.php` – database connection template
  - `mail.php` – email helper (currently uses PHP `mail()`)
  - `solution-data.php` – loads solution titles/images from DB
- `database/` – SQL schema and upgrades

---

## Setup (Local)

### 1) Requirements
- PHP 8.x recommended (7.4+ should work)
- MySQL/MariaDB
- WAMP/XAMPP (Windows) or any PHP server stack

### 2) Put the project in your web root
Example (WAMP):
- `C:\wamp64\www\company_website\`

Then you should be able to open:
- `http://localhost/company_website/`

### 3) Create the database
Create a database named:

- `company_website`

Then import these SQL files (in order):

1. `database/schema.sql`
2. `database/schema-additions.sql`

Optional upgrades (only if you need those features / your DB is older):
- `database/inquiry-upgrade.sql`
- `database/user-profile-upgrade.sql`
- `database/password-reset.sql`

### 4) Configure DB connection (important)
`includes/db.php` is ignored by git for safety.

Copy the example file and edit it:

- Copy `includes/db.example.php` → `includes/db.php`
- Update DB name/user/password inside `includes/db.php`

### 5) Configure base URL
Edit:

- `includes/config.php`

Set:

- `$BASE_URL = '/company_website';`

If you rename the folder, update `$BASE_URL` accordingly.

---

## Admin Panel

### Access
- Admin pages are under: `admin/`
- Login at: `auth/login.php`

### Default admin
The SQL in `database/schema.sql` includes a sample admin record (example email and a default password hash).
After installing, **change the admin credentials** in your DB for production use.

### Admin features
- Inquiries management
- Testimonials management
- Users listing + activate/deactivate
- Admin password reset button per user
- ES Solutions image management (images are pulled from DB on `es-*.php` pages)
- Password reset requests log page: `Admin → Password requests`

---

## Password Reset Workflow (Manual)

Email sending may not be available on some local setups. This project supports a manual flow:

- Users submit **Forgot password** (`auth/forgot-password.php`)
- A request is logged in `password_reset_requests` (status defaults to `pending`)
- Admin can view requests in: `admin/password-requests.php`
- Admin resets the password in: `admin/users.php`
- Admin marks the request as **done** in the Password requests page



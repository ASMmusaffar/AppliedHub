# 🏢 AppliedHub — Staff & Student Management System

**AppliedHub** is a role-based **PHP + MySQL** web application for managing an educational organization's staff, students, batches, and departments — with staff-side dashboards and per-profile detail views.

> Code by AS Mohammed Musaffar · © 2023 · Apache License 2.0

---

## ✨ Features

- 🔐 **Staff login** — Sign in from the staff login page (`index.php` → `engine.php`), validated directly against the `staffs` table, then redirected to the dashboard.
- 📊 **Dashboard** — Central landing page (`dashboard.php`) after login.
- 🏫 **Departments** — Add and delete departments (`detailsdep.php` + `engine.php` actions).
- 🎓 **Batches** — Create batches linked to a department and commencement date.
- 👨‍🎓 **Students** — Add students with registration number, name, batch, department, contact, email, and **profile photo upload** (`add_student` flow).
- 👥 **Staff & Student detail views** — `detailsstaff.php` / `detailsstudent.php` list records; `profilestaff.php` / `profilestudent.php` show full profiles.
- 🗃️ **MySQL Backend** — `conn.php` holds the database connection used by every page.

## 📂 Project Structure

```
├── index.php                 # Staff login page
├── engine.php                # All POST actions: login, add/delete department,
│                             #   add batch, add student (+ photo upload)
├── conn.php                  # MySQL connection settings
├── dashboard.php             # Main dashboard after login
├── detailsdep.php            # Department management view
├── detailsstaff.php          # Staff records view
├── detailsstudent.php        # Student records view
├── profilestaff.php          # Staff profile page
├── profilestudent.php        # Student profile page
├── scripts/  styles/         # Frontend assets
├── sources/  staffs/  students/   # Stored uploads (photos)
└── LICENSE                   # Apache License 2.0
```

## 🚀 Getting Started

### Prerequisites
- **XAMPP / WAMP / LAMP** — Apache + PHP 7.4+ + MySQL/MariaDB

### Setup
1. Clone the repository:
   ```bash
   git clone https://github.com/ASMmusaffar/AppliedHub.git
   ```
2. Copy the project into your web root (e.g., `htdocs/AppliedHub`).
3. Create the database and required tables (`staffs`, `students`, `batchs`, `departments`).
4. Configure your DB credentials in `conn.php`.
5. Open `http://localhost/AppliedHub/` and log in with a staff account.

> ⚠️ **Security note:** current database queries use string interpolation. Before any real deployment, switch all queries in `engine.php` to **prepared statements** and hash passwords with `password_hash()`.

## 🛠️ Tech Stack

- **Backend:** PHP (sessions, file uploads, mysqli)
- **Database:** MySQL / MariaDB
- **Frontend:** HTML, CSS, JavaScript

## 📄 License

Released under the **Apache License 2.0** — see [LICENSE](LICENSE).

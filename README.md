<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
  </a>
</p>

<h1 align="center">Task Manager</h1>

<p align="center">
  A simple Laravel-based Task Management application with authentication and role-based access.
</p>

---

## 🚀 Features
- User Authentication (Login/Register/Forgot Password)
- Admin Dashboard
- Task Create / Update / Delete
- Role Management (Admin & User)
- Default Admin Account after fresh setup

---

## 🛠️ Project Setup

Follow these steps to set up the project locally:

```bash
# 1. Clone the repository
git clone https://github.com/Pawan7986/Task-Manager.git

# 2. Go inside project folder
cd Task-Manager

# 3. Install dependencies
composer install

# 4. Copy .env file
cp .env.example .env

# 5. Generate app key
php artisan key:generate

# 6. Configure database in .env
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=

# 7. Run migrations & seed default admin account
php artisan migrate --seed

# 8. Start local server
php artisan serve
Default Admin Account

After running php artisan migrate --seed, a default admin will be created:

## 👨‍💻 Default Admin Account

After running `php artisan migrate --seed`, a default admin user will be created automatically:

- **Email:** kmr.fam07@gmail.com  
- **Password:** admin@123

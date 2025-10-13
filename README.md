# HRM - Human Resource Management System

![License](https://img.shields.io/badge/License-MIT-blue)
![Issues](https://img.shields.io/github/issues/yourusername/hrm-laravel)
![PHP](https://img.shields.io/badge/PHP-8.0+-blue)
![Laravel](https://img.shields.io/badge/Laravel-9.x-red)
![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-v3-green)

A modern **HRM system** built with **Laravel**, **Tailwind CSS**, and **AJAX**, featuring role-based access control, dynamic sidebar navigation, and a responsive dashboard.

---

## Features

-   User authentication with **login/logout**
-   Role-based access control using **Spatie Permissions**
-   Dynamic sidebar navigation based on user roles
-   Dashboard with dummy statistics
-   AJAX-based forms and logout for smooth UX
-   Tailwind CSS for responsive design
-   Profile management (view, update, change password)
-   Modular and scalable Laravel backend

---

## Tech Stack

-   **Backend:** Laravel 9+
-   **Frontend:** Tailwind CSS, jQuery, Font Awesome & Bootstrap Icons
-   **Database:** MySQL / PostgreSQL (configurable)
-   **Authentication:** Laravel Auth + Spatie Role & Permission
-   **AJAX:** jQuery for form submission and logout

---

## Installation

1. Clone the repository:

```bash
git clone https://github.com/yourusername/hrm-laravel.git
cd hrm-laravel


Install PHP dependencies:

composer install

Install NPM dependencies:

npm install
npm run build


Copy .env.example to .env:

cp .env.example .env


Generate application key:

php artisan key:generate


Configure database in .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hrm_db
DB_USERNAME=root
DB_PASSWORD=


Run migrations and seeders:

php artisan migrate --seed


Note: Default super admin user is user ID 5 (for testing).


Usage

Start the development server:

php artisan serve


Open your browser at http://127.0.0.1:8000

Login with the super admin user or create users via the dashboard

Explore the sidebar, dashboard, and profile management

AJAX is used for login, logout, and form submissions
```

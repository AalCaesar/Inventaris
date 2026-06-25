# Sistem Inventaris

Aplikasi web manajemen inventaris barang berbasis Laravel 11 dengan fitur CRUD kategori & barang, dashboard statistik, dan visualisasi data.

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap)

---

## ✨ Features

- 🔐 **Authentication** - Login/Logout dengan Laravel Breeze
- 📁 **CRUD Kategori** - Manajemen kategori barang
- 📦 **CRUD Barang** - Manajemen barang dengan search & filter
- 📊 **Dashboard** - Statistik inventaris dengan visualisasi Chart.js
- 📱 **Responsive Design** - Mobile-friendly interface
- ⚡ **Real-time Validation** - Server-side validation dengan error messages
- 🎨 **Modern UI** - Bootstrap 5 dengan SweetAlert2 notifications

---

## 📋 Requirements

- **PHP** 8.2 atau lebih tinggi
- **Composer** 2.6+
- **Node.js** 18+ dan npm
- **MySQL** 8.0+ atau MariaDB 10.3+
- **Git** (untuk clone repository)

---

## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/your-username/inventaris.git
cd inventaris
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Database

Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventaris
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Create Database

Buat database MySQL:

```sql
CREATE DATABASE inventaris CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Build Assets

```bash
# For development (with hot reload)
npm run dev

# For production
npm run build
```

### 8. Run Application

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://localhost:8000**

### 9. Create First User

Kunjungi http://localhost:8000/register untuk membuat akun pertama.

---

## 🎯 Usage

### Dashboard
- Akses: `/dashboard`
- Menampilkan statistik total kategori, total barang, nilai inventaris, dan barang stok rendah
- Visualisasi distribusi barang per kategori dengan Chart.js

### Kategori
- **List**: `/categories` - Lihat semua kategori dengan search
- **Create**: `/categories/create` - Tambah kategori baru
- **Edit**: `/categories/{id}/edit` - Edit kategori
- **Delete**: Tombol hapus di list (dengan konfirmasi SweetAlert2)

### Barang
- **List**: `/items` - Lihat semua barang dengan search & filter kategori
- **Create**: `/items/create` - Tambah barang baru
- **Show**: `/items/{id}` - Detail barang
- **Edit**: `/items/{id}/edit` - Edit barang
- **Delete**: Tombol hapus di list (dengan konfirmasi SweetAlert2)

---

## 🛠️ Tech Stack

### Backend
- **Laravel 11.x** - PHP Framework
- **MySQL** - Database
- **Laravel Breeze** - Authentication scaffolding

### Frontend
- **Bootstrap 5.3** - CSS Framework
- **Chart.js 4.4** - Data visualization
- **SweetAlert2** - Beautiful alerts
- **Font Awesome 6** - Icons

### Development Tools
- **Vite** - Asset bundling
- **Laravel Pint** - Code formatting
- **Tailwind CSS** - Utility-first CSS (untuk auth pages)

---

## 📁 Project Structure

```
inventaris/
├── app/
│   ├── Http/Controllers/
│   │   ├── CategoryController.php
│   │   ├── ItemController.php
│   │   └── DashboardController.php
│   └── Models/
│       ├── Category.php
│       └── Item.php
├── database/
│   └── migrations/
│       ├── create_categories_table.php
│       └── create_items_table.php
├── resources/
│   ├── views/
│   │   ├── categories/
│   │   ├── items/
│   │   ├── dashboard.blade.php
│   │   └── layouts/app.blade.php
│   ├── css/
│   └── js/
└── routes/
    └── web.php
```

---

## 🔒 Security Features

- ✅ CSRF Protection pada semua forms
- ✅ XSS Prevention dengan Blade escaping
- ✅ SQL Injection protection via Eloquent ORM
- ✅ Mass assignment protection dengan $fillable
- ✅ Authentication middleware pada protected routes
- ✅ Server-side validation pada semua input

---

## 🧪 Testing

```bash
# Run tests (jika tersedia)
php artisan test
```

Manual testing checklist tersedia di `panduan_kerja_anggota.md`.

---

## 📝 Development Commands

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Format code
./vendor/bin/pint

# Check routes
php artisan route:list

# Database fresh migration (WARNING: deletes all data)
php artisan migrate:fresh
```

---

## 🚀 Deployment

Untuk deployment ke production server:

1. Set `APP_ENV=production` dan `APP_DEBUG=false` di `.env`
2. Run optimization commands:
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm run build
   ```
3. Configure web server (Nginx/Apache) untuk point ke folder `public/`
4. Set file permissions: `chmod -R 755 storage bootstrap/cache`
5. Setup SSL certificate untuk HTTPS

Lihat panduan detail di dokumentasi deployment.

---

## 📄 License

Proyek ini menggunakan [MIT License](LICENSE).

---

## 👥 Team

- **Anggota 1** - Fullstack Developer Lead (Laravel setup, CRUD)
- **Anggota 2** - Backend Developer (Dashboard backend)
- **Anggota 3** - Frontend Developer (Dashboard UI)
- **Anggota 4** - QA/Tester (Testing & bug fixing)
- **Anggota 5** - DevOps/Backend (Deployment & documentation)

---

## 📞 Support

Jika ada pertanyaan atau issues:
1. Buka [GitHub Issues](https://github.com/your-username/inventaris/issues)
2. Contact: your-email@example.com

---

**Version**: 1.0.0  
**Last Updated**: June 2026  
**Status**: ✅ Production Ready

---

Made with ❤️ using Laravel

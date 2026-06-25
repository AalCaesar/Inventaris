# Sistem Inventaris

Aplikasi web untuk manajemen inventaris barang dengan Laravel 11.

## Features

- **Authentication** - Login/Logout dengan Laravel Breeze
- **CRUD Kategori Barang** - Manajemen kategori dengan search dan pagination
- **CRUD Barang** - Manajemen barang dengan search, filter kategori, dan pagination
- **Dashboard** - Statistik inventaris dengan visualisasi Chart.js
  - Total Kategori, Total Barang, Total Nilai Inventaris
  - Tabel Barang Stok Rendah (stock < 10)
  - Chart distribusi barang per kategori

## Requirements

- PHP 8.2+
- Composer 2.6+
- Node.js 18+
- MySQL 8.0+

## Installation

### 1. Clone repository

```bash
git clone [repo-url]
cd inventaris
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` dan sesuaikan database configuration:

```env
DB_DATABASE=inventaris
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Database setup

```bash
# Create database
CREATE DATABASE inventaris;

# Run migrations
php artisan migrate
```

### 5. Build assets

```bash
npm run build
```

### 6. Run server

```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

## Default Login

Untuk testing, buat user baru melalui halaman register atau gunakan seeder jika tersedia:

- Email: `admin@inventaris.com`
- Password: `password`

## Tech Stack

- **Backend**: Laravel 11.x
- **Frontend**: Bootstrap 5
- **JavaScript Libraries**: 
  - Chart.js - Data visualization
  - SweetAlert2 - Beautiful alerts/confirmations
  - Font Awesome - Icons
- **Database**: MySQL 8.0+
- **Build Tool**: Vite

## Project Structure

```
app/
├── Http/Controllers/
│   ├── CategoryController.php  # CRUD Kategori
│   ├── ItemController.php      # CRUD Barang  
│   └── DashboardController.php # Dashboard & Statistics
├── Models/
│   ├── Category.php            # Model Kategori
│   └── Item.php                # Model Barang
database/migrations/            # Database migrations
resources/
├── views/
│   ├── categories/             # Views Kategori
│   ├── items/                  # Views Barang
│   ├── dashboard.blade.php     # Dashboard view
│   └── layouts/app.blade.php   # Master layout
routes/web.php                  # Application routes
```

## Key Features Detail

### Authentication
- Laravel Breeze untuk authentication system
- Protected routes dengan `auth` middleware
- Session-based authentication

### Kategori Management
- CRUD operations dengan validation
- Search by nama kategori
- Pagination (10 items per page)
- Delete protection: kategori dengan items tidak bisa dihapus
- Display jumlah barang per kategori

### Barang Management
- CRUD operations dengan comprehensive validation
- Search by kode barang atau nama
- Filter by kategori
- Pagination (15 items per page)
- Auto-uppercase untuk kode barang
- Unique item_code validation
- Low stock badge (stock < 10)
- Format harga Rupiah

### Dashboard
- Real-time statistics:
  - Total Kategori
  - Total Barang
  - Total Nilai Inventaris (SUM stock × price)
  - Jumlah Barang Stok Rendah
- Tabel 10 barang dengan stok terendah
- Bar chart distribusi barang per kategori (Chart.js)

## Development

### Code Standards
- PSR-12 coding standard
- Laravel best practices
- Eager loading untuk prevent N+1 queries

### Security
- CSRF protection pada semua forms
- XSS prevention dengan Blade `{{ }}` escaping
- SQL injection prevention dengan Eloquent ORM
- Mass assignment protection dengan `$fillable`
- Server-side validation

## Testing

Manual testing checklist tersedia di `panduan_kerja_anggota.md` Section A-G.

## Deployment

Panduan lengkap deployment ke production tersedia di [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md).

Dokumentasi meliputi:
- Pre-deployment checklist
- Deployment ke Shared Hosting, VPS, dan Cloud
- Post-deployment verification
- Troubleshooting guide
- Maintenance & backup strategies

## License

MIT License

# Panduan Deployment Production

Dokumentasi lengkap untuk deployment aplikasi Sistem Inventaris ke production environment.

---

## 📋 Daftar Isi

1. [Pre-deployment Checklist](#pre-deployment-checklist)
2. [Persiapan Production Environment](#persiapan-production-environment)
3. [Deployment ke Shared Hosting](#deployment-ke-shared-hosting)
4. [Deployment ke VPS](#deployment-ke-vps)
5. [Deployment ke Cloud (Heroku/AWS)](#deployment-ke-cloud)
6. [Post-deployment Verification](#post-deployment-verification)
7. [Troubleshooting](#troubleshooting)

---

## Pre-deployment Checklist

Sebelum deployment, pastikan semua langkah berikut sudah dilakukan:

### ✅ Code Quality
- [ ] Semua test passed
- [ ] Tidak ada debugging code (dd, var_dump, console.log)
- [ ] Code review completed
- [ ] Git branch merged ke main/production

### ✅ Configuration
- [ ] `.env.production.example` sudah di-review
- [ ] Database production sudah disiapkan
- [ ] Domain/subdomain sudah disiapkan
- [ ] SSL certificate ready (Let's Encrypt recommended)

### ✅ Dependencies
- [ ] `composer install --optimize-autoloader --no-dev` tested locally
- [ ] `npm run build` tested dan assets di-generate
- [ ] All required PHP extensions installed

### ✅ Backup
- [ ] Backup kode existing (jika update)
- [ ] Backup database existing (jika update)
- [ ] Rollback plan ready

---

## Persiapan Production Environment

### 1. Optimize Dependencies

```bash
# Install production dependencies (tanpa dev dependencies)
composer install --optimize-autoloader --no-dev

# Build production assets
npm run build
```

### 2. Configure Environment

Copy `.env.production.example` ke `.env` dan sesuaikan:

```bash
cp .env.production.example .env
nano .env  # atau text editor lain
```

**Penting untuk diubah:**
- `APP_KEY` - Generate dengan `php artisan key:generate`
- `APP_URL` - URL production domain
- `APP_DEBUG` - HARUS `false` di production
- `DB_*` - Credentials database production
- `SESSION_DOMAIN` - Domain aplikasi

### 3. Database Setup

```bash
# Jalankan migrations di production database
php artisan migrate --force

# (Optional) Seed data awal jika diperlukan
php artisan db:seed --force
```

### 4. File Permissions

Set permissions yang benar untuk Laravel:

```bash
# Storage dan bootstrap/cache harus writable
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Ubah ownership ke web server user (contoh: www-data)
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

### 5. Optimize Laravel

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# (Optional) Cache events
php artisan event:cache
```

---

## Deployment ke Shared Hosting

**Best for:** Small projects, limited budget

### Requirements
- PHP 8.2+
- MySQL 8.0+
- Composer access (via SSH atau control panel)
- Node.js access (untuk build assets)

### Step-by-Step

#### 1. Upload Files

**Option A: Via cPanel File Manager**
- Zip project folder locally
- Upload via File Manager
- Extract di directory (biasanya `public_html` atau `htdocs`)

**Option B: Via FTP/SFTP**
- Gunakan FileZilla atau WinSCP
- Upload semua files kecuali `node_modules` dan `vendor`

**Option C: Via Git (Recommended)**
```bash
# SSH ke hosting
ssh user@yourdomain.com

# Clone repository
cd public_html
git clone https://github.com/yourusername/inventaris.git .
```

#### 2. Install Dependencies

```bash
# Via SSH
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

#### 3. Configure .env

```bash
cp .env.production.example .env
nano .env

# Generate APP_KEY
php artisan key:generate
```

#### 4. Setup Database

Via cPanel MySQL:
- Create database: `inventaris_prod`
- Create user dengan privileges
- Update `.env` dengan credentials

```bash
# Run migrations
php artisan migrate --force
```

#### 5. Configure Web Server

Buat file `.htaccess` di root (jika belum ada):

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

**Atau** ubah Document Root di cPanel:
- Domains → domain.com → Document Root
- Ubah ke: `public_html/inventaris/public`

#### 6. File Permissions

```bash
chmod -R 775 storage bootstrap/cache
```

#### 7. Optimize

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Deployment ke VPS

**Best for:** Full control, scalability, custom configuration

### Requirements
- VPS dengan SSH access (Ubuntu 22.04 recommended)
- Root atau sudo access
- Domain pointing ke VPS IP

### Step-by-Step

#### 1. Persiapan VPS

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install LEMP Stack
sudo apt install nginx mysql-server php8.2-fpm php8.2-mysql php8.2-mbstring \
  php8.2-xml php8.2-bcmath php8.2-curl php8.2-zip unzip git -y

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js & npm
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install nodejs -y
```

#### 2. Setup Database

```bash
# Secure MySQL
sudo mysql_secure_installation

# Create database
sudo mysql -u root -p
```

```sql
CREATE DATABASE inventaris_prod CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'inventaris_user'@'localhost' IDENTIFIED BY 'secure_password_here';
GRANT ALL PRIVILEGES ON inventaris_prod.* TO 'inventaris_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### 3. Deploy Application

```bash
# Clone repository
cd /var/www
sudo git clone https://github.com/yourusername/inventaris.git
cd inventaris

# Set ownership
sudo chown -R www-data:www-data /var/www/inventaris

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Setup .env
cp .env.production.example .env
nano .env
php artisan key:generate

# Run migrations
php artisan migrate --force

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
sudo chmod -R 775 storage bootstrap/cache
```

#### 4. Configure Nginx

Create Nginx config:

```bash
sudo nano /etc/nginx/sites-available/inventaris
```

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/inventaris/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable site:

```bash
sudo ln -s /etc/nginx/sites-available/inventaris /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

#### 5. Setup SSL with Let's Encrypt

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx -y

# Obtain SSL certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal test
sudo certbot renew --dry-run
```

#### 6. Setup Firewall

```bash
# Allow SSH, HTTP, HTTPS
sudo ufw allow 22
sudo ufw allow 80
sudo ufw allow 443
sudo ufw enable
```

---

## Deployment ke Cloud

### Heroku

**Step-by-Step:**

1. Install Heroku CLI
2. Create `Procfile`:
```
web: vendor/bin/heroku-php-apache2 public/
```

3. Deploy:
```bash
heroku create inventaris-app
heroku addons:create cleardb:ignite
heroku config:set APP_KEY=$(php artisan key:generate --show)
git push heroku main
heroku run php artisan migrate --force
```

### AWS Elastic Beanstalk

1. Install AWS CLI & EB CLI
2. Create `.ebextensions/01-laravel.config`
3. Deploy:
```bash
eb init
eb create production-env
eb deploy
```

---

## Post-deployment Verification

### 1. Functional Testing

- [ ] Akses homepage berhasil
- [ ] Login/Register berfungsi
- [ ] CRUD Kategori berfungsi
- [ ] CRUD Barang berfungsi
- [ ] Dashboard tampil dengan benar
- [ ] Charts rendering correctly
- [ ] Search & filter berfungsi
- [ ] Pagination berfungsi

### 2. Performance Check

```bash
# Check response time
curl -w "@curl-format.txt" -o /dev/null -s https://yourdomain.com
```

### 3. Security Check

- [ ] HTTPS aktif dan valid
- [ ] `APP_DEBUG=false` verified
- [ ] `.env` tidak publicly accessible
- [ ] SQL injection tested (basic)
- [ ] XSS protection verified
- [ ] CSRF tokens working

### 4. Monitor Logs

```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Nginx logs (VPS)
sudo tail -f /var/log/nginx/error.log
```

---

## Troubleshooting

### Issue: 500 Internal Server Error

**Solutions:**
```bash
# Check permissions
chmod -R 775 storage bootstrap/cache

# Check logs
tail storage/logs/laravel.log

# Clear & rebuild cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
```

### Issue: Mix Manifest Not Found

**Solution:**
```bash
npm run build
```

### Issue: CSRF Token Mismatch

**Solutions:**
- Check `SESSION_DOMAIN` in `.env`
- Clear browser cookies
- Verify `APP_URL` matches actual domain

### Issue: Database Connection Failed

**Solutions:**
- Verify DB credentials in `.env`
- Check MySQL is running
- Verify user has correct privileges
- Check firewall rules

### Issue: Storage Not Writable

**Solution:**
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

---

## Maintenance Mode

Untuk maintenance:

```bash
# Enable maintenance mode
php artisan down --message="Maintenance in progress" --retry=60

# Disable maintenance mode
php artisan up
```

---

## Backup Strategy

### Database Backup

```bash
# Manual backup
mysqldump -u username -p inventaris_prod > backup_$(date +%Y%m%d).sql

# Automated daily backup (crontab)
0 2 * * * mysqldump -u username -p inventaris_prod > /backups/db_$(date +\%Y\%m\%d).sql
```

### File Backup

```bash
# Backup application files
tar -czf inventaris_backup_$(date +%Y%m%d).tar.gz /var/www/inventaris
```

---

## Update Deployment

Untuk update aplikasi existing:

```bash
# Enable maintenance mode
php artisan down

# Backup database
mysqldump -u user -p inventaris_prod > backup_before_update.sql

# Pull latest code
git pull origin main

# Update dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Run migrations
php artisan migrate --force

# Clear & rebuild cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Disable maintenance mode
php artisan up
```

---

## Support & Contact

Untuk bantuan deployment atau troubleshooting:
- GitHub Issues: [your-repo/issues]
- Email: admin@yourdomain.com

---

**Last Updated:** 25 Juni 2026

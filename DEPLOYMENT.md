# 🚀 Deployment Guide - Sistem Inventaris

Panduan lengkap deployment aplikasi Sistem Inventaris ke production server.

---

## 📋 Pre-Deployment Checklist

Sebelum deploy, pastikan:

- [ ] Semua fitur sudah tested dan working
- [ ] Code sudah di-push ke Git repository
- [ ] Database production sudah disiapkan
- [ ] Domain/subdomain sudah pointing ke server
- [ ] SSL certificate sudah ready (atau akan setup Let's Encrypt)
- [ ] Server memenuhi requirements (PHP 8.2+, MySQL 8.0+, Composer, Node.js)

---

## 🎯 Deployment Options

### Option 1: Shared Hosting (cPanel)
Cocok untuk: Small projects, limited budget, easy management

### Option 2: VPS/Cloud (DigitalOcean, Linode, AWS)
Cocok untuk: Full control, scalability, production-grade

### Option 3: Platform-as-a-Service (Laravel Forge, Ploi)
Cocok untuk: Quick deployment, managed infrastructure

---

## 🔧 Option 1: Shared Hosting Deployment

### Step 1: Prepare Production Files

Di local machine:

```bash
# 1. Install production dependencies
composer install --optimize-autoloader --no-dev

# 2. Build production assets
npm run build

# 3. Create archive
cd ..
zip -r inventaris-production.zip inventaris -x "inventaris/node_modules/*" "inventaris/.git/*"
```

### Step 2: Upload to Server

1. Login ke cPanel
2. File Manager → Navigate ke folder web root (biasanya `public_html`)
3. Upload `inventaris-production.zip`
4. Extract file

### Step 3: Configure Environment

Di cPanel File Manager, edit `.env`:

```env
APP_NAME="Sistem Inventaris"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_production_db
DB_USERNAME=your_db_user
DB_PASSWORD=your_secure_password
```

Generate APP_KEY via terminal cPanel atau SSH:
```bash
php artisan key:generate
```

### Step 4: Database Setup

Di cPanel phpMyAdmin:
```sql
CREATE DATABASE inventaris_prod CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Run migrations via Terminal/SSH:
```bash
cd public_html/inventaris
php artisan migrate --force
```

### Step 5: Configure Document Root

Di cPanel → Domains → Manage:
- Point document root ke: `/public_html/inventaris/public`

### Step 6: File Permissions

```bash
chmod -R 755 storage bootstrap/cache
```

### Step 7: Optimization

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🖥️ Option 2: VPS Deployment (Ubuntu/Debian)

### Step 1: Server Setup

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install LEMP Stack
sudo apt install nginx mysql-server php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip unzip git -y

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs
```

### Step 2: MySQL Database Setup

```bash
sudo mysql
```

```sql
CREATE DATABASE inventaris_prod CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'inventaris_user'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT ALL PRIVILEGES ON inventaris_prod.* TO 'inventaris_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### Step 3: Clone & Setup Application

```bash
# Clone repository
cd /var/www
sudo git clone https://github.com/your-username/inventaris.git
cd inventaris

# Set ownership
sudo chown -R www-data:www-data /var/www/inventaris
sudo chmod -R 755 /var/www/inventaris
sudo chmod -R 775 /var/www/inventaris/storage
sudo chmod -R 775 /var/www/inventaris/bootstrap/cache

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Environment setup
cp .env.example .env
php artisan key:generate
```

Edit `.env`:
```bash
sudo nano .env
```

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_DATABASE=inventaris_prod
DB_USERNAME=inventaris_user
DB_PASSWORD=strong_password_here
```

Run migrations:
```bash
php artisan migrate --force
```

### Step 4: Nginx Configuration

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

### Step 5: SSL Certificate (Let's Encrypt)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx -y

# Obtain & install certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Test auto-renewal
sudo certbot renew --dry-run
```

### Step 6: Production Optimization

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## 🔒 Security Hardening

### 1. Hide Server Signature

Edit `/etc/nginx/nginx.conf`:
```nginx
server_tokens off;
```

### 2. Firewall Setup

```bash
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw enable
```

### 3. Disable Directory Listing

Already handled by Laravel (public/.htaccess)

### 4. Regular Updates

```bash
# Setup automatic security updates
sudo apt install unattended-upgrades -y
sudo dpkg-reconfigure --priority=low unattended-upgrades
```

---

## 📊 Monitoring & Maintenance

### Log Monitoring

```bash
# Laravel logs
tail -f /var/www/inventaris/storage/logs/laravel.log

# Nginx error logs
sudo tail -f /var/log/nginx/error.log

# PHP-FPM logs
sudo tail -f /var/log/php8.2-fpm.log
```

### Database Backup

```bash
# Manual backup
mysqldump -u inventaris_user -p inventaris_prod > backup_$(date +%Y%m%d).sql

# Setup automated daily backup (crontab)
0 2 * * * mysqldump -u inventaris_user -pYOUR_PASSWORD inventaris_prod > /backups/inventaris_$(date +\%Y\%m\%d).sql
```

### Application Updates

```bash
cd /var/www/inventaris
git pull origin main
composer install --no-dev --optimize-autoloader
npm install && npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
sudo systemctl restart php8.2-fpm
```

---

## 🐛 Troubleshooting

### Error: 500 Internal Server Error

1. Check Laravel logs: `storage/logs/laravel.log`
2. Check file permissions: `sudo chmod -R 775 storage bootstrap/cache`
3. Clear cache: `php artisan cache:clear && php artisan config:clear`

### Error: Database Connection Failed

1. Check `.env` credentials
2. Verify MySQL service: `sudo systemctl status mysql`
3. Test connection: `php artisan tinker` → `DB::connection()->getPdo();`

### Error: Assets Not Loading

1. Check Nginx root path: `/var/www/inventaris/public`
2. Rebuild assets: `npm run build`
3. Clear view cache: `php artisan view:clear`

### Error: Permission Denied

```bash
sudo chown -R www-data:www-data /var/www/inventaris
sudo chmod -R 755 /var/www/inventaris
sudo chmod -R 775 /var/www/inventaris/storage
sudo chmod -R 775 /var/www/inventaris/bootstrap/cache
```

---

## ✅ Post-Deployment Verification

- [ ] Visit https://yourdomain.com (should load without errors)
- [ ] Test registration & login
- [ ] Test CRUD Kategori (create, read, update, delete)
- [ ] Test CRUD Barang (all operations)
- [ ] Check Dashboard statistics & chart rendering
- [ ] Test search & filter functionality
- [ ] Verify responsive design (mobile/tablet/desktop)
- [ ] Check browser console (no JavaScript errors)
- [ ] Test form validations
- [ ] Verify SSL certificate (green padlock)

---

## 🎉 Success!

Aplikasi Sistem Inventaris Anda sekarang sudah live di production! 🚀

**Next Steps:**
1. Monitor logs regularly
2. Setup automated backups
3. Plan for scaling (jika traffic meningkat)
4. Consider CDN untuk assets (optional)

---

**Need Help?** Check troubleshooting section atau contact support.

# ⚡ Production Optimization - Quick Reference

Panduan cepat optimasi aplikasi untuk production deployment.

---

## 🚀 Production Setup Commands

### 1. Install Production Dependencies

```bash
# Install PHP dependencies (exclude dev packages)
composer install --optimize-autoloader --no-dev

# Install JavaScript dependencies
npm ci --production
```

### 2. Build Production Assets

```bash
# Build & minify assets untuk production
npm run build

# Verify build output
ls -lh public/build/
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Edit production values
nano .env
```

**Production .env settings:**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database (gunakan credentials production)
DB_DATABASE=inventaris_prod
DB_USERNAME=inventaris_user
DB_PASSWORD=secure_random_password

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Database Migrations

```bash
# Production migration (requires --force flag)
php artisan migrate --force

# Check migration status
php artisan migrate:status
```

---

## 🔧 Cache Optimization

### Clear All Caches

```bash
# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Clear compiled classes
php artisan clear-compiled
```

### Build Production Caches

```bash
# Cache configuration (speeds up config loading)
php artisan config:cache

# Cache routes (speeds up route registration)
php artisan route:cache

# Cache views (precompile all Blade templates)
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### Verify Caches

```bash
# Check cached files exist
ls -lh bootstrap/cache/
ls -lh storage/framework/cache/
ls -lh storage/framework/views/
```

---

## 🔒 File Permissions

### Set Correct Permissions

```bash
# Set ownership (www-data untuk Nginx/Apache)
sudo chown -R www-data:www-data /var/www/inventaris

# Set directory permissions
sudo find /var/www/inventaris -type d -exec chmod 755 {} \;

# Set file permissions
sudo find /var/www/inventaris -type f -exec chmod 644 {} \;

# Set writable directories
sudo chmod -R 775 /var/www/inventaris/storage
sudo chmod -R 775 /var/www/inventaris/bootstrap/cache
```

### Verify Permissions

```bash
ls -la storage/
ls -la bootstrap/cache/
```

---

## 🗄️ Database Optimization

### Backup Database

```bash
# Create backup
mysqldump -u username -p database_name > backup_$(date +%Y%m%d_%H%M%S).sql

# Verify backup
ls -lh backup_*.sql
```

### Optimize Tables

```bash
# Via MySQL CLI
mysql -u username -p

# In MySQL prompt
USE inventaris_prod;
OPTIMIZE TABLE categories;
OPTIMIZE TABLE items;
OPTIMIZE TABLE users;
```

---

## 📊 Performance Monitoring

### Check Application Status

```bash
# Check PHP-FPM status
sudo systemctl status php8.2-fpm

# Check Nginx status
sudo systemctl status nginx

# Check MySQL status
sudo systemctl status mysql

# Check disk space
df -h

# Check memory usage
free -h
```

### Monitor Logs

```bash
# Laravel application logs
tail -f storage/logs/laravel.log

# Nginx access logs
sudo tail -f /var/log/nginx/access.log

# Nginx error logs
sudo tail -f /var/log/nginx/error.log

# PHP-FPM error logs
sudo tail -f /var/log/php8.2-fpm.log

# MySQL error logs
sudo tail -f /var/log/mysql/error.log
```

---

## 🔄 Update Deployment Workflow

### Standard Update Process

```bash
# 1. Navigate to application directory
cd /var/www/inventaris

# 2. Enable maintenance mode
php artisan down

# 3. Pull latest code
git pull origin main

# 4. Update dependencies
composer install --no-dev --optimize-autoloader

# 5. Rebuild assets
npm ci --production
npm run build

# 6. Run migrations
php artisan migrate --force

# 7. Clear & rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 8. Restart services
sudo systemctl restart php8.2-fpm

# 9. Disable maintenance mode
php artisan up

# 10. Verify deployment
curl -I https://yourdomain.com
```

### Rollback Process (if needed)

```bash
# 1. Enable maintenance mode
php artisan down

# 2. Rollback git
git reset --hard HEAD~1

# 3. Rollback database
php artisan migrate:rollback

# 4. Clear caches
php artisan cache:clear
php artisan config:clear

# 5. Restart services
sudo systemctl restart php8.2-fpm

# 6. Disable maintenance mode
php artisan up
```

---

## 🧪 Post-Deployment Testing

### Quick Health Check

```bash
# Test HTTP response
curl -I https://yourdomain.com

# Test database connection
php artisan tinker
>>> DB::connection()->getPdo();

# Test queue (if used)
php artisan queue:work --once

# Check scheduled tasks
php artisan schedule:list
```

### Application Testing Checklist

```bash
# Via browser, test:
# - Homepage loads
# - Login works
# - Dashboard displays statistics
# - CRUD operations (Categories & Items)
# - Search & filter functionality
# - Form validations
# - SweetAlert confirmations
# - Chart.js rendering
# - Responsive design (mobile/tablet/desktop)
```

---

## 🛡️ Security Checklist

- [ ] APP_DEBUG=false in production
- [ ] APP_ENV=production
- [ ] Strong database password
- [ ] .env file not accessible via web
- [ ] Directory listing disabled
- [ ] HTTPS enabled (SSL certificate)
- [ ] Firewall configured (UFW/iptables)
- [ ] Regular security updates enabled
- [ ] File permissions correct (755/644)
- [ ] Backup strategy in place

---

## 📈 Performance Optimization Tips

### OPcache Configuration

Edit `/etc/php/8.2/fpm/php.ini`:

```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0
opcache.revalidate_freq=0
```

Restart PHP-FPM:
```bash
sudo systemctl restart php8.2-fpm
```

### MySQL Tuning

Edit `/etc/mysql/my.cnf`:

```ini
[mysqld]
innodb_buffer_pool_size = 1G
innodb_log_file_size = 256M
max_connections = 200
```

Restart MySQL:
```bash
sudo systemctl restart mysql
```

---

## 🎯 Troubleshooting Common Issues

### Issue: Slow Page Load

**Solution:**
```bash
# Enable all caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Check OPcache status
php -i | grep opcache
```

### Issue: 502 Bad Gateway

**Solution:**
```bash
# Check PHP-FPM
sudo systemctl status php8.2-fpm
sudo systemctl restart php8.2-fpm

# Check Nginx logs
sudo tail -f /var/log/nginx/error.log
```

### Issue: Database Too Slow

**Solution:**
```bash
# Analyze slow queries
sudo mysql -u root -p
> SET GLOBAL slow_query_log = 'ON';
> SET GLOBAL long_query_time = 2;

# Check indexes
SHOW INDEX FROM items;
SHOW INDEX FROM categories;
```

---

## 📞 Support

**Production Issues?**
1. Check logs: `storage/logs/laravel.log`
2. Review this guide's troubleshooting section
3. Contact: your-email@example.com

---

**Last Updated:** June 2026  
**Version:** 1.0.0

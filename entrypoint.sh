#!/bin/sh

# Aktifkan virtualenv untuk Python
export PATH="/opt/venv/bin:$PATH"

# Salin .env jika belum ada
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Tunggu database MySQL siap
echo "Menunggu database MySQL..."
while ! nc -z mysql 3306; do
  sleep 2
  echo "Menunggu database MySQL..."
done
echo "Database MySQL siap!"

# Setup Laravel
php artisan key:generate
php artisan migrate --force

# Permissions Laravel
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Bersihkan cache Laravel
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Jalankan Flask app Python di background
echo "Menjalankan Python Flask app..."
python3 storage/app/python/app.py &

# Jalankan PHP-FPM di background
php-fpm -D

# Jalankan Nginx di foreground
nginx -g "daemon off;"
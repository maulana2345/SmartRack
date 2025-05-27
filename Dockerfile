FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    python3 python3-venv python3-pip \
    nodejs npm curl zip unzip git nginx netcat-openbsd \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Buat virtual environment untuk Python
ENV VENV_PATH=/opt/venv
RUN python3 -m venv $VENV_PATH
ENV PATH="$VENV_PATH/bin:$PATH"

# Salin requirements.txt dan install Python requirements
COPY requirements.txt /var/www/SmartRack/
RUN pip install --upgrade pip && pip install -r /var/www/SmartRack/requirements.txt

# Set direktori kerja
WORKDIR /var/www/SmartRack

# Salin seluruh isi project ke container
COPY . .

# Pastikan direktori Python dan app.py disalin
RUN mkdir -p storage/app/python

# Set permission untuk Laravel
RUN chmod -R 777 storage bootstrap/cache

# Install Laravel dan build frontend
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --optimize-autoloader \
    && npm install \
    && npm run build || true

# Salin konfigurasi nginx
COPY default.conf /etc/nginx/conf.d/default.conf

# Salin entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expose port HTTP
EXPOSE 80

# Jalankan entrypoint
ENTRYPOINT ["/entrypoint.sh"]
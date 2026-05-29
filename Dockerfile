FROM php:8.3-fpm

# Install dependensi sistem, termasuk NodeJS dan NPM
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copy file project ke dalam container
WORKDIR /var/www
COPY . .

# Install Composer (Backend)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --optimize-autoloader --no-dev

# ==========================================
# EKSEKUSI NPM UNTUK TAILWIND & JS (FRONTEND)
# ==========================================
# 1. Install dependensi dari package.json
RUN npm install

# 2. Build asset (Vite akan memproses Tailwind dan JS murni-mu ke folder public/build)
RUN npm run build
# ==========================================

# Set permissions agar Nginx/PHP bisa membaca file yang baru di-build
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public
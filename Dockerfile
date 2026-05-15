# Menggunakan image PHP 8.2 (Cocok untuk Laravel versi terbaru)
FROM php:8.2-cli

# Menginstal ekstensi Linux yang dibutuhkan untuk PostgreSQL dan ZIP
RUN apt-get update -y && apt-get install -y libpq-dev libzip-dev unzip

# Menginstal ekstensi PHP untuk nyambung ke Supabase
RUN docker-php-ext-install pdo pdo_pgsql zip

# Mengambil Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Menyiapkan folder kerja di dalam server Render
WORKDIR /app

# Meng-copy semua file Laravelmu ke dalam server
COPY . .

# Menginstal library Laravel
RUN composer install --optimize-autoloader --no-dev

# Memberikan izin akses folder agar tidak error 500
RUN chmod -R 777 storage bootstrap/cache

# Menyalakan server bawaan Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
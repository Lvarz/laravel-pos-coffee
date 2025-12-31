# 1. โหลด Image PHP 8.2 มาใช้
FROM php:8.2-fpm

# 2. ลงโปรแกรมพื้นฐานที่จำเป็นใน Linux
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# 3. ล้างขยะเพื่อลดขนาดไฟล์
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 4. ลง Extension ของ PHP ที่ Laravel จำเป็นต้องใช้
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 5. ลง Composer (ตัวจัดการ Library ของ PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. กำหนดว่าไฟล์งานเราจะอยู่ที่ไหนใน Container
WORKDIR /var/www
# Backend Dockerfile
FROM php:8.1-fpm

# Instala dependências necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip
# Habilita extensões do PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip

# Define o diretório de trabalho
WORKDIR /var/www

# Copia os arquivos do projeto
COPY . .

# Instala as dependências do Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala dependências do Laravel
RUN composer install

# Expondo a porta padrão
EXPOSE 8000

# Comando para iniciar o servidor
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]

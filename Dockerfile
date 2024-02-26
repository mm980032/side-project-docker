# 第一阶段：构建 PHP Apache
FROM php:8.2-apache AS php_apache

# 启用 Apache 的 Rewrite 模块
RUN a2enmod rewrite

# 安装 PHP 扩展
RUN docker-php-ext-install pdo_mysql

COPY /htdocs/XinLiangPin-Company-API/  /var/www/html
COPY /htdocs/StockMarket /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# 暴露 80 端口，允许外部访问
EXPOSE 80

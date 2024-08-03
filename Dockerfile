FROM webdevops/php-nginx:8.2-alpine
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV WEB_DOCUMENT_ROOT /app/public
WORKDIR /app
COPY . .
RUN apk add --no-cache mysql-client mariadb-connector-c
RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN chown -R application:application .
RUN chmod +x /app/start.sh
CMD ["./start.sh"]

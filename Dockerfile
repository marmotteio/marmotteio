FROM webdevops/php-nginx:8.2-alpine
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV WEB_DOCUMENT_ROOT /app/public
WORKDIR /app
COPY . .
RUN apk add --no-cache mysql-client mariadb-connector-c
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.5/install.sh | bash
RUN export NVM_DIR="$HOME/.nvm"
RUN [ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"
RUN nvm install node
RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN npm run build
RUN chown -R application:application .
RUN chmod +x /app/start.sh
CMD ["./start.sh"]
FROM php:apache
RUN a2enmod rewrite && service apache2 restart
COPY . /var/www/html/
COPY .env.docker /var/www/html/.env
EXPOSE 80
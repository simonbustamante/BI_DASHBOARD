FROM nginx:latest

COPY nginx.conf /etc/nginx/conf.d/nginx.conf
COPY my-site.crt /etc/ssl/certs/my-site.crt
COPY my-site.key /etc/ssl/private/my-site.key
COPY php-fpm.conf /etc/php/php-fpm.d/php-fpm.conf


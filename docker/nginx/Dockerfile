FROM nginx:1.21-alpine

LABEL MAINTAINER="Ricardo Alama"

RUN mkdir -p /var/www/html && cp /usr/share/nginx/html/index.html /var/www/html/
COPY config/default.conf /etc/nginx/conf.d/default.conf
COPY config/nginx.conf /etc/nginx/nginx.conf

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
# get latest nginx image
FROM nginx:latest

# sets the docker environment variables
ENV NGINX_ROOT /usr/src/app/public
ENV NGINX_FPM_HOST 127.0.0.1
ENV NGINX_FPM_PORT 3001

# remove nginx config that already exists on the nginx image
RUN rm -f /etc/nginx/conf.d/default.conf
RUN rm -f /etc/nginx/nginx.conf

# copy all config files from host to container
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./nginx/fpm-template.conf /etc/nginx/fpm.tmpl
COPY ./nginx/entrypoint.sh /usr/local/bin/entrypoint.sh

# give executable privilages
RUN chmod +x /usr/local/bin/entrypoint.sh
# expose image to port 80
EXPOSE 80
# configure container to run as executable
ENTRYPOINT ["entrypoint.sh"]

FROM nginx:alpine

# Copy certificates
COPY ./nginx/certs /etc/nginx/certs/

# Copy nginx config
COPY ./nginx/default.conf /etc/nginx/conf.d/

# Copy custom startup script
COPY ./nginx/start.sh /
RUN chmod +x /start.sh

CMD ["nginx", "-g", "daemon off;"]

FROM nginx:alpine

RUN apk add --no-cache curl

COPY frontend/src/ /usr/share/nginx/html/
COPY frontend/nginx/default.conf /etc/nginx/conf.d/default.conf

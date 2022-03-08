#!/bin/sh
set -e

if [ -z ${TZ+x} ]; then
  echo "Warning : TimeZone is unset !";
else
  ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone ;
fi

if [ -z ${PHP_ADDRESS+x} ]; then
  echo "Error : PHP_ADDRESS is unset, please specify php hostname";
  exit 1
else
  sed -i "s/\${PHP_ADDRESS}/${PHP_ADDRESS}/" /etc/nginx/conf.d/default.conf
fi

if [ -z ${SERVER_NAME+x} ]; then
  echo "Error : SERVER_NAME is unset, please specify nginx hostname";
  exit 1
else
  sed -i "s/\${SERVER_NAME}/${SERVER_NAME}/" /etc/nginx/conf.d/default.conf
fi

exec "$@"

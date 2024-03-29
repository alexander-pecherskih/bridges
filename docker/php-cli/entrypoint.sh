#!/bin/sh
set -e

HOST_DOMAIN="host.docker.internal"

if ! ping -q -c1 $HOST_DOMAIN > /dev/null 2>&1
then
  HOST_IP=$(ip route | awk 'NR==1 {print $3}')
  echo "$HOST_IP $HOST_DOMAIN" >> /etc/hosts
fi

if [ "${1#-}" != "$1" ]; then
  set -- php-fpm "$@"
fi

exec "$@"
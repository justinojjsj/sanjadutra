#!/usr/bin/env bash

#echo "Hello from our entrypoint!"
#touch /CRIEI2.tx
/etc/init.d/cron start

exec "$@"
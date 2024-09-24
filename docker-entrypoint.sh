#!/usr/bin/env bash

/etc/init.d/cron start
chmod u+x /app/agendador.sh
/app/agendador.sh

exec "$@"
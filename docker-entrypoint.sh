#!/usr/bin/env bash

/etc/init.d/cron start
chmod u+x /app/agendador.sh
chmod u+x /app/exec.sh
chmod u+x /app/exec2.sh
/app/agendador.sh

exec "$@"
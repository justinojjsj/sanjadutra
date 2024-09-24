#!/bin/bash

crontab -l > meucron
#echo minuto hora dia_do_mês mês dia_da_semana comando
echo "0,15,30,45 * * * * /app/exec.sh" > meucron
echo "1 0 * * * /app/exec2.sh" >> meucron
crontab meucron
rm meucron

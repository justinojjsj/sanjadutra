#!/bin/bash

crontab -l > meucron
echo "0,15,30,47 * * * * /app/exec.sh" > meucron
crontab meucron
rm meucron

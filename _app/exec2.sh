#!/bin/bash

#VARIAVEIS
python_e="/usr/local/bin/python"
app_classificador_temporal="/app/classificador_temporal.py"
data_hora=$(date '+%d/%m/%y %H:%M:%S')
espaco=" "

#SCRIPT
cd /app
$python_e $app_classificador_temporal
echo $app_classificador_temporal$espaco$data_hora >> hora_executada.log #salva horario de execucao
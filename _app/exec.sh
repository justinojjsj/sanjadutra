#!/bin/bash

#VARIAVEIS
python_e="/usr/local/bin/python"
app_ccr="/app/ccr.py"
app_classificador="/app/classificador.py"
data_hora=$(date '+%d/%m/%y %H:%M:%S')
espaco=" "

#SCRIPT
cd /app
$python_e $app_ccr #executa app_ccr.py
echo $app_ccr$espaco$data_hora >> hora_executada.log #salva horario de execucao
$python_e $app_classificador
echo $app_classificador$espaco$data_hora >> hora_executada.log
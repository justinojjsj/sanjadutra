#!/bin/bash

#VARIAVEIS
python_e="/usr/local/bin/python"
app_classificador_temporal="/app/classificador_temporal.py"
data_hora=$(date '+%d/%m/%y %H:%M:%S')
espaco=" "

#SELECIONA O ARQUIVO QUE IRÁ SALVAR
nome_do_pc=$(cat nome_host.txt)

if [ "$nome_do_pc" = "montech" ]; then
    nome_arquivo_log="hora_executada_montech.log"
elif [ "$nome_do_pc" = "capturador" ]; then
    nome_arquivo_log="hora_executada_capturador.log"
else
    nome_arquivo_log="hora_executada_outropc.log"
fi

#SCRIPT
cd /app
$python_e $app_classificador_temporal
echo $app_classificador_temporal$espaco$data_hora >> $nome_arquivo_log #salva horario de execucao
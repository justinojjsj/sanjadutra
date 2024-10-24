#!/bin/bash

#VARIAVEIS
python_e="/usr/local/bin/python"
app_ccr="/app/ccr.py"
app_classificador="/app/classificador.py"
data_hora=$(date '+%d/%m/%y %H:%M:%S')
espaco=" "

#SELECIONA O ARQUIVO QUE IRÁ SALVAR
nome_do_pc=$(/usr/bin/hostname)

if [ "$nome_do_pc" = "montech" ]; then
    nome_arquivo_log="hora_executada_montech.log"
elif [ "$nome_do_pc" = "capturador" ]; then
    nome_arquivo_log="hora_executada_capturador.log"
else
    nome_arquivo_log="hora_executada_outropc.log"
fi

#SCRIPT
cd /app
$python_e $app_ccr #executa app_ccr.py
echo $app_ccr$espaco$data_hora >> $nome_arquivo_log #salva horario de execucao
$python_e $app_classificador
echo $app_classificador$espaco$data_hora >> $nome_arquivo_log
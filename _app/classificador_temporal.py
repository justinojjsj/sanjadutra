### CLASSIFICADOR TEMPORAL ###

# Pega os dados da tabela classificados e completa lacunas de horários com zeros

from datetime import date, datetime, timedelta
import time
import mysql.connector

db_connection = mysql.connector.connect(host='170.17.0.3', user='root', password='my-secret-pw', database='db_ccr')
cursor = db_connection.cursor()

cursor.execute('SELECT hora_coleta FROM classificados WHERE cidade="São José dos Campos" AND data_coleta="2024-09-10"')

resultados = cursor.fetchall()

# Cria o vetor para salvar horários do banco
horarios_banco = []

# Salvar horários do banco em no vetor
for linha in resultados:
    horarios_banco.append(linha[0])

for horario in horarios_banco:
    print(horario)



def gerar_horarios(inicio_str, fim_str, intervalo_minutos=15):
    # Convertendo as strings de início e fim para objetos datetime
    formato = "%H:%M:%S"
    inicio = datetime.strptime(inicio_str, formato)
    fim = datetime.strptime(fim_str, formato)
    
    # Ajustar o fim para o próximo dia se necessário
    if fim < inicio:
        fim += timedelta(days=1)
    
    horarios = []
    atual = inicio
    
    while atual <= fim:
        horarios.append(atual.strftime(formato))
        atual += timedelta(minutes=intervalo_minutos)
    
    return horarios

# Gerar horários
horarios = gerar_horarios("05:00:00", "04:45:00")
for horario in horarios:
    print(horario)


##### FAZER UM DIFF ENTRE O VETOR HORARIOS_BANCO E HORARIOS. A PARTIR DO RESULTADO COMPLETAR COM ZEROS.

# Fechar o cursor e a conexão
cursor.close()
db_connection.close()
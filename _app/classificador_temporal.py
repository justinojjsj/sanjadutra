### CLASSIFICADOR TEMPORAL ###

# Pega os dados da tabela classificados e completa lacunas de horários com zeros

from datetime import date, datetime, timedelta
import time
import mysql.connector

db_connection = mysql.connector.connect(host='170.17.0.3', user='root', password='my-secret-pw', database='db_ccr')
cursor = db_connection.cursor()

#data = '2024-09-18'
#Capturando a data de um dia anterior
data_atual = date.today()
data_anterior = data_atual - timedelta(days=1)
data = str(data_anterior)
cidade = 'São José dos Campos'

#query = "SELECT * FROM classificados WHERE cidade=%s AND data_coleta=%s"
#cursor.execute(query, (cidade, data))

query = """
SELECT *, %s AS data_especifica
FROM classificados
WHERE cidade LIKE 'São José%';
"""
cursor.execute(query, (data,))

resultados = cursor.fetchall()

print(cursor.statement)

# Cria o vetor para salvar horários do banco
horarios_banco = []

# Salvar horários do banco no vetor removendo os segundos
for linha in resultados:
#    print(f"km_ini = {linha[1]} | km_fim = {linha[2]} | pista = {linha[3]} | trafego = {linha[4]} | motivo = {linha[5]} | cidade = {linha[6]} | data_coleta = {linha[7]} | hora_coleta = {linha[8]} ")
    # Inserindo dados originais na tabela classificados_temporais, alterando trafego para valor numérico
    trafego = linha[4]
    if trafego == 'Normal':
        trafego = 1
    elif trafego == 'Acesso':
        trafego = 2
    elif trafego == 'Lento':
        trafego = 3
    elif trafego == 'Intenso':
        trafego = 4
    elif trafego == 'Congestionado':
        trafego = 5
    elif trafego == 'Interditado':
        trafego = 6

    # Coletando dados de horas para manipulação
    hb = linha[8]
    remove_segundos = hb[:-3]
    horarios_banco.append(remove_segundos)

    insere_originais = "INSERT INTO classificados_temporais (km_ini, km_fim, pista, trafego, motivo, cidade, data_coleta, hora_coleta) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
    dados = (linha[1], linha[2], linha[3], trafego, linha[5], linha[6], linha[7], remove_segundos)
    cursor.execute(insere_originais, dados)

horarios_banco = list(set(horarios_banco)) # Remove valores duplicados
horarios_banco = sorted(horarios_banco)

for horario in horarios_banco:
    print(horario)

def gerar_horarios(inicio_str, fim_str, intervalo_minutos=15):
    # Convertendo as strings de início e fim para objetos datetime
    formato = "%H:%M"
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

print("\n ######################### \n")

# Gerar horários
horarios = gerar_horarios("05:00", "04:45")
# for horario in horarios:
#     print(horario)

#Obtém os horários que não estão registrados no banco de dados
horarios_zerados = [item for item in horarios if item not in horarios_banco]

for hz in horarios_zerados:
    #print(hz)
    sql = "INSERT INTO classificados_temporais (km_ini, km_fim, pista, trafego, motivo, cidade, data_coleta, hora_coleta) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
    dados = ('136', '139', 'Expressa', '0', 'fluxo_continuo', cidade, data, hz)
    cursor.execute(sql, dados)

# Confirmar a transação
db_connection.commit()


# Fechar o cursor e a conexão
cursor.close()
db_connection.close()
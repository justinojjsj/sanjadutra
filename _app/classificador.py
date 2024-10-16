# Script para classificar os dados da tabela dados da seguinte forma na tabela classificados
# classificados(id, km_ini, km_fim, pista, trafego, data_coleta, hora_coleta)

from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.firefox.options import Options
from datetime import date
from datetime import datetime
import mysql.connector
import time
db_connection = mysql.connector.connect(host='170.17.0.3', user='root', password='my-secret-pw', database='db_ccr')

#Setando opções do driver firefox
f_options=Options()
f_options.add_argument("-headless")  
options = webdriver.FirefoxOptions()  
webBrowser = webdriver.Firefox(options=f_options)

#Site dos dados para serem capturados
webBrowser.get('https://rodovias.grupoccr.com.br/riosp/cameras-ao-vivo/?openModalCamera=open&camera=km-156-sp')

#Tempo de espera para carregar os dados na página adequadamente
time.sleep(10)

#Classe a ser capturada
conteudo = webBrowser.find_element(By.CLASS_NAME, "cmp-modalCamera__alerts").text
webBrowser.close()

#Separa o conteúdo em vetor
conteudo = conteudo.splitlines()
tamanho = len(conteudo)

i = 0 #contador para o while
titulo = 2 #contador para os titulos
texto = 3  #contador para as noticias

data = date.today()
#data = data.strftime('%d/%m/%Y')
hora = datetime.now()
hora = hora.strftime('%H:%M:%S')

#Condicional criada para capturar dados dos momentos em que não há trânsito
if(tamanho==1):
    #print(conteudo[0])
    sql = f"INSERT INTO classificados (km_ini, km_fim, pista, trafego, data_coleta, hora_coleta) VALUES ('128','162','total','livre','{data}','{hora}')"
    cursor = db_connection.cursor()
    cursor.execute(sql)
    cursor.close() 
else:
    #imprime o conteudo de cada notícia de tráfego separadamente
    while(i < tamanho):
        #Recebimento dos dados a serem colocados no banco (exceto num_noticias, esse é apenas visual)
        #num_noticia = str(int((i/4)+1))
        titulo_t = conteudo[titulo]
        texto_t = conteudo[texto]
        
        #Obtendo somente a kilometragem
        titulo_t = titulo_t.split()
        km_ini = titulo_t[2]
        km_fim = titulo_t[5]
        #print(titulo_t)
                
        #Limpando texto para ficar somente tráfego e a pista
        texto_t = texto_t.split()
        trafego = texto_t[9]
        pista = texto_t[12]
        pista = pista.rstrip(".") #Remove ponto ao final da palavra

        #Obtendo dados do motivo do tráfego
        #print(texto_t)
        tamanho_texto = len(texto_t)
        cont=0
        motivo=' '
        cidade=[]
        del_cidade=0 #Delimitador do nome da cidade

        while(cont < tamanho_texto):
            if(texto_t[cont] == 'Obras' or texto_t[cont] == 'obras' or texto_t[cont] == 'Obra' or texto_t[cont] == 'obra' or texto_t[cont] == 'obra.' or texto_t[cont] == ',obra'):
                motivo = 'obra'
            elif(texto_t[cont] == 'acidente' or texto_t[cont] == 'acidente.'):
                motivo = 'acidente'
            elif(texto_t[cont] == 'detonação'):
                motivo = 'detonacao'
            
            #Capturar a cidade que está a ocorrência (cidade com uma palavra, duas palavras: São Paulo, quatro palavras: São José dos Campos e três palavras: Serra das Araras)
            if(texto_t[cont] == 'Em' and del_cidade==0):
                cidade = texto_t[cont+1]
                
                #Se a próxima palavra for km supoẽ-se que o motivo é quantidade de veículos na pista, pois a ccr só informa o km inicial ou final
                if(texto_t[cont+2] == 'km'):
                    motivo = 'qtde_veiculos'
                
                if((texto_t[cont+1] == 'São' and texto_t[cont+2] == 'Paulo,')or((texto_t[cont+1] == 'São' and texto_t[cont+2] == 'Paulo.'))):
                    cidade = texto_t[cont+1]+' '+texto_t[cont+2]
                    del_cidade=1
                    if(texto_t[cont+3] == 'km'):
                        motivo = 'qtde_veiculos'
                elif((texto_t[cont+1] == 'São' and texto_t[cont+2] != 'Paulo,')or((texto_t[cont+1] == 'São' and texto_t[cont+2] != 'Paulo.'))):
                    cidade = texto_t[cont+1]+' '+texto_t[cont+2]+' '+texto_t[cont+3]+' '+texto_t[cont+4]
                    del_cidade=1
                    if(texto_t[cont+5] == 'km'):
                        motivo = 'qtde_veiculos'
            elif(texto_t[cont] == 'Na' and del_cidade==0):
                cidade = texto_t[cont+1]+' '+texto_t[cont+2]+' '+texto_t[cont+3]
                del_cidade=1
                if(texto_t[cont+4] == 'km'):
                    motivo = 'qtde_veiculos'
                
            cont=cont+1
        cidade = cidade.rstrip(",") #Remove vírgula ao final da palavra
        cidade = cidade.rstrip(".") 
            
        #Caso haja algum motivo que não tenha sido previsto, registrar conteúdo inteiro para depois aprimorar    
        if(motivo == ' '):
            motivo = ' '.join(texto_t[13:tamanho_texto])
            
        motivo = motivo.rstrip(".")
       
        #print('Tamanho texto: '+str(tamanho_texto)+' Contador: '+str(cont)+' Motivo: '+motivo)
        
                        
        #Impressão dos dados (meramente visual)    
        #print("Notícia: "+num_noticia)
        #print('Título: '+titulo_t)
        print('Km inicial: '+km_ini)
        print('Km fim: '+km_fim)
        #print('Texto: '+texto_limpo)
        print('Tráfego: '+trafego)
        print('Pista: '+pista)
        print('Motivo: '+motivo)
        print('Cidade: '+cidade)
        print('Data da coleta: '+str(data))
        print('Hora da coleta: '+str(hora))
        print(' ')
        titulo = titulo + 4
        texto = texto + 4
        
        sql = f"INSERT INTO classificados (km_ini, km_fim, pista, trafego, motivo, cidade, data_coleta, hora_coleta) VALUES ('{km_ini}','{km_fim}','{pista}','{trafego}','{motivo}','{cidade}','{data}','{hora}')"
        cursor = db_connection.cursor()
        cursor.execute(sql)
        cursor.close()    
        
        i = i+4

db_connection.commit()
db_connection.close()

#Pegar somente as últimas notícias baseado na hora mais recente
#Pega a última hora do banco, depois pega todas as notícias que rodaram aquela hora
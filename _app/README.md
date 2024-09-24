# SANJADUTRA _APP

## ETAPA DO DESENVOLVIMENTO

Fazer tabela no _web gerar gráfico de linha com horários de fluxos (no php)

## SCRIPTs SHELL

### agendador.sh

Configura o agendador de tarefas cron com os scripts que serão executados:

1. exec.sh que executa as rotinas a cada 15 minutos
2. exec2.sh que executa as rotinas uma vez ao dias às 00h01min

### exec.sh

1. Executa os scripts python app_ccr.py e classificador.py
2. Salva o horário de execução no hora_executado.log

### exec2.sh

1. Executa o script classificador_temporal.py
2. Salva o horário de execução no hora_executado.log

## SCRIPTs PYTHON

### ccr.py

- Acessa a página com informações de tráfego da rodovia, fornecidos pela CCR e salva no banco de dados de forma catalogada.

### classificador.py

- Captura os dados de tráfego da rodovia Presidente Dutra sentido RIO-SP
- Limpa os dados e salva na tabela [classificados] do banco de dados da seguinte forma:

   - km_ini
   - km_fim
   - pista
   - trafego
   - cidade
   - data_coleta
   - hora_coleta


### classificador_temporal.py

- Lê a tabela [classificados] do banco de dados filtrando São José dos Campos, um dia anterior.
- Verifica todos os horários com informações registradas na tabela das 05:00 às 04:45, de 15 em 15 minutos. Caso não tenha informações em preenchidas em algum desse horário do intervalo preenche o campo [motivo] com a informção "fluxo_continuo" e o campo tráfego com a informação [0].
- Transforma os dados do campo [trafego] da tabela [classificados] em índices, conforme a tabela abaixo:

|       Tabela de tráfego       |
| Índice        | Tráfego       | 
| ------------- | ------------- | 
| 1             | Normal        | 
| 2             | Acesso        | 
| 3             | Lento         | 
| 4             | Intenso       |
| 5             | Congestionado |
| 6             | Interditado   |

- Observação: A coluna 'Tráfego' é baseado nos nomes disponibilizados pela CCR, já a coluna 'Índice' foi estabelecida pelo grupo a fim de gerar os gráficos no php.

## OUTROS

### hora_executada.log

Armazena os logs que contém os instantes que foram executados os scripts shell

### requirements.txt

Deve-se colocar nesse arquivo todas as bibliotecas que o python irá utilizar para executar os scripts. Esse arquivo é lido no momento da instalação dos containers, já instalando as bibliotecas.
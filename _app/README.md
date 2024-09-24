# SANJADUTRA _APP

## ETAPA DO DESENVOLVIMENTO

1. <CONCLUÍDO> Capturar dados de tráfego da rodovia Presidente Dutra sentido RIO-SP via script [classificador.py] nos trechos:

    Início: Km 128 (Caçapava)
    Fim: km 162 (Jacareí)

2. <CONCLUÍDO> Limpar os dados de [classificados] forma que fique:

   - km_ini
   - km_fim
   - pista
   - trafego
   - cidade
   - data_coleta
   - hora_coleta

3. <CONCLUÍDO> Completar dados da tabela [classificados] enviando para tabela [classificados_temporal] com a finalidade de gerar gráfico de linha com horários de fluxos (no php):

- Tabela de nomenclatura de tráfego. O nome é dado pela CCR e o índice foi estabelecido pelo grupo

| Índice        | Tráfego       | 
| ------------- | ------------- | 
| 1             | Normal        | 
| 2             | Acesso        | 
| 3             | Lento         | 
| 4             | Intenso       |
| 5             | Congestionado |
| 6             | Interditado   |

4. <Concluído> Colocar dados no agendador de tarefas para executar todos os dias, uma vez ao dia, capturando os dados do dia anterior

5. Fazer tabela no _web

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

- Observação: A coluna 'Tráfego' é baseado nos nomes disponibilizados pela CCR, já a coluna índice foi estabelecida pelo grupo a fim de gerar os gráficos no php.

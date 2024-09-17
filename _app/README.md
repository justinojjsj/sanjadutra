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

4. Colocar dados no agendador de tarefas para executar todos os dias, uma vez ao dia, capturando os dados do dia anterior

5. Fazer tabela no _web

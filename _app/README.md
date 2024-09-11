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

3. Completar dados da tabela [classificados] enviando para tabela [classificados_temporal] com a finalidade de gerar gráfico de linha com horários de fluxos (no php):

    - Alimentar tabela classificados_temporais com todos os horários Início 05:00 e fim 04:59;
    - Para os horários que tiver dados, alimentar normalmente, para os que não tiver, alimentar com zeros.
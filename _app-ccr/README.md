# SANJADUTRA APP CCR

## ETAPA DO DESENVOLVIMENTO

1. <CONCLUÍDO> Capturando dados de tráfego da rodovia Presidente Dutra sentido RIO-SP via script [classificador.py] nos trechos:

    Início: Km 128 (Caçapava)
    Fim: km 162 (Jacareí)

2. <CONCLUÍDO> Limpando os dados de forma que fique:

   - km_ini
   - km_fim
   - pista
   - trafego
   - cidade
   - data_coleta
   - hora_coleta

3. Próximo passo: Manipular dados classificados gerando gráficos de horários de fluxos

   
4. Dados para gerar gráfico de linha:

    - Alimentar tabela classificados_temporais com todos os horários Início 05:00 e fim 04:59
    - Para os horários que tiver dados, alimentar normalmente, para os que não tiver, alimentar com zeros
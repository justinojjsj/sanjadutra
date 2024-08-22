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

    - Gráfico de colunas:
        
        - Quantidade de acidentes por cidade: 
        
        Enquanto motivo='acidente' e for a mesma cidade soma 1, até que motivo seja diferente ou vazio dentro das próximas 24 horas.
    
    - Gráfico de linha:

        - Apresentar os horários com os maiores fluxos de veículos em São José dos Campos

        cidade='São José dos Campos' e trafego='Intenso'
        
        SELECT * FROM `classificados` WHERE cidade='São José dos Campos' AND trafego='intenso'


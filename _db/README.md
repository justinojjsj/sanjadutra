# SANJADUTRA _DB

## Banco de dados db_ccr
- Banco db_ccr_07112024.sql é um banco com dados capturados 24horas, do dia 30/10/2024 à 06/11/2024;
- Esses dados foras tratados diretamente no banco através dos códigos do arquivo 'limpeza_bds';
- Após a limpeza foi usado esse banco para fazer os últimos gráficos, com os dados mais purificados.

Obs.: Os bancos anteriores contém diversos outros dados, mas que contém alguns detalhes faltando, pois o sistema ainda não estava totalmente pronto e capturando corretamente.

### Tabela dados(id, titulo, texto, data_coleta, hora_coleta)
- Usada para armazenar as informações de tráfego de maneira crua, enviada pelo python.

### Tabela locais(id, cidade, km_ini, km_fim)
- Armazena onde inicia e termina os km das cidades, de acordo com a ccr (informação estática retirada do Google Maps)

### Tabela classificados(id, km_ini, km_fim, pista, trafego, motivo, data_coleta, hora_coleta)
- Armazena os dados classificados, retirados da tabela dados

### Tabela classificados_temporais(id, km_ini, km_fim, pista, trafego, motivo, data_coleta, hora_coleta)
- Armazena dados semelhantes da tabela classificados, porém, o tráfego está com índice (conforme tabela de correspondência abaixo), e possui todas as horas do dia, diferentemente da tabela [classificados].

|       Tabela de tráfego       |
| Índice        | Tráfego       | 
| ------------- | ------------- | 
| 0             | fluxo_continuo| 
| 1             | Normal        | 
| 2             | Acesso        | 
| 3             | Lento         | 
| 4             | Intenso       |
| 5             | Congestionado |
| 6             | Interditado   |
| 7             | Bloqueado     |
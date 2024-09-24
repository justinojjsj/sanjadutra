# SANJADUTRA _DB

## Banco de dados db_ccr

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
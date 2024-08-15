# SANJADUTRA

## JUSTIFICATIVA DO SISTEMA

A partir da descontinuidade da rádio CCR RIOSP, verificou-se uma grande dificuldade nos usuários desta rodovia em saber informações de tráfego como horário de maior fluxo de veículos, horários de tráfego intenso e outras informações. Essas informações são importantes pois com elas o usuário da rodovia consegue planejar melhor sua viagem.

Os dados de tráfego são capturados por câmeras e enviados para a plataforma da CCR. O nosso sistema na primeira fase captura esses dados e armazena. Na segunda fase trata os dados e os classifica. Na terceira fase analisa esses dados e plota em gráfico os horários de maior tráfego por período obtendo-se informações como horários de maior fluxo, acidentes etc. Esses gráficos são apresentados em uma plataforma web para verificação do usuário.

## COMO CONFIGURAR OS SISTEMAS

Para funcionar os sistemas é necessário:

1. Instalar o docker desktop
2. Fazer um clone no repositório [sanjadutra](https://github.com/justinojjsj/sanjadutra.git)
3. Executar os containers docker. Existem duas formas:
- Método 1: 
    - Utilizando o power shell (windows) ou terminal (linux) acessar o diretório onde está salvo o arquivo docker-compose.yaml
    - Digitar o seguinte comando: 
    ```
    docker-compose up -d
    ```
- Método 2:
    - Instalar o VSCODE
    - Instalar o plugin docker
    - Abrir o projeto sanjahoje no VSCODE
    - Encontrar o arquivo docker-compose.yaml
    - Clicar com o botão direito no arquivo e clicar em [compose-up]

4. Após estar com os containers em execução acessar o PhpmyAdmin através do navegador (usuário: root senha: my-secret-pw):
    ```
    127.0.0.1:8087 
    ```
    - Criar um banco de dados com o nome: db_ccr
    - Importar arquivo db.sql (mais recente) que está na pasta _db

5. Acessar o site do sistema:
    ```
    127.0.0.1:88
    ```
    - A cada 15 minutos os dados do site são atualizados automaticamente (aguarde esse tempo para ver os dados carregados na página)

6. Executar os containers e configurar o cron (essa passo não é necessário, a não ser que o sistema não esteja sendo alimentado automaticamente):
    ```
    docker exec -it sanjadutra_python_ccr bash
    ```
    ```
    crontab -e
    ```
    - Selecionar opção 1 (vai selecionar o editor de texto NANO)
    - Copiar a seguinte linha ao final do arquivo (remova o espaço antes e depois)
    ```
    0,15,30,45 * * * * /app/exec.sh
    ```
    - Ctrl+o para salvar arquivo, Ctrol+x para sair do arquivo:
    - Digitar no terminal
    ```
    chmod u+x /app/exec.sh
    ```
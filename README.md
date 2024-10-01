# Teste Prático Stefanini Group

Este projeto é um teste pratico de aplicação full-stack que integra um frontend desenvolvido com Vue.js 3 e um backend construído com Laravel. 

## Endpoints

1. **Listar todas as tarefas**
   - **Método HTTP:** `GET`
   - **Rota:** `/api/tarefas`
   - **Descrição:** Recupera uma lista de todas as tarefas.

2. **Criar uma nova tarefas**
   - **Método HTTP:** `POST`
   - **Rota:** `/api/tarefas`
   - **Descrição:** Cria uma nova tarefa. 
   É necessário enviar os dados da tarefa no corpo da requisição (modelo json mais a baixo).

3. **Mostrar uma tarefas específica por id**
   - **Método HTTP:** `GET`
   - **Rota:** `/api/tarefas/{id}`
   - **Descrição:** Recupera as informações de um tarefa tarefas baseado no `id`.

3. **Mostrar uma tarefas específica por nome**
   - **Método HTTP:** `GET`
   - **Rota:** `/api/tarefas/{titulo}`
   - **Descrição:** Recupera as informações de um tarefa tarefas baseado no `titulo`.

4. **Atualizar um tarefa específico**
   - **Método HTTP:** `PUT`
   - **Rota:** `/api/tarefas/{titulo}`
   - **Descrição:** Atualiza uma tarefa específica baseado no `id`. Os dados atualizados devem ser enviados no corpo da requisição. (modelo json mais a baixo).

5. **Excluir uma tarefa específica**
   - **Método HTTP:** `DELETE`
   - **Rota:** `/api/tarefas/{titulo}`
   - **Descrição:** Remove um tarefa específica baseado no `id`.

### Estrutura Json da tarefa

Para criar ou atualizar uma tarefa, utilize o seguinte modelo JSON:

```json
{
   "titulo": "Programar em php",
   "descricao": "php não morreu",
   "status": "em andamento",
}
```
A chave `status` é um enum, ou seja, os valores são limitados a valores pré-definidos, nesse caso: `não iniciado`, `em andamento` e `concluído`.

## Estrutura do Projeto

```
TestePraticoStefaniniGroup/
├── frontend/
│   └── front-ToDo/
│       ├── src/
│       ├── public/
│       ├── package.json
│       └── ...
└── backend/
    └── api-ToDo/
        ├── routes/
        ├── controllers/
        ├── models/
        ├── database/
        ├── ...
```

* **frontend/front-ToDo:** Contém todos os arquivos do projeto Vue.js, incluindo componentes, estilos e lógica de negócios.

* **Consumo da API:** O front utiliza o cliente HTTP Axios no Vue.js para fazer requisições à API Laravel.

* **backend/api-ToDo:** Contém a aplicação Laravel, responsável pela API RESTful que alimenta o frontend.

# Configuração do Ambiente

## Execução com docker
### Pré-requisitos
* Clonar o projeto
* docker instalado
* docker compose instalado

### Passo a passo
Certifique-se de que o backend está configurado para se conectar ao MySQL usando as variáveis de ambiente definidas no docker-compose.yml no `.env`

```
TestePraticoStefaniniGroup/
├── frontend/
│   └── front-ToDo/
│       ├── src/
│       ├── public/
│       ├── package.json
│       └── ...
└── backend/
    └── api-ToDo/
        ├── routes/
        ├── controllers/
        ├── models/
        ├── .env <-(aqui)
        ├── ...
```

      DB_CONNECTION=mysql
      DB_HOST=mysql
      DB_PORT=3307
      DB_DATABASE=todo_db
      DB_USERNAME=root
      DB_PASSWORD=root_password
   
Em seguida certifique-se de que você está na pasta raiz do projeto (TestePraticoStefaniniGroup/).

Execute o seguinte comando:

```bash
   docker-compose up --build
```

## Execução local

### Pré-requisitos
* Clonar o projeto
* Node.js e npm (ou yarn) instalados
* Composer instalado
* Um banco de dados MySQL configurado

### Instalação das Dependências

1. **Navegue até a pasta frontend/front-ToDo:**
   ```bash
   cd TestePraticoStefaniniGroup/frontend/front-ToDo
   ```
2. **Instale as dependências do Vue.js:**
   ```bash
   npm install
   ```

3. **Navegue até a pasta backend/api-ToDo:**
   ```bash
   cd ../backend/api-ToDo
   ```
4. **Instale as dependências do Laravel:**
   ```bash
   composer install
   ```

### Configuração do Banco de Dados
* **Edite o arquivo .env** na pasta backend/api-ToDo para configurar as credenciais do seu banco de dados.

* **Execute as migrations do Laravel:**
   ```bash
   php artisan migrate
   ```

## Executando o Projeto

### Em modo de Desenvolvimento

1. **Inicie o servidor de desenvolvimento do Vue.js:**
   ```bash
   cd TestePraticoStefaniniGroup/frontend/front-ToDo
   npm run dev
   ```

2. **Inicie o servidor de desenvolvimento do Laravel:**
   ```bash
   cd ../backend/api-ToDo
   php artisan serve
   ```

## Conclusão
 
E pronto, se tudo deu certo, a aplicação esta diponivel em:

Front-end 
```
http://localhost:5173/
```
Back-end 
```
http://localhost:8000/api/tarefas
```


## Bônus

Se prefer o projeto esta ativo também em:

Front-end 
```
https://todoliststefaninigroup.vercel.app/
```
Back-end 
```
https://apitodoliststefaninigroup.vercel.app/api/api/tarefas
```

* Deploy de ambos no vercel.

* Banco de dados MySql na freehostia

* OBS: 
    Nativamente o vercel não faz o deploy em aplicações laravel e em api's, mas com algumas configurações alternativas (obrigado indianos do youtube <3 ), conseguimos subir a api, por razão dessas configurações o caminho fica `/api/api/tarefas` :) ;


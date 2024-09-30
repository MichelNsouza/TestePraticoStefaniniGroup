# Frontend Dockerfile
FROM node:16

# Define o diretório de trabalho
WORKDIR /app

# Copia os arquivos do projeto
COPY package*.json ./

# Instala as dependências
RUN npm install

# Copia o restante do código do projeto
COPY . .

# Constrói o projeto
RUN npm run build

# Expondo a porta padrão
EXPOSE 5173

# Comando para iniciar o servidor
CMD ["npm", "run", "serve"]

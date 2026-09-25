# 🌍 REST Countries com PHP Puro

Aplicação web desenvolvida em **PHP puro**, sem o uso de frameworks, para praticar o consumo e integração com uma API REST externa.

O projeto utiliza a **REST Countries API v5** para obter e apresentar informações sobre países, permitindo consultar dados individuais, visualizar países vizinhos e comparar diferentes países.

---

## 🎯 Objetivo do Projeto

O projeto foi desenvolvido com o objetivo de aprofundar conhecimentos em desenvolvimento web utilizando PHP puro, principalmente nos seguintes aspectos:

- Consumo de APIs REST externas
- Requisições HTTP utilizando cURL
- Autenticação através de API Key
- Manipulação e mapeamento de respostas JSON
- Paginação de resultados
- Organização de rotas sem framework
- Separação de responsabilidades
- Tratamento de erros
- Integração entre PHP e JavaScript
- Manutenção e adaptação de uma aplicação diante de mudanças em uma API externa

---

## 🔄 Atualização para a API v5

O projeto originalmente utilizava uma versão anterior da REST Countries API.

Ao retomar o projeto, foi identificado que a versão utilizada anteriormente havia sido descontinuada. Com isso, foi necessário atualizar a aplicação para a versão 5 da API.

Durante o processo de migração, foram necessárias algumas adaptações:

- Atualização dos endpoints utilizados
- Inclusão de autenticação através de API Key
- Configuração de variáveis de ambiente
- Adaptação à nova estrutura dos dados retornados em JSON
- Atualização do mapeamento dos dados dos países
- Implementação de paginação para consulta dos países
- Adaptação da consulta de países vizinhos
- Tratamento dos novos erros retornados pela API
- Atualização das funcionalidades que dependiam da estrutura antiga dos dados

A atualização também serviu como uma oportunidade para revisar partes do código e corrigir problemas que surgiram durante a migração.

Esse processo reforçou a importância de considerar que APIs externas são dependências que podem sofrer alterações e exigir manutenção da aplicação que as consome.

---

## 🛠 Tecnologias Utilizadas

- PHP (puro)
- cURL
- JSON
- HTML
- CSS (Bootstrap)
- Servidor local (XAMPP, WAMP, Laragon ou PHP Built-in Server)

---

## 🌐 API Utilizada

O projeto utiliza a **REST Countries API v5**.

Documentação oficial:

https://restcountries.com/docs/countries/

A API fornece informações sobre países, incluindo dados como:

- Nome
- População
- Região
- Área
- Capital
- Idiomas
- Moedas
- Bandeiras
- Fronteiras

A aplicação utiliza autenticação através de **API Key**, configurada através de variável de ambiente.

---

## 🔐 Configuração da API Key

Após clonar o projeto, crie um arquivo `.env` na raiz da aplicação:

No arquivo .env:
RESTCOUNTRIES_API_KEY=sua_chave_aqui

A chave não deve ser versionada no Git.

O projeto utiliza o pacote vlucas/phpdotenv para carregar as variáveis de ambiente.

---

## 🛠 Tecnologias Utilizadas

- PHP (puro)
- cURL
- JSON
- HTML
- CSS (Bootstrap)
- Composer
- PHP dotenv
- Servidor local (XAMPP, WAMP, Laragon ou PHP Built-in Server)

---

## 🚀 Como Executar o Projeto

### 1️⃣ Clone o repositório

git clone https://github.com/SalemiDeveloper/api_restcountries.git

### 2️⃣ Acesse a pasta do projeto

cd api_restcountries

### 3️⃣ Instale as dependências

composer install

### 4️⃣ Configure a API Key

Crie um arquivo `.env` na raiz do projeto:

RESTCOUNTRIES_API_KEY=sua_chave_aqui

### 5️⃣ Inicie o servidor PHP

php -S localhost:8001

### 6️⃣ Acesse a aplicação

http://localhost:8001

## ✨ Funcionalidades

- 🌍 Consulta de informações sobre países
- 🔎 Seleção de um país para visualizar seus detalhes
- 🏳️ Exibição da bandeira e informações do país
- 🗺️ Visualização da localização do país em um mapa
- 🤝 Consulta dos países vizinhos
- ⚖️ Comparação entre dois países
- 📊 Comparação de população e território através de barras de progresso
- 🎨 Utilização das cores das bandeiras para personalização visual dos cards
- 📈 Destaques de países por população e território

---

## 🔄 Como Funciona o Consumo da API

A aplicação utiliza uma classe responsável por realizar as requisições à REST Countries API através do **cURL**.

O fluxo básico funciona da seguinte forma:

1. A aplicação recebe uma solicitação do usuário.
2. O PHP realiza uma requisição HTTP para a REST Countries API.
3. A API retorna os dados no formato JSON.
4. O JSON é convertido em array associativo através do `json_decode()`.
5. Os dados são tratados e organizados pela aplicação.
6. As informações são enviadas para as páginas responsáveis pela apresentação dos dados.

Para a consulta de todos os países, a aplicação utiliza paginação através dos parâmetros `limit` e `offset`, realizando múltiplas requisições quando necessário.

As requisições também utilizam a API Key configurada através de variável de ambiente.

---

## ⚠️ Tratamento de Erros

A aplicação realiza verificações durante o consumo da API para identificar problemas como:

- Falhas na requisição cURL
- Erros HTTP retornados pela API
- Respostas inesperadas da API
- Dados ausentes ou não encontrados

Quando ocorre um erro, a aplicação captura a resposta e apresenta uma mensagem correspondente, evitando que erros da API sejam tratados como dados válidos pela aplicação.

---

## 📚 Conceitos Praticados

Durante o desenvolvimento e a atualização do projeto, foram praticados conceitos como:

- Desenvolvimento web com PHP puro
- Programação orientada a objetos
- Consumo de APIs REST
- Requisições HTTP utilizando cURL
- Manipulação de dados em JSON
- Autenticação através de API Key
- Variáveis de ambiente
- Composer e gerenciamento de dependências
- Paginação de resultados
- Tratamento de erros
- Organização de rotas
- Separação de responsabilidades
- Integração entre PHP e JavaScript
- Integração com mapas utilizando Leaflet
- Utilização do Bootstrap
- Manutenção e migração de aplicações existentes

---

## 🎓 Sobre o Projeto

Este projeto faz parte dos meus estudos em desenvolvimento **backend com PHP**, com foco no consumo de APIs, integração com serviços externos e desenvolvimento de aplicações sem frameworks.

Além do desenvolvimento inicial, a atualização para a API v5 proporcionou uma experiência prática de manutenção e migração de uma aplicação existente.

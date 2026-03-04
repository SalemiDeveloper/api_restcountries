# ?? Consumo da API Rest Countries com PHP Puro

Este projeto foi desenvolvido com o objetivo de praticar o consumo de APIs externas utilizando **PHP puro**, sem o uso de frameworks.

A aplicação consome dados da API pública **Rest Countries** para obter informações sobre países, como nome, população, região, idioma e bandeira.

---

## ?? Objetivo do Projeto

- Praticar consumo de API REST utilizando PHP
- Trabalhar com requisições HTTP (GET)
- Manipular respostas em JSON
- Organizar rotas manualmente
- Estruturar melhor aplicações sem framework

---

## ?? Tecnologias Utilizadas

- PHP (puro)
- cURL
- JSON
- HTML
- CSS
- Servidor local (XAMPP, WAMP ou PHP Built-in Server)

---

## ?? API Utilizada

- Rest Countries API  
- Documentação oficial: https://restcountries.com/

A API fornece informações detalhadas sobre países ao redor do mundo.

Exemplo de endpoint utilizado:
https://restcountries.com/v3.1/all?fields=name,capital,population

---

## ?? Como Executar o Projeto

### 1?? Clone o repositório
git clone https://github.com/seu-usuario/seu-repositorio.git

### 2?? Acesse a pasta
cd seu-repositorio

### 3?? Inicie o servidor PHPa
php -S localhost:8000

### 4?? Acesse no navegador
http://localhost:8000


## ?? Como Funciona o Consumo da API

- A aplicação faz uma requisição HTTP utilizando cURL.
- A resposta é recebida no formato JSON.
- O JSON é convertido para array associativo com json_decode().
- Os dados são tratados no controller.
- As informações são exibidas na view.

## ?? Conceitos Praticados

- Consumo de API REST
- Requisições HTTP com cURL
- Manipulação de JSON
- Organização de código em camadas
- Separação de responsabilidades
- Tratamento de erros de requisição
- Estruturação de aplicação sem framework

## Projeto criado para aprofundamento em consumo de APIs REST utilizando PHP puro e melhor compreensão do fluxo de requisições HTTP.
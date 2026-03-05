# 🌍 Consumo da API Rest Countries com PHP Puro

Este projeto foi desenvolvido com o objetivo de praticar o consumo de APIs externas utilizando **PHP puro**, sem o uso de frameworks.

A aplica��o consome dados da API p�blica **Rest Countries** para obter informa��es sobre pa�ses, como nome, popula��o, regi�o, idioma e bandeira.

---

## 🎯 Objetivo do Projeto

- Praticar consumo de API REST utilizando PHP
- Trabalhar com requisi��es HTTP (GET)
- Manipular respostas em JSON
- Organizar rotas manualmente
- Estruturar melhor aplica��es sem framework

---

## 🛠 Tecnologias Utilizadas

- PHP (puro)
- cURL
- JSON
- HTML
- CSS
- Servidor local (XAMPP, WAMP ou PHP Built-in Server)

---

## 🌐 API Utilizada

- Rest Countries API  
- Documenta��o oficial: https://restcountries.com/

A API fornece informa��es detalhadas sobre pa�ses ao redor do mundo.

Exemplo de endpoint utilizado:
https://restcountries.com/v3.1/all?fields=name,capital,population

---

## 🚀 Como Executar o Projeto

### 1️⃣ Clone o reposit�rio
git clone https://github.com/seu-usuario/seu-repositorio.git

### 2️⃣ Acesse a pasta
cd seu-repositorio

### 3️⃣ Inicie o servidor PHPa
php -S localhost:8000

### 4️⃣ Acesse no navegador
http://localhost:8000


## 🔄 Como Funciona o Consumo da API

- A aplica��o faz uma requisi��o HTTP utilizando cURL.
- A resposta � recebida no formato JSON.
- O JSON � convertido para array associativo com json_decode().
- Os dados s�o tratados no controller.
- As informa��es s�o exibidas na view.

## 📚 Conceitos Praticados

- Consumo de API REST
- Requisi��es HTTP com cURL
- Manipula��o de JSON
- Organiza��o de c�digo em camadas
- Separa��o de responsabilidades
- Tratamento de erros de requisi��o
- Estrutura��o de aplica��o sem framework

## Projeto criado para aprofundamento em consumo de APIs REST utilizando PHP puro e melhor compreens�o do fluxo de requisi��es HTTP.
# Documentação do Sistema de Suporte ao Cliente

## Introdução

Este projeto é um sistema de suporte ao cliente desenvolvido em Laravel 11, com Docker. Ele permite que os clientes abram chamados para assistência e que os colaboradores da empresa respondam a esses chamados. O sistema inclui funcionalidades de autenticação, gestão de chamados, e envio de notificações por e-mail.

## Funcionalidades

-   **Autenticação de Usuários:** Cadastro e login de usuários.
-   **Tipos de Usuários:** Cliente e Colaborador.
-   **Gerenciamento de Chamados:** Criação, visualização, e resposta a chamados.
-   **Notificações:** Envio de e-mails para colaboradores quando um novo chamado é aberto.

## Requisitos do Sistema

-   PHP >= 8.2
-   Composer
-   Postgresql
-   Laravel 11
-  Docker

## Instalação

### Passo 1: Clonar o Repositório

`git clone https://github.com/seu-usuario/sistema-suporte-cliente.git
cd sistema-suporte-cliente`

### Passo 2: Instalar Dependências do Projeto

````php
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
````

### Passo 3: Configurar o Ambiente

Crie um arquivo `.env` a partir do exemplo `.env.example`:

`cp .env.example .env`

Edite o arquivo `.env` com suas configurações de banco de dados e e-mail.

### Passo 4: Migrar o Banco de Dados

`php artisan migrate`

### Passo 5: Iniciar o Servidor

`./vendor/bin/sail up`

A aplicação estará disponível em `http://localhost`, casso tenha setado a `APP_PORT` no arquivo `.env`, a url de acesso será `http://localhost:{APP_PORT}`´ .

## Uso

### Cadastro e Login

-   Acesse `/cadastro` para se cadastrar.
-   Acesse `/entrar` para fazer login.

### Gerenciamento de Chamados

-   **Clientes**: Podem criar novos chamados acessando `/painel/chamados/novo` e visualizar seus chamados em `/tickets`.
-   **Colaboradores**: Podem visualizar todos os chamados em `/painel/chamados` e responder a chamados específicos.

### Envio de E-mails

Quando um novo chamado é criado, todos os colaboradores cadastrados recebem um e-mail de notificação.

## Estrutura do Projeto

-   **Controllers**: Contém a lógica de controle da aplicação.
-   **Models**: Representam as entidades do banco de dados.
-   **Views**: Contém as páginas Blade para renderização no frontend.
-   **Routes**: Define as rotas da aplicação.
-   **Policies**: Gerencia as permissões de acesso.

## Autorização

### Policies

As políticas de autorização são definidas em `app/Policies/TicketPolicy.php` e registradas em `app/Providers/AuthServiceProvider.php`.

### Gates

Os gates são definidos para assegurar que apenas clientes possam criar chamados e apenas colaboradores possam finalizar chamados. Estes gates são configurados em `app/Providers/AuthServiceProvider.php`.

## Segurança

-   **Validação de Entrada**: Todas as entradas do usuário são validadas nos controladores.
-   **Autorização**: Uso de policies e gates para restringir ações a determinados tipos de usuários.
-   **Senhas**: São armazenadas de forma segura usando bcrypt.

## Localização

A aplicação suporta localização em português do Brasil (pt-BR). Os arquivos de tradução estão localizados em `resources/lang/pt-BR`.

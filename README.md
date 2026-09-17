# Loja Retrogame

## Integrantes
- Gabrielli Basilio Ferreira
- Lucas Amaral Santos
- João Victor Fortkamp
- Gabriel de Oliveira Caldas

## Descrição
Site de e-commerce para uma loja de retrogames e jogos de tabuleiro, com catálogo de produtos, gerenciamento de usuários e sistema de sugestões/avaliações dos clientes.

## Tecnologias utilizadas
- Laravel
- PHP
- PostgreSQL
- Blade
- Laravel Breeze

## Instalação
Copie o `.env.example` para `.env` e configure com os dados do seu banco PostgreSQL antes de rodar as migrations.

Rode os comandos abaixo no terminal, na raiz do projeto:

```bash
composer install
npm install
php artisan key:generate
php artisan migrate:fresh --seed
```

## Execução
```bash
npm run dev
php artisan serve
```

## Usuários para teste

Sem login, só é possível visualizar o catálogo de produtos. É necessário estar logado como Administrador ou Usuário para acessar as demais funcionalidades do sistema.

**Administrador**
- E-mail: admin@lojaretrogame.com.br
- Senha: 321456

**Usuário**
- E-mail: cliente@lojaretrogame.com
- Senha: 123456
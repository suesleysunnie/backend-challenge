# Backend Challenge
Desenvolver uma API RESTFull, para criar pedidos de uma lanchonete, e um painel administrativo para cadastrar os produtos e gerenciar os pedidos. 
O prazo é de 18/01 a 21/01.

## Tecnologia
Para desenvolver a API e a área administrativa adotamos o Laravel 8 junto com o banco de dados MySQL, além disso utilizamos Laravel UI e Bootstrap para criar o frontend.

O sistema está online e pode ser testado [AQUI](https://challenger.suesley.com.br).

## Instalação
* Clone o projeto: git clone https://github.com/suesleysunnie/backend-challenge.git

* Acesse o projeto e instale as dependências e o framework: *composer install --no-scripts*

* Copie o arquivo .env.example: *cp .env.example .env*

* Crie uma nova chave para a aplicação: *php artisan key:generate*

* Em seguida você deve configurar o arquivo .env e rodar as migrations com: *php artisan migrate --seed*

* Após isso execute o comando: *npm install*

## Resolução do Problema
Os módulos de Cliente, Produto e Pedido foram criados e funcionam conforme solicitado tanto na area administrativa quanto na API.

O painel administrativo possui autenticação, mas a API de clientes funciona simulando um cliente logado atravéz do seu id ou contato (email e/ou telefone), por exemplo, para que seja alterado um Pedido eu tenho que passar o id do cliente proprietário e o do pedido, caso eu passe outro dá erro de permissão.

Os Pedidos e Clientes estão funcionando conforme solicitado na API, porém infelizmente consegui desenvolver o endpoint para o cliente no prazo, idealmente seria um bot do telegram ou um chat bot de um site, consegui criar o bot do Telegram e trocar algumas mensagens mas ainda vai demorar alguns dias pra ficar pronto (sim vou continuar desenvolvendo XD).

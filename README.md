# API de filmes da franquia Star Wars

Este é um projeto desenvolvido durante um teste de um processo seletivo.

## Como instalar o projeto

O primeiro passo é clonar o projeto no seu repositório local. Para isso você precisa ter o [Git](ref_git "Link para o site do Git"), o [XAMPP](ref_xampp "Link para o site do XAMPP") com PHP 7.4 e MySQL e o [Composer](ref_composer "Link para o site do Composer") instalados no seu computador.

Após instalar tudo crie uma pasta no dentro de htdocs do XAMPP onde gostaria de clonar o projeto. Em seguida abra o terminal e navegue até essa pasta.

Com o terminal na pasta escolhida, digite:

```sh
git clone https://github.com/katiri/APIStarWars.git .
```

Isso vai clonar os arquivos do projeto no diretório em que o terminal estiver aberto.

Após isso crie o um banco de dados com MySQL e importe o banco de dados "db_starwarsfilmcatalog.sql" da pasta database. Você pode fazer isso pelo terminal com os códigos a seguir:

1. Acesse o MySQL
```sh
mysql -u seu_usuario -p
```
2. Crie o banco de dados
```sh
CREATE DATABASE nome_do_banco DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```
3. Saia do MySQL ou use outro terminal para importar
```sh
mysql -u seu_usuario -p nome_do_banco < database/db_starwarsfilmcatalog.sql
```

Após instalar todos os itens necessários e criar o banco dados, instale as dependências do projeto executando o seguinte código no terminal:

```sh
composer install
```

Após instalar as dependências via composer, crie dentro do diretório principal um arquivo .env com o seguinte conteúdo:

```sh
DB_NAME=nome_do_banco
DB_USER=seu_usuario
DB_PASSWORD=
API_URL=https://swapi.py4e.com/api/
SSL=false
```

E pronto agora é só executar o servidor Apache e o MySQL no painel do XAMPP e acessar o projeto no navegador.

## Meta
João Pedro P. Ramos - <jpedropazosramos@gmail.com> - [@LinkedIn](https://www.linkedin.com/in/joao-pedro-ramos "Meu LinkedIn")

<https://katiri.github.io/>





[ref_git]: https://git-scm.com/
[ref_xampp]: https://www.apachefriends.org/pt_br/index.html
[ref_composer]: https://getcomposer.org/
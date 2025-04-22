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

## Documentação API
Está API possui dois endpois:
```sh
films/
films/id_filme/
```
Consultando os filmes:
```sh
films/
```
```sh
HTTP/1.0 200 OK
Content-Type: application/json
[
  {
    "name": "A New Hope",
    "episode_number": 4,
    "synopsis": "It is a period of civil war.\r\nRebel spaceships, striking\r\nfrom a hidden base, have won\r\ntheir first victory against\r\nthe evil Galactic Empire.\r\n\r\nDuring the battle, Rebel\r\nspies managed to steal secret\r\nplans to the Empire's\r\nultimate weapon, the DEATH\r\nSTAR, an armored space\r\nstation with enough power\r\nto destroy an entire planet.\r\n\r\nPursued by the Empire's\r\nsinister agents, Princess\r\nLeia races home aboard her\r\nstarship, custodian of the\r\nstolen plans that can save her\r\npeople and restore\r\nfreedom to the galaxy....",
    "release_date": "1977-05-25",
    "director": "George Lucas",
    "producers": "Gary Kurtz, Rick McCallum",
    "characters": [
      "https://swapi.py4e.com/api/people/1/",
      "https://swapi.py4e.com/api/people/2/",
      "https://swapi.py4e.com/api/people/3/",
      ...
    ],
    "film_age": {
      "years": 47,
      "months": 10,
      "days": 28
    }
  },
  {
    "name": "The Empire Strikes Back",
    "episode_number": 5,
    "synopsis": "It is a dark time for the\r\nRebellion. Although the Death\r\nStar has been destroyed,\r\nImperial troops have driven the\r\nRebel forces from their hidden\r\nbase and pursued them across\r\nthe galaxy.\r\n\r\nEvading the dreaded Imperial\r\nStarfleet, a group of freedom\r\nfighters led by Luke Skywalker\r\nhas established a new secret\r\nbase on the remote ice world\r\nof Hoth.\r\n\r\nThe evil lord Darth Vader,\r\nobsessed with finding young\r\nSkywalker, has dispatched\r\nthousands of remote probes into\r\nthe far reaches of space....",
    "release_date": "1980-05-17",
    "director": "Irvin Kershner",
    "producers": "Gary Kurtz, Rick McCallum",
    "characters": [
      "https://swapi.py4e.com/api/people/1/",
      "https://swapi.py4e.com/api/people/2/",
      "https://swapi.py4e.com/api/people/3/",
      ...
    ],
    "film_age": {
      "years": 44,
      "months": 11,
      "days": 5
    }
  }
  ...
]
```

Consultando um filme específico:
```sh
films/1/
```
```sh
HTTP/1.0 200 OK
Content-Type: application/json
{
  "name": "A New Hope",
  "episode_number": 4,
  "synopsis": "It is a period of civil war.\r\nRebel spaceships, striking\r\nfrom a hidden base, have won\r\ntheir first victory against\r\nthe evil Galactic Empire.\r\n\r\nDuring the battle, Rebel\r\nspies managed to steal secret\r\nplans to the Empire's\r\nultimate weapon, the DEATH\r\nSTAR, an armored space\r\nstation with enough power\r\nto destroy an entire planet.\r\n\r\nPursued by the Empire's\r\nsinister agents, Princess\r\nLeia races home aboard her\r\nstarship, custodian of the\r\nstolen plans that can save her\r\npeople and restore\r\nfreedom to the galaxy....",
  "release_date": "1977-05-25",
  "director": "George Lucas",
  "producers": "Gary Kurtz, Rick McCallum",
  "characters": [
    "Luke Skywalker",
    "C-3PO",
    "R2-D2",
    "Darth Vader",
    "Leia Organa",
    "Owen Lars",
    "Beru Whitesun lars",
    "R5-D4",
    "Biggs Darklighter",
    "Obi-Wan Kenobi"
  ],
  "film_age": {
    "years": 47,
    "months": 10,
    "days": 28
  }
}
```

## Meta
João Pedro P. Ramos - <jpedropazosramos@gmail.com> - [@LinkedIn](https://www.linkedin.com/in/joao-pedro-ramos "Meu LinkedIn")

<https://katiri.github.io/>





[ref_git]: https://git-scm.com/
[ref_xampp]: https://www.apachefriends.org/pt_br/index.html
[ref_composer]: https://getcomposer.org/
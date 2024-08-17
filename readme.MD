# GitHub Task

Este repositório foi criado como parte de uma task da UNISUAM, com o objetivo de consumir a API do GitHub e retornar dados específicos de usuários. Buscando simplicidade, o projeto utiliza uma arquitetura MVC ou Monolítica Moderna, em vez de microserviços e toda sua complexidade. Para isso, foi necessário utilizar o Inertia.js como camada de transporte/conexão entre Laravel e Vue.js.

#### Dados do Usuário

Avatar
Nome
Username
Bio
Link para o GitHub
Link para o Blog
Empresa
Localização
Número de repositórios públicos
Número de Seguidores
Número de Seguindo

#### Desenvolvimento

No Desenvolvimento foi utilizado recursos modernos como property promotion e dependency injection.

#### Tecnologias

Laravel 11 , Vue 3 , Docker , Postgree , Axios e NPM

# Rodar o Projeto

Para rodar o projeto deve seguir esses passos abaixo:

#### Acessar o container

cd docker
docker-compose exec -it php8 bash

#### Instalar as dependencias

cd html
composer install && npm install

#### Rodar as Migrations

php artisan migrate

#### Acessar

localhost

### Melhorias

Esse projeto poderia ter algumas melhorias como um DataTable ou Bootstrap-table, Paginação etc, porém devido a simplicidade optei pela não implementação.

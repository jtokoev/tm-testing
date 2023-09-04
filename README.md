## Шаги для запуска: 

1) git clone git@github.com:jtokoev/tm-testing.git
2) cd tm-testing
3) выполнеяем команду `cp docker-compose.override.yml.dist docker-compose.override.yml`
    - указываем нужный порт `docker-compose.override.yml` на случай если у вас 88 уже занят
    - для удобства подтянул adminer, если он вам не нужен, можете удалить сервис `adminer` сразу  
4) выполнеяем команду `cp .env.dist .env`
   - при необходимости в файле `.env` можете настроить доступы к базе, по умолчанию они указаны 
5) выполнеяем команду `cp app/.env.dist app/.env`
     
   
6) выполнеяем команду `docker-compose up -d` чтобы собрать контейнеры 

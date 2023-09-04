## Шаги для запуска: 

1) git clone git@github.com:jtokoev/tm-testing.git
2) cd tm-testing
3) выполнеяем команду `cp docker-compose.override.yml.dist docker-compose.override.yml`
    - указываем нужный порт `docker-compose.override.yml` на случай если у вас 88 уже занят
4) выполнеяем команду `docker-compose up -d` чтобы собрать контейнеры 

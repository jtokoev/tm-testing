## Шаги для запуска
!`Примечание: Пункты с 1 по 3 обязательны для выполнения, они необходимы для настройки проекта и его запуска.`

1) Клонируем проект 
   - git clone git@github.com:jtokoev/tm-testing.git && cd tm-testing
2) Собираем проект
    - прежде убедитесь, что порты `88(nginx), 5432(pqsql), 8093(adminer)` свободны, если нет, то необходимо отредактировать порты в [docker-compose.override.yml.dist](docker-compose.override.yml.dist)
    - при желании можете удалить конфинурацию контейнера `adminer` тут [docker-compose.override.yml.dist](docker-compose.override.yml.dist)
    - команда: `make build`.

3) Настройка базы данных, миграции, фикстуры
   - команда: `make db`.
4) Тесты
   - команда: `make check`
 
5) http://localhost:88 (укажите свой порт если вы поменяли)



## Коротко о выполненной задаче 

- Как только пользователь заходит на главную страницу, 
система генерит вопросы в случайно порядке и сохраняет в сессию, я думал, куда лучше это сохранить, 
но в рамках этой задачи решил в сессиях
 
- После каждого ответа, из сессии удалется вопрос на который уже получен ответ

- Ответы в свою очередь тоже храняться в сессии пока не закончатся тесты 

- После завершения ворпосов, 
система сохраняет полученные ответы в базу (или в другой источник, нужно только реализовать интерфейс [MemberRepositoryInterface.php](app%2Fsrc%2FDomain%2FRepository%2FMemberRepositoryInterface.php) и добавить настройки в [services.yaml](app%2Fconfig%2Fservices.yaml)), 
и перенавравляет на страницу результатов

- На странице результатов показывается список вопросов и ответы пользователя с пометкой верный ответ или нет
## Про обработку ошибок 
- По хорошему надо было все исключения обернуть в абстракцию с методами (пример ниже), и при исключениях ловить их в условном листенере, обрабатывать их, записывать логи, отправлять уведомления админам если код из 5** и так далее. Но в рамках этой задачи не стал копать глубоко
  - `getCodeо
  - `getMessage`
  - `getDetails`
  
## Про тесты 
- Написал функциональный тест на процесс тестирования в браузере
- Так же написал unit тест [QuestionStorageTest.php](app%2Ftests%2FUnit%2FApplication%2FService%2FQuestionStorageTest.php) для сервиса [QuestionStorage.php](app%2Fsrc%2FApplication%2FService%2FQuestionStorage.php) для демонстрации, что unit тесты тоже пишу

## Использовал: 
- [Docker](https://www.docker.com/): Контейнеризация.
- [Symfony 6.3](https://symfony.com/): PHP-фреймворк.
- [PHP 8.1](https://www.php.net/): PHP.
- [PostgreSQL 15.4](https://www.postgresql.org/): База данных.
- [Php-cs-fixer (Phpfixer)](https://cs.symfony.com/): Форматирование PHP-кода.
- [Psalm](https://psalm.dev/): Статический анализатор PHP.
- [PHPUnit](https://phpunit.de/): Тестирование.
- [Makefile](https://www.gnu.org/software/make/manual/make.html): Автоматизация сборки.
- [PhpStorm](https://www.jetbrains.com/phpstorm/): IDE
- [doctrine-test-bundle](https://github.com/dmaicher/doctrine-test-bundle): Библиотека для тестирования Doctrine ORM.

## Операционная система:

- macOS Ventura

## Девайс:

- MacBook 16 M1 Pro

## Контакты:

- Телеграм: [@tokoevj](https://t.me/tokoevj)

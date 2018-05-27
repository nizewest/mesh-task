# Demo
https://mesh-task.herokuapp.com/

# Работа с docker
Настройка env переменных:
```
$ cp docker/.env.example docker/.env
```
Запуск:
```
$ cd docker && sudo docker-compose up
```
Пересобрать:
```
$ cd docker && sudo docker-compose up --build --force-recreate
```
Остановка:
```
$ cd docker && sudo docker-compose down
```
Работа из контейнера:
```
$ sudo docker/bash
```
# Установка
Из контейнера:
```
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
```
В локальный /etc/hosts файл дописать строчку
```
127.0.0.1 mesh-task.local
```
Запускаем http://mesh-task.local/ в браузере.

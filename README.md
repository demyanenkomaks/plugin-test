# Проект для тестирования плагинов

Тестовый Laravel-проект для проверки пакетов **maksde/helpers** и **maksde/support** (Filament-формы, валидация, дата/время).

## Стек

| Сервис / пакет | Версия |
|----------------|--------|
| PHP            | 8.4    |
| Laravel        | 12     |
| Filament       | 5      |
| MySQL          | 9.6.0  |


## Разворачивание

1. Клонировать репозиторий: `git clone ...`
2. Скопировать `.env.example` в `.env`
3. Заполнить переменные в `.env` (подсказки — в `.env.example`)
4. Установить зависимости: `composer install`
5. Сгенерировать ключ: `php artisan key:generate`
6. Выполнить миграции: `php artisan migrate`
7. Создать символическую ссылку хранилища: `php artisan storage:link`
8. Создать пользователя Filament: `php artisan make:filament-user`

Для пересоздания кеша Laravel и Filament: `composer cache`.

## Документация

В папке **`documentation/`** лежат Postman-коллекции для проверки API:

- `Test validate.postman_collection.json` — тесты валидации (телефон, дата, время, даты и время)
- `REST API.postman_collection.json` — запросы REST API для Обратной связи, тест сохранения и вывода данных (дата, время, даты и время)
- `Email Validation - Extended Test Cases.postman_collection.json` — расширенные кейсы валидации email

Импортируйте нужную коллекцию в Postman и при необходимости задайте переменные окружения (например, базовый URL).

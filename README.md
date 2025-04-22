## Разработка ведеться

| Service  | Version |
|----------|---------|
| mysql    | 8.0.27  |
| php      | 8.3     |
| laravel  | 12      |
| filament | 3       |

## Разворачивание проекта

1. Клонируем проект `git clone ...`
2. Копируем `.env.example` в `.env`
3. Указываем настройки в файле `.env` описание смотреть `.env.example`
4. Устанавливаем пакеты Composer `composer install --no-dev`
5. Генерируем ключ приложения `php artisan key:generate`
6. Запускаем миграции `php artisan migrate`
7. Создание симолический ссылок `php artisan storage:link`
8. Создание пользователя `php artisan make:filament-user`
9. Готово!

## В случае возникновения ошибок с кешом:

```bash
composer cache:clear // очищает кеш для laravel и filament

composer cache // очищает и создает новый кеш для laravel и filament
```


## Коллекция постман для проверки валидации:

```
Test_validate.postman_collection.json
```
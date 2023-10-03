# Laravel Template Project
Проект предоставляет шаблонную реализацию часто используемого функционала.
Решения реализованные в проекте **не должны** восприниматься как единственно правильные.

## Цели:
- Внести стандартизацию.
- Увеличить скорость реализации базового функционала.
- Упростить вход новых разработчиков.

## Общие сведения
- Дизайн для клиентской части служит исключительно для визуального насыщения.
- Идеи по улучшению кода и pull requests приветствуются.

## Реализованный функционал:
- [Авторизация](#авторизация)
- [Админ панель](#админ-панель)
- [Ответы json](#ответы-json)
- [Подписка](#подписка)
- [Локализация](#локализация)
- [Отправка Email](#отправка-email)
- [Хранение файлов](#хранение-файлов)

### Авторизация
Используемые пакеты: [Laravel Forify](https://laravel.com/docs/9.x/fortify), [Larave Socialite](https://laravel.com/docs/9.x/socialite).
Авторизация включает в себя логин, регистрацию, восстановление пароля, авторизацию через соц. сети. 
Остальная логика находится в *app/Providers/FortifyServiceProvider.php* и *app/Http/Controllers/SocialAuthController.php*.

### Админ панель
Используемые пакеты: [Laravel-AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE), [Laravel DataTables](https://datatables.yajrabox.com/).
Рауты для админ панели реализованы в отдельном файле *routes/admin.php* подключенном в *app/Providers/RouteServiceProvider.php*.
Админ часть имеет отдельный логин.
Стоит обратить внимание на файл *public/js/admin/custom.js* - в нем реализован общий полезный функционал используемый в разных разделах, например, отправка форм, реакцией UI на ответ и тд. 
JS функционал уникальный для каждого раздела находится в отдельных файлах, например, *public/js/admin/users.js*.
Для настройки общих/глобальных параметров сайта реализован раздел *Settings*.
Для настройки статического контента на клиентской части реализованы разделы *Pages* и *Menus*.

### Ответы json
Для шаблонного ответа за JS запросы подготовлены 2 метода в базовом контроллере - *app/Http/Controllers/Controller.php*.

### Подписка
Используемые пакеты: [stripe-php](https://github.com/stripe/stripe-php).
Функционал имеет 3 основных модели.
*app/Models/Subscription.php* - план подписки с ценой, 
*app/Models/SubscriptionPlan.php* - подписка пользователя на конкретный план, 
*app/Models/SubscriptionCycle.php* - циклы подписки.
Имеется возможность выбрать trial period для плана. Оплата реализована через следующие файлы: *public/js/payments.js*, *app/Services/StripeService.php*. Для отслеживания циклов подписки реализована команда *app/Console/Commands/CheckSubscription.php*. Имеется функционал методов оплаты - добавление\удаление\выбор по умолчанию.

### Локализация
Используемые пакеты: [laravel-localization](https://github.com/mcamara/laravel-localization).
Локализация реализована через *app/Traits/HasTranslations.php*. 
Пример подготовлен в *app/Models/Blog.php*. 

### Отправка Email
Пример подготовлен в *app/Http/Controllers/FeedbackController.php*.

### Хранение файлов
Хранение файлов представлено двумя разными путями.
Первый - более простой, используя *app/Casts/File.php*, пример подготовлен в *app/Models/User.php*.
Второй - используя отдельную таблицу и запись для каждого файла *app/Traits/HasAttachments.php*, пример подготовлен в *app/Models/Blog.php*.

### Другие файлы на которые стоит обратить внимание:
- *app/Providers/AppServiceProvider.php*.
Изменение значений глобального конфига на значения с базы.
Установка общих/часто используемых переменных для blade файлов.
- *app/helpers.php*.
Полезные функции помощники.
- *public/adminer.php*.
Визуализация базы в браузере.
- *public/js/custom.js*.
Копия *public/js/admin/custom.js* описанного в [Админ панель](#админ-панель), но для клиентской части - содержит общий функционал JS используемый в разных местах клиентской части.
- *app/Http/Controllers/DevController.php*.
Полезный функционал для стадии разработки.

### To do:
- Subscribe via saved card
- Refactor *app/Services/StripeService.php*
- Simple translate, using JSON column
- Redesign admin input file fields
- Switch front design to simple bootstrap
- Refactor admin menus section
- Single payment
- Add comments

## Installation
Download project
```bash
git clone https://[YOUR-TOKEN]github.com/Oleksii-T/laravel-template-project.git
```
Go to project`s folder
```bash
cd laravel-template-project.git
```
Install dependencies
```bash
composer install
```
Make .env file
```bash
cp .env.example .env
```
Generate app key
```bash
php artisan key:generate
```
Link storage
```bash
php artisan storage:link
```
Install AdminLTE
```bash
php artisan adminlte:install
```
Copy seeder images to storage folder
```bash
cp -R database/seeders/images/* storage/app/public/
```
Start the server via service you like. E.g. [Laravel Sail](https://laravel.com/docs/9.x/sail)
```bash
sail up -d
```
Run migrations and seeders
```bash
php artisan migrate --seed
```
To test subscription related functionalities, stripe and plans must be configured manually.

You are ready to go!

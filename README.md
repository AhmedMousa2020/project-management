## About Backend

Project Management Web App

## prerequisites

- PHP version 7.3 or higher
- composer installing
- Node installing

## Setup

- Clone repository
- Create '.env' file from sample '.env.example'
- Update DB credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD etc)
- Ensure you have PHP and apache server running. You can get this via 
[Wamp](https://www.wampserver.com/en/) or [Xammp](https://www.apachefriends.org/), 
- Open terminal and run 
  - `composer install && npm install`
  - `php artisan key:generate`
  - `php artisan migrate`
  - `php artisan db:seed` (for dummy data)
  - `php artisan serve`
- Navigate to 'localhost:8000' and see application is running

## Api's Notes

- api link for postman collection
  - your_serve\api\get-projects
  - your_serve\api\get-issues 
  - your_serve\api\get-user-issues?user_id

## database Notes
- admin-login: email => `admin1@example.com` , password => `password`

## Additional Notes
- thare are a PHP Decomntor Created in app folder  for http files
- if you want create a new one i provided to you a PHPDocomentor Script 
  you can use this command  php phpDocumentor.phar -d <`Folder you docement`>. -t <`dirctory save`> 
   to make it  

- you should craete folder name `files` in storge/app/public  dirctoey   



1. Clone the repository (https://gitlab.com/ikram9883740/novel_manager.git)
2. configure database in .env , for example:
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=yourdatabasename
        DB_USERNAME=root
        DB_PASSWORD=
3. create database in mysql
4. php artisan migrate
5. php artisan serve
6. php artisan test
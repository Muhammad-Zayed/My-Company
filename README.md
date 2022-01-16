## My Company
This is a multilanguage POS system .

## Installation

1- Clone the project or download the zip file .

2- Open the project folder and run the following commands: 

* install dependencies : 
```
composer install 
```

* Rename ` .env.example ` file to ` .env ` and run this command :
```
php artisan key:generate
```

* Database Conncetion :
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```


* run the migrations and seeder with this command :
```
php artisan migrate --seed
```

* link the storage
```
php artisan storage:link 
```

* run the project with this command 
```
php artisan serve 
```

* finally you can login with this credentials :
    * Email : ` admin@admin.com `
    * password  : ` password `







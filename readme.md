# MEGAHACK

Usuários

*Corretor
email: corretor@fkmail.com
senha: 123456

*Usuário
email: usuario@fkmail.com
senha: 123456

# Preparing enviroment

* requirements

``` 
PHP >= 7.1.3

```

```
 MariaDB 10.1.25

```

```
 Laravel 5.8

```

* Clone this repository
* Create a database and user in MySQL 
* Crete a `.env` file under `root` following `.env.example`;

* Update composer

    ```
    $ composer update
    ```

* Generate a key

    ```
    $ php artisan key:generate

    ```
* Update requirements and install migrate:

	```
	$ php artisan update
	$ php artisan migrate
	```

* Install fixtures:
	```
	$ php artisan db:seed
	```

# Working with

* To start server:

	```
	$ php artisan serve
	```



# MEGAHACK


# Preparing enviroment

* Clone this repository
* Create a database and user in MySQL 
* Crete a `.env` file under `root` following `.env.example`;

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








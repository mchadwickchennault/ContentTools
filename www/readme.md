# Setting up the Main Dev Environment
* Add `127.0.0.1       ct_mysql` to the end or your `/etc/hosts` file
* Cd into the `www` directory and run `composer install`
* Migrate the databases by running `php artisan migrate`
* Seed the database tables by running `php artisan db:seed`
* Open `http://localhost` and login using the following credentials:
    * email: `admin@admin.com`
    * password: `adminpw123`
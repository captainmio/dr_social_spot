# Installation
I only do the configuration using the .env file so please do the adjustment of the values to .env variables

**Step 1**: rename .env-example to .env file
<br />
**Step 2**: update the following variable(depending how you set-up your localserver)

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

APP_URL=http://127.0.0.1:8000/
```
**Step 3**: Run migration command to migrate the tables to the DB

```
php artisan migrate
```

**Step 4**: Run the following command below and you can now test the application

```
# for laravel
php artisan serve

# for vuejs
npm run watch
```

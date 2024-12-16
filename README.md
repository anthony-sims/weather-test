# Setup
The easiest setup for this project is using [Laravel Sail](https://laravel.com/docs/11.x/sail). A valid and working Docker setup can be instansiated with:

    $ sail up -d

## .env
The `.env.example` provides the basic necessities to get up and running, as per normal Laravel usage, a new `APP_KEY` will need to be generated:

    $ php artisan key:generate

## Initial Setup
In order to authenticate requests, a user first needs to be create which will generate an API key.

    $ php artisan app:create-user

Follow the promts to create a user which will return the users' API key for requests. This API key is a Bearer token and should be used for all Users and Posts.

There is a seeder to seed 20 posts.

    $ php artisan db:seed

## Weather API
This project makes use of the `rakibdevs/openweather-laravel-api` SDK to retrieve weather from the [OpenWeatherMap](https://openweathermap.org/api) API.

To ensure the weather API can connect, a valid API key is required to OpenWeatherMap. Once retrieved, ensure the API key is saved to `.env` as `OPENWEATHER_API_KEY`

The API is configured to refresh the weather for Perth once every 15 minutes and save this result to the Cache. If using the provided Sail setup, this will use Redis to cache. If the cache does not exist, a GET request to the weather endpoint will also save the result to the cache.

## API Docs
There is a Postman collection file in the root of this repo at `WeatherTest.postman_collection.json`

## Queue
The queue is configured as per standard Laravel usage. Calling `php artisan queue:work` will run the worker. The default .env is configured to use the database queue driver. For instant queue excecution, change the `QUEUE_CONNECTION` .env variable to `sync`
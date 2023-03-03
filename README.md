# exchange-rates-app
Display exchange rates of major currencies with a button to refresh values

## Installation
- Place provided .env file at `/.env` location
- Run `docker-compose build`
- Run `docker-compose up -d`
- Run `docker container ls` to get the running containers. Pick the ID of server container
- Run `docker-exec  {server-container-id} php artisan migrate`
- Open `http://localhost`

## Cache implementation
App will check for the time elapsed from last updated time from the API read from local database if it's less than a minute. Check `env('REFRESH_WINDOW')`
# exchange-rates-app
Display exchange rates of major currencies with a button to refresh values

## Installation
- Stop any web services listening on your local machine(e.g. `brew services stop httpd` or `sudo apachectl stop`)
- Place provided .env file at `/.env` location
- Run `docker compose build`
- Run `docker compose up -d`
- Run `docker exec -it app sh` to enter an interactive SSH session to the `app` container. Run followings on the `app` terminal
- `# php artisan key:generate`
- `# php artisan migrate`
- Open `http://localhost` on your local machine

## Cache implementation
App will check for the time elapsed from last updated time from the API read from local database if it's less than a minute. Check `env('REFRESH_WINDOW')`
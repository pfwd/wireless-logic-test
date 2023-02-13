#!/bin/bash
printf "=====================================================================\n"
printf "======== BOOTING WIRELESS LOGIC TEST: CLI IN ${APP_ENV} MODE ======\n\n"

#printf "Adjusting permissions for var/log and var/cache \n\n"
#mkdir -p var/log \
#    && mkdir -p var/cache \
#    && chown www-data:www-data -Rf var \
#    && chown www-data:www-data -Rf var/log \
#    && chown www-data:www-data -Rf var/cache

printf "Running composer install \n\n"
if [ "$APP_ENV" = "dev" ]; then
  composer install
elif [ "$APP_ENV" = "test" ]; then
   composer install
elif [ "$APP_ENV" = "prod" ]; then
  composer install --no-dev --optimize-autoloader --no-scripts
  composer dump-env prod --empty
fi

printf "\n\n==================== WIRELESS LOGIC TEST: CLI BOOTED IN ${APP_ENV} MODE =====================\n\n"
apachectl -D FOREGROUND


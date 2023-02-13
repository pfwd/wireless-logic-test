#!/bin/bash
printf "==========================================================\n"
printf "======== BOOTING WIRELESS LOGIC TEST in ${APP_ENV} mode ======\n\n"

printf "Adjusting permissions for var/log and var/cache \n\n"
mkdir -p var/log \
    && mkdir -p var/cache \
    && chown www-data:www-data -Rf var \
    && chown www-data:www-data -Rf var/log \
    && chown www-data:www-data -Rf var/cache



printf "\n\n==================== WIRELESS LOGIC TEST BOOTED =====================\n\n"
apachectl -D FOREGROUND


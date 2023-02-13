#!/bin/bash -x
# Xdebug will be installed if $XDEBUG_MODE is not "off"
printf "Installing Xdebug \n"
if [ "$XDEBUG_MODE" = "off" ]; then
   printf "XDEBUG_MODE = $XDEBUG_MODE Skipping ...... \n"
else
  printf "XDEBUG_MODE = $XDEBUG_MODE Installing \n"
  pecl install xdebug-3.2.0 && docker-php-ext-enable xdebug
fi

# Enable apache modules
a2enmod rewrite
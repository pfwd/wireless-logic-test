FROM php:8.2-apache-buster as  php-base

LABEL maintainer="Peter Fisher"

ARG XDEBUG_MODE="debug"
ARG APP_ENV="test"
ENV APP_ENV=$APP_ENV

ARG APP_DEBUG=0
ENV APP_DEBUG=$APP_DEBUG

ARG DEBIAN_FRONTEND=noninteractive

VOLUME /var/www/html

COPY ./infra/scripts/install_base.sh /tmp/
RUN chmod u+x /tmp/install_base.sh && /tmp/install_base.sh

COPY ./infra/scripts/install_php.sh /tmp/
RUN chmod u+x /tmp/install_php.sh && /tmp/install_php.sh

FROM composer/composer:2.5.2 as package-builder
WORKDIR /app
ARG APP_ENV
COPY ./app/composer.json .
COPY ./app/composer.lock .

COPY ./infra/scripts/install_composer_packages.sh /tmp/
RUN chmod u+x /tmp/install_composer_packages.sh && /tmp/install_composer_packages.sh

FROM php-base as app
WORKDIR /var/www/html
COPY --from=package-builder /usr/bin/composer /usr/bin/composer
COPY --chown=www-data:www-data --from=package-builder /app/vendor ./vendor
COPY --chown=www-data:www-data  ./app .

COPY ./infra/scripts/docker_entry_point.sh /
RUN chmod +x /docker_entry_point.sh

ENTRYPOINT ["/docker_entry_point.sh"]
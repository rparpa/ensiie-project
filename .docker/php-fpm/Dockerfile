FROM php:8.0-fpm

ARG DOCKER_USER
ARG DOCKER_USER_ID

RUN apt-get update -qq \
    && apt-get install -y --no-install-recommends \
        cmake \
        gettext-base \
        git \
        libcurl3-dev \
        libpq-dev \
        libssl-dev \
        libssl-doc \
        libxml2-dev \
        libzip-dev \
        make \
        openssh-client \
        sudo \
        wget \
        zlib1g-dev \
    && pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_pgsql \
        bcmath \
        xml \
        curl \
        zip \
    && ln -s /root/.composer/vendor/phing/phing/bin/phing /usr/bin/phing \
    && apt-get clean \
    && mkdir /nginx \
    && rm -rf /var/lib/apt/lists/* \
    && cd -

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy config
COPY ./config/ /docker/
ADD config/custom-php.ini /usr/local/etc/php/conf.d/custom-php.ini


# Add local user
RUN useradd --shell /bin/bash -u ${DOCKER_USER_ID} -o -c "" -m ${DOCKER_USER} \
    && adduser ${DOCKER_USER} sudo \
    && echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers \
    && export HOME=/home/${DOCKER_USER}

ENTRYPOINT ["/bin/bash", "/docker/entrypoint.sh"]
CMD ["php-fpm"]

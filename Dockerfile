FROM php:7.0-zts

RUN pecl install pthreads && printf "[pthreads]\n\nextension=pthreads.so\n" > usr/local/etc/php/conf.d/pthreads.ini

WORKDIR /app

CMD ["php", "-a"]

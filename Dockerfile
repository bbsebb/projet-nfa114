FROM php:8.1.4-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
# sendmail config
############################################

RUN apt-get update && apt-get install -q -y ssmtp mailutils

# root is the person who gets all mail for userids < 1000
RUN echo "root=yourAdmin@email.com" >> /etc/ssmtp/ssmtp.conf

# Here is the gmail configuration (or change it to your private smtp server)
RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthUser=sebastien.burckhardt@gmail.com" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthPass=shfhjwxcxxwwsiqz" >> /etc/ssmtp/ssmtp.conf

RUN echo "UseTLS=YES" >> /etc/ssmtp/ssmtp.conf
RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf


# Set up php sendmail config
RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini

# PDO config
############################################
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Apache config
############################################
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
&& sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
&& a2enmod rewrite
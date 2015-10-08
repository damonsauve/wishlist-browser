#!/bin/bash
apt-get update -y
apt-get install -y apache2 > /var/log/install-apache.out 2>&1
apt-get install -y php5 libapache2-mod-php5 php5-mcrypt php5-curl > /var/log/install-php5.out 2>&1

apt-get install -y php-pear > /var/log/install-pear.out 2>&1
apt-get install -y php5-dev apache2-prefork-dev build-essential > /var/log/install-apc.out 2>&1

mv /etc/php5/mods-available/opcache.ini /etc/php5/mods-available/opcache.ini.dist

apt-get install -y redis-server  > /var/log/install-redis.out 2>&1

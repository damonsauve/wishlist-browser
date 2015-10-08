#!/bin/bash

cd /var/tatcha-interview-project

mkdir smarty
mkdir smarty/templates
mkdir smarty/templates_c
mkdir smarty/cache
mkdir smarty/configs
chown www-data:www-data smarty/templates_c
chown www-data:www-data smarty/cache
chmod 775 smarty/templates_c
chmod 775 smarty/cache

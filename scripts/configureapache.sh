#!/bin/bash

SYMLINK='/etc/apache2/sites-enabled/000-default.conf'

if [ -h $SYMLINK ]; then
    unlink $SYMLINK > /var/log/apache-configure.out 2>&1
fi

SYMLINK='/etc/apache2/sites-enabled/tatcha-interview-project.conf'
FILE='/var/tatcha-interview-project/conf/tatcha-interview-project.conf'

if [ ! -h $SYMLINK ]; then
    ln -s $FILE $SYMLINK > /var/log/apache-configure.out 2>&1
fi

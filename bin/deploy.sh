#!/bin/sh

# Sync from home/repo to prod
# Need to run with sudo!
rsync -a --delete /home/pdw/dev.weinstein.org/www/ /var/www/html;
rsync -a --delete /home/pdw/dev.weinstein.org/lib/ /var/www/lib;

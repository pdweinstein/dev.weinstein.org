#!/bin/sh

# Sync from home/repo to prod
# Need to run with sudo!
rsync -a --delete /home/pdw/dev.weinstein.org/www/index.php /var/www/html/index.php;
rsync -a --delete /home/pdw/dev.weinstein.org/lib/ /var/www/lib;

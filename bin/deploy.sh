#!/bin/bash

if [[ -z "$1" ]]; then

	1>&2 echo "Deploy env arg missing"

elif [[ $1 == "prod" ]]; then

	# Sync from home/repo to prod
	rsync -a --delete /home/pdw/dev.weinstein.org/www/index.php /var/www/html/index.php;
	rsync -a --delete /home/pdw/dev.weinstein.org/www/after-dark/ /var/www/html/after-dark;
	rsync -a --delete /home/pdw/dev.weinstein.org/lib/ /var/www/lib;

elif [[ $1 == "dev" ]]; then

	# Sync from home/repo to dev
	rsync -a --delete /Users/pdw/Sites/dev.weinstein.org/www/index.php  /Library/WebServer/Documents/index.php;
	rsync -a --delete /Users/pdw/Sites/dev.weinstein.org/www/after-dark/  /Library/WebServer/Documents/after-dark;
	rsync -a --delete /Users/pdw/Sites/dev.weinstein.org/lib/  /Library/WebServer/lib;

fi

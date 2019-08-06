# Sync from home/repo to prod
# Need to run with sudo!
rsync -a --delete ~/dev/weinstein.org/www/ /var/www/html
rsync -a --delete ~/dev/weinstein.org/lib/ /var/www/lib


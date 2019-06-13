
# Execute composer
echo "Install Composer"
docker exec -ti geekshubs_php7 sh -c "cd .. && composer require --ignore-platform-reqs ext-pcntl ext-posix"

echo "Permisos a source"
docker exec -ti geekshubs_php7 sh -c "chown -R www-data:www-data /var/www/html"


echo "Migration"
docker exec -ti geekshubs_php7 sh -c "cd .. && php vendor/bin/phinx migrate -e development"

docker exec -ti geekshubs_php7 sh -c "cd .. && php vendor/bin/phinx seed:run -e development"

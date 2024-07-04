To launch project:
- Run "composer install"
- then run "php -S 127.0.0.1:8000 -t public" 
- open in browser "http://127.0.0.1:8000/" to run application


PHPStan:
- ./vendor/bin/phpstan analyse


PHP Code Sniffer (should be installed globally via composer):
- then "phpcs" to check, and "phpcbf" to fix


PHP Unit tests:
- ./vendor/bin/phpunit

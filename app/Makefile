check:
	vendor/bin/php-cs-fixer fix --using-cache=no
	vendor/bin/psalm --no-cache
	bin/console doctrine:database:drop --force
	bin/console doctrine:database:create
	bin/console doctrine:m:m -n -q
	bin/console doctrine:fixtures:load -n --append
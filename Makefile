git:
	git add -A
	opencommit
clean:
	find . -name '. DS_Store' -type f -delete
	php artisan optimize:clear
	composer upgrade
	npm upgrade
	./vendor/bin/pint

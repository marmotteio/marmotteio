git:
	git add -A
	git commit -m "Modified `git status --porcelain | grep 'M' | wc -l` file(s), Added `git status --porcelain | grep 'A' | wc -l` file(s), Removed `git status --porcelain | grep 'D' | wc -l` file(s)" -m "`git status --porcelain`"
clean:
	find . -name '. DS_Store' -type f -delete
	php artisan optimize:clear
	composer upgrade
	npm upgrade
	./vendor/bin/pint

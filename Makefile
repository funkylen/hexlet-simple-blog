install-local:
	cp .env.local .env
	composer install
	./vendor/bin/sail up -d
	./vendir/bin/sail artisan migrate
	@printf "Check http://localhost:8010\n"


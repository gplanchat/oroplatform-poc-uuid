.PHONY: install
install: vendor
	bin/console oro:install \
		--application-url=http://localhost:8000 \
		--env=prod \
		--organization-name="Winpub" \
		--user-name=admin \
		--user-email=hello@kiboko.fr \
		--user-firstname=Hippo \
		--user-lastname=Potamus \
		--user-password=password \
		--language=en \
		--formatting-code=en \
		--symlink \
		--timeout=0

.PHONY: uninstall
uninstall:
	rm -rf var/cache/*
	php -r "use Symfony\Component\Yaml\Yaml;require 'vendor/autoload.php';\$$data = Yaml::parseFile('config/parameters.yml');\$$data['parameters']['installed'] = null;file_put_contents('config/parameters.yml', Yaml::dump(\$$data));"

.PHONY: reinstall
reinstall: vendor uninstall
	bin/console oro:install \
		--application-url=http://localhost:8000 \
		--env=prod \
		--organization-name="Winpub" \
		--user-name=admin \
		--user-email=hello@kiboko.fr \
		--user-firstname=Hippo \
		--user-lastname=Potamus \
		--user-password=password \
		--language=en \
		--formatting-code=en \
		--symlink \
		--timeout=0 \
		--drop-database

vendor: composer.json composer.lock
	composer install

.PHONY: start
start:
	bin/console server:start 127.0.0.1:8000

.PHONY: stop
stop:
	bin/console server:stop

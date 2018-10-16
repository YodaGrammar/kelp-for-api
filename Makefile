DOCKER_COMPOSE  = docker-compose
DOCKER_EXEC     = $(DOCKER_COMPOSE) exec php
EXEC_PHP        = $(DOCKER_EXEC) php
COMPOSER        = $(DOCKER_EXEC) composer
SYMFONY         = $(EXEC_PHP) bin/console

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help

##
## Project
## -------
##

kill:
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

install: ## Install and start the project
install: .env start db

reset: ## Stop and start a fresh install of the project
reset: kill install

start: ## Start the project
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

stop: ## Stop the project
	$(DOCKER_COMPOSE) stop

clean: ## Stop the project and remove generated files
clean: kill
	rm -rf .env vendor node_modules

.PHONY: kill install reset start stop clean

##
## Lint
## -----
##

lint-twig: ## Check the syntax of your Twig templates
	$(SYMFONY) lint:twig ./templates

lint-php: ## Check the syntax of your PHP files
	$(EXEC_PHP) vendor/bin/php-cs-fixer fix --diff --dry-run -v

##
## Utils
## -----
##

db: ## Reset the database and load fixtures
db: .env vendor
	@$(DOCKER_EXEC) php -r 'echo "Wait database...\n"; set_time_limit(15); require __DIR__."/vendor/autoload.php"; (new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__."/.env"); $$u = parse_url(getenv("DATABASE_URL")); for(;;) { if(@fsockopen($$u["host"].":".($$u["port"] ?? 3306))) { break; }}'
	-$(SYMFONY) doctrine:database:drop --if-exists --force
	-$(SYMFONY) doctrine:database:create --if-not-exists
	$(SYMFONY) doctrine:migrations:migrate --no-interaction --allow-no-migration
	$(SYMFONY) doctrine:fixtures:load --no-interaction

migration: ## Generate a new doctrine migration
migration: vendor
	$(SYMFONY) doctrine:migrations:diff

db-validate-schema: ## Validate the doctrine ORM mapping
db-validate-schema: .env vendor
	$(SYMFONY) doctrine:schema:validate

.PHONY: db migration

##
## Tests
## -----
##

coverage: ## Run coverage unit tests
coverage: vendor
	$(EXEC_PHP) vendor/bin/phpunit --coverage-html --coverage-text

test: ## Run unit and functional tests
test: tu tf

tu: ## Run unit tests
tu: vendor
	$(EXEC_PHP) vendor/bin/phpunit --exclude-group functional

tf: ## Run functional tests
tf: vendor
	$(EXEC_PHP) vendor/bin/behat

.PHONY: tests tu tf

##
## Quality assurance
## -----------------
##

phpmd: ## PHP Mess Detector (https://phpmd.org)
	$(EXEC_PHP) vendor/bin/phpmd src text .phpmd.xml


phpcpd: ## PHP Copy/Paste Detector (https://github.com/sebastianbergmann/phpcpd)
	$(EXEC_PHP) vendor/bin/phpcpd src

pdepend: ## PHP_Depend (https://pdepend.org)
	$(EXEC_PHP) vendor/bin/pdepend \
		--summary-xml=$(ARTEFACTS)/pdepend_summary.xml \
		--jdepend-chart=$(ARTEFACTS)/pdepend_jdepend.svg \
		--overview-pyramid=$(ARTEFACTS)/pdepend_pyramid.svg \
		src/

phpcs: ## PHP CS (https://github.com/squizlabs/PHP_CodeSniffer)
	$(EXEC_PHP) vendor/bin/phpcs --standard=PSR2 src

.PHONY: pdepend phpmd phpcs phpcpd

# rules based on files
composer.lock: composer.json
	$(COMPOSER) update --lock --no-scripts --no-interaction

vendor: composer.lock
	$(COMPOSER) install

.env: .env.dist
	@if [ -f .env ]; \
	then\
		echo '\033[1;41m/!\ The .env.dist file has changed. Please check your .env file (this message will not be displayed again).\033[0m';\
		touch .env;\
		exit 1;\
	else\
		echo cp .env.dist .env;\
		cp .env.dist .env;\
	fi

.PHONY: ${TARGETS}
.DEFAULT_GOAL := help

STRIPE_MOCK_VERSION=0.44.0

define say_red =
    echo "\033[31m$1\033[0m"
endef

define say_green =
    echo "\033[32m$1\033[0m"
endef

define say_yellow =
    echo "\033[33m$1\033[0m"
endef

help:
	@echo "\033[33mUsage:\033[0m"
	@echo "  make [command]"
	@echo ""
	@echo "\033[33mAvailable commands:\033[0m"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort \
		| awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[32m%s\033[0m___%s\n", $$1, $$2}' | column -ts___

install: ## Install all applications
	@$(call say_green,"Downloading Stripe mock server")
	@curl -L "https://github.com/stripe/stripe-mock/releases/download/v${STRIPE_MOCK_VERSION}/stripe-mock_${STRIPE_MOCK_VERSION}_linux_amd64.tar.gz" -o "var/stripe-mock.tar.gz"
	@$(call say_green,"Unpacking Stripe mock server")
	@tar -zxf "var/stripe-mock.tar.gz" -C "var/"
	@$(call say_green,"Installin PHP dependencies")
	@composer install

start: ## Start application
	@var/stripe-mock > /dev/null &

stop: ## Stop the application
	@pkill stripe-mock || $(call say_red,"No running Stripe mock server")

test: ## Launch tests
	@vendor/bin/phpunit

cs-lint: ## Verify check styles
	-vendor/bin/php-cs-fixer fix --dry-run --using-cache=no --verbose --diff

cs-fix: ## Apply Check styles
	-vendor/bin/php-cs-fixer fix --using-cache=no --verbose --diff

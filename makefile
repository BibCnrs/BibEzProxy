.PHONY: help
.DEFAULT_GOAL := help

help:
	@test -f /usr/bin/xmlstarlet || echo "Needs: sudo apt-get install --yes xmlstarlet"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

cleanup-docker: ## remove all bibezproxy docker image
	test -z "$$(docker ps -a | grep bibezproxy)" || \
            docker rm --force $$(docker ps -a | grep bibezproxy | awk '{ print $$1 }')

run-dev: ## run bibezproxy for dev environment
	docker-compose -f docker-compose.dev.yml up

run-prod: ## run bibezproxy for production environment
	docker-compose -f docker-compose.prod.yml up

save-ws-key: ## save wskey.key from ezproxy docker image to locale folder
	docker cp bibezproxy_insb_1:/usr/local/ezproxy/wskey.key .

load-ws-key: ## load wskey.key from locale folder to ezproxy docker image
	docker cp ./wskey.key bibezproxy_insb_1:/usr/local/ezproxy/
	docker cp ./wskey.key bibezproxy_inshs_1:/usr/local/ezproxy/

cleanup-docker:
	test -z "$$(docker ps -a | grep bibezproxy_ezproxy_1)" || \
        docker rm --force $$(docker ps -a | grep bibezproxy_ezproxy_1 | awk '{ print $$1 }')
	test -z "$$(docker ps -a | grep bibezproxy_dnsmasq_1)" || \
            docker rm --force $$(docker ps -a | grep bibezproxy_ezproxy_1 | awk '{ print $$1 }')
run-dev:
	docker-compose up

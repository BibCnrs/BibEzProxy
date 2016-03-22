cleanup-docker:
	test -z "$$(docker ps -a | grep bibezproxy_ezproxy_1)" || \
        docker rm --force $$(docker ps -a | grep bibezproxy_ezproxy_1 | awk '{ print $$1 }')
	test -z "$$(docker ps -a | grep bibezproxy_dnsmasq_1)" || \
            docker rm --force $$(docker ps -a | grep bibezproxy_dnsmasq_1 | awk '{ print $$1 }')
run-dev:
	docker-compose up

save-ws-key:
	docker cp bibezproxy_ezproxy_1:/usr/local/ezproxy/wskey.key .

load-ws-key:
	docker cp ./wskey.key bibezproxy_ezproxy_1:/usr/local/ezproxy/

install:
	docker-compose up -d

console-test:
	docker-compose exec php-console composer test
api-test:
	docker-compose exec php-api composer test
console-logs:
	docker logs -f php-console
api-logs:
	docker logs -f php-api
test: console-test api-test

scraper:
	docker-compose exec php-console ./bin/console scraper

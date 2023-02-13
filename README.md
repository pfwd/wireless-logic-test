# Wireless Logic Test

## Install

Build the containers

```bash
make install
```

Please note that you may need to wait until the docker entry points are completed.

Check the logs to be sure that the containers are fully booted. 

You should a similar message to the following in the logs: 
```bash
==================== WIRELESS LOGIC TEST BOOTED =====================
```
To check the logs run the following

```bash
make api-logs
```

```bash
make console-logs
```

## Testing
The PHP containers can run the following tests
- PHP_CodeSniffer
- PHPStan (Max)
- PHPUnit

Test all the containers
```bash
make test
```

Test just the console container
```bash
make test-console
```

Test just the API container
```bash
make test-api
```

# Scraping the website
To scrap the website and build the database run the following.  

This will reset the database and reload the data from the scraped site.

```bash
make scraper
```

```bash
❯ make scraper
docker-compose exec php-console ./bin/console scraper make scraper                                                                                                                                          ✔ 
Resetting up database
Crawling site
Saving data: Basic: 500MB Data - 12 Months
Saving data: Standard: 1GB Data - 12 Months
Saving data: Optimum: 2 GB Data - 12 Months
Saving data: Basic: 6GB Data - 1 Year
Saving data: Standard: 12GB Data - 1 Year
Saving data: Optimum: 24GB Data - 1 Year
Done
```

# Configuring API host entry
Create a host entry of `pf-php-wireless-logic-test.local`

EG: 
```bash
// /etc/hosts

127.0.0.1 pf-php-wireless-logic-test.local
```

Reset the local hosts. On a Mac this is done like so `sudo killall -HUP mDNSResponder`

Now access [http://pf-php-wireless-logic-test.local](http://pf-php-wireless-logic-test.local)

To access the products go to [http://pf-php-wireless-logic-test.local/product](http://pf-php-wireless-logic-test.local/product)


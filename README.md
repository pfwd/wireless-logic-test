# Wireless Logic Test

## Requirements
- Make. If you don't have `Make` please see the `Makefile` to run the commands.
 
## Install

To build the containers run:

```bash
make install
```

Please note that you may need to wait until the Docker entry points are completed as they install Composer packages.

Check the logs to be sure that the containers are fully booted. 

You should a similar message to the following in the logs: 
```bash
==================== WIRELESS LOGIC TEST BOOTED =====================
```
To check the logs run the following

For the API container

```bash
make api-logs
```

For the console container

```bash
make console-logs
```

These commands follow the logs so use CTRL+C to exit the output

## Testing
The PHP containers run the following tests
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
To scrape the website and build the database run the following.  

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

## FAQ

### Where is the data stored?

The data is stored in SQLite and shared across both the php-console and php-api containers via a Docker volume. 
See `docker-compose` for more details.

### Why are there so many nested folders?

This is a mono-repo which currently contains the PHP apps. 

The folder structure allows for other apps built using Java or Python or another programming language. These apps (micro-services) could share data and proxy webserver.

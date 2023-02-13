<?php

namespace tests\PhpunitBundle\Command;

use Console\App\Command\ScraperCommand;
use Console\App\Crawler\DOMCrawler;
use Console\App\DataStore\Product;
use Console\App\Formatter\PriceFormatter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ScraperCommandDefaultTest extends TestCase
{
    /** @var CommandTester */
    private CommandTester $commandTester;

    public function testExecute()
    {
        $this->commandTester->execute([]);

        $display = trim($this->commandTester->getDisplay());
        $this->assertStringContainsString('Resetting up database', $display);
        $this->assertStringContainsString('Crawling site', $display);
        $this->assertStringContainsString('Done', $display);
    }



    protected function setUp(): void
    {
        $priceFormatterMock = $this->createMock(PriceFormatter::class);
        $crawlerMock = $this->createMock(DOMCrawler::class);
        $productModelMock = $this->createMock(Product::class);

        $application = new Application();
        $application->add(new ScraperCommand($priceFormatterMock, $crawlerMock, $productModelMock));
        $command = $application->find('scraper');
        $this->commandTester = new CommandTester($command);
    }

}
<?php

namespace tests\PhpunitBundle\Command;

use Console\App\Command\ScraperCommand;
use Console\App\Crawler\DOMCrawler;
use Console\App\DataStore\Product;
use Console\App\Formatter\PriceFormatter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DomCrawler\Crawler;

class ScraperCommandWithMockedCrawlerTest extends TestCase
{
    /** @var CommandTester */
    private CommandTester $commandTester;

    public function testExecute()
    {
        $this->commandTester->execute([]);

        $display = trim($this->commandTester->getDisplay());
        $this->assertStringContainsString('Saving data:', $display);
    }



    protected function setUp(): void
    {
        $priceFormatterMock = $this->createMock(PriceFormatter::class);
        $crawlerMock = $this->createMock(DOMCrawler::class);

        $fullPage = file_get_contents(__DIR__ .'/../fixtures/full_page.html');

        $crawler = new Crawler($fullPage);

        $crawlerMock->expects(self::once())->method('getDocumentCrawler')->willReturn($crawler);

        $productModelMock = $this->createMock(Product::class);

        $application = new Application();
        $application->add(new ScraperCommand($priceFormatterMock, $crawlerMock, $productModelMock));
        $command = $application->find('scraper');
        $this->commandTester = new CommandTester($command);
    }

}
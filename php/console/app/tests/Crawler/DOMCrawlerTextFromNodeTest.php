<?php declare(strict_types=1);

use Console\App\Crawler\DOMCrawler;
use PHPUnit\Framework\TestCase;

final class DOMCrawlerTextFromNodeTest extends TestCase
{

    public static function dataProvider(): array
    {

        return [
            [
                '<div class="header dark-bg"><h3>Optimum: 24GB Data - 1 Year</h3></div>',
                'h3',
                'Optimum: 24GB Data - 1 Year'
            ],
            [
                '<li><div class="package-name">The basic starter subscription providing you with all you need to get your device up and running with inclusive Data and SMS services.</div></li>',
                '.package-name',
                'The basic starter subscription providing you with all you need to get your device up and running with inclusive Data and SMS services.'
            ],
            [
                '<li><div class="package-price"><span class="price-big">£5.99</span><br>(inc. VAT)<br>Per Month</div></li>',
                '.price-big',
                '£5.99'
            ],
        ];
    }


    /**
     * @dataProvider dataProvider
     *
     * @param $fixture
     * @param $selector
     * @param $expected
     * @return void
     */
    public function testLoadDocument($fixture, $selector, $expected): void
    {
        $domCrawler = new DOMCrawler();
        $crawler = $domCrawler->getCrawler($fixture);
        $result = $domCrawler->getTextFromNode($crawler, $selector);

        self::assertSame($result, $expected);
    }
}
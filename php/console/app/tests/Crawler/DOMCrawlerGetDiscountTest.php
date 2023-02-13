<?php declare(strict_types=1);

use Console\App\Crawler\DOMCrawler;
use PHPUnit\Framework\TestCase;

final class DOMCrawlerGetDiscountTest extends TestCase
{

    public static function dataProvider(): array
    {
        return [
            [
                '<div class="package-price"><span class="price-big">£5.99</span><br>(inc. VAT)<br>Per Month</div>',
                '0'
            ],
            [
                '<div class="package-price"><span class="price-big">£9.99</span><br>(inc. VAT)<br>Per Month</div>',
                '0'
            ],
            [
                '<div class="package-price"><span class="price-big">£15.99</span><br>(inc. VAT)<br>Per Month</div>',
                '0'
            ],
            [
                '<div class="package-price"><span class="price-big">£15.99</span><br>(inc. VAT)<br>Per Month</div>',
                '0'
            ],
            [
                '<div class="package-price"><span class="price-big">£66.00</span><br>(inc. VAT)<br>Per Year<p style="color: red">Save £5.86 on the monthly price</p></div>',
                'Save £5.86 on the monthly price'
            ],
            [
                '<div class="package-price"><span class="price-big">£108.00</span><br>(inc. VAT)<br>Per Year<p style="color: red">Save £11.90 on the monthly price</p></div>',
                'Save £11.90 on the monthly price'
            ],
            [
                '<div class="package-price"><span class="price-big">£174.00</span><br>(inc. VAT)<br>Per Year<p style="color: red">Save £17.90 on the monthly price</p></div>',
                'Save £17.90 on the monthly price'
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     *
     * @param $fixture
     * @param $expected
     * @return void
     */
    public function testLoadDocument($fixture, $expected): void
    {
        $domCrawler = new DOMCrawler();
        $crawler = $domCrawler->getCrawler($fixture);
        $result = $domCrawler->getDiscountFromCrawler($crawler);

        self::assertStringContainsString($result, $expected);
    }
}
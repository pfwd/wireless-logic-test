<?php declare(strict_types=1);

use Console\App\Crawler\DomCrawler;
use PHPUnit\Framework\TestCase;

final class DOMCrawlerLoadDocumentTest extends TestCase
{

    public static function dataProvider(): array
    {
        return [
            [
                'http://google.com',
                '</html>'
            ],
            [
                'https://wltest.dns-systems.net/',
                '</html>'
            ],
            [
                'http://domain-does-not-exist',
                ''
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     *
     * @param $input
     * @param $expected
     *
     * @return void
     */
    public function testLoadDocument($input, $expected): void
    {
        $crawler = new DomCrawler();
        $result = $crawler->loadDocument($input);

        self::assertStringContainsString($expected, $result);
    }
}
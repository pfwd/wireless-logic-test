<?php declare(strict_types=1);

use Console\App\Crawler\DOMCrawler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

final class DOMCrawlerGetDocumentCrawlerTest extends TestCase
{

    public static function dataProvider(): array
    {
        return [
            [
                'http://google.com',
            ],
            [
                'https://wltest.dns-systems.net/',
            ],
            [
                'http://domain-does-not-exist',
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     *
     * @param $input
     *
     * @return void
     */
    public function testGetDocumentCrawler($input): void
    {
        $crawler = new DOMCrawler();
        $result = $crawler->getDocumentCrawler($input);

        self::assertInstanceOf(Crawler::class, $result);
    }
}
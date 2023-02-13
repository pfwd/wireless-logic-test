<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PriceFormatterAnnualPriceInPenniesTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     *
     * @param $priceText
     * @param $priceInPennies
     * @param $expected
     * @return void
     */
    public function testGetAnnualPriceFromText($priceText, $priceInPennies, $expected): void
    {
        $formatter = new Console\App\Formatter\PriceFormatter();
        $result = $formatter->getAnnualPriceFromText($priceText, $priceInPennies);

        self::assertSame($expected, $result);
    }

    public static function dataProvider(): array
    {
        return [
            [
                'test',
                 10,
                120
            ],
            [
                'Basic: 6GB Data - 1 Year',
                6600,
                6600
            ],
            [
                'Basic: 500MB Data - 12 Months',
                599,
                7188
            ],

        ];
    }
}
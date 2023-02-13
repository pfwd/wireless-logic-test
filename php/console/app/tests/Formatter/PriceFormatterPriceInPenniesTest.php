<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PriceFormatterPriceInPenniesTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     *
     * @param $input
     * @param $expected
     *
     * @return void
     */
    public function testGetPriceInPennies($input, $expected): void
    {
        $formatter = new Console\App\Formatter\PriceFormatter();
        $result = $formatter->getPriceInPennies($input);

        self::assertSame($expected, $result);
    }


    public static function dataProvider(): array
    {
        return [
            [
                'test',
                 0,
            ],
            [
                '0',
                0,
            ],
            [
                '0.0',
                0,
            ],
            [
                '5.99',
                599,
            ]
        ];
    }
}
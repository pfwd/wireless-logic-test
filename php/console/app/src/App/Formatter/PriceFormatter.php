<?php

namespace Console\App\Formatter;

class PriceFormatter
{
    /**
     * Returns the price in pennies by
     * converting the price string into a float and multiplying by 100
     *
     * @param string $price
     * @return int
     */
    public function getPriceInPennies(string $price = ''): int
    {
        // '5.99' is converted to 5.99 and multiply by 100
        $multiple = (float)$price * 100;

        // Cast the return to an int so 5.99 becomes 599
        return (int)$multiple;
    }

    /**
     * Gets the annual price from the provided string.
     * This searches for the word 'Year' in the string and multiples that by 12.
     *
     * @param string    $priceText      Price text
     * @param int|float $priceInPennies Price in pennies
     *
     * @return float|int
     */
    public function getAnnualPriceFromText(string $priceText, int|float $priceInPennies): float|int
    {
        return !str_contains($priceText, "Year") ? $priceInPennies * 12 : $priceInPennies;
    }
}
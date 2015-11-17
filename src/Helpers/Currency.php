<?php

/**
 * Currency.php
 *
 */
namespace sainsburyswebscraper\Helpers;

/**
 *
 * Currency
 */
class Currency
{

    /**
     * Currency map
     *
     * @var array
     */
    protected static $currencyMap = array(
        self::CODE_EUR => array(
            'symbol' => '€',
            'text'   => 'Euro'
        ),
        self::CODE_GBP => array(
            'symbol' => '£',
            'text'   => 'British Pound'
        ),
        self::CODE_EUR => array(
            'symbol' => '$',
            'text'   => 'US Dollar'
        )
    );

    // ISO 4217 currency code constants
    const CODE_EUR = 'EUR';
    const CODE_GBP = 'GBP';
    const CODE_USD = 'USD';

    /**
     * Get the corresponding currency code for a given symbol
     *
     * @param  string $symbol
     * @return mixed  (string|null)
     */
    public static function symbolToCode($symbol)
    {
        foreach (self::$currencyMap as $currencyCode => $currency) {
            if ($currency['symbol'] == $symbol) {
                return $currencyCode;
            }
        }
        return null;
    }

    /**
     * Get the currency text for a given currency code
     *
     * @param  string $code
     * @return mixed  (string|null)
     */
    public static function getText($code)
    {
        return isset(self::$currencyMap[$code]) ? self::$currencyMap[$code]['text'] : null;
    }
}

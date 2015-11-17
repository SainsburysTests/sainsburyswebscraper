<?php

/**
 * UnitPrice.php
 */
namespace sainsburyswebscraper\Models;

use sainsburyswebscraper\Abstracts\BaseModel;
use sainsburyswebscraper\Helpers\Currency;

/**
 *
 * UnitPrice
 *
 * @package SainsburysWebScraper
 *
 */
class UnitPrice extends BaseModel
{

    /**
     *
     * @var float
     */
    protected $amount;

    /**
     *
     * @var string
     */
    protected $currencySymbol;

    /**
     * Get the amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the currency symbol
     *
     * @return string
     */
    public function getCurrencySymbol()
    {
        return $this->currencySymbol;
    }

    /**
     * (non-PHPdoc)
     */
    public function toArray()
    {
        return array(
            'amount'   => round($this->getAmount(), 2),
            'currency' => Currency::symbolToCode($this->getCurrencySymbol())
        );
    }
}

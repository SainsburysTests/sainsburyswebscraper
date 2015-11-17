<?php

/**
 * UnitPriceMapper.php
 *
 */
namespace sainsburyswebscraper\Models\Mappers;

use sainsburyswebscraper\Abstracts\BaseMapper;
use sainsburyswebscraper\Models\UnitPrice as Model;
use Symfony\Component\DomCrawler\Crawler;

/**
 *
 * UnitPriceMapper
 *
 * @package sainsburyswebscraper
 *
 */
class UnitPriceMapper extends BaseMapper
{

    /**
     * Returns a new instance of the object the mapper corresponds to
     * or if false is passed just the namespace.
     *
     * @return Object
     */
    public static function create($returnObject = true)
    {
        return $returnObject ? new Model() : Model::class;
    }

    /**
     * Populate the object with the values from the node
     *
     * @param  Crawler $node
     * @return object
     */
    public static function populate(Crawler $node)
    {
        $map = array(
            'amount'         => (float) substr(self::getValue($node, '.pricing > .pricePerUnit'), 2),
            'currencySymbol' => substr(self::getValue($node, '.pricing > .pricePerUnit'), 0, 2)
        );

        return parent::fill(self::create(), $map);
    }
}

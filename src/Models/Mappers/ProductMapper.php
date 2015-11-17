<?php

/**
 * ProductMapper.php
 */
namespace sainsburyswebscraper\Models\Mappers;

use sainsburyswebscraper\Abstracts\BaseMapper;
use sainsburyswebscraper\Models\Product as Model;
use Symfony\Component\DomCrawler\Crawler;

/**
 *
 * ProductMapper
 *
 * @package SainsburysWebScraper
 *
 */
class ProductMapper extends BaseMapper
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
     * @return Object
     */
    public static function populate(Crawler $node)
    {
        // @formatter:off
        $map = array(
            'description' => trim(
                str_replace('Description', '', self::getValue($node, '.productText', null, self::CAST_TYPE_STRING))
            ),
            'size'        => SizeMapper::populate($node),
            'title'       => self::getValue($node, 'h1', null, self::CAST_TYPE_STRING),
            'unitPrice'   => UnitPriceMapper::populate($node)
        );
        // @formatter:on

        return parent::fill(self::create(), $map);
    }
}

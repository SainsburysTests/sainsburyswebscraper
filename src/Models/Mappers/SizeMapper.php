<?php

/**
 * SizeMapper.php
 *
 */
namespace sainsburyswebscraper\Models\Mappers;

use sainsburyswebscraper\Abstracts\BaseMapper;
use sainsburyswebscraper\Models\Size as Model;
use Symfony\Component\DomCrawler\Crawler;

/**
 *
 * SizeMapper
 *
 * @package sainsburyswebscraper
 *
 */
class SizeMapper extends BaseMapper
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
            'bytes' => mb_strlen($node->html(), '8bit')
        );

        return parent::fill(self::create(), $map);
    }
}

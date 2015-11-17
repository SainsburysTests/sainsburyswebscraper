<?php

/**
 * MapperContract.php
 *
 */
namespace sainsburyswebscraper\Interfaces;

use Symfony\Component\DomCrawler\Crawler;

/**
 *
 * MapperContract.php
 *
 */
interface MapperContract
{

    /**
     * Returns a new instance of the object the mapper corresponds to.
     *
     * @param  boolean $returnObject
     * @return object
     */
    public static function create($returnObject = true);

    /**
     * Returns the namespace of the object the mapper corresponds to
     *
     * @return string
     */
    public static function getModelNamespace();

    /**
     * Populate the object with values from a node
     *
     * @param  Crawler $data
     * @return object
     */
    public static function populate(Crawler $data);
}
